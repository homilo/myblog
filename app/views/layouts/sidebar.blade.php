<div class="" style="padding: 20px; position: relative; background-color: #FFFFFF;">
	<i class="fa fa-play fa-2x" style="position: absolute; top: 0px; left: -1px; cursor: pointer;"></i>

	<div class="clearfix">
		<br>
		@if($user = Auth::user())
			<div class="">
				<img class="img-responsive" src="{{image_url($user->profile->avatar_filename)}}" style="margin-right: 10px;">
				<h3 class="pull-left"> {{ $user->fullname }} </h3> 
				<div class="">
					<!-- <svg total-height="16" total-width="90" min-width="90" min-height="15" measured-height="16" measured-width="90" id="ad6682cf3-e0b9c72d" class="stencil stencil-dom-optimizer" name="tmplsvg-stars" editable="true" x="1054" y="247" version="1.1" width="90" height="16">     <svg total-height="80" total-width="90" y="0" x="0" measured-height="16" measured-width="90" dirty="true" min-width="90" min-height="15" width="100%" height="100%" layout="horizontal">                  <path measured-height="16" measured-width="16" dirty="true" min-height="15" min-width="16" width="100%" height="100%" "="" d="M7.66222,0.422045 c0.185526,-0.562727 0.490613,-0.562727 0.67717,0 l1.43267,4.32867 c0.187587,0.562727 0.801884,1.0313 1.3698,1.04429 l4.36295,0.0941485 c0.566885,0.012986 0.661709,0.315993 0.209232,0.676354 l-3.47861,2.76818 c-0.451446,0.360361 -0.686446,1.12004 -0.523595,1.69034 l1.2657,4.3871 c0.163881,0.56922 -0.082456,0.757517 -0.547301,0.417716 l-3.58477,-2.61776 c-0.464846,-0.3398 -1.2255,-0.3398 -1.69138,0 l-3.58271,2.61776 c-0.465876,0.3398 -0.711183,0.152585 -0.547301,-0.417716 l1.26261,-4.3871 c0.163881,-0.56922 -0.0700876,-1.32998 -0.522565,-1.69034 L0.285504,6.56442 C-0.165943,6.20406 -0.072149,5.90105 0.494736,5.88807 l4.36398,-0.0941485 c0.566885,-0.012986 1.18324,-0.481564 1.36877,-1.04429 L7.66222,0.422045 z" fill="rgba(255, 168, 52, 1)"></path>             <rect y="0" x="16" width="2" measured-height="0" measured-width="2" dirty="true" min-height="0" min-width="2" explicit-width="2" height="0" fill="none"></rect>                  <path measured-height="16" measured-width="16" dirty="true" min-height="15" min-width="16" width="100%" height="100%" "="" d="M25.6622,0.422045 c0.185526,-0.562727 0.490613,-0.562727 0.67717,0 l1.43267,4.32867 c0.187587,0.562727 0.801884,1.0313 1.3698,1.04429 l4.36295,0.0941485 c0.566885,0.012986 0.661709,0.315993 0.209232,0.676354 l-3.47861,2.76818 c-0.451446,0.360361 -0.686446,1.12004 -0.523595,1.69034 l1.2657,4.3871 c0.163881,0.56922 -0.082456,0.757517 -0.547301,0.417716 l-3.58477,-2.61776 c-0.464846,-0.3398 -1.2255,-0.3398 -1.69138,0 l-3.58271,2.61776 c-0.465876,0.3398 -0.711183,0.152585 -0.547301,-0.417716 l1.26261,-4.3871 c0.163881,-0.56922 -0.0700876,-1.32998 -0.522565,-1.69034 L18.2855,6.56442 C17.8341,6.20406 17.9279,5.90105 18.4947,5.88807 l4.36398,-0.0941485 c0.566885,-0.012986 1.18324,-0.481564 1.36877,-1.04429 L25.6622,0.422045 z" fill="rgba(255, 168, 52, 1)"></path>             <rect y="0" x="34" width="2" measured-height="0" measured-width="2" dirty="true" min-height="0" min-width="2" explicit-width="2" height="0" fill="none"></rect>                  <path measured-height="16" measured-width="16" dirty="true" min-height="15" min-width="16" width="100%" height="100%" "="" d="M43.6622,0.422045 c0.185526,-0.562727 0.490613,-0.562727 0.67717,0 l1.43267,4.32867 c0.187587,0.562727 0.801884,1.0313 1.3698,1.04429 l4.36295,0.0941485 c0.566885,0.012986 0.661709,0.315993 0.209232,0.676354 l-3.47861,2.76818 c-0.451446,0.360361 -0.686446,1.12004 -0.523595,1.69034 l1.2657,4.3871 c0.163881,0.56922 -0.082456,0.757517 -0.547301,0.417716 l-3.58477,-2.61776 c-0.464846,-0.3398 -1.2255,-0.3398 -1.69138,0 l-3.58271,2.61776 c-0.465876,0.3398 -0.711183,0.152585 -0.547301,-0.417716 l1.26261,-4.3871 c0.163881,-0.56922 -0.0700876,-1.32998 -0.522565,-1.69034 L36.2855,6.56442 C35.8341,6.20406 35.9279,5.90105 36.4947,5.88807 l4.36398,-0.0941485 c0.566885,-0.012986 1.18324,-0.481564 1.36877,-1.04429 L43.6622,0.422045 z" fill="rgba(255, 168, 52, 1)"></path>             <rect y="0" x="52" width="2" measured-height="0" measured-width="2" dirty="true" min-height="0" min-width="2" explicit-width="2" height="0" fill="none"></rect>                  <path measured-height="16" measured-width="16" dirty="true" min-height="15" min-width="16" width="100%" height="100%" "="" d="M61.6622,0.422045 c0.185526,-0.562727 0.490613,-0.562727 0.67717,0 l1.43267,4.32867 c0.187587,0.562727 0.801884,1.0313 1.3698,1.04429 l4.36295,0.0941485 c0.566885,0.012986 0.661709,0.315993 0.209232,0.676354 l-3.47861,2.76818 c-0.451446,0.360361 -0.686446,1.12004 -0.523595,1.69034 l1.2657,4.3871 c0.163881,0.56922 -0.082456,0.757517 -0.547301,0.417716 l-3.58477,-2.61776 c-0.464846,-0.3398 -1.2255,-0.3398 -1.69138,0 l-3.58271,2.61776 c-0.465876,0.3398 -0.711183,0.152585 -0.547301,-0.417716 l1.26261,-4.3871 c0.163881,-0.56922 -0.0700876,-1.32998 -0.522565,-1.69034 L54.2855,6.56442 C53.8341,6.20406 53.9279,5.90105 54.4947,5.88807 l4.36398,-0.0941485 c0.566885,-0.012986 1.18324,-0.481564 1.36877,-1.04429 L61.6622,0.422045 z" fill="#CCCCCC"></path>             <rect y="0" x="70" width="2" measured-height="0" measured-width="2" dirty="true" min-height="0" min-width="2" explicit-width="2" height="0" fill="none"></rect>                  <path measured-height="16" measured-width="16" dirty="true" min-height="15" min-width="16" width="100%" height="100%" "="" d="M79.6622,0.422045 c0.185526,-0.562727 0.490613,-0.562727 0.67717,0 l1.43267,4.32867 c0.187587,0.562727 0.801884,1.0313 1.3698,1.04429 l4.36295,0.0941485 c0.566885,0.012986 0.661709,0.315993 0.209232,0.676354 l-3.47861,2.76818 c-0.451446,0.360361 -0.686446,1.12004 -0.523595,1.69034 l1.2657,4.3871 c0.163881,0.56922 -0.082456,0.757517 -0.547301,0.417716 l-3.58477,-2.61776 c-0.464846,-0.3398 -1.2255,-0.3398 -1.69138,0 l-3.58271,2.61776 c-0.465876,0.3398 -0.711183,0.152585 -0.547301,-0.417716 l1.26261,-4.3871 c0.163881,-0.56922 -0.0700876,-1.32998 -0.522565,-1.69034 L72.2855,6.56442 C71.8341,6.20406 71.9278,5.90105 72.4947,5.88807 l4.36398,-0.0941485 c0.566885,-0.012986 1.18324,-0.481564 1.36877,-1.04429 L79.6622,0.422045 z" fill="#CCCCCC"></path>             <rect y="0" x="88" width="2" measured-height="0" measured-width="2" dirty="true" min-height="0" min-width="2" explicit-width="2" height="0" fill="none"></rect></svg> </svg> -->
				</div>
				<br>
				<div class="row">
					<div class="col-md-6">
						<p>
							<a href="{{ url("/posts/user/{$user->username}") }}">
								{{ $user->posts->count() }} posts
							</a>
						</p>
					</div>
					<div class="col-md-6">
						<p>{{ $user->comments->count() }} comments</p>
					</div>
					<p class="col-md-12">Last login: <br> {{ $user->throttle->last_login }}</p>
				</div>
			</div>
		@else
			<div class="btn-group btn-group-justified">
				<a href="{{ Url::to('login') }}" class="btn btn-default">Login</a>
				<a href="#" class="btn btn-primary">f | facebook</a>
			</div>
		@endif
		
		<br>

		@foreach(Category::all() as $category)
			<div>
				<a href="{{ url("/posts/category/{$category->name}") }}">
					<img class="img-responsive" src="{{ cat_image_url($category->image) }}" >
				</a>
			</div>

			<br>
		@endforeach
	</div>

</div>