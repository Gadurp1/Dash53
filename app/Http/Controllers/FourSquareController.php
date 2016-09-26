<?php
namespace App\Http\Controllers;
use FoursquareApi;
use App\Http\Requests;
class FoursquareController extends Controller
{
    /**
     * Instance of Foursquare API
     * @var object
     */
    protected $foursquare;
     /**
     * Initialize the Controller with necessary arguments
     */
    public function __construct()
    {
        $this->foursquare = new FoursquareApi('LEJZKTHNGHKCAVFZSGFVGE50FDWYML5SAGX01JJM31LFGNSD','DADYOUOGNT4UGW3N0DQIWZO2QWHJXODMHX2KZS30DPLILV55');
    }
    /**
     * Search For Venues
     * @return array
     */
    private function getVenues()
    {
        // Searching for venues nearby e.g Lagos, Nigeria
        $endpoint = 'venues/search';
        // Prepare parameters
        $params = ['near' => 'Chicago, Illinois','limit' => 1000,'offset',0];
        // Perform a request to a public resource
        $response = json_decode($this->foursquare->GetPublic($endpoint,$params),true);
        return $response['response']['venues'];
    }
    /**
     * Return all data to the Foursquare API dashboard
     * @return mixed
     */
    public function getPage()
    {
        $venues = $this->getVenues();
        return view('api.fourSquare')->withVenues($venues);
    }
}
