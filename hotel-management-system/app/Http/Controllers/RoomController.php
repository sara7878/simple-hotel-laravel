<?php

namespace App\Http\Controllers;

use App\Models\floor;
use App\Models\manager;
use App\Models\room;
use Illuminate\Http\Request;

class RoomController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $rooms=room::with('floor')->get();
        return view('dashboard.room.index',['rooms' => $rooms]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {    $managers=manager::get(['id','name']);
         $floors=floor::get(['id','number']);
        return view('dashboard.room.create',['managers'=>$managers,'floors'=>$floors]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        //validation
        $request->validate([
            'name' =>'required|string|min:3|max:50',
        ]);

        room::create([
            'name'=>$request->name ,
            'number'=>$request->number ,
            'capacity'=>$request->capacity ,
            'price'=>$request->price ,
            'manager_id'=>$request->manager ,
            'floor_id'=>$request->floor ,
            
        ]);

      return redirect(route('room.index'));
    }


    /**
     * Display the specified resource.
     *
     * @param  \App\Models\room  $room
     * @return \Illuminate\Http\Response
     */
    // public function show($id)
    // {
    //     $room=room::findOrFail($id);
    //     return view('dashboard.room.show',compact('room'));
    // }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\room  $room
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $room=room::findOrFail($id);
        $managers=manager::get(['id','name']);
         $floors=floor::get(['id','number']);
        return view('dashboard.room.edit',compact('room','managers','floors'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\room  $room
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id){
                //validation
                $request->validate([
                    'name' =>'required|string|min:3|max:50',
                ]);
                //$request->validated();
                $room=room::findOrFail($id);
                $room->update([
                    'name'=>$request->name ,
                    'number'=>$request->number ,
                    'capacity'=>$request->capacity ,
                    'price'=>$request->price ,
                    'manager_id'=>$request->manager ,
                    'floor_id'=>$request->floor ,
                ]);
        
                return redirect(route('room.index',$id));
    }








    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\room  $room
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $room=room::findOrFail($id);
        $room->delete();
        return redirect(route('room.index'));
    }
}
