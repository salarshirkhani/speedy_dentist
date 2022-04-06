<?php

namespace App\Http\Controllers;

use App\Models\EmailTemplate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class EmailTemplateController extends Controller
{
    /**
     * Constructor
     */
    function __construct()
    {
        $this->middleware('permission:email-template-read|email-template-create|email-template-update|email-template-delete', ['only' => ['index','show']]);
        $this->middleware('permission:email-template-create', ['only' => ['create','store']]);
        $this->middleware('permission:email-template-update', ['only' => ['edit','update']]);
        $this->middleware('permission:email-template-delete', ['only' => ['destroy']]);
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $emailTemplates = $this->filter($request)->paginate(10);
        return view('email-template.index', compact('emailTemplates'));
    }

    /**
     * Filter function
     *
     * @param Request $request
     * @return Illuminate\Database\Eloquent\Builder
     */
    private function filter(Request $request)
    {
        $query = EmailTemplate::where('company_id', session('company_id'))->latest();
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
        return view('email-template.create');
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
            EmailTemplate::create($data);
        });
        return redirect()->route('email-templates.index')->with('success', trans('Email Templates Added Successfully'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\EmailTemplate  $emailTemplate
     * @return \Illuminate\Http\Response
     */
    public function show(EmailTemplate $emailTemplate)
    {
        return view('email-template.show',compact('emailTemplate'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\EmailTemplate  $emailTemplate
     * @return \Illuminate\Http\Response
     */
    public function edit(EmailTemplate $emailTemplate)
    {
        return view('email-template.edit',compact('emailTemplate'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\EmailTemplate  $emailTemplate
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, EmailTemplate $emailTemplate)
    {
        $this->validation($request, $emailTemplate->id);
        $data = $request->only(['name','template']);
        $data['company_id'] = session('company_id');
        DB::transaction(function () use ($emailTemplate, $data) {
            $emailTemplate->update($data);
        });
        return redirect()->route('email-templates.index')->with('success', trans('Email Templates Edited Successfully'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\EmailTemplate  $emailTemplate
     * @return \Illuminate\Http\Response
     */
    public function destroy(EmailTemplate $emailTemplate)
    {
        $emailTemplate->delete();
        return redirect()->route('email-templates.index')->with('success', trans('Email Templates Deleted Successfully'));
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
