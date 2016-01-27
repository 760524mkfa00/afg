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
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">Projects...
                        <form id="lets_search" action="{{ route('projects') }}" class="pull-right" style="margin-top: -6px;">
                            <div class="input-group">
                                <input type="hidden" name="sortBy" value="{{ app('request')->input('sortBy') }}">
                                <input type="hidden" name="direction" value="{{ app('request')->input('direction') }}">
                                <span class="input-group-addon" id="basic-addon1"><i class="fa fa-search"></i></span>
                                <input type="text" name="str" class="form-control" id="str" aria-describedby="basic-addon1">
                                <input type="hidden" name="year" value="{{ app('request')->input('year') }}">
                            </div>
                            {{--<input type="submit" value="send" name="send" id="send">--}}
                        </form>
                    </div>
                    <!-- Table -->
                    <table class="table">
                        <thead>
                        <tr>
                            <th>Project #</th>
                            <th class="hidden-sm hidden-xs hidden-md">{{ sort_projects_by('region','Region') }}</th>
                            <th class="hidden-sm hidden-xs">{{ sort_projects_by('category','Category') }}</th>
                            <th class="hidden-sm hidden-xs">{{ sort_projects_by('location','Location') }}</th>
                            <th>Project Description</th>
                            <th class="hidden-sm hidden-xs">{{ sort_projects_by('client','Client') }}</th>
                            <th class="hidden-sm hidden-xs">{{ sort_projects_by('priority_number','Priority') }}</th>
                            <th class="hidden-sm hidden-xs">{{ sort_projects_by('priority','Req Priority') }}</th>
                            <th class="hidden-sm hidden-xs">{{ sort_projects_by('year','Year Started') }}</th>
                            <th class="hidden-sm hidden-xs">{{ sort_projects_by('estimate','Estimate') }}</th>
                            <th class="hidden-sm hidden-xs">Actual</th>
                            <th class="hidden-sm hidden-xs hidden-md">{{ sort_projects_by('name','Manager') }}</th>
                        </tr>
                        </thead>
                        <tbody>
                            <div id="projectData">
                                @foreach($data as $project)
                                <tr>
                                    <th scope="row">{{ $project->project_number }}</th>
                                    <td class="hidden-sm hidden-xs hidden-md">{{ $project->region }}</td>
                                    <td class="hidden-sm hidden-xs">{{ $project->category }}</td>
                                    <td class="hidden-sm hidden-xs">{{ $project->location }}</td>
                                    <td><a href="#" rel="tooltip" title="{{ $project->project_description }}">{{ str_limit($project->project_description, $limit = 75, $end = '...') }}</a></td>
                                    <td class="hidden-sm hidden-xs">{{ $project->client }}</td>
                                    <td class="hidden-sm hidden-xs">{{ $project->priority_number }}</td>
                                    <td class="hidden-sm hidden-xs">{{ $project->priority }}</td>
                                    <td class="hidden-sm hidden-xs">{{ $project->year }}</td>
                                    <td class="hidden-sm hidden-xs">{{ number_format($project->estimate,2,'.',',') }}</td>
                                    <td class="hidden-sm hidden-xs">Actual Value</td>
                                    <td class="hidden-sm hidden-xs hidden-md">{{ @$project->name }}</td>
                                </tr>
                                @endforeach
                            </div>
                        </tbody>
                    </table>
                </div>{!! $data->appends( Request::only(['sortBy', 'direction', 'str', 'year']) )->links() !!}
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function () {
            $("a").tooltip({
                'selector': '',
                'placement': 'top',
                'container':'body'
            });
        });

    </script>

@stop
