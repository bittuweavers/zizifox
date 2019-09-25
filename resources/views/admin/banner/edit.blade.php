@extends('admn-template.app')

@section('style')
	
	<link href="{{ asset('css/uploadfile.css')}}" rel="stylesheet" />
@stop

@section('content')


<div class="row">
	<div class='col-sm-12'>
		<h2> Edit Page</h2>
        {{ Form::model($banner, ['method' => 'PUT', 'route' => ['admin.banners.update', $banner->id]]) }}
		

		<div class='form-group'>
			{{ Form::label('banner_title', 'Title') }}
			{{ Form::text('banner_title', null, ['placeholder' => 'Title', 'class' => 'form-control', 'id' => 'banner-title']) }}
		</div>
		<div class='form-group'>
			{{ Form::label('banner_image', 'Banner Image', ['class' => 'control-label']) }}
			<input type="hidden" id="banner_url" class="form-control" name="banner_image" value="{{$banner->banner_url}}" >
			<div id="bannerimage">Upload</div>
			@if($banner->banner_url)
			<div id="influence_image">
			<img src="{{$banner->banner_url}}" alt="{{$banner->title}}" width=100>
			</div>
			@endif

		</div>
		<div class='form-group'>
			<?php $array = explode(",",$banner->page_type); ?>
			<input type="checkbox" name="page_type[]" value="1" <?php if(in_array('1',$array)){ echo "checked";  } ?>>Home 
  			<input type="checkbox" name="page_type[]" value="2" <?php if(in_array('2',$array)){ echo "checked";  } ?> >Influencer Home
  			<input type="checkbox" name="page_type[]" value="3" <?php if(in_array('3',$array)){ echo "checked";  } ?>>Search Result
  			<input type="checkbox" name="page_type[]" value="4" <?php if(in_array('4',$array)){ echo "checked";  } ?> >Influencer Search Result
		</div>
	

		<div class='form-group'>
			{!! Form::submit(trans('Update'), ['class' => 'btn btn-danger']) !!}
		</div>

		{{ Form::close() }}

	</div>
</div>

@section('javascript')
<script src="{{ asset('js/jquery.uploadfile.js')}}"></script>

<script>
jQuery(document).ready(function() {
	jQuery("#bannerimage").uploadFile({
		url:"{{ url('admin/ajax-upload-photo') }}",
		fileName:"image",
		showPreview: true,
		showProgress: true,
		showError: false,
		showStatusAfterError: false,
		showFileCounter: false,
		multiple: false,
		showCancel: false,
		showAbort: false,
		dragDropStr: '',
		dragdropWidth: '28%',
		showFileSize: false,
		previewHeight: "60px",
		previewWidth: "auto",
		headers: {'X-CSRF-TOKEN': "{{ csrf_token() }}"},
		onSuccess: function (files, response, xhr, pd) {
			jQuery('#influence_image').hide();
			jQuery("#banner_url").val(response.response.file_path);
		}
	});

});	

var rand = function() {
    return Math.random().toString(36).substr(2); // remove `0.`
};

var token = function() {
    var tk = rand() + rand() + rand() + rand(); // to make it longer
    jQuery("#api_token").val(tk);
    
};

</script>

@stop	

@stop	