<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Add New Category</h4>
      </div>
      <div class="modal-body">

				{!! Form::open(
		        array(
		          'route' => 'admin.post-categories.store',
		          'class' => 'form',
		          'files' => false
							)
		        )
		    !!}
						<div class="form-group">
							{!! Form::label('name', 'Name:') !!}
							{!! Form::text('name',null, array('class'=>'form-control')) !!}
						</div>
						<div class="form-group">
							{!! Form::label('slug', 'Slug:') !!}
							{!! Form::text('slug',null, array('class'=>'form-control')) !!}
						</div>
						<div class="form-group">
							{!! Form::label('description', 'Description:') !!}
							{!! Form::text('description',null, array('class'=>'form-control')) !!}
						</div>

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
					{!! Form::submit('Save',array('class'=>'btn btn-success')) !!}
				</div>
				{!! Form::close() !!}
			</div>
    </div>
  </div>
</div>
