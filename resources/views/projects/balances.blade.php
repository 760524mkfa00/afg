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
            <div class="col-md-3">
                <div class="panel panel-default">
                    <div class="panel-heading"><strong>Project</strong></div>
                    <div class="panel-body">
                        {{ $data->project_description }}
                        <hr />
                        <table class="table table-bordered">
                            <tbody>
                                <tr>
                                    <td>Project Number</td>
                                    <td>{{ $data->project_number }}</td>
                                </tr>
                                <tr>
                                    <td>Region</td>
                                    <td>{{ $data->regions->region }}</td>
                                </tr>
                                <tr>
                                    <td>Project Number</td>
                                    <td>{{ $data->project_number }}</td>
                                </tr>
                                <tr>
                                    <td>Category</td>
                                    <td>{{ $data->categories->category }}</td>
                                </tr>
                                <tr>
                                    <td>Client</td>
                                    <td>{{ $data->clients->client }}</td>
                                </tr>
                                <tr>
                                    <td>Priority Number</td>
                                    <td>{{ $data->priority_number }}</td>
                                </tr>
                                <tr>
                                    <td>Priority</td>
                                    <td>{{ $data->priorities->priority }}</td>
                                </tr>
                                <tr>
                                    <td>Year</td>
                                    <td>{{ $data->year }}</td>
                                </tr>
                                <tr>
                                    <td>Estimate</td>
                                    <td>{{ $data->estimate }}</td>
                                </tr>
                                <tr>
                                    <td>Manager</td>
                                    <td>{{ $data->managers }}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <div class="col-md-9">
                <div class="panel panel-default">
                    <div class="panel-heading"><strong>Team</strong></div>
                    <div class="panel-body">
                        <table class="table table-bordered">
                            <thead>
                                <th>Edit</th>
                                <th>Description of Commitments Against Budget</th>
                                <th>Contractor/Vendor/Supplier</th>
                                <th>Committed without GST</th>
                                <th style="text-align: right;">Add Invoice</th>
                            </thead>
                            <tbody>
                                @foreach($data->tracking as $track)
                                <tr>
                                    <td><a href="{{ route('tracking.edit', [$track->id, $data->id]) }}"><i class="fa fa-pencil-square-o"></i></a></td>
                                    <td>{{ $track->description }}</td>
                                    <td>{{ $track->cvs }}</td>
                                    <td>{{ $track->id }}</td>
                                    <td style="color: #00A000; text-align: right;"><a href="{{ route('tracking.invoices', $track->id) }}"><i class="fa fa-plus" ></i></a></td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <a href="{{ route('tracking.create', $data->id) }}" class="btn btn-primary">Add Contractor</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function () {
            setTimeout(function(){
                $('.alert').fadeTo("slow", 0.1, function(){
                    $('.alert').alert('close')
                });
            }, 3000)
        });

    </script>

@stop
