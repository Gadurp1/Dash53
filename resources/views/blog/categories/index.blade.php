@extends('spark::layouts.app')
@section('content')

@include('pages.blog.categories.create')
@include('errors.list')
  <div class="container">
      <div class="row">

          <div class="col-md-8 col-md-offset-2">

            <div class="panel panel-default">
              <div class="panel-heading">
                <div class="row">
                  <!-- Button trigger modal -->
                  <a type="button" class="pull-right btn btn-primary btn-sm" data-toggle="modal" data-target="#myModal">
                    + New category
                  </a>
                </div>
              </div>
              <div class="panel-body">

                <table class="table table-responsive table-bordered">
                  <tbody>

                    <thead>
                      <th>Name</th>
                      <th>Slug</th>
                      <th>Info</th>
                      <th></th>
                    </thead>

                    @foreach($categories as $category)
                    <tr>
                      <td>{{$category->name}}</td>
                      <td>{{$category->slug}}</td>
                      <td>{{$category->description}}</td>
                      <td>
                        {!! Form::model($category,
                          [
                            'method'=>'DELETE',
                            'action' => ['Blog\CategoryController@destroy', $category->id]
                          ])
                        !!}

                          <button type="submit" name="button" class="btn btn-danger">
                            <i class="fa fa-trash"></i>
                          </button>

                        {!! Form::close() !!}
                    </td>
                    </tr>
                    @endforeach

                  </tbody>
                </table>
              </div>

            </div>

            <!-- Render Pagination -->
            {{$categories->appends(Request::except('page'))->render()}}

          </div>
      </div>
  </div>

@endsection
