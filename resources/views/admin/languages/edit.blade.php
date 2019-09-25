@extends('admn-template.app')

@section('content')
<div class="row">
	<div class="col-md-12">
	<div class="form">
		<div class="main-div cust">
        <div class="panel panel-default">
			<div class="panel-heading">
				<h4 class="title">Update Language</h4>
			</div>
			{{ Form::model($language, ['method' => 'PUT', 'route' => ['admin.languages.update', $language->id]]) }}
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
					</div>		
					<div class="row">
						<div class="col-md-12 form-group">
							{{ Form::submit('Update', ['class' => 'btn btn-primary']) }}
						</div>
					</div>
				</div>
			{{ Form::close() }}

		</div>
	</div>
</div>
</div>
</div>

@endsection

