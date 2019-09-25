@extends('admn-template.app')

@section('content')


    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Dashboard</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    You are logged in!
                </div>
            </div>
        </div>
    </div>
    <style type="text/css">
    	.card{
     margin: 20px 20px 20px 20px;
    font-size: 17px;
    padding: 10px 0px 9px 20px;
    	}
    </style>

@endsection