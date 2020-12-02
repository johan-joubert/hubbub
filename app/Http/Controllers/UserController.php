<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;



use Illuminate\Support\Facades\DB;

use Auth;


class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index()
    {
        //
    }

    public function create()
    {
    }

    public function store()
    {

    }

    public function showAccount()
    {
        $user = auth()->user();
        return view('user.account', ['user' => $user]);
    }



    public function showUpdatePage()
    {
        $userId = auth()->user()->id;
        $user = User::findOrFail($userId);
        return view('user.update', ['user' => $user]);
    }

    public function showUpdatePagePassword()
    {
        $userId = auth()->user()->id;
        $user = User::findOrFail($userId);
        return view('user.editPassword', ['user' => $user]);
    }


    public function update(Request $request)
    {


        $userId = auth()->user()->id;
        $user = User::findOrFail($userId);

        $user->prenom = $request->input('prenom');
        $user->nom = $request->input('nom');
        $user->pseudo = $request->input('pseudo');
        $user->email = $request->input('email');
        $user->save();

        return redirect()->route('user.update');  

    }

    public function updatePassword(Request $request)
    {

        // $request->validate([
        //     'Oldpassword' => ['required', 'string', 'min:8', 'confirmed'],
        //     'confirmNewPassword' => ['required', 'string', 'min:8', 'confirmed'],
        // ]);
        
        $userId = auth()->user()->id;
        $user = User::findOrFail($userId);
        $password = $user->password;


        if (Hash::check($request->input('oldPassword'), $password)) {

            if($request->input('newPassword') == $request->input('confirmNewPassword')) {
            
                if($request->input('oldPassword') !== $request->input('confirmNewPassword')) {

                    $user->password = Hash::make($request->input('confirmNewPassword'));
                    $user->save();

                    return redirect()->route('user.account')->with('message', 'le mot de passe à bien été modifié');

                }
                else {
                    return redirect()->route('user.updatePassword')->withErrors(['password_error', 'mot de passe identique à l\'acien']);
                }
            } else {
                return redirect()->route('user.updatePassword')->withErrors(['password_error', 'mauvaise confirmation']);
            }
        }
        else {
            return redirect()->route('user.updatePassword')->withErrors(['password_error', 'mauvais mot de passe']);
        }
    }



    public function destroy($id)
    {
        //
    }
}
