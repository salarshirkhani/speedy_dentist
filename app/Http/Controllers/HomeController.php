<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App;
use Illuminate\Support\Facades\Input;
use Auth;
use App\Models\User;

/**
 * Class HomeController
 * @package App\Http\Controllers
 * @category Controller
 */
class HomeController extends Controller
{
    /**
     * load constructor method
     *
     * @access public
     * @return void
     */
    public function __construct()
    {
        // $this->middleware('auth');
    }

    /**
     * Show the application dashboard
     *
     * @access public
     * @return mixed
     */
    public function index()
    {
        return redirect()->route('dashboard');
    }

    public function lang(Request $request)
    {
        $locale = $request->language;
        App::setLocale($locale);
        session()->put('locale', $locale);
        $user = auth()->user();
        if ($user)
            $user->update(['locale' => $locale]);

        return redirect()->back();
    }
}
