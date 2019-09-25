@extends('admn-template.app')

@section('content')
	<div class="content">
		<div class="container-fluid">
			<div class="search-wrap">
				<div class="row">
				<h4 style="text-align: center;">Language List</h4>
				</div>
				<div class="row">
				<a href="{{url('admin/languages/add')}}" class="btn btn-success pull-right">Add Language</a>

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
          

						  @endphp
						<div class="content table-responsive table-full-width">
							<table  class="table table-bordered table-hover table-striped">
								<thead>
									
									<th>Sl No</th>
									<th>Language Name</th>
									<th >Action</th>
									
								</thead>
								<tbody>
									@if(isset($language) && is_object($language))
										@foreach($language as $key=>$val)
											<tr data-entry-id="{{ $val->id }}">
												
												<td>{{$no}}</td>
												<td>{{$val->lang_name}}</td>
												<td colspan="2">
														{!! Form::open(array(
															'style' => 'display: inline-block;',
															'method' => 'DELETE',
															'onsubmit' => "return confirm('Are you sure ?');",
															'route' => ['admin.languages.destroy', $val->id])) !!}
															{!! Form::submit('Delete', array('class' => 'btn btn-xs btn-danger')) !!}
														{!! Form::close() !!}
												
			                                       <a class="btn btn-xs btn-warning" href="{{ route('admin.languages.edit',[$val->id]) }}">Edit</a> 
												</td>
											</tr>
											@php $no++; @endphp
										@endforeach
										
									@endif
								</tbody>	
							</table>
						
                        </div>
                        <div class="text-center">
						{{ $language->links() }}
						</div>
                    </div>
                   
                </div>
            </div>
        </div>

    </div>

    
@stop	




