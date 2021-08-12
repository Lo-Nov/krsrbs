<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;

class GSPAuth extends Controller
{
    public function auth(Request $request){
        $url = config('base.auth_URL').'/RevenueSure/api/Account/GetToken';

        $payload = $request->validate([
            'user_name' => ['required', 'string', 'max:255'],
            'password' => 'required'
        ]);

        $data = json_decode(Http::post($url,$payload)->body());

        if ($data->status_code !=200){
            return Redirect::back()->withErrors($data->message);
        }

        Session::put('first_name', $data->first_name);
        Session::put('roles', $data->roles);
        Session::put('is_login', 1);

        return redirect()->route('dashboard');

    }
}
