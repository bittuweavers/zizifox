
@extends('admn-template.app')

@section('style')
	<link href="{{ asset('css/uploadfile.css')}}" rel="stylesheet" />
@stop
@section('content')
<div class="row">
	<div class="col-md-12">
		<div class="panel panel-default">
			<div class="panel-heading">
				<h4 class="title">Dictionary Admin Settings</h4>
			</div>
			{{ Form::open(['method' => 'POST', 'url' => 'admin/settings/update' ]) }}
				<div class="panel-body">
					<!------------------------Fornt Content Settings---------------------------->
					<section class="admin-setting-section">
					<div class="row">
						<div class="col-xs-12 form-group">
							<h4>Page Content</h4>
						</div>
					</div>
					
					<div class="row">
						<div class="col-xs-12 form-group">
							{{ Form::label('Home Page Content', 'Home Page Content', ['class' => 'control-label']) }}
							<?php $home_page_content = \App\Models\Settings::getSettings('home-page-content');?>
							<textarea class="form-control" name="settings[home-page-content]" Required >{{$home_page_content}}</textarea>
							
						</div>
					</div>
					</section>
				<?php /*
					<!------------------------Contact Form Settings---------------------------->
					<section class="admin-setting-section">
					<div class="row">
						<div class="col-xs-12 form-group">
							<h4>Contact Form Settings</h4>
						</div>
					</div>
					
					<div class="row">
						<div class="col-xs-12 form-group">
							{{ Form::label('Admin Email Address', 'Admin Email Address)', ['class' => 'control-label']) }}
							<?php $adminEmail = \App\Models\Settings::getSettings('admin-email');?>
							<input type="text" class="form-control" name="settings[admin-email]" value="{{$adminEmail}}">
						</div>
					</div>
					</section>
					<!---------------------------------------------------->
					*/ ?>
					<!------------------------Header Footer Settings---------------------------->
					<section class="admin-setting-section">
					<div class="row">
						<div class="col-xs-12 form-group">
							<h4>Logo Settings</h4>
						</div>
					</div>
					<div class="row">
						<div class="col-xs-12 form-group">
							{{ Form::label('Logo', 'Logo', ['class' => 'control-label']) }}
							<?php $headerLogo = \App\Models\Settings::getSettings('header-logo');?>
							<input type="text" id="header-logo" class="form-control" name="settings[header-logo]" value="{{$headerLogo}}" Required>
							<div id="headerLogouploader">Upload</div>
						</div>
					</div>
				<?php /*	
					<div class="row">
						<div class="col-xs-12 form-group">
							{{ Form::label('Footer Logo', 'Footer Logo', ['class' => 'control-label']) }}
							<?php $footerLogo = \App\Models\Settings::getSettings('footer-logo');?>
							<input type="text" id="footer-logo" class="form-control" name="settings[footer-logo]" value="{{$footerLogo}}">
							<div id="footerLogouploader">Upload</div>
						</div>
					</div>
					<div class="row">
						<div class="col-xs-12 form-group">
							{{ Form::label('Footer bottom text', 'Footer bottom text', ['class' => 'control-label']) }}
							<?php $footerBottomText = \App\Models\Settings::getSettings('footer-bottom-text');?>
							<textarea  class="form-control" name="settings[footer-bottom-text]">{{$footerBottomText}}</textarea>
							
						</div>
					</div>
					<div class="row">
						<div class="col-xs-12 form-group">
							{{ Form::label('Footer copyright text', 'Footer copyright text', ['class' => 'control-label']) }}
							<?php $footerCopyrightText = \App\Models\Settings::getSettings('footer-copyright-text');?>
							<textarea  class="form-control" name="settings[footer-copyright-text]">{{$footerCopyrightText}}</textarea>
							
						</div>
					</div>
					</section>
					<!---------------------------------------------------->
					
					<!------------------------Social media Settings---------------------------->
					<section class="admin-setting-section">
					<div class="row">
						<div class="col-xs-12 form-group">
							<h4>Social media Settings</h4>
						</div>
					</div>
					<div class="row">
						<div class="col-xs-12 form-group">
							{{ Form::label('Facebook Link', 'Facebook Link', ['class' => 'control-label']) }}
							<?php $facebookLink = \App\Models\Settings::getSettings('facebook-link');?>
							<input type="text" class="form-control" name="settings[facebook-link]" value="{{$facebookLink}}">
							
						</div>
					</div>
					
					<div class="row">
						<div class="col-xs-12 form-group">
							{{ Form::label('Twitter Link', 'Twitter Link', ['class' => 'control-label']) }}
							<?php $twitterLink = \App\Models\Settings::getSettings('twitter-link');?>
							<input type="text" class="form-control" name="settings[twitter-link]" value="{{$twitterLink}}">
							
						</div>
					</div>
					
					<div class="row">
						<div class="col-xs-12 form-group">
							{{ Form::label('Linkedin Link', 'Linkedin Link', ['class' => 'control-label']) }}
							<?php $linkedinLink = \App\Models\Settings::getSettings('linkedin-link');?>
							<input type="text" class="form-control" name="settings[linkedin-link]" value="{{$linkedinLink}}">
							
						</div>
					</div>
					
					<div class="row">
						<div class="col-xs-12 form-group">
							{{ Form::label('Instagram Link', 'Instagram Link', ['class' => 'control-label']) }}
							<?php $instagramLink = \App\Models\Settings::getSettings('Instagram-link');?>
							<input type="text" class="form-control" name="settings[instagram-link]" value="{{$instagramLink}}">
							
						</div>
					</div>
					</section>
					<!---------------------------------------------------->
					*/ ?>

					<!-------------------------Google Ads---------------------------------->

					<section class="admin-setting-section">
					<div class="row">
						<div class="col-xs-12 form-group">
							<h4>Ads Section</h4>
						</div>
					</div>
					<?php /*
					<div class="row">
						<div class="col-xs-12 form-group">
							{{ Form::label('Home Page Left Ads', 'Home Page Left Ads', ['class' => 'control-label']) }}
							<?php $homepageleftads = \App\Models\Settings::getSettings('home-page-left-ads');?>
							<textarea class="form-control" name="settings[home-page-left-ads]" Required >{{$homepageleftads}}</textarea>
							
						</div>
					</div> */ ?>
					
					<div class="row">
						<div class="col-xs-12 form-group">
							{{ Form::label('Bottom Ads', 'Home Page Bottom Ads', ['class' => 'control-label']) }}
							<?php $homepagebottomads = \App\Models\Settings::getSettings('home-page-bottom-ads');?>
							<textarea class="form-control" name="settings[home-page-bottom-ads]" Required >{{$homepagebottomads}}</textarea>
							
						</div>
					</div>

					<div class="row">
						<div class="col-xs-12 form-group">
							{{ Form::label('Search Page Left Ads', 'Search Page Left Ads', ['class' => 'control-label']) }}
							<?php $searchpageleftads = \App\Models\Settings::getSettings('search-page-left-ads');?>
							<textarea class="form-control" name="settings[search-page-left-ads]" Required >{{$searchpageleftads}}</textarea>
							
						</div>
					</div>

					<div class="row">
						<div class="col-xs-12 form-group">
							{{ Form::label('Search Page Right Ads', 'Search Page Right Ads', ['class' => 'control-label']) }}
							<?php $searchpagerightads = \App\Models\Settings::getSettings('search-page-right-ads');?>
							<textarea class="form-control" name="settings[search-page-right-ads]" Required >{{$searchpagerightads}}</textarea>
							
						</div>
					</div>
					<div class="row">
						<div class="col-xs-12 form-group">
							{{ Form::label('Right Ads', 'Inner Page Right Ads', ['class' => 'control-label']) }}
							<?php $innerpagerightads = \App\Models\Settings::getSettings('inner-page-right-ads');?>
							<textarea class="form-control" name="settings[inner-page-right-ads]" Required >{{$innerpagerightads}}</textarea>
							
						</div>
					</div> 
					</section>

					<!--------------------------------------------------------------------->

						<!------------------------Header Footer Settings---------------------------->
					<section class="admin-setting-section">
					<div class="row">
						<div class="col-xs-12 form-group">
							<h4>Api Setting</h4>
						</div>
					</div>
					<div class="row">
						<div class="col-xs-12 form-group">

							<?php $api_status = \App\Models\Settings::getSettings('api-status');?>
							<div class="api_en_db"> Api Status</div>
							<div class="onoffswitch">
								    <input type="checkbox" name="settings[api-status]"  @if($api_status=='1') {{'checked'}} @endif class="onoffswitch-checkbox" id="myonoffswitch" >
								    <label class="onoffswitch-label" for="myonoffswitch">
								        <span class="onoffswitch-inner"></span>
								        <span class="onoffswitch-switch"></span>
								    </label>
							</div>
							
							
						</div>



						<div class="col-xs-12 form-group">
							{{ Form::label('Api Token', 'Api Token', ['class' => 'control-label']) }}
							<?php $api_token = \App\Models\Settings::getSettings('api-token');?>
							<textarea class="form-control" id="api_token" name="settings[api-token]" Required >{{$api_token}}</textarea>
							<a href="JavaScript:void(0)" onclick="token();" class="generate_token_btn btn btn-info">Generate Token</a>
						</div>
					</div>
					<!--------------------------------------------------------------------->
					<div class="row">
						<div class="col-xs-12 form-group">
							{{ Form::submit('save', ['class' => 'btn btn-info']) }}
						</div>
					</div>
				</div>
			{{ Form::close() }}
		</div>
	</div>
