<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Auth;
use Hash;

/**
 * Class ProfileController
 * @package App\Http\Controllers
 * @category Controller
 */
class ProfileController extends Controller
{
    /**
     * load constructor method
     *
     * @access public
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Method to load setting view
     *
     * @access public
     * @return mixed
     */
    public function setting()
    {
        $user = Auth::user()->id;
        $user = User::find($user);
        return view('auth.profile.setting', compact('user'));
    }

    /**
     * Method to update setting
     *
     * @param Request $request
     * @access public
     * @return mixed
     */
    public function updateSetting(Request $request)
    {
        $id = Auth::user()->id;
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email,'.$id,
            'photo' => ['nullable', 'image', 'mimes:png,jpg,jpeg']
        ]);
        $input = $request->only(['name','email']);
        if($request->photo)
            $input['photo'] = 'storage/' . $request->photo->store('profiles');

        $user = User::find($id);
        $user->update($input);
        return redirect()
            ->route('profile.setting')
            ->with('success','Account Settings Updated successfully');
    }

    /**
     * Method to load password view
     *
     * @access public
     * @return mixed
     */
    public function password()
    {
        $user = Auth::user()->id;
        $user = User::find($user);
        return view('auth.profile.changepassword', compact('user'));
    }

    /**
     * Method to update password
     *
     * @param Request $request
     * @access public
     * @return mixed
     */
    public function updatePassword(Request $request)
    {
        if (!(Hash::check($request->get('current-password'), Auth::user()->password)))
        {
            return redirect()->back()->with("error","Your current password does not matches with the password you provided. Please try again.");
        }
        if(strcmp($request->get('current-password'), $request->get('new-password')) == 0)
        {
            return redirect()->back()->with("error","New Password cannot be same as your current password. Please choose a different password.");
        }
        $validatedData = $request->validate([
            'current-password' => 'required',
            'new-password' => 'required|string|min:6|confirmed',
        ]);
        $user = Auth::user();
        $user->password = bcrypt($request->get('new-password'));
        $user->save();
        return redirect()->back()->with("success","Password Changed successfully !");
    }

    /**
     * Method to load view
     *
     * @access public
     * @return mixed
     */
    public function view()
    {
        $user = Auth::user()->id;
        $user = User::find($user);
        return view('auth.profile.view', compact('user'));
    }
}
