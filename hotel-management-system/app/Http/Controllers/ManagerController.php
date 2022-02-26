<?php

namespace App\Http\Controllers;

use App\Models\manager;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ManagerController extends Controller
{

    public function loginForm()
    {
        return view('managerLogin.login');
    }
    public function Login(Request $request)
    {
        $check = $request->all();
        if (Auth::guard('manager')->attempt(['email' => $check['email'], 'password' => $check['password']])) {
            return redirect('/manager');
        } else {
            return back()->with('error', 'invalid email ');;
        }
    }

    public function logout(){
        Auth::guard('admin')->logout();
        return redirect()->route('login.form')->with('error', 'Admin Logout
            Successfully');
     }

    public function index()
    {
        $managers=manager::get();
        return view('dashboard.manager.index',['managers' => $managers]);
    }



    public function create()
    {
        return view('dashboard.manager.create');
    }


    public function store(Request $request)
    {
        //validation
        $request->validate([
            'email' =>'required|email',
            'name' =>'required|string|min:3|max:50',
            'password' =>'required|min:6',
            'national_id' =>'required|max:50',
            'avatar_img' =>'required|image|mimes:jpeg,png',
        ]);
        //$request->validate();
        //$request->validated();
        $img=$request->file('avatar_img');             //bmsek el soura
        $ext=$img->getClientOriginalExtension();   //bgeb extention
        $image="man -".uniqid().".$ext";            // conncat ext +name elgded
        $img->move(public_path("uploads/manager/"),$image);
        manager::create([
            'name'=>$request->name ,
            'email'=>$request->email,
            'password'=>Hash::make($request->password),
            'national_id'=>$request->national_id ,
            'avatar_img'=>$image,
        ]);

      return redirect(route('manager.index'));
    }


    public function show($id)
    {
        $manager=manager::findOrFail($id);
        return view('dashboard.manager.show',compact('manager'));

    }

    public function edit($id)
    {
        $manager=manager::findOrFail($id);
        return view('dashboard.manager.edit',compact('manager'));
    }


    public function update(Request $request, $id)
    {

        //validation
        $request->validate([
            'email' =>'required|email',
            'name' =>'required|string|min:3|max:50',
            'password' =>'required|min:6',
            'national_id' =>'required|max:50',
            'avatar_img' =>'image|mimes:jpeg,png',
        ]);
        //$request->validated();
        $manager=manager::findOrFail($id);
        $name=$manager->avatar_img;
        if ($request->hasFile('avatar_img'))
        {
            $img=$request->file('avatar_img');             //bmsek el soura
            $ext=$img->getClientOriginalExtension();   //bgeb extention
            $name="man -".uniqid().".$ext";            // conncat ext +name elgded
            $img->move(public_path("uploads/manager/"),$name);   //elmkan , $name elgded

        }

        $manager->update([
            'name'=>$request->name ,
            'email'=>$request->email,
            'password'=>Hash::make($request->password),
            'national_id'=>$request->national_id ,
            'avatar_img'=>$name,
        ]);

        return redirect(route('manager.index',$id));
    }


    public function destroy($id)
    {
        $manager=manager::findOrFail($id);
        $manager->delete();
        return redirect(route('manager.index'));
    }





}