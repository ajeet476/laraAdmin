@extends('layouts.admin')

@section('content')
        <div class="row">
            <table class="table">
                <thead>
                <tr>
                    <th>#</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Created_At</th>
                </tr>
                </thead>
                <tbody>
            @foreach ($users as $user)
                <tr>

                    <th scope="row"> <a href=" {{url('/admin/user', [$user->id])}}"> {{ $user->id }} </a></th>
                    <td> {{ $user->name }} </td>
                    <td> {{ $user->email }} </td>
                    <td> {{ $user->created_at }} </td>
                </tr>
            @endforeach
                </tbody>
            </table>
            {{ $users->links() }}
        </div>
@endsection
