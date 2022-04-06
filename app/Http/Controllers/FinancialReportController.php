<?php

namespace App\Http\Controllers;

use App\Exports\ReportExport;
use App\Models\InvoiceItem;
use App\Models\Payment;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class FinancialReportController extends Controller
{
    /**
     * Constructor
     */
    function __construct()
    {
        $this->middleware('permission:financial-report-read', ['only' => ['index','doExport','filterInvoice','filterPayment']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->export)
            return $this->doExport($request);

        $credits = [];
        $debits = [];
        if ($request->date_from || $request->date_to) {
            $credits = $this->filterPayment($request)->get();
            $debits = $this->filterInvoice($request)->get();
        }

        return view('financial-reports.index', compact('credits', 'debits'));
    }

    /**
     * Performs exporting
     *
     * @param Request $request
     * @return void
     */
    private function doExport(Request $request)
    {
        return Excel::download(new ReportExport($request), 'Reports.xlsx');
    }

    /**
     * Filter function
     *
     * @param Request $request
     * @return Illuminate\Database\Eloquent\Builder
     */
    private function filterInvoice(Request $request)
    {
        $query = InvoiceItem::with(['invoice'])->where('company_id', session('company_id'))
            ->whereHas('invoice', function($q) use ($request) {
                if ($request->date_from && $request->date_to)
                    $q->whereBetween('invoice_date', [Carbon::parse($request->date_from)->format('Y-m-d'), Carbon::parse($request->date_to)->format('Y-m-d')]);
                else if ($request->date_from || $request->date_to)
                {
                    $order_date = $request->date_from ? $request->date_from : $request->date_to;
                    $q->whereDate('invoice_date', Carbon::parse($order_date)->format('Y-m-d'));
                }
            });

        return $query;
    }

    /**
     * Filter function
     *
     * @param Request $request
     * @return Illuminate\Database\Eloquent\Builder
     */
    private function filterPayment(Request $request)
    {
        $query = Payment::where('company_id', session('company_id'));

        if($request->date_from && $request->date_to)
            $query->whereBetween('payment_date', [Carbon::parse($request->date_from)->format('Y-m-d'), Carbon::parse($request->date_to)->format('Y-m-d')]);
        else if($request->date_from || $request->date_to)
        {
            $order_date = $request->date_from ? $request->date_from : $request->date_to;
            $query->whereDate('payment_date', Carbon::parse($order_date)->format('Y-m-d'));
        }

        return $query;
    }
}
