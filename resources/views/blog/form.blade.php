
<div class="row">

  <div class="col-md-8 col-md-offset-2">

    <!-- Post Title -->
    <div class="well">
      <div class="row">
        <div class="col-md-12">
          {!! Form::file('img_url',null, array('class'=>'form-control','type'=>'file',  'enctype'=>'multipart/form-data')) !!}
        </div>
      </div>
    </div>
    <hr>

    <div class="row">

      <!-- Post Title -->
      <div class="col-md-9">
        {!! Form::label('title', 'Title:') !!}
        {!! Form::text('title',null, array('id'=>'title','class'=>'form-control','v-model'=>'title')) !!}
      </div>

      <!-- Category -->
      <div class="col-md-3">
        {!! Form::label('category_id', 'Category:') !!}
        {!! Form::select('category_id',$categories,'', array('class'=>'form-control')) !!}
      </div>

    <!-- End Row -->
    </div>
    <hr>

    <!-- Slug  TODO::Autofill slug with title minus whitespace -->
    <div id="form-group">
      {!! Form::label('slug', 'Slug:') !!}
      {!! Form::text('slug',null, array('class'=>'form-control','placeholder'=>'Title-With-Hyphens-and-No-special-Chars')) !!}
    </div>
    <hr>

    <!-- Summary -->
    <div class="form-group">
      {!! Form::label('description', 'Summary:') !!}
      {!! Form::textarea('description',null, array('class'=>'form-control')) !!}
    </div>
    <hr>

    <!-- Summernote Text Editor for Content -->
    <div class="form-group">
      {!! Form::label('content', 'Content:') !!}
      {!! Form::textarea('content',null, array('class'=>'form-control','id'=>'dude')) !!}
    </div>
    <hr>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/simplemde/latest/simplemde.min.css">
    <script src="https://cdn.jsdelivr.net/simplemde/latest/simplemde.min.js"></script>
    <script>
      var simplemde = new SimpleMDE();
    </script>
    <!-- Checkboxes for Post Details-->
    <div class="row">
      <div class="col-md-4">

          <p>Status</p>
          {!! Form::label('status', 'Publish') !!}
          {!! Form::radio('status',1) !!}
          {!! Form::label('status', 'Draft') !!}
          {!! Form::radio('status',0) !!}

      </div>

      <div class="col-md-3 col-md-offset-1">
        <p>Comments</p>
        {!! Form::label('comments', 'On') !!}
        {!! Form::radio('comments',1) !!}
        {!! Form::label('comments', 'Off') !!}
        {!! Form::radio('comments',0) !!}
      </div>

      <div class="col-md-2 pull-right">
        <p>Featured</p>
        {!! Form::label('featured', 'On') !!}
        {!! Form::radio('featured',1) !!}
        {!! Form::label('featured', 'Off') !!}
        {!! Form::radio('featured',0) !!}
      </div>

    <!-- End Row -->
    </div>
    <hr>
    <!-- Form Submit Button -->
    <div class="form-group">
      {!! Form::submit('Save', array('class'=>'form-control btn btn-success')) !!}
    </div>
  </div>
