<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use DB;
use Artisan;
use Log;

class ChecksChart extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'stuff:get';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

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
      $log=\App\ArtLog::first();
      $artists=\App\Models\ArtistEvent::orderBy('name','asc')
          ->where('name','>',''.$log->name.'')
          ->where('name','NOT LIKE','%/%')
          ->get();

        foreach($artists as $artist)
        {
          // Normalize stored artist name TODO:: should be a separate task
          $name=str_replace(' ', '%20', $artist->name);
          $name=str_replace('"', '%20', $name);
          $name=htmlspecialchars_decode($name);

          $artist_info=@file_get_contents('http://api.bandsintown.com/artists/'.$name.'.json?api_version=2.0&app_id=YOUR_APP_ID');

          if($artist_info)
          {
            $artist_info=json_decode($artist_info);
            /*
              * Logging artists
            */
            $artist->image_url=$artist_info->image_url;
            $artist->thumb_urlCopy=$artist_info->thumb_url;
            $artist->facebook_tour_dates_url=$artist_info->facebook_tour_dates_url;
            $artist->facebook_page_url=$artist_info->facebook_page_url;
            $artist->tracker_count=$artist_info->tracker_count;
            $artist->upcoming_events_count=$artist_info->upcoming_event_count;
            $artist->update();
            $i=1;

            $log=\App\ArtLog::first();
            $log->name=$artist->name;
            $log->update();

            $this->info($artist->name.'  [1]');

          }
          //  Delete Record if no Info Found
          else{


            $artist->delete();

            $this->info($artist->name.' Deleted ========================   1');

            Artisan::call('stuff:get2');

          }
        }



    }
}
