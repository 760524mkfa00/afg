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
                            <th>Project Description</th>
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
                            <th scope="row">$project->project_number</th>
                            <td>$project->region_id</td>
                            <td>$project->category_id</td>
                            <td>$project->location_id</td>
                            <td>$project->project_description</td>
                            <td>$project->client_id</td>
                            <td>$project->priority_number</td>
                            <td>$project->priority_id</td>
                            <td>$project->year</td>
                            <td>$project->estimate</td>
                            <td>Actual Value</td>
                            <td>$project->manager_id</td>
                        </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

@stop
