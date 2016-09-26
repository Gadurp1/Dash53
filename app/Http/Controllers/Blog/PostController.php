<?php namespace App\Http\Controllers\Blog;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Blog\Post;
use App\Models\Blog\Category;
use Image;


class PostController extends Controller {

  /**
   * Display a listing of the resource.
   *
   * @return Response
   */
  public function index(Request $request)
  {
    // Base Blog Query
    $query=Post::orderBy('created_at','DESC');



    $posts=$query->paginate(10);
    return view('blog.index', compact('posts'));
  }

  /**
   * Show the form for creating a new resource.
   *
   * @return Response
   */
  public function create()
  {

      // Get categories list and display in dropdown
      $categories=Category::pluck('name','id');

      return view('blog.create',compact('categories'));

  }

  /**
   * Store a newly created post in storage.
   *
   * @return Response
   */
  public function store(Request $request)
  {
      // Create and Save User Post
      $post= New Post;
      $post->user_id==Auth::user()->id;
      $post->title = $request->title;
      $post->type = $request->type;
      $post->slug = $request->slug;
      $post->description = $request->description;
      $post->content = $request->content;
      $post->status = $request->status;
      $post->comments = $request->comments;
      $post->featured = $request->featured;

      if($request->img_url){

        // Resize image
        $img = Image::make($request->img_url)->resize(680, 320);

        // Rename file
        $fileName = Auth()->user()->name.'-'.$request->type.''.\Carbon\Carbon::now().'.'.$request->file('img_url')
            ->getClientOriginalExtension();

        // Move file to uploads folder
        $request->file('img_url')->move(
            base_path() . '/public/uploads', $fileName
        );

        // Set post url to new path
        $post->img_url=$fileName;
      }

      // Save post
      $post->save();

      return redirect('admin/post/'.$post->slug.'');

  }

  /**
   * Display the specified blog post.
   *
   * @param  int  $id
   * @return Response
   */
  public function show($slug)
  {
      // Select current blog post
      $post=Post::where('slug',$slug)->firstOrFail();

      // Select suggested blog posts
      $more_posts=Post::where('slug','!=',$slug)->latest()->take(9)->get();
      return view('blog.show',compact('post','more_posts'));
  }

  /**
   * Show the form for editing the specified resource.
   *
   * @param  int  $id
   * @return Response
   */
  public function edit($slug)
  {
      $categories=Category::pluck('name','id');
      $post=Post::where('slug',$slug)->firstOrFail();
      return view('blog.edit',compact('post','categories'));
  }

  /**
   * Update the specified blog post in storage.
   *
   * @param  int  $id
   * @return Response
   */
  public function update(Request $request, $slug)
  {
      $post=Post::where('slug',$slug)->first();
      $post->title = $request->title;
      $post->type = $request->type;
      $post->slug = $request->slug;
      $post->description = $request->description;
      $post->content = $request->content;
      $post->status = $request->status;
      $post->comments = $request->comments;
      $post->featured = $request->featured;

      if($request->img_url){

        $img = Image::make($request->img_url)->resize(680, 320);

        /* Rename file and store in uploads folder */
        $fileName = Auth()->user()->name.'-'.$request->type.''.\Carbon\Carbon::now().'.'.$request->file('img_url')
            ->getClientOriginalExtension();

        $request->file('img_url')->move(
            base_path() . '/public/uploads', $fileName
        );

        $post->img_url=$fileName;
      }

      $post->update();
      session()->flash('flash_message','Blog Post Successfully Saved!');
      return redirect('admin/post/'.$post->slug.'');
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  int  $slug
   * @return Response
   */
  public function destroy($slug)
  {
      $post=Post::where('slug',$slug)->firstOrFail();
      session()->flash('flash_message',$post->title.' Successfully Deleted!');
      $post->delete();
      return redirect('admin.post');
  }

}

?>
