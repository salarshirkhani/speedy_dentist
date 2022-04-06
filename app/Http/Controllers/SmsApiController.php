<?php

namespace App\Http\Controllers;

use App\Models\SmsApi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SmsApiController extends Controller
{
    /**
     * Constructor
     */
    function __construct()
    {
        $this->middleware('permission:sms-api-read|sms-api-update', ['only' => ['index']]);
        $this->middleware('permission:sms-api-update', ['only' => ['index','update']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $smsApis = SmsApi::where('company_id', session('company_id'))->get();
        return view('sms-api.edit', compact('smsApis'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\SmsApi  $smsApi
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, SmsApi $smsApi)
    {
        $this->validation($request);
        $data = $request->only(['gateway', 'auth_id', 'auth_token', 'api_id','sender_number','status']);
        DB::transaction(function () use ($data,$smsApi,$request) {
            $smsApi->update($data);
            $tableId = $smsApi->id;
            if( $request->status == '1') {
                DB::table('sms_apis')->where('id', '!=', $tableId)->update(['status' => '0']);
            }
        });
        return redirect()->route('sms-apis.index')->with('success', trans('SMS Api Updated Successfully'));
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
            'gateway' => ['nullable', 'string'],
            'auth_id' => ['nullable', 'string', 'max:255'],
            'auth_token' => ['nullable', 'string', 'max:255'],
            'api_id' => ['nullable', 'string', 'max:255'],
            'status' => ['required', 'integer'],
        ]);
    }
}
