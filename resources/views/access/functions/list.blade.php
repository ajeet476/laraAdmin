@extends('layouts.admin')

@section('content')
    <div class="container">
        <div class="row">
            @if($unRegisteredRoutesCount)
            <span class="label label-warning">#{{ $unRegisteredRoutesCount }} UnRegistered Functions</span>
                <div class="btn-group" role="group">
                    <a type="button" class="btn btn-success" href="{{url('/admin/function/register')}}">Register Function</a>
                </div>
                @else
                <span class="label label-success">No UnRegistered Function</span>
            @endif
            <table class="table">
                <thead>
                <tr>
                    <th>#</th>
                    <th>Name</th>
                    <th>Display Name</th>
                    <th>Created_At</th>
                    <th>Updated_At</th>
                </tr>
                </thead>
                <tbody>
                @foreach ($functions as $one)
                    <tr>
                        <td> {{ $one->id }} </td>
                        <td> {{ $one->name }} </td>
                        <td> {{ $one->display_name }} </td>
                        <td> {{ $one->created_at }} </td>
                        <td> {{ $one->updated_at }} </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
