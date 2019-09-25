@extends('fornt-template.app')

@section('content')
<!-- Start Banner Section -->
<section class="banner_cover text_inside" style="background: url('{{$page->banner_image}}');background-repeat: no-repeat;background-size: cover;background-position: top center;">
	<div class="container">
		  @include('forntend.menu')
	</div>
</section>
<!-- End Banner Section -->

<!-- Start banner Add Section  -->
<section class="inside_wrap">
	<div class="container-fluid">
		<div class="row">
			<div class="col-md-10">
				<div class="content_sec">
					{!! $page->content !!}
				</div>
			</div>
			<div class="col-md-2">
				<div class="img_sec">
					<?php $innerpagerightads = \App\Models\Settings::getSettings('inner-page-right-ads');?>
          			{!! $innerpagerightads !!}
				</div>
			</div>
		</div>
	</div>
</section>
<!-- End banner Add Section  -->

@stop 