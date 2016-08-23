@extends('layouts.app')
@section('content')
    @include('alerts.alerts')
    <div class="col-md-12">



        {!!Form::model($ad,['route'=> ['ads.update',$ad],'method'=>'PUT'])!!}

            @include('ads.form')

        {!! Form::submit('Actualizar',['class'=>'btn btn-success']) !!}

        {!! Form::close() !!}

    </div>

@endsection