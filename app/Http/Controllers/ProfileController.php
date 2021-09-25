<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Auth;

class ProfileController extends Controller
{
    private User $user;
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function __invoke()
    {
        return view("profile.index");
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $this->user = Auth::user();
        $this->check($request)
        ->props($request)
        ->setPassword($request)
        ->save();
        return back()->withSuccess("Profile Updated");
    }
    private function check(Request $request)
    {
        $id = auth()->user()->id;
        $request->validate([
            'name' => ["required","max:255"],
            "email" => ["required","email","max:255","unique:users,email,{$id}"],
            "password" => ["nullable","min:6","confirmed"],
        ]);
        return $this;
    }
    private function props(Request $request):object
    {
        $this->user->name = $request->name;
        $this->user->email = $request->email;
        return $this;
    }
    private function setPassword(Request $request):object
    {
        if ($request->has('password')) {
            $this->user->password = bcrypt($request->password);
        }
        return $this;
    }
    private function save():void
    {
        $this->user->save();
    }
}
