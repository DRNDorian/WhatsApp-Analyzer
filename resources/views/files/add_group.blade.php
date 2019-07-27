@extends("layouts.app")

@section("content")

    <div class="container">
        <div class="card-header">Adding group</div>

        <div class="card-body">
            @if (session('status'))
                <div class="alert alert-success" role="alert">
                    {{ session('status') }}
                </div>
            @endif
            <p> Hello, {{Auth::user()->login}}</p>
           {!! Form::Open(['url'=>'group']) !!}
                <div class="form-group">
                    {!! Form::label('Enter name of group') !!}
                    <br/>
                    {!! Form::text('group_name') !!}
                    <br/><br/>
                    {!! Form::submit('Add group') !!}
                </div>
           {!! Form::Close() !!}
        </div>
    </div>

@endsection