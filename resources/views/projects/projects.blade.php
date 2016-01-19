@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">Projects...</div>
                    <!-- Table -->
                    <table class="table">
                        <thead>
                        <tr>
                            <th>Project #</th>
                            <th>Region</th>
                            <th>Category</th>
                            <th>Location</th>
                            <th width="25%;">Project Description</th>
                            <th>Client</th>
                            <th>Priority</th>
                            <th>Req Priority</th>
                            <th>Year Started</th>
                            <th>Estimate</th>
                            <th>Actual</th>
                            <th>Manager</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($data as $project)
                        <tr>
                            <th scope="row">{{ $project->project_number }}</th>
                            <td>{{ $project->regions->region }}</td>
                            <td>{{ $project->categories->category }}</td>
                            <td>{{ $project->locations->location }}</td>
                            <td>{{ $project->project_description }}</td>
                            <td>{{ $project->clients->client }}</td>
                            <td>{{ $project->priority_number }}</td>
                            <td>{{ $project->priorities->priority }}</td>
                            <td>{{ $project->year }}</td>
                            <td>{{ $project->estimate }}</td>
                            <td>Actual Value</td>
                            <td>{{ @$project->managers->name }}</td>
                        </tr>
                        @endforeach
                        </tbody>

                    </table>


                </div>{!! $data->render() !!}
            </div>
        </div>
    </div>

@stop
