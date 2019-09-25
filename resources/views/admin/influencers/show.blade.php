@extends('admn-template.app')

@section('content')
			<div class="row">

				<div class="col-sm-12">
					<table class="table table-bordered table-striped">
			    		<thead>
			      			<tr>
			        			<h4 style="text-align: center;"></h4>
			      			</tr>
			    		</thead>					
			    		<tbody>
			      		
			        		<tr> 
			        			<td>Title</td>
			        			<td>{{$influencer->title}}</td>
			         		</tr>
			         		<tr> 
			        			<td>Description</td>
			        			<td>{{$influencer->description}}</td>
			         		</tr>
			         		<tr> 
			        			<td>Channel Name</td>
			        			<td><?php echo $channel_name = \App\Models\Channel::get_channel_name( $influencer->channels_id);?></td>
			         		</tr>
			         		<tr> 
			        			<td>Logo</td>
			        			@if($influencer->logo)
			        			<td><img src="{{$influencer->logo}}" alt="{{$influencer->title}}"></td>
			        			@else
			        			<td></td>
			        			@endif
			         		</tr>
			         		<tr> 
			        			<td>Site Url</td>
			        			<td><a target="_blank" href="{{$influencer->site_url}}">{{$influencer->site_url}}</a></td>
			         		</tr>
			         		<tr> 
			        			<td>Subscription Custom Url</td>
			        			<td>{{$influencer->subscription_custom_url}}</td>
			         		</tr>
			         		<tr> 
			        			<td>Youtube Channel Url</td>
			        			<td><a target="_blank" href="{{$influencer->youtube_channel_url}}">{{$influencer->youtube_channel_url}}</a></td>
			         		</tr>
			         		<tr> 
			        			<td>Url</td>
			        			<td><a target="_blank" href="{{ route('influencers',[$influencer->slug]) }}">{{ route('influencers',[$influencer->slug]) }}</a></td>
			         		</tr>							
						</tbody>
			      	</table>					
				</div>			
			</div>	
	<style>
	ul.user-info {
		padding: 0;
	}
	.user-info>li {
		list-style: none;
		padding: 3px;
	}
	.user-info>li>strong {
		margin-right: 10px;
	}
	</style>

@stop	
@section('javascript')
@endsection