<?php

namespace App\Console\Commands;
use Illuminate\Console\Command;
use DB;
use FoursquareApi;

class GetVenues extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'getVenues:run';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Parse Upcoming Events in Chicago';
    /**
     * Instance of Foursquare API
     * @var object
     */
    protected $foursquare;

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
        $this->foursquare = new FoursquareApi('LEJZKTHNGHKCAVFZSGFVGE50FDWYML5SAGX01JJM31LFGNSD','DADYOUOGNT4UGW3N0DQIWZO2QWHJXODMHX2KZS30DPLILV55');

    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {

        // Searching for venues nearby e.g Lagos, Nigeria
        $endpoint = 'venues/search';
        // Prepare parameters
        $params = ['query'=>'Thalia Hall','near' => 'Chicago, Illinois','limit' => 1000,'offset',0];
        // Perform a request to a public resource
        $response = json_decode($this->foursquare->GetPublic($endpoint,$params),true);
        $venues=$response['response']['venues'];
        foreach($venues as $venue){

          $venue2=new \App\Models\Venue;
          $venue2->foursquare_id=$venue['id'];
          $venue2->name=$venue['name'];
          $venue2->lat=$venue['location']['lat'];
          $venue2->long=$venue['location']['lng'];


          if(ISSET($venue['location']['postalCode'])){
            $venue2->postal_code=$venue['location']['postalCode'];
          }
          if(ISSET($venue['location']['cc'])){
            $venue2->cc=$venue['location']['cc'];
          }
          if(ISSET($venue['location']['city'])){
            $venue2->city=$venue['location']['city'];
          }
          if(ISSET($venue['location']['state'])){
            $venue2->state=$venue['location']['state'];
          }
          if(ISSET($venue['contact']['phone'])){
            $venue2->phone=$venue['contact']['phone'];
          }
          if(ISSET($venue['contact']['formattedPhone'])){
              $venue2->formatted_phone=$venue['contact']['formattedPhone'];
          }
          if(ISSET($venue['contact']['twitter'])){
            $venue2->twitter=$venue['contact']['twitter'];
          }
          if(ISSET($venue['contact']['facebook'])){
            $venue2->twitter=$venue['contact']['facebook'];
          }
          if(ISSET($venue['contact']['facebookUser'])){
            $venue2->facebook_user=$venue['contact']['facebookUser'];
          }
          if(ISSET($venue['contact']['facebookName'])){
            $venue2->facebook_user=$venue['contact']['facebookName'];
          }
          $venue2->save();
          $this->info($venue2->name.' updated');
        }
      }
}
