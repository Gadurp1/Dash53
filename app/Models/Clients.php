<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Clients extends Model
{

    protected $table = 'tdata.clients';
    protected $primaryKey = 'ID';
    protected function ae()
    {
    /**
     *
     * A user can have many unique templates
     *
     */
        return $this->belongsTo('App\AE','AE_ID');
    }

    protected function deficiencies()
    {
    /**
     *
     * A user can have many Deficiencies (deficient accounts)
     *
     */
        return $this->hasMany('App\Deficiencies','client_id')
            ->join('tdata.cases','dash_new.deficiencies.case_id','=','tdata.cases.ID');
    }

    protected function checks()
    {
    /**
     *
     * A user can have many unique templates
     *
     */
        return $this->hasMany('App\Checks','Client_ID');
    }
    protected function subclients()
    {
    /**
     *
     * A user can have many unique templates
     *
     */
        return $this->hasMany('App\Subclients','Client_ID');
    }
    protected function data()
    {
    /**
     *
     * A user can have many unique templates
     *
     */
        return $this->hasMany('App\Data','Client_ID')->orderBy('Recieved','DESC');
    }

    protected function allocationRequests()
    {
    /**
     *
     * A user can have many requests
     *
     */
        return $this->hasMany('App\RequestMessages','Client_ID')->orderBy('created_at','DESC');
    }
    protected function claims()
    {
    /**
     *
     * A user can have many requests
     *
     */
        return $this->hasMany('App\Claims','Client_ID')->orderBy('ID','DESC');
    }
    protected function latestClaim()
    {
    /**
     *
     * A user can have many requests
     *
     */
        return $this->hasOne('App\Claims','Client_ID')
            ->orderBy('Date_Mailed','DESC')
            ->take(1);
    }
    /**
     * Get all of the posts for the country.
     */
    public function notes()
    {
        return $this->hasManyThrough('App\Notes', 'App\Contacts','claimtron_id','ContactID');
    }

    protected function contact()
    {
    /**
     *
     * A contact belongs to a client
     *
     */
        return $this->hasOne('App\Contacts','claimtron_id');
    }

    protected function latestDeficienciesRequest()
    {
    /**
     *
     * Date of the last deficiencies request sent to client
     *
     */
      return $this->hasOne('App\Emails','client_id')
          ->join('campaigns', 'email_sents.campaigns_id', '=', 'campaigns.id')
          ->where('campaigns.type','boi')
          ->orderBy('date_sent','DESC')
          ->take(1);
    }
}
