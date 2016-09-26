<?php namespace App\Http\Controllers\Blog;

use Request;
use App\Models\ShareholderAlert;
use App\Models\Category;
use App\Http\Requests;
use App\Http\Requests\PostRequest;
use App\Http\Controllers\Controller;
use Auth;

class ShareholderAlertController extends Controller {

  /**
   * Display a listing of shareholder alerts.
   *
   * @return Response
   */
  public function index(PostRequest $request)
  {

    // Base Alert Query
    $query=ShareholderAlert::orderBy('created_at','DESC');

    $alerts=$query->paginate(10);
    return view('pages.shareholderAlerts.index', compact('alerts'));

  }

}

?>
