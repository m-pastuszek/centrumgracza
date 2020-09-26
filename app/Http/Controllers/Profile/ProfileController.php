<?php

namespace App\Http\Controllers\Profile;

use App\Http\Controllers\Controller;
use App\Models\Profile;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Intervention\Image\Facades\Image;

class ProfileController extends Controller
{
    public function show()
    {
        $user = Auth::user();
        $username = $user->username;
        $editors = User::where('username', '!=', $username)->where('role_id', 3)->orderBy('first_name', 'asc')->get();

        return view('profiles.show', compact('user', 'editors'));
    }


    public function edit() {
        $user = Auth::user();
        return view('profiles.edit', compact('user'));
    }

    public function update(Request $request)
    {
        $this->validate(request(), [
            'first_name'    => 'required|min:2|max:50',
            'last_name'     => 'nullable|min:2|max:50',
            'email'         => 'required|email',
            'birth_date'    => 'required',
            'gender'        => 'required',
            'facebook_url'  => 'nullable|url|max:255',
            'twitter_url'   => 'nullable|max:255',
            'instagram_url' => 'nullable|max:255',
            'twitch_url'    => 'nullable|max:255',
            'website_url'   => 'nullable|max:255',
            'my_hardware'   => 'nullable',
            'bio'           => 'nullable',
            'avatar'        => 'image|mimes:jpeg,png,jpg,gif,svg'
            ]);

        $user = Auth::user();

        // Checking if user profile exists
        if ($user->profile == null) {
            $profile = new Profile();
            $user->profile()->save($profile);
        } else {
            $user->profile->save();
        }

        if($request->hasFile('avatar'))
        {
            $avatar = $request->avatar;

            if($user->profile->avatar != ''  && $user->profile->avatar != null){
                $file_old = public_path('/storage/' . $user->profile->avatar);
                unlink($file_old);
            }

            $avatar_new_name = time() . '_' . $user->id .'_'. $avatar->getClientOriginalName();

            Image::make($avatar)->resize(300, 300)->save(public_path('/storage/users/avatars/' . $avatar_new_name));

            $user->profile->avatar = '/users/avatars/' . $avatar_new_name;

            $user->profile->save();

        }

        $user->first_name               = request('first_name');
        $user->last_name                = request('last_name');
        $user->email                    = request('email');
        $user->profile->birth_date      = request('birth_date');
        $user->profile->gender          = request('gender');
        $user->profile->facebook_url    = request('facebook_url');
        $user->profile->twitter_url     = request('twitter_url');
        $user->profile->instagram_url   = request('instagram_url');
        $user->profile->twitch_url      = request('twitch_url');
        $user->profile->website_url     = request('website_url');
        $user->profile->my_hardware     = request('my_hardware');
        $user->profile->bio             = request('bio');

        $user->profile->save();
        $user->save();

        Session::flash('alert-darken-success', 'success');
        Session::flash('message', 'Twoje konto zostało pomyślnie zaktualizowane!');

        return redirect()->back();
    }

    public function changePassword() {
        $user = Auth::user();
        return view('profiles.password-change', compact('user'));
    }

    public function updatePassword(Request $request)
    {
        $user = Auth::user();

        $this->validate($request, [
            'old_password'              => ['required', function ($attribute, $value, $fail) {
                if (!\Hash::check($value, Auth::user()->password)) {
                    return $fail(__('Wprowadzono nieprawidłowe hasło.'));
                }
            }],
            'password'                  => 'required|min:6|confirmed',
            'password_confirmation'     => 'required'
        ]);

        $user->password = bcrypt($request->password);

        $user->save();

        Session::flash('alert-darken-success', 'success');
        Session::flash('message', 'Twoje hasło zostało pomyślnie zmienione!');

        return redirect()->back();
    }



}
