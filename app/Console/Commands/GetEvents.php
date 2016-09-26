<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use DB;
class GetEvents extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'eventsParse:run';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Parse Upcoming Events in Chicago';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
      for ($i = 101; $i <= 150; $i++)
      {
        $festivals=@file_get_contents('http://api.bandsintown.com/events/search.json?api_version=2.0&app_id=YOUR_APP_ID&location=chicago,il&date=2016-10-01,2018-01-01&page='.$i.'');

         foreach(json_decode($festivals) as $festival){

           /*
            *
            * Logging Venues
            *
            */
           $venue=new \App\Models\Venue;
           $venue->name=  $festival->venue->name;

           $venue->city=  $festival->venue->city;
           $venue->region=  $festival->venue->region;
           $venue->country=  $festival->venue->country;
           $venue->long=  $festival->venue->longitude;
           $venue->lat=  $festival->venue->latitude;
           $venue->save();
           $venue_id=$venue->id;
           $this->info('new venue');


           /*
            *
            * Logging Events
            *
            */
            $event=\App\Models\Event::find($festival->id);

            if($event){
              $event->id=$festival->id;
            }
            else{
              $event=new \App\Models\Event;
              $event->id=$festival->id;
            }

            $event->venue_id=$venue_id;
            if(isset($festival->title)){
              $event->name= $festival->title;

            }
            else{
              $event->name=  $festival->venue->name;
            }
            $event->date=  $festival->datetime;
            $event->ticket_url=  $festival->ticket_url;
            $event->ticket_status=  $festival->ticket_status;
            $event->on_sale_datetime=  $festival->on_sale_datetime;
            if(isset($festival->description))
            {
              $event->description=$festival->description;
            }
            if(ISSET($event->facebook_rsvp_url))
            {
              $event->facebook_rsvp_url=$event->facebook_rsvp_url;
            }

              $event->save();
              $this->info('new event');

            $event_id=$event->id;

            /*
             *
             * Parse and Store Artists
             *
             */
            foreach($festival->artists as $artist){

              $artist_event=new \App\Models\ArtistEvent;
              $artist_event->event_id=  $event_id;

              $artist_event->name= $artist->name;
              $artist_event->mbid= $artist->mbid;

              if(ISSET($artist->image_url))
              {
                $artist_event->image_url= $artist->image_url;
              }
              if(ISSET($artist->thumb_url))
              {
                $artist_event->image_url= $artist->thumb_url;
              }

              if(ISSET($artist->facebook_tour_dates_url))
              {
                $artist_event->facebook_tour_dates_url= $artist->facebook_tour_dates_url;
              }
              if(ISSET($artist->tracker_count))
              {
                $artist_event->tracker_count= $artist->tracker_count;
              }
              if(ISSET($artist->upcoming_events_count))
              {
                $artist_event->upcoming_events_count= $artist->upcoming_events_count	;
              }
                $artist_event->save();
                $this->info('new artist');
            }

        }
      }
    }
}
