<?php

namespace App\Http\Controllers;

use Spatie\Permission\Models\Role;
use App\Models\LabReportTemplate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class LabReportTemplateController extends Controller
{
    /**
     * Constructor
     */
    function __construct()
    {
        $this->middleware('permission:lab-report-template-read|lab-report-template-create|lab-report-template-update|lab-report-template-delete', ['only' => ['index','show']]);
        $this->middleware('permission:lab-report-template-create', ['only' => ['create','store']]);
        $this->middleware('permission:lab-report-template-update', ['only' => ['edit','update']]);
        $this->middleware('permission:lab-report-template-delete', ['only' => ['destroy']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $labReportTemplates = $this->filter($request)->paginate(10);
        return view('lab-report-template.index', compact('labReportTemplates'));
    }

    /**
     * Filter function
     *
     * @param Request $request
     * @return Illuminate\Database\Eloquent\Builder
     */
    private function filter(Request $request)
    {
        $query = LabReportTemplate::where('company_id', session('company_id'))->latest();
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
        return view('lab-report-template.create');
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
            LabReportTemplate::create($data);
        });
        return redirect()->route('lab-report-templates.index')->with('success', trans('Lab Report Templates Added Successfully'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\LabReportTemplate  $labReportTemplate
     * @return \Illuminate\Http\Response
     */
    public function show(LabReportTemplate $labReportTemplate)
    {
        return view('lab-report-template.show',compact('labReportTemplate'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\LabReportTemplate  $labReportTemplate
     * @return \Illuminate\Http\Response
     */
    public function edit(LabReportTemplate $labReportTemplate)
    {
        return view('lab-report-template.edit',compact('labReportTemplate'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\LabReportTemplate  $labReportTemplate
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, LabReportTemplate $labReportTemplate)
    {
        $this->validation($request, $labReportTemplate->id);
        $data = $request->only(['name','template']);
        $data['company_id'] = session('company_id');
        DB::transaction(function () use ($labReportTemplate, $data) {
            $labReportTemplate->update($data);
        });
        return redirect()->route('lab-report-templates.index')->with('success', trans('Lab Report Templates Edited Successfully'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\LabReportTemplate  $labReportTemplate
     * @return \Illuminate\Http\Response
     */
    public function destroy(LabReportTemplate $labReportTemplate)
    {
        $labReportTemplate->delete();
        return redirect()->route('lab-report-templates.index')->with('success', trans('Lab Report Templates Deleted Successfully'));
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
            'name' => ['required', 'string', 'max:255', 'unique:lab_report_templates,name,'.$id],
            'template' => ['required', 'string']
        ]);
    }
}
