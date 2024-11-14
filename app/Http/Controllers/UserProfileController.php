<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class UserProfileController
{
    public function create(Request $request){
        $parameters = $request->only('group', 'password', 'login');

        DB::insert('insert into user_profiles (login, user_groupId, password) values (?, ?, MD5(?))', [
            $parameters['login'], $parameters['group'], $parameters['password']
        ]);
        return redirect('/users');
    }

    public function update(Request $request){

        $parameters = $request->only('group', 'password', 'login', 'id');


        DB::table('user_profiles')
        ->where('id', $parameters['id'])
        ->update(['login' => $parameters['login'],
        'group' => $parameters['group'],
        'password' => $parameters['password'] != "" ?
        'password = MD5('.$parameters['password'].')' :
        DB::select('select password from user_profiles where id = ?', [$parameters['id']])
    ]);

        return redirect('/users');
    }


    public function delete(Request $request){
        $parameters = $request->only('id');

        DB::delete('delete from user_profiles where id = ?', [$parameters['id']]);
        return redirect('/users');
    }

}
