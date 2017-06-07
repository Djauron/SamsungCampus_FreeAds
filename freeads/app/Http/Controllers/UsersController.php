<?php

namespace freeads\Http\Controllers;

use freeads\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UsersController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('Users.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \freeads\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $id)
    {
        $user = User::find($id);
        return view('Users.show', ["user"=>$user]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \freeads\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, $id)
    {
        $user = User::find($id);

        if($user->id != Auth::id())
        {
            return redirect('users');
        }
        else
        {
            return view('Users.edit', ["user" => $user]);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \freeads\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $user = User::find($id);

        $this->validate($request, [
            'name' => 'required',
            'email' => 'required'
        ]);

        $user->name = $request->name;

        $user->email = $request->email;

        $info = "Profil mis a jour";

        if(!empty($request->new_password) && !empty($request->conf_password))
        {
            if($request->new_password == $request->conf_password)
            {
                $hash = Hash::make($request->new_password);
                $user->password = $hash;
                $info = "Mot de passe mis a jour";
            }
            else
            {
                $info = " Mot de passe different";
            }
        }

        $user->save();

        return view('Users.show', ["user" => $user , 'info' => $info]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \freeads\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        //
    }
}
