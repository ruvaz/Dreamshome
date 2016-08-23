@extends('layouts.app')
@section('content')
    @include('alerts.alerts')
    <div class="col-md-12">

        {!! Form::open(['route'=>['ads.store'],'method'=>'POST'],['class'=>'form-group']) !!}

        @include('ads.form')

        {!! Form::submit('Enviar',['class'=>'btn btn-primary']) !!}

        {!! Form::close() !!}

    </div>

@endsection