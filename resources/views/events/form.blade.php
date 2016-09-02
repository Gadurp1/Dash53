
<div class="container">
  <div class="col-md-8 col-md-offset-2">
    <h2>Edit Event</h2>
    <hr>
    <div class="row">
      <div class="col-md-12">
        {!! Form::label('name', 'Name:') !!}
        {!! Form::text('name',null,['class'=>'form-control input-md col-md-12']) !!}

      </div>
    </div>
    <hr>
    <div class="row">
      <div class="col-md-12">
        {!! Form::label('image_url', 'Image:') !!}
        {!! Form::text('image_url',null,['class'=>'form-control input-md col-md-12']) !!}
      </div>
    </div>
    <hr>
    <div class="row">
    <div class="col-md-6">
      {!! Form::label('date', 'Start:') !!}
      {!! Form::text('date',null,['class'=>'form-control input-md col-md-12']) !!}
    </div>
    </div>
    <hr>
    <div class="row">
      {!! Form::label('ticket_url', 'Ticket Url:') !!}
      {!! Form::text('ticket_url',null,['class'=>'form-control input-md col-md-12']) !!}
    </div>
    <hr>
    <div class="row">
      {!! Form::label('ticket_status', 'Ticket Status') !!}
      {!! Form::text('ticket_status',null,['class'=>'form-control input-md col-md-12']) !!}
    </div>
    <hr>
    <div class="row">
      {!! Form::label('on_sale_date_time', 'Sale Date:') !!}
      {!! Form::text('on_sale_date_time',null,['class'=>'form-control input-md col-md-12']) !!}
    </div>
    <hr>
    <div class="row">
      {!! Form::label('venue_id', 'Venue:') !!}
      {!! Form::text('venue_id',null,['class'=>'form-control input-md col-md-12']) !!}
    </div>
    <hr>
    <div class="row">
      {!! Form::label('description', 'Description:') !!}
      {!! Form::textarea('description',null,['class'=>'form-control input-lg','id'=>'summernote']) !!}
    </div>
    <hr>

    <div class="row">
      <button href="#" type="submit" class="btn btn-success col-md-12"> Save Event</button>
    </div>
  </div>
</div>
