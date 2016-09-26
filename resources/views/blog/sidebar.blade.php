  <div class="row">
    <div class="col-md-12">
      <h2 class="page-header">More from CCC</h2>

      @foreach($more_posts as $more_post)

        <!-- Suggested Posts -->
        <div class="panel panel" style="margin-bottom:3em">
          <div class="panel-body">
            <div class="row">

              @if($more_post->img_url)

                <div class="col-md-4">
                  <img src="/uploads/{{$more_post->img_url}}" class="img-responsive col-md-12"  alt="" />
                </div>

              @else
                <div class="col-md-4">
                  <img class="img-responsive col-md-12"  alt="" src="https://upload.wikimedia.org/wikipedia/commons/thumb/c/c4/Chicago_skyline,_viewed_from_John_Hancock_Center.jpg/1024px-Chicago_skyline,_viewed_from_John_Hancock_Center.jpg" alt="" />
                </div>
              @endif

              <div class="col-md-8">
                <a href="/pages/Securities-Class-Action-Blog/{{$more_post->slug}}">
                  <h3>{{$more_post->title}}</h3>
                  <h6><small>Created {{$more_post->created_at->diffForHumans()}}</small></h6>
                </a>
              </div>

            </div>
          </div>
        </div>
      @endforeach
    </div>

  </div>
  <div class="row">
    <div class="col-md-4 col-md-offset-4">
      <a href="{{url('pages/Securities-Class-Action-Blog')}}" class="col-md-12 btn btn-info btn-lg">View All</a>
    </div>
  </div>
