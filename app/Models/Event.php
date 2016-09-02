<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Event extends Model {

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    	protected $table = 'events';
    	public $timestamps = true;

    	protected $fillable = array('name', 'date',  'ticket_status','ticket_status', 'description', 'image_url');
    	protected $visible = array('name', 'date',  'ticket_status','ticket_status',  'description', 'image_url');

    	public function eventDays()
    	{
    		return $this->hasMany('EventDays');
    	}

    	public function stages()
    	{
    		return $this->hasMany('Stage');
    	}

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required',
        ];
    }

    public function artists()
  	{
  		return $this->hasMany('App\Models\ArtistEvent');
  	}
}
