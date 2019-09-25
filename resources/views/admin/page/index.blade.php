@extends('admn-template.app')
@section('content')

<div class="row">
	<div class="col-sm-12">

		    <div class="col-md-6 col-md-offset-3">
				@if(Session::has('message'))
				<p class="alert {{ Session::get('alert-class', 'alert-info') }}">{{ Session::get('message') }}</p>
				@endif
            </div>
		<div class="table-responsive">
			<table class="table table-bordered table-striped">

				<thead>
					<tr>
						<th>Title</th>
						<th>Slug</th>
						<th>Date/Time Added</th>
						<th></th>
					</tr>
				</thead>

				<tbody>
					@foreach ($pages as $page)
					<tr>
						<td>{{ $page->title }}</td>
						<td>{{ $page->page_slug }}</td>
						<td>{!! $page->created_at !!}</td>
						<td>
							<a href="{{url('/').'/'.$page->page_slug}}" class="btn btn-success pull-left" style="margin-right: 3px;" target="_blank">View</a>
							<a href="{{url('admin/pages/edit/'.$page->id)}}" class="btn btn-info pull-left" style="margin-right: 3px;">Edit</a>
							@php /*
							{!! Form::open(array(
								'style' => 'display: inline-block;',
								'method' => 'DELETE',
								'onsubmit' => "return confirm('Are you sure ?');",
								'route' => ['admin.pages.destroy', $page->id])) !!}
								{!! Form::submit('Delete', array('class' => 'btn btn-danger')) !!}
							{!! Form::close() !!} */ @endphp

							
						</td>
					</tr>
					@endforeach
				</tbody>
			
			</table>
			{{ $pages->links() }}
		</div>

	</div>
</div>


@stop