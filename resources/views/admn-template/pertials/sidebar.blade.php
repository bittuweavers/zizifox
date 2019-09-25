		<style>
		.logo img {
			height: auto;
		}
		</style>
		<div class="sidebar-wrapper">
            <div class="logo">
                <a href="{{url('/')}}" class="simple-text">
                	<?php $headerLogo = \App\Models\Settings::getSettings('header-logo');?>
					<img src="{{$headerLogo}}" width="80" >
                </a>
            </div>

            <ul class="nav" id="sidebar-menu">
				@if(Request::is('admin/videos/add'))
					<?php $videosaddmenuClass = 'active'; ?>
				@else
					<?php $videosaddmenuClass = ''; ?>
				@endif

				@if(Request::is('admin/videos/list'))
					<?php $videoslistmenuClass = 'active'; ?>
				@else
					<?php $videoslistmenuClass = ''; ?>
				@endif

				@if(Request::is('admin/search/list'))
					<?php $searchlistmenuClass = 'active'; ?>
				@else
					<?php $searchlistmenuClass = ''; ?>
				@endif
				@if(Request::is('admin/settings'))
					<?php $settingmenuClass = 'active'; ?>
				@else
					<?php $settingmenuClass = ''; ?>
				@endif
				@if(Request::is('admin/influencers/add'))
					<?php $influencersaddmenuClass = 'active'; ?>
				@else
					<?php $influencersaddmenuClass = ''; ?>
				@endif
				@if(Request::is('admin/influencers/list'))
					<?php $influencerslistmenuClass = 'active'; ?>
				@else
					<?php $influencerslistmenuClass = ''; ?>
				@endif

				@if(Request::is('admin/pages/list'))
					<?php $pageslistmenuClass = 'active'; ?>
				@else
					<?php $pageslistmenuClass = ''; ?>
				@endif
				@if(Request::is('admin/banners/list'))
					<?php $bannerslistmenuClass = 'active'; ?>
				@else
					<?php $bannerslistmenuClass = ''; ?>
				@endif
				@if(Request::is('admin/languages/list'))
					<?php $languageslistmenuClass = 'active'; ?>
				@else
					<?php $languageslistmenuClass = ''; ?>
				@endif
							
				<li class="{{$videosaddmenuClass}}">
					<a href="{{url('admin/videos/add')}}">
						<p class="title">Add a New Video</p>
					</a>
				</li>
				<li class="{{$videoslistmenuClass}}">
					<a href="{{url('admin/videos/list')}}">
						<p class="title">Stored Video</p>
					</a>
				</li>
				<li class="{{$searchlistmenuClass}}">
					<a href="{{url('admin/search/list')}}">
						<p class="title">Search Log</p>
					</a>
				</li>
				<li class="{{$influencersaddmenuClass}}">
					<a href="{{url('admin/influencers/add')}}">
						<p class="title">Add Influencers</p>
					</a>
				</li>
				<li class="{{$influencerslistmenuClass}}">
					<a href="{{url('admin/influencers/list')}}">
						<p class="title">Influencers</p>
					</a>
				</li>
				<li class="{{$pageslistmenuClass}}">
					<a href="{{url('admin/pages/list')}}">
						<p class="title">Pages</p>
					</a>
				</li>
				<li class="{{$bannerslistmenuClass}}">
					<a href="{{url('admin/banners/list')}}">
						<p class="title">Banners</p>
					</a>
				</li>
				<li class="{{$languageslistmenuClass}}">
					<a href="{{url('admin/languages/list')}}">
						<p class="title">Languages</p>
					</a>
				</li>
				
				<li class="{{$settingmenuClass}}">
					<a href="{{url('admin/settings')}}">
						<p class="title">Settings</p>
					</a>
				</li>
                  				
            </ul>
    	</div>
		@section('javascript')
		  
		@stop