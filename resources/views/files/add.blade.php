@extends("layouts.app")

@section("content")

    <div class="container">
        <div class="card-header">Adding file</div>

        <div class="card-body">
            @if (session('status'))
                <div class="alert alert-success" role="alert">
                    {{ session('status') }}
                </div>
            @endif
            <p> Hello, {{Auth::user()->login}}</p>
           {!! Form::Open(['url'=>"files/add/$group_id", 'files'=>'true']) !!}
                <div class="form-group">
                    {!! Form::label('file', 'Choose file') !!}
                    {!! Form::file('file', ['class'=>'form-control']) !!}
                    <br/>
                    {!! Form::submit('Add file') !!}
                </div>
           {!! Form::Close() !!}
        </div>
    </div>

@endsection