</div>
<style>
.api_en_db{	
	font-weight: 400;
    font-size: 14px;
    margin-top: 1px;
    margin-bottom: 5px;
}
p.help-tip {
    font-size: 12px;
    padding: 5px 4px;
    border: 1px solid #c3c3bd;
    width: 40%;
    border-radius: 2px;
}
section.admin-setting-section {
    border: 1px solid #4d6796;
    margin-bottom: 5px;
    padding: 10px;
}

section.admin-setting-section h4 {
    font-size: 25px;
    text-decoration: underline;
    font-weight: 500;
}
.admin-setting-section textarea.form-control {
    height: 100px;
}

.onoffswitch {
    position: relative; width: 100px;
    -webkit-user-select:none; -moz-user-select:none; -ms-user-select: none;
}
.onoffswitch-checkbox {
    display: none;
}
.onoffswitch-label {
    display: block; overflow: hidden; cursor: pointer;
    border: 2px solid #999999; border-radius: 20px;
}
.onoffswitch-inner {
    display: block; width: 200%; margin-left: -100%;
    transition: margin 0.3s ease-in 0s;
}
.onoffswitch-inner:before, .onoffswitch-inner:after {
    display: block; float: left; width: 50%; height: 30px; padding: 0; line-height: 30px;
    font-size: 14px; color: white; font-family: Trebuchet, Arial, sans-serif; font-weight: bold;
    box-sizing: border-box;
}
.onoffswitch-inner:before {
    content: "Enable";
    padding-left: 10px;
    background-color: #34A7C1; color: #FFFFFF;
}
.onoffswitch-inner:after {
    content: "Disable";
    padding-right: 10px;
    background-color: #EEEEEE; color: #999999;
    text-align: right;
}
.onoffswitch-switch {
    display: block; width: 18px; margin: 6px;
    background: #FFFFFF;
    position: absolute; top: 0; bottom: 0;
    /*right: 56px;*/
    border: 2px solid #999999; border-radius: 20px;
    transition: all 0.3s ease-in 0s; 
}
.onoffswitch-checkbox:checked + .onoffswitch-label .onoffswitch-inner {
    margin-left: 0;
}
.onoffswitch-checkbox:checked + .onoffswitch-label .onoffswitch-switch {
    right: 0px; 
}
</style>
@stop
@section('javascript')
<script src="{{ asset('js/jquery.uploadfile.js')}}"></script>
<script>
jQuery(document).ready(function() {
	jQuery("#headerLogouploader").uploadFile({
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
			jQuery("#header-logo").val(response.response.file_path);
		}
	});
	jQuery("#footerLogouploader").uploadFile({
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
			jQuery("#footer-logo").val(response.response.file_path);
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
