<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreReservationRequest;
use App\Models\reservation;
use Illuminate\Http\Request;

class ReservationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $reservations = reservation::all();
        return view('dashboard.reservation.index', ['reservations' => $reservations]);        
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function showAll()
    {
        $reservations = reservation::with('client')->get();
        return view('dashboard.reservation.clientReservations', ['reservations' => $reservations]);        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('dashboard.reservation.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreReservationRequest $request)
    {
        $validated = $request->validated();
        $reservation = new reservation();
        $reservation->accompany_number = $request->accompany_number;
        $reservation->paid_price = $request->paid_price;
        $reservation->room_number = $request->room_number;
        $reservation->client_id = $request->client_id;
        $reservation->receptionist_id = $request->receptionist_id;

        $reservation->save();
        
        return redirect()->route('reservation.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\reservation  $reservation
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $reservation = reservation::find($id);
        return view('dashboard.reservation.show', ['reservation' => $reservation]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\reservation  $reservation
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $reservation = reservation::find($id);
        return view('dashboard.reservation.edit',['id'=>$id, 'reservation'=>$reservation]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\reservation  $reservation
     * @return \Illuminate\Http\Response
     */
    public function update(StoreReservationRequest $request, $id)
    {
        $validated = $request->validated();
        
        $reservation = reservation::find($id);
        $reservation->accompany_number = $request->accompany_number;
        // $reservation->paid_price = $request->paid_price;
        $reservation->room_number = $request->room_number;
        // $reservation->client_id = $request->client_id;
        // $reservation->receptionist_id = $request->receptionist_id;

        $reservation->save();
        return redirect()->route('reservation.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\reservation  $reservation
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $reservation = reservation::find($id);
        if($reservation)
            $reservation->delete();
        return redirect()->route('reservation.index');
    }
}
