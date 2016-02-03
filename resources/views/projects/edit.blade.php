@extends('layouts.app')

@section('content')
    @if (count($errors) > 0)
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-4">
                <div class="panel panel-default">
                    <div class="panel-heading">Edit Project...</div>
                    <div class="panel-body">
                        {!! Form::model($data, array('route' => ['projects.update', $data->id])) !!}
                            @include('projects.form', ['submitButtonText' => 'Update Project'])
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>

@stop
