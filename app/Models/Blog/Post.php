<?php namespace App\Models\Blog;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Post extends Model {

	protected $table = 'blog_posts';
	public $timestamps = true;

	use SoftDeletes;

	protected $dates = ['deleted_at'];
	protected $guarded = array('id');

	public function category()
	{
		return $this->belongsTo('Category', 'category_id');
	}

	public function tags()
	{
		return $this->belongsToMany('PostTag');
	}

}
