@extends('admn-template.app')

@section('content')
<?php $message = Session::get('message'); ?>
@if($message)
	<div class = "alert alert-danger">
		<ul>
			@foreach($message as $single_message)
				<li>{{ $single_message }}</li>
			 @endforeach
		</ul>
	</div>
@endif
<div class="row">
	<div class="col-md-12">
    <div class="form">
        <div class="main-div">
        <div class="panel panel-default">
			<div class="panel-heading">
				<h4 class="title">Add Video</h4>
			</div>
			{{ Form::open(['method' => 'POST','files' => true,'route' => ['admin.videos.store']] ) }}
				<div class="panel-body">
					<div class="row">
						<div class="col-md-12">
							<div class="col-xs-12 form-group">
								{{ Form::label('video_id_url', 'Please paste youtube link or video id*', ['class' => 'control-label']) }}

								{{ Form::text('video_id_url', old('video_id'), ['class' => 'form-control', 'placeholder' => 'Youtube Video Id OR URl', 'required' => '']) }}
								<p class="help-block"></p>
							
							</div>
					
						</div>
						</div>						
						<div class="row">
						<div class="col-md-12 form-group">
							{{ Form::label('channel_name', 'Channel Name', ['class' => 'control-label']) }}
							{{ Form::text('channel_name', old('channel_name'), ['class' => 'form-control', 'placeholder' => 'Channel Name']) }}
						</div>
											
					</div>
	
					<div class="row">
						<div class="col-md-12 form-group">
							<label for="lang" class="control-label">Language*</label>
							<select name="lang" class="form-control">
								@if($language->count()>0)
								@foreach($language as $key=>$val)
									
									<option value="{{$val->lang_code}}">{{$val->lang_name}}</option>
								@endforeach	
								@else
									<option value="us">US</option>			
								@endif   
							</select>
						</div>
											
					</div>	
					<div class="row">
						<div class="col-md-12">	
						</div>					
					</div>			
					<div class="row">
						<div class="col-xs-12 form-group">
							{{ Form::submit('save', ['class' => 'btn btn-primary']) }}
						</div>
					</div>
				</div>	
			{{ Form::close() }}

		</div>
	</div></div>	
	</div>
</div>

<style>
.main-div {
    background: #ffffff none repeat scroll 0 0;
    border-radius: 2px;
    margin: 10px auto 30px;
    max-width: 100%;
    padding: 50px 70px 70px 71px;
}
</style>
@endsection

