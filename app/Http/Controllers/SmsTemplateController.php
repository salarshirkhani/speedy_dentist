<?php

namespace App\Http\Controllers;

use Spatie\Permission\Models\Role;
use App\Models\SmsTemplate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SmsTemplateController extends Controller
{
    /**
     * Constructor
     */
    function __construct()
    {
        $this->middleware('permission:sms-template-read|sms-template-create|sms-template-update|sms-template-delete', ['only' => ['index','show']]);
        $this->middleware('permission:sms-template-create', ['only' => ['create','store']]);
        $this->middleware('permission:sms-template-update', ['only' => ['edit','update']]);
        $this->middleware('permission:sms-template-delete', ['only' => ['destroy']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $smsTemplates = $this->filter($request)->paginate(10);
        return view('sms-template.index', compact('smsTemplates'));
    }

    /**
     * Filter function
     *
     * @param Request $request
     * @return Illuminate\Database\Eloquent\Builder
     */
    private function filter(Request $request)
    {
        $query = SmsTemplate::where('company_id', session('company_id'))->latest();
        if ($request->name) {
            $query->where('name', 'like', $request->name.'%');
        }
        return $query;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('sms-template.create');
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
        $data = $request->only(['name','template']);
        $data['company_id'] = session('company_id');
        DB::transaction(function () use ($data) {
            SmsTemplate::create($data);
        });
        return redirect()->route('sms-templates.index')->with('success', trans('SMS Templates Added Successfully'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\SmsTemplate  $smsTemplate
     * @return \Illuminate\Http\Response
     */
    public function show(SmsTemplate $smsTemplate)
    {
        return view('sms-template.show',compact('smsTemplate'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\SmsTemplate  $smsTemplate
     * @return \Illuminate\Http\Response
     */
    public function edit(SmsTemplate $smsTemplate)
    {
        return view('sms-template.edit',compact('smsTemplate'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\SmsTemplate  $smsTemplate
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, SmsTemplate $smsTemplate)
    {
        $this->validation($request, $smsTemplate->id);
        $data = $request->only(['name','template']);
        $data['company_id'] = session('company_id');
        DB::transaction(function () use ($smsTemplate, $data) {
            $smsTemplate->update($data);
        });
        return redirect()->route('sms-templates.index')->with('success', trans('SMS Templates Edited Successfully'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\SmsTemplate  $smsTemplate
     * @return \Illuminate\Http\Response
     */
    public function destroy(SmsTemplate $smsTemplate)
    {
        $smsTemplate->delete();
        return redirect()->route('sms-templates.index')->with('success', trans('SMS Templates Deleted Successfully'));
    }

    /**
     * validation check for create & edit
     *
     * @param Request $request
     * @param integer $id
     * @return void
     */
    public function validation(Request $request, $id = 0)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'template' => ['required', 'string']
        ]);
    }
}
