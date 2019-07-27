@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Popular users</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    <p>HELLO, {{Auth::user()->login}}</p>
                        <br/>Number of users in the group: {{$all_users[0]->message_count}}
                        <br/><br/>
                        <table>
                            <tr>
                                <th>User</th>
                                <th>Number of messeges</th>
                            </tr>
                        @foreach($users as $user)
                        <tr>
                            <td>{{$user->user}}</td>
                            <td>{{$user->message_count}} </td>
                        </tr>
                        @endforeach
                        </table>
                        <br/><br/>
                        {{$users->render()}}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
