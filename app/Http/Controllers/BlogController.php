<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use Illuminate\Http\Request;
use DB;
use Analytics;
use Spatie\Analytics\Period;
use App\Models\Blog;

class BlogController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');

        // $this->middleware('subscribed');
    }

    /**
     * Show the blog homepage.
     *
     * @return Response
     */
    public function index(Request $request)
    {
      $blogs=Blog::get();
      return view('blogs.index',compact('blogs'));
    }

    /**
     * Show the application dashboard.
     *
     * @return Response
     */
    public function show($slug)
    {
      $blog=Blog::where('slug',$slug)->first();
      return view('blogs.show',compact('blog'));
    }

    /**
     * Show the form for editing the selected blog.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($slug)
    {
      $blog=Blog::where('slug',$slug)->first();
      return view('blogs.edit',compact('blog'));
    }

    /**
    * Update the specified resource in storage.
    *
    * @param  int  $id
    * @return Response
    */
    public function update($id, Requests\BlogRequest  $request)
    {
      $blog=Blog::find($id);
      $blog->update($request->all());
      session()->flash('flash_message','Blog Successfully Saved!');
      return redirect('Blogs/'.$blog->slug.'');
    }

}
