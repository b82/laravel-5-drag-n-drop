@extends('admin')

@section('content')

	<div class="container admin-panel">
		
		<div class="row">
			<div class="col-md-3"><strong>News: ({{ $dataCount }})</strong></div>
			<div class="col-md-7"></div>
			<div class="col-md-2">
				Insert news: <a href="{{ url('admin/news/create') }}" class="btn btn-primary btn-xs admin-create-news"><i class="glyphicon glyphicon-plus"></i></a>
			</div>
		</div>

		@if($dataCount > 0)

			<ul id="post-list" class="news-list">

				@foreach($news AS $post)

					<li id="sort_{{ $post->id }}" class="row sortable">
						<div class="col-md-2">{{$post->title}}</div>
						<div class="col-md-8">
							<article class="admin-news" draggable="true" data-order="{{ $post->order_posts }}">
								<?php 
									if(strlen($post->cont) > 100){
										echo substr($post->cont, 0, strpos(wordwrap($post->cont, 100), "\n")).' ...';
									}else{
										echo $post->cont;
									}
								?>
							</article>
						</div>
						<div class="col-md-1">
							<a href="{{ url('admin/news/').'/'.$post->id }}/edit" class="btn btn-xs btn-primary admin-edit-news">Edit <span class="glyphicon glyphicon-pencil"></span></a>
						</div>
						<div class="col-md-1">
							{!! Form::open(array('class' => 'form-inline admin-delete-news', 'method' => 'DELETE', 'route' => array('admin.news.destroy', $post->id))) !!}
								<button class="btn btn-xs btn-danger" type="submit" value="Delete">Delete <span class="glyphicon glyphicon-trash"></span></button>
							{!! Form::close() !!}
						</div>
					</li>

				@endforeach

			</ul>

		@else

			<div>No news loaded..</div>

		@endif

	</div>

@stop