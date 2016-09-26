<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Delete Post</h4>
      </div>
      <div class="modal-body">

        Are you sure you want to delete this post?

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
        {!! Form::model($post,

          [ 'method'=>'DELETE', 'action' => ['Blog\PostController@destroy',$post->slug] ]

        ) !!}

        <button type="submit" name="button" class="btn btn-danger"> Yes Delete</button>

        {!! Form::close() !!}
      </div>
    </div>
  </div>
</div>
