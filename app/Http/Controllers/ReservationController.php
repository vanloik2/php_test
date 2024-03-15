<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ReservationController extends Controller
{
    /**
     * 
     */
    public function submitReservation(Request $request)
    {
        \abort(404);
        \dd($request->all());
    }
}
