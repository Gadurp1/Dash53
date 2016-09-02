<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\Clients;

class ClientsController extends Controller
{

    /**
     *  Check to see if user is logged in.
     *
     */
    //public function __construct()
    //{
    //    $this->middleware('auth');
    //}

    /**

     * Main client view. Display
     * all clients in a grid
     *
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {
      $query=Clients::orderBy('Name','ASC')
          ->join('tdata.contacts','tdata.clients.ID','=','tdata.contacts.claimtron_id')
          ->selectRaw('tdata.clients.ID as id,tdata.contacts.RecordManager,tdata.clients.Name as name,tdata.clients.valid_start as valid_start,tdata.contacts.Ranking as ranking');
      $search=null;
      if($request->search){
        $search=$request->search;
        $query->where('Name','LIKE','%'.$search.'%')
            ->orWhere('tdata.clients.Email','LIKE','%'.$search.'%');
      }
      $clients=$query->paginate(50);
      return view('clients.index',compact('clients','search'));
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($client_id)
    {
        $contact=\App\Contacts::where('claimtron_id',$client_id)->first();
        $notes=\App\Notes::where('ContactID',$contact->UNIQUE_ID)->get();
        $calls=\App\Calls::where('ContactID',$contact->UNIQUE_ID)->get();
        $filer=\App\Filers::where('salestron_id',$contact->UNIQUE_ID)->first();
        $chart='';
        $audit=DB::table('tdata.audit')
          ->where('Key_Value',$contact->UNIQUE_ID)
          ->orderBy('DateTime','DESC')
          ->groupBy('DateTime')
          ->get();

        // Check to see if client files 13f's
        if($filer){
        $chart= DB::table('dash_new.filings')
            ->selectRaw("period_of_report as date,sum(market_value) as value,filer_id,filing_id")
            ->join('dash_new.filing_stock_records', 'dash_new.filings.id', '=', 'dash_new.filing_stock_records.filing_id')
            ->join('dash_new.filers', 'dash_new.filings.filer_id', '=', 'dash_new.filers.id')
            ->where('dash_new.filers.id',$filer->id)
            ->groupBy('period_of_report')
            ->orderBy('period_of_report','ASC')
            ->get();
        }

        return view('contacts.profile',compact('contact','audit','calls'))
        ->with('chart',$chart)
        ->with('notes',$notes)
        ->with('filer',$filer);
    }
}
