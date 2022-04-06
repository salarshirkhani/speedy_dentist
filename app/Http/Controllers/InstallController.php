<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;

/**
 * Class InstallController
 *
 * @package App\Http\Controllers
 * @category Controller
 */
class InstallController extends Controller
{
    /**
     * Method to load installation view
     *
     * @access public
     * @return mixed
     */
    public function index()
    {
        try {
            DB::connection()->getPdo();
        } catch (\Exception $e) {
            return view('install.manually');
        }

        if (Schema::hasTable('application_settings'))
            return redirect('login');
        
        return view('install.manually');
    }

    /**
     * Store a newly created resource in storage
     *
     * @param Request $request
     * @access public
     * @return mixed
     */
    public function install(Request $request)
    {
        try {
            DB::connection()->getPdo();
            if (Schema::hasTable('application_settings'))
                return redirect('login');
        } catch (\Exception $e) {
            ;
        }
        
        $this->validation($request);
        $data = [
            'APP_URL' => $request->app_url,
            'DB_HOST' => $request->host_name,
            'DB_PORT' => $request->database_port,
            'DB_DATABASE' => $request->database_name,
            'DB_USERNAME' => $request->database_username,
            'DB_PASSWORD' => $request->database_password
        ];
        $this->updateEnv($data);

        $isOk = $this->isConfigOk();
        if (!$isOk)
            return redirect('install?wrong=true')->withInput();

        Artisan::call('migrate', ['--force' => true]);
        Artisan::call('db:seed', ['--force' => true]);
        Artisan::call('storage:link', ['--force' => true]);

        $admin = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'status' => '1',
        ]);
        $admin->companies()->attach(1);
        $adminRole = Role::where('name', 'Super Admin')->first();
        $admin->assignRole([$adminRole->id]);

        return redirect('/');
    }

    /**
     * Store a newly created resource in storage
     *
     * @param Request $request
     * @access public
     * @return void
     */
    private function validation(Request $request)
    {
        $this->validate($request, [
            'app_url' => 'required',
            'host_name' => 'required',
            'database_port' => 'required',
            'database_name' => 'required',
            'database_username' => 'required',
            'database_password' => 'nullable',
            'name' => 'required',
            'email' => ['required', 'email'],
            'password' => ['required']
        ]);
    }

    /**
     * isConfigOk function
     *
     * @return boolean
     */
    private function isConfigOk()
    {
        try {
            DB::connection()->getPdo();
        } catch (\Exception $e) {
            return FALSE;
        }

        return TRUE;
    }

    /**
     * Method to update env
     *
     * @access public
     * @param $data
     * @return bool
     */
    private function updateEnv($data)
    {
        if(empty($data)||!is_array($data)||!is_file(base_path('.env')))
        {
            return false;
        }
        $env = file_get_contents(base_path('.env'));
        $env = explode("\n", $env);
        foreach ($data as $dataKey => $dataValue) {
            $updated = false;
            foreach ($env as $env_key => $env_value) {
                $entry = explode('=', $env_value, 2);
                if ($entry[0] == $dataKey) {
                    $env[$env_key] = $dataKey . '=' . $dataValue;
                    $updated = true;
                } else {
                    $env[$env_key] = $env_value;
                }
            }
            if (!$updated) {
                $env[] = $dataKey . '=' . $dataValue;
            }
        }
        $env = implode("\n", $env);
        file_put_contents(base_path('.env'), $env);
        Artisan::call('config:clear');
        Artisan::call('key:generate');
        Artisan::call('config:cache');
        return true;
    }
}
