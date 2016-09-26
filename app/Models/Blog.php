<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Blog extends Model {

	protected $table = 'blogs';
	public $timestamps = true;

	protected $fillable = array('title', 'content','image','slug');


}
