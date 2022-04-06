<?php

namespace App\Http\Controllers;

use App\Models\AccountHeader;
use App\Models\Company;
use App\Models\Insurance;
use App\Models\Invoice;
use App\Models\InvoiceItem;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Session;

class InvoiceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if (auth()->user()->hasRole('Patient'))
            $patients = User::role('Patient')->where('id', auth()->id())->where('status', '1')->get(['id', 'name']);
        else
            $patients = User::role('Patient')->where('status', '1')->get(['id', 'name']);
        
        $invoices = $this->filter($request)->paginate(10);
        return view('invoices.index', compact('invoices', 'patients'));
    }

    /**
     * Filter function
     *
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    private function filter(Request $request)
    {
        $query = Invoice::where('company_id', session('company_id'));

        if (auth()->user()->hasRole('Patient'))
            $query->where('user_id', auth()->id());
        elseif ($request->user_id)
            $query->where('user_id', $request->user_id);

        if ($request->invoice_date)
            $query->where('invoice_date', $request->invoice_date);

        return $query;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $accountHeaders = AccountHeader::where('type', 'Debit')->where('status', '1')->get();
        $insurances = Insurance::where('status', '1')->get();
        $patients = User::role('Patient')->where('company_id', session('company_id'))->where('status', '1')->get(['id', 'name']);
        return view('invoices.create', compact('accountHeaders', 'insurances', 'patients'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validation($request);

        DB::transaction(function () use ($request) {
            $invoice = Invoice::create([
                'company_id' => session('company_id'),
                'user_id' => $request->user_id,
                'insurance_id' => $request->insurance_id,
                'invoice_date' => Carbon::parse($request->invoice_date)
            ]);

            $this->storeInvoice($request, $invoice);
        });

        return redirect()->route('invoices.index')->with('success', trans('Invoice Added Successfully'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Invoice  $invoice
     * @return \Illuminate\Http\Response
     */
    public function show(Invoice $invoice)
    {
        if (auth()->user()->hasRole('Patient') && auth()->id() != $invoice->user_id)
            return redirect()->route('dashboard');
        
        $company = Company::find($invoice->company_id);
        $company->setSettings();
        return view('invoices.show', compact('company', 'invoice'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Invoice  $invoice
     * @return \Illuminate\Http\Response
     */
    public function edit(Invoice $invoice)
    {
        $accountHeaders = AccountHeader::where('type', 'Debit')->where('status', '1')->get();
        $insurances = Insurance::where('status', '1')->get();
        $patients = User::role('Patient')->where('company_id', session('company_id'))->where('status', '1')->get(['id', 'name']);
        return view('invoices.edit', compact('accountHeaders', 'insurances', 'invoice', 'patients'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Invoice  $invoice
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Invoice $invoice)
    {
        $this->validation($request);

        $invoice->invoiceItems()->delete();
        $this->storeInvoice($request, $invoice);

        return redirect()->route('invoices.index')->with('success', trans('Invoice Updated Successfully'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Invoice  $invoice
     * @return \Illuminate\Http\Response
     */
    public function destroy(Invoice $invoice)
    {
        $invoice->invoiceItems()->delete();
        $invoice->delete();

        return redirect()->route('invoices.index')->with('success', trans('Invoice Removed Successfully'));
    }

    /**
     * Stores invoce data
     *
     * @param Request $request
     * @param Invoice $invoice
     * @return void
     */
    private function storeInvoice(Request $request, Invoice $invoice)
    {
        DB::transaction(function () use ($request, $invoice) {
            $invoiceItems = [];
            $total = 0;
            foreach ($request->account_name as $key => $value) {
                $itemTotal = round(($request->quantity[$key] * $request->price[$key]), 2);
                $invoiceItems[] = [
                    'company_id' => session('company_id'),
                    'invoice_id' => $invoice->id,
                    'account_name' => $request->account_name[$key],
                    'description' => $request->description[$key],
                    'account_type' => 'Debit',
                    'quantity' => round($request->quantity[$key], 2),
                    'price' => round($request->price[$key], 2),
                    'total' => round($itemTotal, 2),
                    'created_at' => now(),
                    'updated_at' => now()
                ];

                $total += $itemTotal;
            }
            InvoiceItem::insert($invoiceItems);

            $grandTotal = round($total, 2);
            $totalDiscount = round($request->total_discount, 2);
            if ($request->discount_percentage > 0)
                $totalDiscount = ($request->discount_percentage / 100) * $total;
            $grandTotal -= round($totalDiscount, 2);

            $totalVat = round($request->total_vat, 2);
            if ($request->vat_percentage > 0)
                $totalVat = ($request->vat_percentage / 100) * $grandTotal;
            $grandTotal += round($totalVat, 2);

            $invoice->update([
                'insurance_id' => $request->insurance_id,
                'total' => round($total, 2),
                'discount_percentage' => round($request->discount_percentage, 2),
                'total_discount' => round($totalDiscount, 2),
                'vat_percentage' => round($request->vat_percentage, 2),
                'total_vat' => round($totalVat, 2),
                'grand_total' => round($grandTotal, 2),
                'paid' => round($request->paid, 2),
                'due' => round(($grandTotal - $request->paid), 2)
            ]);
        });
    }

    /**
     * Validation function
     *
     * @param Request $request
     * @return void
     */
    private function validation(Request $request)
    {
        $request->validate([
            'user_id' => ['required', 'integer', 'exists:users,id'],
            'insurance_id' => ['nullable', 'integer', 'exists:insurances,id'],
            'invoice_date' => ['required', 'date'],
            'vat_percentage' => ['required', 'numeric'],
            'total_vat' => ['required', 'numeric'],
            'discount_percentage' => ['required', 'numeric'],
            'total_discount' => ['required', 'numeric'],
            'paid' => ['required', 'numeric'],
            'account_name' => ['required', 'array'],
            'description' => ['required', 'array'],
            'quantity' => ['required', 'array'],
            'price' => ['required', 'array']
        ]);
    }
}
