<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use Dandelionmood\LastFm\LastFm;

class BandController extends Controller
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
     * Return all tweets to the LastFM API dashboard
     * @return mixed
     */
    public function getPage($artist)
    {
        $details = $this->getArtistInfo($artist);

        $albums = array_slice($this->getTopAlbums($artist), 0, 4);

        $tracks = array_slice($this->getTopTracks($artist), 0, 10);

        return view('api.lastfm')->withDetails($details)
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
