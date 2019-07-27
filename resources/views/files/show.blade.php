@extends("layouts.app")

@section("content")

    <div class="container">
        <div class="card-header">List of files</div>

        <div class="card-body">
            @if (session('status'))
                <div class="alert alert-success" role="alert">
                    {{ session('status') }}
                </div>
            @endif
            <p> Hello, {{Auth::user()->login}}</p>
            <br/>
            <table>
                <tr>
                    <td>ID</td>
                    <td>User ID</td>
                    <td>Name of group</td>
                    <td>Actions</td>
                    <td></td>
                </tr>
                @foreach($groups as $group)
                    <tr>
                        <td> {{$group->id}} </td>
                        <td> {{$group->user_id}} </td>
                        <td> {{$group->group_name}} </td>
                        <td>
                            @if($group->files->count())
                                @if($group->files->last()->availability=="ready")
                                Updated at {{$group->files->last()->created_at}}
                                @else {{"Processing"}}
                                    @endif
                            @else
                                <a href="/files/add/{{$group->id}}">Add file</a>
                            @endif
                        </td>
                        <td> <a href="/files/update/{{$group->id}}">Update</a> /  <a href="/group/remove/{{$group->id}}">Remove</a> </td>
                    </tr>
                @endforeach
            </table>

        </div>
    </div>

@endsection