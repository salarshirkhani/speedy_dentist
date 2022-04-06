<?php

namespace App\Http\Controllers;

use App\Models\Tax;
use Illuminate\Http\Request;
use App\Services\PayUService\Exception;
use Illuminate\Support\Facades\DB;

class TaxController extends Controller
{
    /**
     * Constructor
     *
     * @return void
     */
    function __construct()
    {
        $this->middleware('permission:tax-rate-read|tax-rate-create|tax-rate-update|tax-rate-delete', ['only' => ['index','show']]);
        $this->middleware('permission:tax-rate-create', ['only' => ['create','store']]);
        $this->middleware('permission:tax-rate-update', ['only' => ['edit','update']]);
        $this->middleware('permission:tax-rate-delete', ['only' => ['destroy']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $taxes = $this->filter($request)->paginate(10)->withQueryString();
        return view('tax.index',compact('taxes'));
    }

    private function filter(Request $request)
    {
        $query = Tax::where('company_id', session('company_id'))->latest();
        if ($request->name)
            $query->where('name', 'like', $request->name.'%');

        if (isset($request->type))
            $query->where('type', $request->type);

        return $query;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('tax.create');
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
            'rate' => 'required|numeric',
            'type' => 'required',
            'enabled' => 'required',
        ]);

        /**
         * Method to call db transaction
         */
        DB::beginTransaction();
        try {
            $data = new Tax;
            $data->company_id = session('company_id');
            $data->name = $request->name;
            $data->rate = $request->rate;
            $data->type = $request->type;
            $data->enabled = $request->enabled;
            $data->save();

            DB::commit();
            return redirect()->route('tax.index')->withSuccess(trans('Tax Information Inserted Successfully'));
        } catch (Exception $e) {
            DB::rollback();
            return redirect()->back()->withErrors($e->getMessage());
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Tax  $tax
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, Tax $tax)
    {
        return view('tax.edit', ['data' => $tax]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Tax  $tax
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Tax $tax)
    {
        $validatedData = $request->validate([
            'name' => 'required',
            'rate' => 'required|numeric',
            'type' => 'required',
            'enabled' => 'required',
        ]);

        /**
         * Method to call db transaction
         */
        DB::beginTransaction();
        try {
            $data = $tax;
            $data->company_id = session('company_id');
            $data->name = $request->name;
            $data->rate = $request->rate;
            $data->type = $request->type;
            $data->enabled = $request->enabled;
            $data->save();

            DB::commit();
            return redirect()->route('tax.index')->withSuccess(trans('Tax Information Updated Successfully'));
        } catch (Exception $e) {
            DB::rollback();
            return redirect()->back()->withErrors($e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Tax  $tax
     * @return \Illuminate\Http\Response
     */
    public function destroy(Tax $tax)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Currency  $tax
     * @return \Illuminate\Http\Response
     */
    public function delete($id)
    {
       $data = Tax::find(decrypt($id));
       $data->delete();
       return redirect()->route('tax.index')->withSuccess(trans('Your Tax Info Has Been Deleted Successfully'));
    }
}

