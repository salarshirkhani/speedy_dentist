<?php

namespace App\Exports;

use App\Models\Payment;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Concerns\FromView;

class PaymentExport implements FromView
{
    protected $payments;

    public function __construct(Request $request)
    {
        $query = Payment::query();
        
        $this->payments = $query->get();
    }

    /**
     * Undocumented function
     *
     * @return Illuminate\Contracts\View\View
     */
    public function view(): View
    {
        return view('exports.payments', [
            'payments' => $this->payments
        ]);
    }
}
