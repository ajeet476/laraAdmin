@extends('layouts.admin')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-sm-8 col-md-8">
                <h4>
                    {{$user->name}}</h4>
                <p>
                    <i class="glyphicon glyphicon-envelope"></i>{{$user->email}}
                    <br />
                    <i class="glyphicon glyphicon-globe"></i><a href="http://www.jquery2dotnet.com">www.jquery2dotnet.com</a>
                    <br />
                    <i class="glyphicon glyphicon-gift"></i>{{ $user->created_at }}</p>
                <!-- Split button -->
            </div>
        </div>
    </div>
@endsection
