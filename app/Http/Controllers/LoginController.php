<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;
use DB;
class LoginController
{
    public function login(Request $request) : View
    {
        $credentials = $request->only('login', 'password');
        $users = DB::select('select * from user_profiles where login = ? and password = MD5(?) and user_groupId = 1', [
            $credentials['login'], $credentials['password']
        ]);

        if (count($users) > 0){
            return view('welcome', ['name' => $users[0]->login]);
        }
        else  return view('login');
    }


}
