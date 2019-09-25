@extends('admn-template.app')

@section('style')
	
	<link href="{{ asset('css/uploadfile.css')}}" rel="stylesheet" />
@stop

@section('content')


<div class="row">
	<div class='col-sm-12'>
		<h2> Edit Page</h2>
        {{ Form::model($page, ['method' => 'PUT', 'route' => ['admin.pages.update', $page->id]]) }}
		

		<div class='form-group'>
			{{ Form::label('title', 'Title') }}
			{{ Form::text('title', null, ['placeholder' => 'Title', 'class' => 'form-control', 'id' => 'page-title']) }}
		</div>
		
		<div class="form-group {!! $errors->has('page_slug') ? 'has-error' : '' !!}">
			{!! Form::label('page_slug', 'Url:', ['class' => 'control-label']) !!}
			{!! url('/') . '/' . Form::text('page_slug', null, ['id' => 'permalien', 'readonly' => 'true']) !!}
			<small class="text-danger">{!! $errors->first('page_slug') !!}</small>
		</div>
		
		<div class="row">
			<div class='col-sm-12'>
				<div class='form-group'>
					{{ Form::label('Content', 'Content') }}
					{{ Form::textarea('content', null, ['placeholder' => 'Write page content here', 'class' => 'form-control']) }}
				</div>
			</div>
		</div>

		<div class='form-group'>
			{{ Form::label('banner_image', 'Banner Image', ['class' => 'control-label']) }}
			<input type="hidden" id="banner_url" class="form-control" name="banner_image" value="{{$page->banner_image}}" >
			<div id="bannerimage">Upload</div>
			@if($page->banner_image)
			<div id="influence_image">
			<img src="{{$page->banner_image}}" alt="{{$page->title}}" width=100>
			</div>
			@endif

		</div>

		<div class='form-group'>
			{!! Form::submit(trans('Update'), ['class' => 'btn btn-danger']) !!}
		</div>

		{{ Form::close() }}

	</div>
</div>
<style>
textarea.faq-control {
    display: block;
    width: 100%;
    height: 80px;
    padding: 6px 12px;
    font-size: 14px;
    line-height: 1.42857143;
    color: #555;
    background-color: #fff;
    background-image: none;
    border: 1px solid #ccc;
    border-radius: 4px;
    box-shadow: inset 0 1px 1px rgba(0,0,0,.075);
    -webkit-transition: border-color ease-in-out .15s,-webkit-box-shadow ease-in-out .15s;
    -o-transition: border-color ease-in-out .15s,box-shadow ease-in-out .15s;
    transition: border-color ease-in-out .15s,box-shadow ease-in-out .15s;
}

</style>


@stop

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
	<script>
	
	var config = {
		codeSnippet_theme: 'Monokai',
		language: '{{ config('app.locale') }}',
		height: 100,
		toolbarGroups: [
			{ name: 'clipboard',   groups: [ 'clipboard', 'undo' ] },
			{ name: 'editing',     groups: [ 'find', 'selection', 'spellchecker' ] },
			{ name: 'links' },
			{ name: 'insert' },
			{ name: 'forms' },
			{ name: 'tools' },
			{ name: 'document',	   groups: [ 'mode', 'document', 'doctools' ] },
			{ name: 'others' },
			//'/',
			{ name: 'basicstyles', groups: [ 'basicstyles', 'cleanup' ] },
			{ name: 'paragraph',   groups: [ 'list', 'indent', 'blocks', 'align', 'bidi' ] },
			{ name: 'styles' },
			{ name: 'colors' }
		],
	};
	config['height'] = 400;		

	CKEDITOR.replace( 'content', config);
	/*function sansAccent(str){
		var accent = [
			/[\300-\306]/g, /[\340-\346]/g, // A, a
			/[\310-\313]/g, /[\350-\353]/g, // E, e
			/[\314-\317]/g, /[\354-\357]/g, // I, i
			/[\322-\330]/g, /[\362-\370]/g, // O, o
			/[\331-\334]/g, /[\371-\374]/g, // U, u
			/[\321]/g, /[\361]/g, // N, n
			/[\307]/g, /[\347]/g // C, c
		];
		var noaccent = ['A','a','E','e','I','i','O','o','U','u','N','n','C','c'];
		for(var i = 0; i < accent.length; i++){
			str = str.replace(accent[i], noaccent[i]);
		}
		return str;
	}
	jQuery("#page-title").keyup(function(){
		var str = sansAccent($(this).val());
		str = str.replace(/[^a-zA-Z0-9\s]/g,"");
		str = str.toLowerCase();
		str = str.replace(/\s/g,'-');
		jQuery("#permalien").val(str);        
	}); */
	
  </script>
  

@stop	