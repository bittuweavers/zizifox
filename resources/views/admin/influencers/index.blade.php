@extends('admn-template.app')

@section('content')
	<div class="content">
		<div class="container-fluid">
			<div class="search-wrap">
				<div class="row">
				<h4 style="text-align: center;">Stored Videos</h4>
				</div>
			</div>
			<div class="row">
				

			</div>
			<div class="row">
				<div class="col-md-12">
				
					<div class="card">
						@php
				   if(isset($_GET['page'])){
				              $no=($_GET['page']-1)*40+1;
				           
				          }else{
				            $no = 1;
				          }
          

						  @endphp
						<div class="content table-responsive table-full-width">
							<table  class="table table-bordered table-hover table-striped">
								<thead>
									
									<th>Sl No</th>
									<th>Title</th>
									<th>Channel Name</th>
									<th>Site Link</th>
									<th >Action</th>
									
								</thead>
								<tbody>
									@if(isset($influencer) && is_object($influencer))
										@foreach($influencer as $key=>$val)
											<tr data-entry-id="{{ $val->id }}">
												
												<td>{{$no}}</td>
												<td>{{$val->title}}</td>
												<td><?php echo $channel_name = \App\Models\Channel::get_channel_name( $val->channels_id);?></td>
												
												<td><a href="{{$val->site_url}}" target="_blank">{{$val->site_url}}</a></td>
												
												<td colspan="2">

														{!! Form::open(array(
															'style' => 'display: inline-block;',
															'method' => 'DELETE',
															'onsubmit' => "return confirm('Are you sure ?');",
															'route' => ['admin.influencers.destroy', $val->id])) !!}
															{!! Form::submit('Delete', array('class' => 'btn btn-xs btn-danger')) !!}
														{!! Form::close() !!}
												
			                                      	<a class="btn btn btn-xs btn-info " href="{{ url('admin/influencers/view')}}/{{$val->id}}">Show</a>
			                                       <a class="btn btn-xs btn-warning" href="{{ route('admin.influencers.edit',[$val->id]) }}">Edit</a>
			                                       <a class="btn btn-xs btn-info" target="_blank" href="{{ route('influencers',[$val->slug]) }}">View</a>      
			                                     
												</td>
											</tr>
											@php $no++; @endphp
										@endforeach
										
									@endif
								</tbody>	
							</table>
						
                        </div>
                        <div class="text-center">
						{{ $influencer->links() }}
						</div>
                    </div>
                   
                </div>
            </div>
        </div>

    </div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script>

    	$(document).ready(function(){
        	
            $('.video_status').on('click', function(event){
            	if(confirm('Are you sure to change the status?')){

                id = $(this).data('id');
                var $this = $(this);
                $.ajax({
                    type: 'POST',
                    url:"{{ URL::route('admin.videos.changeStatus') }}",
					data: {
					        "_token": "{{ csrf_token() }}",
					        "id": id
					        },
                    success: function(data) {
                    	$this.html(data);
                        // empty
                    },
                });
            }
            });
          
        });

 	</script>
@stop	




