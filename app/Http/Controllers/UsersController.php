<?php

namespace App\Http\Controllers;

use App\Models\Users;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;


class UsersController extends Controller
{
    public function signIn(){

        if(session('USER_LOGIN')){
            return redirect('/dashboard');
        }else{
            return view('login');
        }

    }

    public function signUp(){
        return view('register');
    }

    public function userAuthentication(Request $request){

        $request->validate([
            'username' => 'required|digits:10',
            'password' => 'required',
        ]);

        $userInfo = Users::where('username', $request->username)->first();

        if ($userInfo && Hash::check($request->password, $userInfo->password)) {
            $request->session()->put('USER_LOGIN', true);
            $request->session()->put('USER_ID', $userInfo->id);
            $request->session()->put('USER_NAME', $userInfo->username);
            return redirect('/dashboard');
        } else {
            $errorMessage = $userInfo ? 'Invalid password. Please try again.' : 'Invalid credentials. Please try again.';
            return back()->with('error', $errorMessage)->withInput();
        }
    }

    public function dashboard()
    {
        return view('admin.dashboard');
    }


    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Users $users)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Users $users)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Users $users)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Users $users)
    {
        //
    }

    public function userLogout()
    {
        Session::flush();
        return redirect('/');
    }
}
