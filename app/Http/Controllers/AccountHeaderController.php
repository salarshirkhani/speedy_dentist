<?php

namespace App\Http\Controllers;

use App\Models\AccountHeader;
use Illuminate\Http\Request;

class AccountHeaderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $accountHeaders = $this->filter($request)->paginate(10);
        return view('account-headers.index', compact('accountHeaders'));
    }

    /**
     * Filter function
     *
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function filter(Request $request)
    {
        $query = AccountHeader::where('company_id', session('company_id'));

        if ($request->name)
            $query->where('name', $request->name);

        if ($request->type)
            $query->where('type', $request->type);

        if ($request->status > -1)
            $query->where('status', $request->status);

        return $query;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('account-headers.create');
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
        $data = $request->only(['name', 'type', 'description', 'status']);
        $data['company_id'] = session('company_id');
        AccountHeader::create($data);
        return redirect()->route('account-headers.index')->with('success', trans('Account Header Added Successfully'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\AccountHeader  $accountHeader
     * @return \Illuminate\Http\Response
     */
    public function show(AccountHeader $accountHeader)
    {
        return view('account-headers.show', compact('accountHeader'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\AccountHeader  $accountHeader
     * @return \Illuminate\Http\Response
     */
    public function edit(AccountHeader $accountHeader)
    {
        return view('account-headers.edit', compact('accountHeader'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\AccountHeader  $accountHeader
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, AccountHeader $accountHeader)
    {
        $this->validation($request, $accountHeader->id);

        $data = $request->only(['name', 'type', 'description', 'status']);
        $accountHeader->update($data);

        return redirect()->route('account-headers.index')->with('success', trans('Account Header Updated Successfully'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\AccountHeader  $accountHeader
     * @return \Illuminate\Http\Response
     */
    public function destroy(AccountHeader $accountHeader)
    {
        $accountHeader->delete();

        return redirect()->route('account-headers.index')->with('success', trans('Account Header Deleted Successfully'));
    }

    /**
     * Validation function
     *
     * @param Request $request
     * @return void
     */
    private function validation(Request $request, $id=0)
    {
        $request->validate([
            'name' => ['required', 'string', 'unique:account_headers,name,'.$id, 'max:255'],
            'type' => ['required', 'in:Credit,Debit'],
            'description' => ['nullable', 'string', 'max:1000'],
            'status' => ['required', 'in:0,1']
        ]);
    }
}
