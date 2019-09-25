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
					<form>
				<select name="search_type">
						<option value="yt_video_name" <?php  if(isset($_GET['search_type'])){ if($_GET['search_type']=='yt_video_name'){ echo "selected"; } } ?>>Video Name</option>
						<option value="yt_video_id" <?php  if(isset($_GET['search_type'])){ if($_GET['search_type']=='yt_video_id'){ echo "selected"; } } ?>>Video ID</option>
						<option value="channel" <?php  if(isset($_GET['search_type'])){ if($_GET['search_type']=='channel'){ echo "selected"; } } ?>>Channel Name</option>
				</select>		
				<input type="text" <?php  if(isset($_GET['search'])){ ?> value="<?php echo $_GET['search'] ?>" <?php } ?> name="search">
				<button type="submit" class="btn btn btn-xs btn-info">Sumit</button>
				<a href="{{ url('admin/videos/list')}}" class="btn btn btn-xs btn-info">Clear</a>
				</form>
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
									<th>Video Name</th>
									<th>View Count</th>
									<th>Video Id</th>
									<th>Channel</th>
									<th>Status</th>
									<th >Action</th>
									
								</thead>
								<tbody>
									@if(isset($videos) && is_object($videos))
										@foreach($videos as $key=>$val)

											<tr data-entry-id="{{ $val->id }}">
												
												<td>{{$no}}</td>
												<td>{{$val->yt_video_name}}</td>
												<td><?php echo (new App\Models\VideoViews)->getVideoViewCount($val->id); ?></td>
												<td>{{$val->yt_video_id}}</td>
												<td><?php echo $channel_name = \App\Models\Channel::get_channel_name( $val->channels_id);?></td>
												<td>@if($val->status=='1') {{'Enable'}} @else {{'Disable'}} @endif</td>
												<td colspan="2">

														{!! Form::open(array(
															'style' => 'display: inline-block;',
															'method' => 'DELETE',
															'onsubmit' => "return confirm('Are you sure ?');",
															'route' => ['admin.videos.destroy', $val->id])) !!}
															{!! Form::submit('Delete', array('class' => 'btn btn-xs btn-danger')) !!}
														{!! Form::close() !!}
												
			                                      	<a class="btn btn btn-xs btn-info " href="{{ url('admin/videos/view')}}/{{$val->id}}">Show</a>
			                                        <a class="btn btn btn-xs btn-info video_status" href="javascript:void(0)" data-id="{{$val->id}}">@if($val->status=='1') {{'Disable'}} @else {{'Enable'}} @endif</a>	   	
												</td>
											</tr>
											@php $no++; @endphp
										@endforeach
										
									@endif
								</tbody>	
							</table>
						
                        </div>
                        <div class="text-center">
						{{ $videos->links() }}
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




