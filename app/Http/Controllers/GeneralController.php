<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Currency;
use App\Models\Setting;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Contracts\Encryption\DecryptException;
use DB;
use Date;
use Session;
use App\Models\ApplicationSetting;
use App\Models\Company;
use App\Models\User;
use Carbon\Carbon;

class GeneralController extends Controller
{
    /**
     * Constructor
     */
    function __construct()
    {
        $this->middleware('permission:company-read|company-update', ['only' => ['index']]);
        $this->middleware('permission:company-update', ['only' => ['edit','update']]);
    }

	/**
     * Method to load general view
     *
     * @access public
     * @return mixed
     */
    public function index() {
        if (empty(Session::get('company_id'))) {
            return redirect()->route('company.index')->withError('Create Company First');
        } else {
            $id = Session::get('company_id');
            $company = Company::findOrFail($id);
            $company->setSettings();
            $currencies = Currency::where('company_id',$id)->pluck('name', 'code');
            $timezone = $this->timeZones();
            return view('settings.general.index', compact('company','currencies','timezone'));
        }
    }

    /**
 	* Method to check general section edit
 	*
 	* @access public
 	* @param Request $request
    */
 	public function edit(Request $request) {
        $request->validate([
            'company_name' => 'required',
            'company_email' => 'required',
            'company_address' => 'required',
            'company_logo' => ['nullable', 'image', 'mimes:png,jpg,jpeg']
        ]);
 		// $this->validate($request,['company_logo' => 'image|mimes:png,jpg,jpeg']);
 		$id = Session::get('company_id');
 		$data = Setting::where('company_id', $id)->get();
 		$company = Company::findOrFail($id);
        $company->setSettings();
        // tax number
		if (array_key_exists("company_tax_number", $company->toArray())) {
            $data = Setting::where('company_id', $id)
                ->where('key', 'general.company_tax_number')
                ->update(['value' => $request->company_tax_number]);
		} else {
		  	$data = Setting::create(['company_id' => $id, 'key' => 'general.company_tax_number', 'value' => $request->company_tax_number]);
		}
		// phone
		if (array_key_exists("company_phone", $company->toArray())) {
            $data = Setting::where('company_id', $id)
                ->where('key', 'general.company_phone')
                ->update(['value' => $request->company_phone]);
		} else {
		  	$data = Setting::create(['company_id' => $id, 'key' => 'general.company_phone', 'value' => $request->company_phone]);
		}
		// Logo
        if ($request->company_logo) {
            $logo = 'storage/' . $request->company_logo->store('companies');
            Setting::updateOrCreate(['company_id' => $id, 'key' => 'general.company_logo'], ['value' => $logo]);
        }

        if (array_key_exists("company_name", $company->toArray())) {
            $data = Setting::where('company_id', $id)
                ->where('key', 'general.company_name')
                ->update(['value' => $request->company_name]);
        }

        if (array_key_exists("company_email", $company->toArray())) {
            $data = Setting::where('company_id', $id)
                ->where('key', 'general.company_email')
                ->update(['value' => $request->company_email]);
        }

        if (array_key_exists("company_address", $company->toArray())) {
            $data = Setting::where('company_id', $id)
                ->where('key', 'general.company_address')
                ->update(['value' => $request->company_address]);
        }

        if($data) {
        	return redirect()->route('general')->withSuccess(trans('Company Information Updated Successfully'));
        } else {
        	return redirect()->back()->withErrors(trans('Something Went Wrong, Please Try Again'));
        }
 	}

 	/**
 	* Method to check general localisation section edit
 	*
 	* @access public
 	* @param Request $request
    */
 	public function localisation(Request $request) {

 		$id = Session::get('company_id');
 		$data = Setting::where('company_id', $id)->get();
 		$company = Company::findOrFail($id);
        $company->setSettings();

        // financial_start
		if (array_key_exists("financial_start", $company->toArray())) {
            $data = Setting::where('company_id', $id)
                ->where('key', 'general.financial_start')
                ->update(['value' => $request->financial_start]);
		} else {
		  	$data = Setting::create(['company_id' => $id, 'key' => 'general.financial_start', 'value' => $request->financial_start]);
		}

		// timezone
		if (array_key_exists("timezone", $company->toArray())) {
            $data = Setting::where('company_id', $id)
                ->where('key', 'general.timezone')
                ->update(['value' => $request->timezone]);
		} else {
		  	$data = Setting::create(['company_id' => $id, 'key' => 'general.timezone', 'value' => $request->timezone]);
		}

		// date_format
		if (array_key_exists("date_format", $company->toArray())) {
            $data = Setting::where('company_id', $id)
                ->where('key', 'general.date_format')
                ->update(['value' => $request->date_format]);
		} else {
		  	$data = Setting::create(['company_id' => $id, 'key' => 'general.date_format', 'value' => $request->date_format]);
		}

		// date_separator
		if (array_key_exists("date_separator", $company->toArray())) {
            $data = Setting::where('company_id', $id)
                ->where('key', 'general.date_separator')
                ->update(['value' => $request->date_separator]);
		} else {
		  	$data = Setting::create(['company_id' => $id, 'key' => 'general.date_separator', 'value' => $request->date_separator]);
		}

		// percent_position
		if (array_key_exists("percent_position", $company->toArray())) {
            $data = Setting::where('company_id', $id)
                ->where('key', 'general.percent_position')
                ->update(['value' => $request->percent_position]);
		} else {
		  	$data = Setting::create(['company_id' => $id, 'key' => 'general.percent_position', 'value' => $request->percent_position]);
		}

        if($data) {
        	return redirect()->route('general')->withSuccess(trans('Localisation Information Updated Successfully'));
        } else {
        	return redirect()->back()->withErrors(trans('Something Went Wrong, Please Try Again'));
        }
 	}
}
