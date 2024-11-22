<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class SessionController extends Controller
{
    public function login_post(Request $request)
    {


        if (auth()->attempt(request(['email', 'password'])) == false) {
            return back()->withErrors([
                'message' => 'The user or password are wrong!'
            ]);
        }


        $user = auth()->user();

        if ($user->role == 'Server' || $user->role == 'Chef' || $user->role == 'Busboy') {
            $usuarioActual = Auth::user();


            return redirect()->route('employee');


        } elseif ($user->role == 'Admin') {
            $usuarioActual = Auth::user();


            return redirect('adminindex');
        }else{
            return redirect()->route('loginindex');
        }


    }


    public function destroy(Request $request){

        auth()->logout();



        return redirect()->to('/');
    }
}

