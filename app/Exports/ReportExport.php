<?php

namespace App\Exports;

use App\Models\InvoiceItem;
use App\Models\Payment;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Concerns\FromView;

class ReportExport implements FromView
{
    protected $credits;
    protected $debits;

    public function __construct(Request $request)
    {
        $creditQuery = Payment::where('company_id', session('company_id'));
        $this->credits = $creditQuery->get();

        $debitQuery = InvoiceItem::query();
        $this->debits = $debitQuery->where('company_id', session('company_id'))->get();
    }

    /**
     * Undocumented function
     *
     * @return Illuminate\Contracts\View\View
     */
    public function view(): View
    {
        return view('exports.reports', [
            'credits' => $this->credits,
            'debits' => $this->debits
        ]);
    }
}
