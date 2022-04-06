<?php

namespace App\Http\Controllers;

use App\Models\SmtpConfiguration;
use App\Models\ApplicationSetting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\DB;

class SmtpConfigurationController extends Controller
{
    /**
     * Constructor
     */
    function __construct()
    {
        $this->middleware('permission:smtp-read|smtp-create|smtp-update|smtp-delete', ['only' => ['index','show']]);
        $this->middleware('permission:smtp-create', ['only' => ['create','store']]);
        $this->middleware('permission:smtp-update', ['only' => ['edit','update']]);
        $this->middleware('permission:smtp-delete', ['only' => ['destroy']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $lists = SmtpConfiguration::latest()->paginate(10);
        return view('admin.smpt.list')->with('lists', $lists);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.smpt.add');
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
        $data = $request->only(['sender_name', 'sender_email', 'smtp_host', 'smtp_port', 'smtp_user', 'smtp_password', 'smtp_type', 'status']);

        $smtpConfiguration = SmtpConfiguration::create($data);
        $tableId = $smtpConfiguration->id;
        if( $request->status == '1') {
            DB::table('smtp_configurations')->where('id', '!=', $tableId)->update(['status' => '0']);
            $this->setEnv($smtpConfiguration);
        }

        return redirect()->route('smtp-configurations.index')->with('success', trans('New Smtp Information Inserted Successfully'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\SmtpConfiguration  $smtp_configuration
     * @return \Illuminate\Http\Response
     */
    public function show(SmtpConfiguration $smtp_configuration)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\SmtpConfiguration  $smtp_configuration
     * @return \Illuminate\Http\Response
     */
    public function edit(SmtpConfiguration $smtp_configuration)
    {
        $data = $smtp_configuration;
        return view('admin.smpt.edit', compact('data'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\SmtpConfiguration  $smtp_configuration
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, SmtpConfiguration $smtp_configuration)
    {
        $this->validation($request);
        $data = $request->only(['sender_name', 'sender_email', 'smtp_host', 'smtp_port', 'smtp_user', 'smtp_password', 'smtp_type', 'status']);

        $applicationSetting = ApplicationSetting::first();
        if($applicationSetting->is_demo == "1")
        {
            session()->flash('demo_error', trans('This Feature Is Disabled In Demo Version'));
            return redirect()->back();
        }

        $smtp_configuration->update($data);

        if( $request->status == '1')
        {
            DB::table('smtp_configurations')->where('id', '!=', $smtp_configuration->id)->update(['status' => '0']);
            $this->setEnv($smtp_configuration);
        }

        return redirect()->route('smtp-configurations.index')->with('success', trans('Smtp Information Updated Successfully'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\SmtpConfiguration  $smtp_configuration
     * @return \Illuminate\Http\Response
     */
    public function destroy(SmtpConfiguration $smtp_configuration)
    {
        $applicationSetting = ApplicationSetting::first();
        if($applicationSetting->is_demo == "1")
        {
            echo json_encode(array("success"=>2,"error"=>"<div class='alert alert-success text-center'>This Feature Is Disabled In Demo Version</div>"));
            return redirect()->back();
        }

        $smtp_configuration->delete();

        return redirect()->route('smtp-configurations.index')->with('success', trans('Smtp Information Deleted Successfully'));
    }

    /**
     * Sets .env configs for mail
     *
     * @param object $newValue
     * @return void
     */
    private function setEnv($newValue)
    {
        $path = base_path('.env');

        // rewrite file content with changed data
        if (file_exists($path)) {
            foreach (config('constant.mail_config') as $key => $value) {
                $dbKey = config('constant.mail_key_map')[$key];
                file_put_contents(
                    $path, str_replace(
                        $key.'="'.$value.'"',
                        $key.'="'.$newValue->$dbKey.'"',
                        file_get_contents($path)
                    )
                );
            }
            Artisan::call('config:cache');
        }
    }

    /**
     * validation function
     *
     * @param Request $request
     * @return void
     */
    private function validation(Request $request)
    {
        $this->validate($request, [
            'sender_name' => 'required|string|max:255',
            'sender_email' => 'required|email|max:255',
            'smtp_host' => 'required|max:255',
            'smtp_port' => 'required|max:255',
            'smtp_user' => 'required|max:255',
            'smtp_password' => 'required|max:255',
            'smtp_type' => 'required|max:255',
            'status' => 'required|in:0,1'
        ]);
    }
}
