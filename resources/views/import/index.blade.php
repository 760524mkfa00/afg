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
                    <div class="panel-heading">Import Work Order Totals...</div>
                    <div class="panel-body">
                        {!! Form::open(array('url' => '/import', 'method' => 'post', 'files' => 'true')) !!}
                            {!! Form::file('file') !!}
                            {!! Form::submit('Send') !!}
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>

            <div class="col-md-8">
                <div class="panel panel-default">
                    <div class="panel-heading">Imported work orders...</div>
                    <div class="panel-body">
                        @if($file)
                            <table class="table table-striped table-bordered">
                                <thead>
                                <th>WOID</th>
                                <th>Description</th>
                                <th>Total Costs</th>
                                <th>Match</th>
                                </thead>
                                <tbody>
                                @foreach($file as $row)
                                    <tr>
                                        <td>{{ $row->woid }}</td>
                                        <td><a href="#" rel="tooltip" title="{{ $row->description }}">{{ str_limit($row->description, $limit = 75, $end = '...') }}</a></td>
                                        <td>{{ number_format($row->total_costs,2) }}</td>
                                        <td>match big tick!!!</td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        @else
                            <p>Load Data</p>
                        @endif
                    </div>
                </div>
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

            setTimeout(function(){
                $('.alert').fadeTo("slow", 0.1, function(){
                    $('.alert').alert('close')
                });
            }, 3000)
        });

    </script>

@stop