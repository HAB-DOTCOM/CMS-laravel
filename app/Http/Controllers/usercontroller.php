<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Http\Requests\users\updaterequest;

class usercontroller extends Controller
{
    //
    public function index(){
        return view('users.index')->with('users',User::all());
    }
    public function makeadmin(user $user){
        $user->role='admin';
        $user->save();
        session()->flash('success','user made admin successfully!');
        return redirect(route('users.index'));
    }
    public function edit(){

        return view('users.edit')->with('user',auth()->user());
        
    }
    public function update(updaterequest $request){
        $user =auth()->user();
        $user->update([
            'name'=>$request->name,
            'about'=>$request->about
        ]);
        session()->flash('success','users profile updated successfully!');
        return redirect()->back();
    }
}
