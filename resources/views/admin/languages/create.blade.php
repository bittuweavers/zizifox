@extends('admn-template.app')
@section('content')
<div class="row">
	<div class="col-md-12">
    <div class="form">
        <div class="main-div cust">
        <div class="panel panel-default">
			<div class="panel-heading">
				<h4 class="title">Create Language</h4>
			</div>
			{{ Form::open(['method' => 'POST','files' => true, 'route' => ['admin.languages.store']]) }}
				<div class="panel-body">
					<div class="row">
						
						<div class="col-md-12 form-group">
						{{ Form::label('lang_name', 'Language Name*', ['class' => 'control-label']) }}

							{{ Form::text('lang_name', old('lang_name'), ['class' => 'form-control', 'placeholder' => 'Title', 'required' => '']) }}
							<p class="help-block"></p>
							@if($errors->has('lang_name'))
								<p class="help-block">
									{{ $errors->first('lang_name') }}
								</p>
							@endif
						</div>
											
					</div>

					<div class="col-md-12 form-group">
							{{ Form::label('lang_code', 'Language Code*', ['class' => 'control-label']) }}

								{{ Form::text('lang_code', old('lang_code'), ['class' => 'form-control', 'placeholder' => 'Language Code', 'required' => '']) }}
								<p class="help-block"></p>
								@if($errors->has('lang_code'))
									<p class="help-block">
										{{ $errors->first('lang_code') }}
									</p>
								@endif
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