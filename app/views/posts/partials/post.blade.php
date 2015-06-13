<div class="panel panel-default">
    <div class="panel-body">

        <div class="row">
			<div class="col-md-4 blog-img blog-tag-data">
				<img src="{{ post_image_url($post->image) }}" alt="" class="img-responsive" style="margin-bottom: 12px;">
				<ul class="list-inline" style="font-size: 14px;">
					<li>
						<i class="fa fa-calendar"></i>
						{{ $post->updated_at->format('F j, Y') }}
					</li>
					<li class="pull-right">
						{{ $post->comments->count() }} <i class="fa fa-comments"></i>
						 <!-- Bình luận -->
					</li>
				</ul>
				<ul class="list-inline blog-tags" style="font-size: 14px;">

					<li>
						<i class="fa fa-tags"></i>
						@foreach($post->tags as $tag)
				            <a href="{{ url("/posts/tag/{$tag->name}") }}">#{{ $tag->name }}</a>
				        @endforeach
					</li>
				</ul>
			</div>
			<div class="col-md-8 blog-article">
				<h3 style="margin-top: 0px;">{{ link_to($post->url, $post->title) }}</h3>

				<!-- <p class="text-muted">{{ mb_strtoupper($post->updated_at->diffForHumans()) }}</p> -->

				<p>{{ str_limit($post->content, 380, "...") }}</p>

				<a class="btn btn-primary btn-sm pull-left" href="{{ $post->url }}">Xem bài viết</a>

			</div>
		</div>

    </div>
</div>