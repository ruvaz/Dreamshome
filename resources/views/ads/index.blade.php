@extends('home')
@section('content')
    @include('alerts.alerts')
    <div class="page-header"><h2>Anuncios</h2></div>
    <table class="table table-striped table-hover">
        <thead>
        <tr>
            <th>ID</th>
            <th>User</th>
            <th>State</th>
            <th>Delegation</th>
            <th>Title</th>
        </tr>
        </thead>
        <tbody>
        todos
        @if($ads)
            @foreach($ads as $ad)
                {{--@can('read-ad',$ad)--}}
                <tr>

                    <td>{{$ad->id}}</td>
                    <td>{{$ad->user_id}}/{{$ad->user->name}}</td>
                    <td>{{$ad->state_id}}</td>
                    <td>{{$ad->delegation}}</td>
                    <td>{{$ad->title}}</td>
                </tr>
                {{-- @endcan--}}
            @endforeach
        @endif
        </tbody>

    </table>

    <hr>
    <div class="page-header"><h2>Anuncios Usuario  - gates</h2></div>
    <table class="table table-striped table-hover">
        <thead>
        <tr>
            <th>ID</th>
            <th>User</th>
            <th>State</th>
            <th>Delegation</th>
            <th>Title</th>
            <th></th>
        </tr>
        </thead>
        <tbody>
        @if($ads)
            @foreach($ads as $ad)
                @can('edit-ad',$ad)
                    <tr>
                        <td>{{$ad->id}}</td>
                        <td>{{$ad->user_id}}/{{$ad->user->name}}</td>
                        <td>{{$ad->state_id}}</td>
                        <td>{{$ad->delegation}}</td>
                        <td>{{$ad->title}}</td>
                        <td>
                            {!! Form::open(['route'=>['ads.edit',$ad->id], 'method' => 'GET']) !!}
                            <input type="submit" class="btn btn-primary" value="Modificar">
                            {!! Form::close() !!}
                        </td>
                    </tr>
                @endcan
            @endforeach
        @endif
        </tbody>

    </table>

    <hr>
    <div class="page-header"><h2>Anuncios Usuario - Policies </h2></div>
    <table class="table table-striped table-hover">
        <thead>
        <tr>
            <th>ID</th>
            <th>User</th>
            <th>State</th>
            <th>Delegation</th>
            <th>Title</th>
            <th></th>
        </tr>
        </thead>
        <tbody>

        @foreach($ads as $ad)
            @can('owner',$ad)
                <tr>
                    <td>{{$ad->id}}</td>
                    <td>{{$ad->user_id}}/{{$ad->user->name}}</td>
                    <td>{{$ad->state_id}}</td>
                    <td>{{$ad->delegation}}</td>
                    <td>{{$ad->title}}</td>
                    <td>
                        {{--{!! Form::open(['route'=>['ads.edit',$ad], 'method' => 'GET']) !!}--}}
                        {{--<input type="submit" class="btn btn-primary" value="Modificar">--}}
                        {{--{!! Form::close() !!}--}}
                        <div class="btn-group-vertical">
                            {!! link_to_route('ads.edit','Editar',$ad,['class'=>'btn btn-primary']) !!}
                            @include('ads.delete')
                        </div>
                    </td>
                </tr>
            @endcan
        @endforeach
        </tbody>

    </table>

@endsection