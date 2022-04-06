<?php

namespace App\Http\Controllers;

use App\Exports\PaymentExport;
use App\Models\AccountHeader;
use App\Models\Payment;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class PaymentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->export)
            return $this->doExport($request);

        $payments = $this->filter($request)->paginate(10);
        $accountHeaders = AccountHeader::where('status', '1')->get();

        return view('payments.index', compact('payments', 'accountHeaders'));
    }

    /**
     * Performs exporting
     *
     * @param Request $request
     * @return void
     */
    private function doExport(Request $request)
    {
        return Excel::download(new PaymentExport($request), 'Payments.xlsx');
    }

    /**
     * Filter function
     *
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    private function filter(Request $request)
    {
        $query = Payment::query();

        if ($request->account_name)
            $query->where('account_name', $request->account_name);

        if ($request->receiver_name)
            $query->where('receiver_name', 'like', $request->receiver_name.'%');

        if ($request->payment_date)
            $query->where('payment_date', $request->payment_date);

        return $query;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $accountHeaders = AccountHeader::where('type', 'Credit')->where('status', '1')->get();
        return view('payments.create', compact('accountHeaders'));
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
        $data = $request->only(['payment_date', 'receiver_name', 'description', 'amount']);
        $accountHeader = AccountHeader::find($request->account_name);
        $data['account_name'] = $accountHeader->name;
        $data['account_type'] = $accountHeader->type;
        $data['company_id'] = session('company_id');
        Payment::create($data);
        return redirect()->route('payments.index')->with('success', trans('Payment Added Successfully'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Payment  $payment
     * @return \Illuminate\Http\Response
     */
    public function show(Payment $payment)
    {
        return view('payments.show', compact('payment'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Payment  $payment
     * @return \Illuminate\Http\Response
     */
    public function edit(Payment $payment)
    {
        $accountHeaders = AccountHeader::where('type', 'Credit')->where('status', '1')->get();
        return view('payments.edit', compact('accountHeaders', 'payment'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Payment  $payment
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Payment $payment)
    {
        $this->validation($request);

        $data = $request->only(['payment_date', 'receiver_name', 'description', 'amount']);
        $accountHeader = AccountHeader::find($request->account_name);
        $data['account_name'] = $accountHeader->name;
        $data['account_type'] = $accountHeader->type;
        $payment->update($data);

        return redirect()->route('payments.index')->with('success', trans('Payment Updated Successfully'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Payment  $payment
     * @return \Illuminate\Http\Response
     */
    public function destroy(Payment $payment)
    {
        $payment->delete();
        return redirect()->route('payments.index')->with('success', trans('Payment Deleted Successfully'));
    }

    public function validation(Request $request)
    {
        $request->validate([
            'account_name' => ['required', 'integer', 'exists:account_headers,id'],
            'payment_date' => ['required', 'date'],
            'receiver_name' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string', 'max:1000'],
            'amount' => ['required', 'numeric']
        ]);
    }
}
