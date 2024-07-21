<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Exception;
use Illuminate\Http\RedirectResponse;

class AuthController extends Controller
{
    //
    public function signup(Request $request)
    {
        //signup  process
        $request->validate([
            'name' => 'required',
            'phone' => 'required',
            'password' => 'required',

        ]);

        try {

            $user = User::create([
                'name' => $request->name,
                'phone' => $request->phone,
                'email' => $request->email,
                'password' => Hash::make($request->password),
            ]);
            Auth::login($user);

            return redirect('/');
        } catch (Exception $e) {
            return redirect()->back()->withErrors($e->getMessage());
        }
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'login_id' => 'required',
            'password' => 'required',

        ]);

        // 
        if (Auth::attempt($credentials)) {
            //user verified
            if (Auth::user()->hasRole('admin')) {
                session(['role' => 'admin']);
                return redirect('admin');
            } else if (Auth::user()->hasRole('admission')) {
                session(['role' => 'admission']);
                return redirect('admission');
            } else if (Auth::user()->hasRole('library')) {
                session(['role' => 'library']);
                return redirect('library');
            }

            // return  redirect('login/as');
            // echo "validated";
        } else {
            //user not verified
            return redirect()->back()->with(['warning' => 'User credentials incorrect !']);
        }
    }
    // login step2

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function signout()
    {
        //destroy session
        session()->flush();
        Auth::logout();
        return redirect('/');
    }

    public function changePassword(Request $request)
    {
        $user = Auth::user();
        //change password process
        $request->validate([
            'current' => 'required',
            'new' => 'required',
        ]);

        try {

            if (Hash::check($request->current, $user->password)) {
                $user->password = Hash::make($request->new);
                $user->save();
                return redirect()->back()->with('success', 'successfuly changed');
            } else {
                //password not found
                return redirect()->back()->with('warning', 'Oops, something wrong!');;
            }
        } catch (Exception $e) {
            return redirect()->back()
                ->withErrors($e->getMessage());
            // something went wrong
        }
    }
}
