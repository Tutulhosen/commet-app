<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AdminUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    /**
     * show user profile page
     */
    public function userprofile()
    {

        return view('admin.pages.users.profile');
    }

    /**
     * edit user profile info
     */
    public function editProfile(Request $request, $id)
    {
        $this->validate($request, [
            'name'          => 'required',
            'email'         => 'required',
            'cell'          => 'required',
        ]);

        $update_id = AdminUser::findOrFail($id);
        $update_id->update([
            'name'                  =>$request->name,
            'birthday'              =>$request->birthday,
            'email'                 =>$request->email,
            'cell'                  =>$request->cell,
            'location'              =>$request->location,
        ]);
        return redirect()->route('admin.user.profile')->with('success', 'successfully update your profile info');

    }


    /**
     * upload profile photo
     */
    public function uploadphoto(Request $request, $id)
    {
        $update_id= AdminUser::findOrFail($id);
        if ($request->hasFile('photo')) {
            $file= $request->file('photo');
            $file_name = md5(time() . rand()) . '.' . $file->clientExtension();
            $file->move(storage_path('app/public/adminUser'), $file_name);
            if ($update_id->photo != 'avatar.png') {
                unlink(storage_path('app/public/adminUser/' . $update_id->photo));
            }
            $update_id->update([
                'photo'     => $file_name
            ]);
            return back()->with('success' , 'successfully upload your profile photo');

        } else {
            return back();
        }
        
    }

    /**
     * change Admin User password
     */

     public function changePassword(Request $request, $id)
     {
        $this->validate($request, [
            'old_password'              =>'required',
            'password'                  =>'required|confirmed',
            'password_confirmation'     =>'required'
        ]);

        $user_id= AdminUser::findOrFail($id);
        if (password_verify($request->old_password, $user_id->password)==false) {
            return back()->with('warning', 'incorrect old password');
        } else {
            $user_id->update([
                'password'                  =>Hash::make($request->password),
            ]);
            return back()->with('success', 'successfully changed the password');
        }
        

     }




}
