<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
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
        return view('users.register');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $formFields = $request->validate([
            'name' => ['required','min:3'],
            'email' => ['email', 'required', Rule::unique('users', 'email')],
            'password' => ['required', 'confirmed', 'min:6'],
        ]);

        //Hash Password
        $formFields['password'] = bcrypt($formFields['password']);

        //Create User
        $user = User::create($formFields);

        // Authenticate User
        auth()->login($user);

        return redirect('/listings')->with('message', 'User created and logged in successfully');
        
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        //
    }
    public function login(){
        return view('users.login');
    }
    public function logout(Request $request){
        auth()->logout();
        $request->session()->invalidate();
        $request->session()->regenerate();
        return redirect('/listings')->with('message', 'Logged out successfully');
    }
    public function authenticate(Request $request){
        
            $formFields = $request->validate([
            'email' => ['email', 'required'],
            'password' => 'required',
        ]);

        if(auth()->attempt($formFields)){
        $request->session()->regenerate();

        return redirect('/listings')->with('message', 'You are now logged in');
     }
     else{
        return back()->withErrors(['email' => 'Email or password is incoreect'])->onlyInput('email');
    }
}
}
