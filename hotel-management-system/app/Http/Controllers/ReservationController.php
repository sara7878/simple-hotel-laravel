<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreReservationRequest;
use App\Models\client;
use App\Models\reservation;
use App\Models\room;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

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
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function showAllforAdmin()
    {
        $reservations = reservation::with(['client', 'receptionist'])->get();
        return view('dashboard.reservation.showforAdmin', ['reservations' => $reservations]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function showUnapproved()
    {
        $reservations = reservation::where('status', 'pending')->get();
        
        return view('dashboard.reservation.manageReservations', ['reservations' => $reservations]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function approve($id)
    {
        $reservation = reservation::find($id);
        $reservation->status = 'approved';
        $reservation->save();
        $reservations = client::all();
        return redirect()->route('reservation.approved',['reservations' => $reservations]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function reject($id)
    {
        $reservation = reservation::find($id);
        $reservation->status = 'rejected';
        $reservation->save();
        $reservations = client::all();
        return redirect()->route('reservation.manage',['reservations' => $reservations]);
    }
    
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($roomId)
    {
        return view('dashboard.reservation.makeReservation', ['roomId' => $roomId]);
    }
    
    public function store(Request $request, $roomId)
    {
        $request->validate([
            'accompany_number' => 'bail|required|integer',
        ]);

            $room = room::find($roomId);

            $reservation = new reservation();
            if ($request->accompany_number <= $room->capacity && $request->accompany_number > 0) {
                $reservation->accompany_number = $request->accompany_number;
            
            $room_number = DB::table('rooms')
                ->select('number')
                ->where('id', '=', $roomId)
                ->get();


            $reservation->room_number = $room_number[0]->number;
            $price = DB::table('rooms')
                ->select('price')
                ->where('id', '=', $roomId)
                ->get();

            $reservation->paid_price = $price[0]->price;
            $client = Auth::guard('client')->user()->id;

            $reservation->client_id = $client;

            $room->status = true;
            $room->save();

            $reservation->save();

            return redirect()->route('reservation.index');
        }
        return view('dashboard.reservation.makeReservation', ['roomId' => $roomId]);
 
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
        return view('dashboard.reservation.edit', ['id' => $id, 'reservation' => $reservation]);
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
        if ($reservation)
            $reservation->delete();
        return redirect()->route('reservation.index');
    }
}
