<?php

namespace App\Http\Controllers;

use App\Models\receptionist;
use App\Models\manager;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;


class ReceptionistController extends Controller
{
   
    public function index()
    {
         
        $receptionists = receptionist::get(); 
       
      
        return view('dashboard.receptionist.index',['receptionists'=>$receptionists]);
    }

   
    public function create()
    {
        $receptionists =receptionist::get();
        $manager = manager::all();
        return view('dashboard.receptionist.create',compact('receptionists','manager'));
    }

  
    public function store(Request $request)
    {
        $request->validate([
            'email' =>'required|email',
            'name' =>'required|string|min:3|max:50',
            'password' =>'required|min:6',
            'national_id' =>'required|max:50',
            'manager_id' =>'required|max:50',
            'avatar_img' =>'required|image|mimes:jpeg,png',
        ]);


        $img=$request->file('avatar_img');
        $ext=$img->getClientOriginalExtension(); 
        $image="recp -".uniqid().".$ext"; 
        $img->move(public_path("uploads/receptionists/"),$image);
        receptionist::create([
        'name'=>$request->name ,
        'email'=>$request->email,
        'password'=>Hash::make($request->password),
        'national_id'=>$request->national_id ,
        'manager_id'=>$request->manager_id,
        'avatar_img'=>$image,
]);
return redirect()->route('dashboard.receptionist.index');
    }

    public function destroy($id)
    {
        $receptionist = receptionist::find($id);
        if($receptionist)
        {
            $receptionist -> delete();
        }

        return redirect()->route('dashboard.receptionist.index');
    }
   
    public function show($id)
    {
        $receptionist=receptionist::findOrFail($id);
        return view('dashboard.receptionist.show',compact('receptionist'));
    }

    public function edit($id)
    {
         
        $receptionist=receptionist::find($id);
        $manager = manager::all();
       

        return view('dashboard.receptionist.edit',compact('receptionist','manager'));
    }


    public function update(Request $request, $id)
    {
 
        $request->validate([
            'email' =>'required|email',
            'name' =>'required|string|min:3|max:50',
            'manager_id'=>'required',
            'password' =>'required|min:6',
            'national_id' =>'required|max:50',
            'avatar_img' =>'image|mimes:jpeg,png',
        ]);
        
        $receptionist=receptionist::find($id);
        $name=$receptionist->avatar_img;
        if ($request->hasFile('avatar_img'))
        {
            $img=$request->file('avatar_img');            
            $ext=$img->getClientOriginalExtension();  
            $name="recp -".uniqid().".$ext";           
            $img->move(public_path("uploads/receptionists/"),$name);  

        }

        $receptionist->update([
            'name'=>$request->name ,
            'email'=>$request->email,
            'password'=>Hash::make($request->password),
            'national_id'=>$request->national_id ,
            'avatar_img'=>$name,
            'manager_id'=>$request->manager_id,
        ]);

        return redirect(route('dashboard.receptionist.index',$id));
    }

  
  
}
