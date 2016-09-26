<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      $events=\App\Models\ArtistEvent::upcomingEvents()
          ->selectRaw('artists.tracker_count,events.id,events.image_url as image_url,events.id as event_id,artists.name as name,artists.mbid,events.name as title,events.date,artists.image_url')
          ->orderBy('date','asc')
              ->paginate(50);
        return view('welcome',compact('events'));
    }


}
