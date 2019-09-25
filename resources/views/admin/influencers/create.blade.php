@extends('admn-template.app')
@section('style')
<style type="text/css">
	.cust{
		    max-width: 80% !important;
	}
	.select2-container{
		background: #f7f7f7 none repeat scroll 0 0;
    border: 1px solid #d4d4d4;
    border-radius: 4px;
    font-size: 14px;
    line-height: 26px;
	}
</style>
	<link href="{{ asset('css/uploadfile.css')}}" rel="stylesheet" />

@stop
@section('content')
<div class="row">
	<div class="col-md-12">
    <div class="form">
        <div class="main-div cust">
        <div class="panel panel-default">
			<div class="panel-heading">
				<h4 class="title">Create Influencer</h4>
			</div>
			{{ Form::open(['method' => 'POST','files' => true, 'route' => ['admin.influencers.store']]) }}
				<div class="panel-body">
					<div class="row">
						
						<div class="col-md-12 form-group">
						{{ Form::label('title', 'Title*', ['class' => 'control-label']) }}

							{{ Form::text('title', old('title'), ['class' => 'form-control', 'placeholder' => 'Title', 'required' => '']) }}
							<p class="help-block"></p>
							@if($errors->has('title'))
								<p class="help-block">
									{{ $errors->first('title') }}
								</p>
							@endif
						</div>
						<div class="col-md-12 form-group">
							{{ Form::label('description', 'Description', ['class' => 'control-label']) }}
							{{ Form::textarea('description', old('description'), ['class' => 'form-control','placeholder' => 'Description','style' => 'height:150px;']) }}
						
						</div>
											
					</div>
					<div class="row">
						<div class="col-md-12 form-group">
							{{ Form::label('Logo', 'Logo', ['class' => 'control-label']) }}
							
							<input type="text" id="logo" class="form-control" name="logo" value="">
							<div id="influencerslogo">Upload</div>
						</div>
					</div>

					<div class="row">
						<div class="col-md-12 form-group">
							{{ Form::label('Description Image', 'Description Image', ['class' => 'control-label']) }}
							
							<input type="text" id="description_image" class="form-control" name="description_image" value="">
							<div id="descriptionimage">Upload</div>
						</div>
					</div>
					<div class="row">
						<div class="col-md-12 form-group">
							{{ Form::label('site_url', 'Site URL', ['class' => 'control-label']) }}
							{{ Form::text('site_url', old('site_url'), ['class' => 'form-control', 'placeholder' => 'Site URL']) }}
						</div>
					</div>
					<div class="row">
						<div class="col-md-12 form-group">
							{{ Form::label('youtube_channel_url', 'Youtube Channel URL', ['class' => 'control-label']) }}
							{{ Form::text('youtube_channel_url', old('youtube_channel_url'), ['class' => 'form-control', 'placeholder' => 'Youtube Channel URL']) }}
						</div>
					</div>				
					<div class="row">
						<div class="col-md-12 form-group">
							{{ Form::label('subscription_custom_url', 'Subscription Custom URL', ['class' => 'control-label']) }}
							{{ Form::text('subscription_custom_url', old('subscription_custom_url'), ['class' => 'form-control', 'placeholder' => 'Subscription Custom URL']) }}
						</div>
					</div>	
					<div class="row">
						<div class="col-md-12 form-group">
							{{ Form::label('Channel', 'Channel', ['class' => 'control-label']) }}
							 <select id="channel_list" name="channel[]" class="form-control" multiple required=""></select>
							
						</div>
					</div>	
	
								
					<div class="row">
						<div class="col-md-12 form-group">
							{{ Form::submit('save', ['class' => 'btn btn-primary']) }}
						</div>
					</div>
				</div>	
			{{ Form::close() }}

		</div>
	</div></div>	
	</div>
</div>


@endsection



@section('javascript')
<script src="{{ asset('js/jquery.uploadfile.js')}}"></script>

<script>
jQuery(document).ready(function() {
	jQuery("#influencerslogo").uploadFile({
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
			jQuery("#logo").val(response.response.file_path);
		}
	});

	jQuery("#descriptionimage").uploadFile({
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
			jQuery("#description_image").val(response.response.file_path);
		}
	});


	     jQuery('#channel_list').select2({
            placeholder: "Choose Channels...",
            minimumInputLength: 2,
            ajax: {
                url: "{{ url('admin/channel/find') }}",
                dataType: 'json',
                data: function (params) {
                    return {
                        q: $.trim(params.term)
                    };
                },
                processResults: function (data) {
                    return {
                        results: data
                    };
                },
                cache: true
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

CKEDITOR.replace('description')
</script>
@stop