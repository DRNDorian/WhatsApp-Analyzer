@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Adding file</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    <p>HELLO, {{Auth::user()->login}}</p>
                    <br/><a href="group/add">Add group</a>
                    <br/><a href="group/show">List of groups</a>
                        <br/><br/><h4>Analyze</h4>
                    <br/><a href="analize/popular">User rating</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
