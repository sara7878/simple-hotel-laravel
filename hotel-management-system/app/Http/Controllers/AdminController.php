<?php

namespace App\Http\Controllers;

use App\Models\admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{

    public function loginForm()
    {
        return view('adminLogin.login');
    }
    public function Login(Request $request)
    {
        $check = $request->all();
        if (Auth::guard('admin')->attempt(['email' => $check['email'], 'password' => $check['password']])) {
            return redirect('/hotel');
        } else {
            return back()->with('error', 'invalid email ');;
        }
    }
    public function index()
    {
        $admins = admin::get();
        return view('dashboard.admin.index', ['admins' => $admins]);
    }




    public function create()
    {
        return view('dashboard.admin.create');
    }


    public function store(Request $request)
    {
        //validation
        $request->validate([
            'email' => 'required|email',
            'name' => 'required|string|min:3|max:50',
            'password' => 'required|min:6',
            'national_id' => 'required|max:50',
            'avatar_img' => 'required|image|mimes:jpeg,png',
        ]);
        //$request->validate();
        //$request->validated();
        $img = $request->file('avatar_img');             //bmsek el soura
        $ext = $img->getClientOriginalExtension();   //bgeb extention
        $image = "man -" . uniqid() . ".$ext";            // conncat ext +name elgded
        $img->move(public_path("uploads/admin/"), $image);
        admin::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'national_id' => $request->national_id,
            'avatar_img' => $image,
        ]);

        return redirect(route('admin.index'));
    }


    public function show($id)
    {
        $admin = admin::findOrFail($id);
        return view('dashboard.admin.show', compact('admin'));
    }

    public function edit($id)
    {
        $admin = admin::findOrFail($id);
        return view('dashboard.admin.edit', compact('admin'));
    }


    public function update(Request $request, $id)
    {

        //validation
        $request->validate([
            'email' => 'required|email',
            'name' => 'required|string|min:3|max:50',
            'password' => 'required|min:6',
            'national_id' => 'required|max:50',
            'avatar_img' => 'image|mimes:jpeg,png',
        ]);
        //$request->validated();
        $admin = admin::findOrFail($id);
        $name = $admin->avatar_img;
        if ($request->hasFile('avatar_img')) {
            $img = $request->file('avatar_img');             //bmsek el soura
            $ext = $img->getClientOriginalExtension();   //bgeb extention
            $name = "man -" . uniqid() . ".$ext";            // conncat ext +name elgded
            $img->move(public_path("uploads/admin/"), $name);   //elmkan , $name elgded

        }

        $admin->update([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'national_id' => $request->national_id,
            'avatar_img' => $name,
        ]);

        return redirect(route('admin.index', $id));
    }


    public function destroy($id)
    {
        $admin = admin::findOrFail($id);
        $admin->delete();
        return redirect(route('admin.index'));
    }
}
