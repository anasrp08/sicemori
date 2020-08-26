<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\File;

class SettingsController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function profile()
    {
        return view('settings.profile');
    }

    public function editProfile()
    {
        return view('settings.edit-profile');
    }

    public function updateProfile(Request $request)
    {
        $user = Auth::user();

        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|unique:users,email,' . $user->id,
            'avatar' => 'nullable',
        ]);

        $user->name = $request->get('name');
        $user->email = $request->get('email');
 
        if ($request->hasFile('avatar')) {
 
            $filename = null;
            $uploaded_avatar = $request->file('avatar');
            $extension = $uploaded_avatar->getClientOriginalExtension();
 
            $filename = md5(time()) . '.' . $extension;
            $destinationPath = public_path() . DIRECTORY_SEPARATOR . 'img';
 
            $uploaded_avatar->move($destinationPath, $filename);
 
            if ($user->avatar) {
                $old_avatar = $user->avatar;

               
                if (!$old_avatar == "member_avatar.png" || "admin_avatar.png") {
                    $filepath = public_path() . DIRECTORY_SEPARATOR . 'img' . DIRECTORY_SEPARATOR . $user->avatar;

                    try {
                        File::delete($filepath);
                    } catch (FileNotFoundException $e) { 
                    }
                }
            }

            // Ganti field cover dengan cover yang baru
            $user->avatar = $filename;
            $user->save();
        }

        $user->save();

        Session::flash("flash_notification", [
            "level" => "success",
            "icon" => "fa fa-check",
            "message" => "Profile berhasil diubah"
        ]);

        return redirect('settings/profile');
    }

    public function editPassword()
    {
        return view('settings.edit-password');
    }

    public function updatePassword(Request $request)
    {
        $user = Auth::user();
        $this->validate($request, [
            'password' => 'required|passcheck:' . $user->password,
            'new_password' => 'required|confirmed|min:6',
        ], [
            'password.passcheck' => 'Password lama tidak sesuai'
        ]);

        $user->password = bcrypt($request->get('new_password'));
        $user->save();

        Session::flash("flash_notification", [
            "level" => "success",
            "icon" => "fa fa-check",
            "message" => "Password berhasil dirubah"
        ]);

        return redirect('settings/password');
    }

}
