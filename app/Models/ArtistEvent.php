<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ArtistEvent extends Model {

	protected $table = 'artists';
	public $timestamps = true;

	/**
	 * Get the validation rules that apply to the request.
	 *
	 * @return array
	 */
	public function scopeUpcomingEvents()
	{
		$now = \Carbon\Carbon::now();
		return static::where('date','>=',$now)
		->where('events.name','NOT LIKE','%fest%')
		->join('events', 'artists.event_id', '=', 'events.id')
		->where('tracker_count','>',1000);
	}

	/**
	 * Get the validation rules that apply to the request.
	 *
	 * @return array
	 */
	public function scopeMoreEvents($artist)
	{
		$now = \Carbon\Carbon::now();
		return static::where('date','>=',$now)
		->where('artists.name',$artist)
		->join('events', 'artists.event_id', '=', 'events.id')
		->where('tracker_count','>',1000);
	}


	public function event()
	{
		return $this->belongsTo('App\Models\Event','event_id');
	}
}
