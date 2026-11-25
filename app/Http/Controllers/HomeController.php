<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Coach;
use App\Models\Event;


class HomeController extends Controller
{
     public function index()
    {
        $coaches = Coach::take(3)->get();
        $events = Event::orderBy('event_date')->take(3)->get();

        return view('home', [
            'coaches' => $coaches,
            'events' => $events,
        ]);
    }
}
