<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Venue extends Model {

	protected $table = 'foursquare_venues';
	public $timestamps = true;

}
