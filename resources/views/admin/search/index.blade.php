@extends('admn-template.app')

@section('content')
	<div class="content">
		<div class="container-fluid">
			<div class="search-wrap">
				<div class="row">
				<h4 style="text-align: center;">The Search Log</h4>
				</div>
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
              			 if(isset($_GET['status'])){
                        $status = $_GET['status'];
                       }else{
                        $status ="";
                   		}

						  @endphp
						<div class="content table-responsive table-full-width">
							
							<div class="search_drop"><select onchange="window.location.href='?status='+this.value" name="status" class="filter_drop_down">
								<option <?php if( $status=="all"){ echo "selected"; }  ?> value="all">All</option>
								<option <?php if( $status==1){ echo "selected"; }  ?> value="1">Found</option>
								<option <?php if( $status=='0'){ echo "selected"; }  ?> value="0">Not Found</option>
							</select> </div>
							
							<table  class="table table-bordered table-hover table-striped">
								<thead>
									
									<th>Sl No</th>
									<th>The Search Log</th>
									<th>Date Time</th>
									<th>Status</th>
									<th>Action</th>
									
								</thead>
								<tbody>
									@if(isset($search_result) && is_object($search_result))
										@foreach($search_result as $key=>$val)
											<tr data-entry-id="{{ $val->id }}">
												
												<td>{{$no}}</td>
												<td>{{$val->search_text}}</td>
												<td>{{date('H:i:s d/m/Y',strtotime($val->search_date))}}</td>
												<td>@if($val->search_found_status=='1') {{'Found'}} @else {{'Not Found'}} @endif</td>
												<td colspan="2">

														{!! Form::open(array(
															'style' => 'display: inline-block;',
															'method' => 'DELETE',
															'onsubmit' => "return confirm('Are you sure ?');",
															'route' => ['admin.search.destroy', $val->id])) !!}
															{!! Form::submit('Delete', array('class' => 'btn btn-xs btn-danger')) !!}
														{!! Form::close() !!}
			                                       	
												</td>
											</tr>
											@php $no++; @endphp
										@endforeach
										
									@endif
								</tbody>	
							</table>
						
                        </div>
                            <div class="text-center">
						{{ $search_result->links() }}
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

<style type="text/css">
.search_drop{ padding: 10px 10px 10px 10px;}
.search_drop select{     padding: 5px 11px 5px 12px;}
</style>
@stop	




