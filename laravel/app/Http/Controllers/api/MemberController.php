<?php
namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use app\Http\Controllers\Controller;
use app\Models\Member;
use Illuminate\Support\Facades\Validator;

class MemberController extends Controller
{

public function login(Request $requset){
    // dd($requset->all());die();
    $user = Member::where('nama_member', $requset->nama_member)->first();

    if($user){

        $user->update([
            'fcm' => $requset->fcm
        ]);

        if(password_verify($requset->password, $user->password)){
            return response()->json([
                'success' => 1,
                'message' => 'Selamat datang '.$user->name,
                'user' => $user
            ]);
        }
        return $this->error('Password Salah');
    }
    return $this->error('Email tidak terdaftar');
}

public function error($pasan){
    return response()->json([
        'success' => 0,
        'message' => $pasan
    ]);
}

}