<?php

namespace App\Http\Controllers;
use App\Http\Requests;
use Illuminate\Http\Request;
use DB;
use App\Models\Event;
use Spatie\Analytics\Period;
use App\Models\ArtistEvent;
use Dandelionmood\LastFm\LastFm;

class EventController extends Controller
{
  /**
   * @var array
   */

  /**
   * LastFm Object
   * @var object;
   */
  protected $lastfm;

  /**
   * Initialize the Controller with necessary arguments
   */
  public function __construct()
  {
      $this->lastfm = new LastFm(env('LASTFM_API_KEY'), env('LASTFM_API_SECRET'));
  }


    /**
     * Show the application dashboard.
     *
     * @return Response
     */
    public function index(Request $request)

    {
      $now = \Carbon\Carbon::now();
      $future = \Carbon\Carbon::now()->addWeeks(2);
      $per_page=1;

      $query=ArtistEvent::upcomingEvents()
          ->selectRaw('artists.tracker_count,events.id,events.image_url as image_url,events.id as event_id,artists.name as name,artists.mbid,events.name as title,events.date,artists.image_url')
          ->where('events.date','>',$now);
      $search=null;

      if($request->search){
        $search=$request->search;
        $query->where('artists.name','LIKE','%'.$search.'%')
            ->orWhere('events.name','LIKE','%'.$search.'%');
      }

      if($request->rank){
        $rank=$request->rank;
        $query->where('tracker_count','<',$rank);
      }

      $events=$query->orderBy('events.date','ASC')
          ->paginate(50);

      return view('events.index',compact('events','search'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
      $event=Event::find($id);
      return view('events.edit',compact('event'));
    }

      /**
       * Update the specified resource in storage.
       *
       * @param  int  $id
       * @return Response
       */
      public function update($id, Requests\EventsRequest  $request)
      {
        $event=Event::findorFail($id);
        $event->update($request->all());
        session()->flash('flash_message','Event Successfully Saved!');
        return redirect('Events/'.$id.'');
      }

    /**
     * Show the application dashboard.
     *
     * @return Response
     */
    public function show($venue,$artist)
    {
      $details = $this->getArtistInfo($artist);

      $albums = array_slice($this->getTopAlbums($artist), 0, 4);

      $tracks = array_slice($this->getTopTracks($artist), 0, 10);
      /* De-Sluggify Url Params */
      $event=str_replace('-', ' ', $venue);
      $artist=str_replace('-', ' ', $artist);

      /* Date Time Stuff */
      $now = \Carbon\Carbon::now();
      $future = \Carbon\Carbon::now()->addWeeks(2);

      /* De-Sluggify Url Params */
      $event=Event::where('name',$event)->first();
      $fuzzies=Event::where('name','Like','%'.$event->name.'%')
          ->where('date','>=',$now)
          ->pluck('id');

      $artist_detail=ArtistEvent::where('name',$artist)->first();

      $artists=ArtistEvent::whereIn('event_id',$fuzzies)
          ->orderBy('tracker_count','DESC')
          ->paginate(6);

      $venue=\App\Models\Venue::where('id',$event->venue_id)->first();
      return view('events.show',compact('event','artists','venue','artist_detail','additional_events'))
      ->withDetails($details)
                               ->withAlbums($albums)
                               ->withTracks($tracks);
    }
    /**
     * Get Artist Info
     * @return array
     */
    private function getArtistInfo($artist)
    {
        $result = (array)$this->lastfm->artist_getInfo(['artist' => $artist]);

        return $result['artist'];
    }

    /**
     * Get Top Albums
     * @return array
     */
    private function getTopAlbums($artist)
    {
        $result = (array)$this->lastfm->artist_getTopAlbums(['artist' => $artist]);

        return $result['topalbums']->album;
    }

    /**
     * Get Top Tracks
     * @return array
     */
    private function getTopTracks($artist)
    {
        $result = (array)$this->lastfm->artist_getTopTracks(['artist' => $artist]);

        return $result['toptracks']->track;
    }
}
