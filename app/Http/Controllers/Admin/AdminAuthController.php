<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class AdminAuthController extends Controller
{
    /**
     * show login page
     */
    public function ShowLoginPage()
    {
        return view('admin.pages.login');
    }

    /**
     * login process
     */
    public function login(Request $request)
    {
        $this->validate($request, [
            'auth'          =>'required',
            'password'      =>'required',
        ]);

        if (Auth::guard('admin')->attempt([ 'email' =>$request->auth, 'password' =>$request->password ]) || Auth::guard('admin')->attempt([ 'username' =>$request->auth, 'password' =>$request->password ]) || Auth::guard('admin')->attempt([ 'cell' =>$request->auth, 'password' =>$request->password ])) {

            if (Auth::guard('admin')->user()->status && Auth::guard('admin')->user()->trash==false) {
                return redirect()->route('admin.dashboard');
            } else {
                Auth::guard('admin')->logout();
                return redirect()->route('admin.login.page')->with('warning', 'Your account is blocked');
            }
            

        } else {
            return redirect()->route('admin.login')->with('warning', 'Email or password is incorrect');
        }
        
    }

    /**
     * admin user logout process
     */
    public function logOut()
    {
        Auth::guard('admin')->logout();
        return redirect()->route('admin.login.page');
    }


}
