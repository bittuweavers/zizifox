@extends('admn-template.app')

@section('content')
			<div class="row">

				<div class="col-sm-12">
					<table class="table table-bordered table-striped">
			    		<thead>
			      			<tr>
			        			<h4 style="text-align: center;">Video Details</h4>
			      			</tr>
			    		</thead>					
			    		<tbody>
			      			<tr>
			        			<td>Video Id</td>
			        			<td>{{$videos->yt_video_id}}</td>
			         		</tr>
			        		<tr> 
			        			<td>Video Name</td>
			        			<td>{{$videos->yt_video_name}}</td>
			         		</tr>
			         		<tr> 
			        			<td>Video Url</td>
			        			<td>{{$videos->yt_video_url	}}</td>
			         		</tr>
			         		<tr> 
			        			<td>Channel Name</td>
			        			<td><?php echo $channel_name = \App\Models\Channel::get_channel_name( $videos->channels_id);?></td>
			         		</tr>
			         		
			         		<tr> 
			        			<td>Status</td>
			        			@if($videos->status=='1')
			        			<td>{{'Enable'}}</td>
			        			@else 
			        			<td>{{'Disable'}}</td>
			        			@endif
			     			</tr>
												
						</tbody>
			      	</table>					
				</div>			
			</div>	
				@php
					 $vi_cap = $videos->caption;
              		 $cap_arr = explode("|||",$vi_cap);
				 @endphp

			<div class="row">

				<div class="col-sm-12">
				<div class="card">

						@php $no = 1; 

						@endphp
						<div class="content table-responsive table-full-width">
								<h4 style="text-align: center;">Video Caption</h4>
							<table  class="table table-bordered table-hover table-striped {{ count($cap_arr) > 0 ? 'datatable' : '' }} ">
								<thead>
									
									<th>ID</th>
									<th>Caption Text</th>
									<th>Time</th>
									<th>Duration</th>
							
									
									
								</thead>
								<tbody>
									@if(count($cap_arr) > 0)
										@foreach($cap_arr as $val)
											<tr >
												
												<td>{{$no}}</td>
												   @php
												
												   	$cap_arr2 = explode("@@@",$val); 
								                    $video_time = $cap_arr2[0];
								                     $start_vid_caption = $cap_arr2[2];
							                         $str1 = htmlspecialchars_decode($start_vid_caption, ENT_QUOTES); 
							                          $output = preg_replace_callback("/(&#[0-9]+;)/", function($m) { return mb_convert_encoding($m[1], "UTF-8", "HTML-ENTITIES"); }, $str1); 
							                          @endphp 
												<td>{{$output}}</td>
												<td>{{$video_time}}</td>
												<td>{{$cap_arr2[1]}}</td>
												
												
											</tr>
											@php $no++; @endphp
										@endforeach
										
									@endif
								</tbody>	
							</table>
						
                        </div>

                    </div>					
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