<?php

namespace App\Http\Controllers;

use App\Models\Currency;
use App\Models\Setting;
use Illuminate\Http\Request;
use App\Services\PayUService\Exception;
use Illuminate\Support\Facades\DB;

class CurrencyController extends Controller
{
    /**
     * Constructor
     *
     * @return void
     */
    function __construct()
    {
        $this->middleware('permission:currencies-read|currencies-create|currencies-update|currencies-delete', ['only' => ['index','show']]);
        $this->middleware('permission:currencies-create', ['only' => ['create','store']]);
        $this->middleware('permission:currencies-update', ['only' => ['edit','update']]);
        $this->middleware('permission:currencies-delete', ['only' => ['destroy']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $currencies = $this->filter($request)->paginate(10)->withQueryString();
        return view('currencies.index',compact('currencies'));
    }

    private function filter(Request $request)
    {
        $query = Currency::where('company_id', session('company_id'))->latest();

        if ($request->name)
            $query->where('name', 'like', '%'.$request->name.'%');

        if($request->code)
            $query->where('code', 'like', '%'.$request->code.'%');

        if($request->symbol)
            $query->where('symbol', '=', $request->symbol);

        return $query;
    }

    /**
     * Show data for the specified resource.
     *
     * @param  \App\Currency  $currency
     * @return \Illuminate\Http\Response
     */
    public function code(Request $request)
    {
        $json = new \stdClass();
        $code = request('code');
        if ($code) {
            $currency = config('money.' . $code);
            $currency['rate'] = isset($currency['rate']) ? $currency['rate'] : null;
            $currency['symbol_first'] = $currency['symbol_first'] ? 1 : 0;
            $json = (object) $currency;
        }
        return response()->json($json);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $currencies = config('money');
        return view('currencies.create')->with('data', $currencies);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required',
            'code' => 'required',
            'rate' => 'required',
            'precision' => 'required',
            'symbol' => 'required',
            'symbol_first' => 'required',
            'decimal_mark' => 'required',
            'thousands_separator' => 'required',
            'enabled' => 'required',
        ]);

        /**
         * Method to call db transaction
         */
        DB::beginTransaction();
        try {
            $data = new Currency;
            $data->company_id = session('company_id');
            $data->name = $request->name;
            $data->code = $request->code;
            $data->rate = $request->rate;
            $data->precision = $request->precision;
            $data->symbol = $request->symbol;
            $data->symbol_first = $request->symbol_first;
            $data->decimal_mark = $request->decimal_mark;
            $data->thousands_separator = $request->thousands_separator;
            $data->enabled = $request->enabled;
            $data->save();

            if ($request->enabled == "1") {
                Currency::where('company_id', session('company_id'))
                ->where('id', '!=', $data->id)
                ->update(['enabled' => 0]);
                Setting::where('company_id', session('company_id'))
                ->where('key', 'general.default_currency')
                ->update(['value' => $data->id]);
            }
            DB::commit();
            return redirect()->route('currency.index')->withSuccess(trans('Currency Information Inserted Successfully'));
        } catch (Exception $e) {
            DB::rollback();
            return redirect()->back()->withErrors($e->getMessage());
        }

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Currency  $currency
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, Currency $currency)
    {
        $currencies = config('money');
        $data = $currency;
        return view('currencies.edit', compact('data', 'currencies'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Currency  $currency
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Currency $currency)
    {
       $validatedData = $request->validate([
            'id' => 'required',
            'name' => 'required',
            'code' => 'required',
            'rate' => 'required',
            'precision' => 'required',
            'symbol' => 'required',
            'symbol_first' => 'required',
            'decimal_mark' => 'required',
            'thousands_separator' => 'required',
            'enabled' => 'required',
        ]);

       /**
         * Method to call db transaction
         */
        $data = $currency;
        DB::beginTransaction();
        try {
            $data->company_id = session('company_id');
            if($data->enabled == 1 && $request->enabled == 0) {
                return redirect()->back()->withErrors(trans('You Can Not Disable All The Status At A Time'));
            }
            $data->name = $request->name;
            $data->code = $request->code;
            $data->rate = $request->rate;
            $data->precision = $request->precision;
            $data->symbol = $request->symbol;
            $data->symbol_first = $request->symbol_first;
            $data->decimal_mark = $request->decimal_mark;
            $data->thousands_separator = $request->thousands_separator;
            $data->enabled = $request->enabled;
            $data->save();

            if ($request->enabled == "1") {
                Currency::where('company_id', session('company_id'))
                ->where('id', '!=', $data->id)
                ->update(['enabled' => 0]);
                Setting::where('company_id', session('company_id'))
                ->where('key', 'general.default_currency')
                ->update(['value' => $data->id]);
            }

            DB::commit();
            return redirect()->route('currency.index')->withSuccess(trans('Currency Information Updated Successfully'));
        } catch (Exception $e) {
            DB::rollback();
            return redirect()->back()->withErrors($e->getMessage());
        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Currency  $currency
     * @return \Illuminate\Http\Response
     */
    public function destroy(Currency $currency)
    {
        $data = $currency;
        if($data->enabled == 1) {
            return redirect()->route('currency.index')->withErrors(trans('You Can Not Delete An Enabled Currency'));
        }

       $data->delete();

       return redirect()->route('currency.index')->withSuccess(trans('Your Currency Has Been Deleted Successfully'));
    }
}
