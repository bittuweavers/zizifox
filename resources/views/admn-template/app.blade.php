<!doctype html>
<html lang="en">
<head>
 <!------------Include header here------------------>
    @include('admn-template.pertials.head')
	<style>
	.search-wrap select {
		border-color: #2d2c2c;
	}
	input.search-sbt {
		background-color: #00bfa5;
		border: none;
		color: #fff;
	}
	.search-wrap {
		padding: 20px 0;
	}
	input.search-sbt:hover,input.search-sbt:active,input.search-sbt:focus {
		background-color: #00bfa5;
		color: #fff;
	}
	.table td,th {
   		text-align: left;   
	}
	</style>	
</head>
<body>

<div class="wrapper">
    <div class="sidebar" data-color="azure" data-image="{{url('admin/img/sidebar-img.jpg')}}">

    <!--

        Tip 1: you can change the color of the sidebar using: data-color="blue | azure | green | orange | red | purple"
        Tip 2: you can also add an image using data-image tag

    -->
    <!------------Include Sidebar here------------------>
      @include('admn-template.pertials.sidebar')
    </div>

    <div class="main-panel">
        <nav class="navbar navbar-default navbar-fixed">
            <!------------Include Header here------------------>
			@include('admn-template.pertials.header')
        </nav>

            <section class="angelProfile">
            <div class="container-fluid">
               	<!------------Include Body content here------------------>	
				@if (count($errors) > 0)
					<div class = "alert alert-danger">
						<ul>
						   @foreach ($errors->all() as $error)
							  <li>{{ $error }}</li>
						   @endforeach
						</ul>
					</div>
			    @endif
				@if ($message = Session::get('success'))
					<div class="alert alert-success">
						<p>{{ $message }}</p>
					</div>	
				@endif
				@if ($messages = Session::get('error'))
					<div class="alert alert-danger">
						<p>{{ $messages }}</p>
					</div>	
				@endif
				
                @yield('content')				
            </div>
        </section>


        <footer class="footer">
           <!------------Include Footer here------------------>	
		   @include('admn-template.pertials.footer')
        </footer>

    </div>
</div>


</body>
 <!------------Include Script here------------------>	
 @include('admn-template.pertials.script')

</html>
