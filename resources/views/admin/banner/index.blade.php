@extends('admn-template.app')
@section('content')

<div class="row">
	<div class="col-sm-12">
		<h2>Banners <a href="{{url('admin/banners/add')}}" class="btn btn-success pull-right">Add Banners</a></h2>
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
						<th>Image Url</th>
						<th>Date/Time Added</th>
						<th></th>
					</tr>
				</thead>

				<tbody>
					@foreach ($banners as $banner)
					<tr>
						<td>{{ $banner->banner_title }}</td>
						<td>{{ $banner->banner_url }}</td>
						<td>{!! $banner->created_at !!}</td>
						<td>
							<a href="{{url('admin/banners/edit/'.$banner->id)}}" class="btn btn-info pull-left" style="margin-right: 3px;">Edit</a>
							
							{!! Form::open(array(
								'style' => 'display: inline-block;',
								'method' => 'DELETE',
								'onsubmit' => "return confirm('Are you sure ?');",
								'route' => ['admin.banners.destroy', $banner->id])) !!}
								{!! Form::submit('Delete', array('class' => 'btn btn-danger')) !!}
							{!! Form::close() !!}

							
						</td>
					</tr>
					@endforeach
				</tbody>
			
			</table>
			{{ $banners->links() }}
		</div>

	</div>
</div>


@stop