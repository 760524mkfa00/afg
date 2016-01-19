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
                            <th class="hidden-sm hidden-xs hidden-md">Region</th>
                            <th class="hidden-sm hidden-xs">Category</th>
                            <th class="hidden-sm hidden-xs">Location</th>
                            <th>Project Description</th>
                            <th class="hidden-sm hidden-xs">Client</th>
                            <th class="hidden-sm hidden-xs">Priority</th>
                            <th class="hidden-sm hidden-xs">Req Priority</th>
                            <th class="hidden-sm hidden-xs">Year Started</th>
                            <th class="hidden-sm hidden-xs">Estimate</th>
                            <th class="hidden-sm hidden-xs">Actual</th>
                            <th class="hidden-sm hidden-xs hidden-md">Manager</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($data as $project)
                        <tr>
                            <th scope="row">{{ $project->project_number }}</th>
                            <td class="hidden-sm hidden-xs hidden-md">{{ $project->regions->region }}</td>
                            <td class="hidden-sm hidden-xs">{{ $project->categories->category }}</td>
                            <td class="hidden-sm hidden-xs">{{ $project->locations->location }}</td>
                            <td>{{ $project->project_description }}</td>
                            <td class="hidden-sm hidden-xs">{{ $project->clients->client }}</td>
                            <td class="hidden-sm hidden-xs">{{ $project->priority_number }}</td>
                            <td class="hidden-sm hidden-xs">{{ $project->priorities->priority }}</td>
                            <td class="hidden-sm hidden-xs">{{ $project->year }}</td>
                            <td class="hidden-sm hidden-xs">{{ number_format($project->estimate,2,'.',',') }}</td>
                            <td class="hidden-sm hidden-xs">Actual Value</td>
                            <td class="hidden-sm hidden-xs hidden-md">{{ @$project->managers->name }}</td>
                        </tr>
                        @endforeach
                        </tbody>

                    </table>


                </div>{!! $data->render() !!}
            </div>
        </div>
    </div>

@stop
