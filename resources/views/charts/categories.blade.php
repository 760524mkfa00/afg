@extends('layouts.app')

@section('content')

    {{--<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js"></script>--}}
    {{--<style type="text/css">--}}
        {{--${demo.css}--}}
    {{--</style>--}}
    {{--<script type="text/javascript">--}}
        {{--$(function () {--}}
            {{--$('#container').highcharts({--}}
                {{--chart: {--}}
                    {{--type: 'bar'--}}
                {{--},--}}
                {{--title: {--}}
                    {{--text: 'Historic World Population by Region'--}}
                {{--},--}}
                {{--subtitle: {--}}
                    {{--text: 'Source: <a href="https://en.wikipedia.org/wiki/World_population">Wikipedia.org</a>'--}}
                {{--},--}}
                {{--xAxis: {--}}
                    {{--categories: ['Africa', 'America', 'Asia', 'Europe', 'Oceania'],--}}
                    {{--title: {--}}
                        {{--text: null--}}
                    {{--}--}}
                {{--},--}}
                {{--yAxis: {--}}
                    {{--min: 0,--}}
                    {{--title: {--}}
                        {{--text: 'Population (millions)',--}}
                        {{--align: 'high'--}}
                    {{--},--}}
                    {{--labels: {--}}
                        {{--overflow: 'justify'--}}
                    {{--}--}}
                {{--},--}}
                {{--tooltip: {--}}
                    {{--valueSuffix: ' millions'--}}
                {{--},--}}
                {{--plotOptions: {--}}
                    {{--bar: {--}}
                        {{--dataLabels: {--}}
                            {{--enabled: true--}}
                        {{--}--}}
                    {{--}--}}
                {{--},--}}
                {{--legend: {--}}
                    {{--layout: 'vertical',--}}
                    {{--align: 'right',--}}
                    {{--verticalAlign: 'top',--}}
                    {{--x: -40,--}}
                    {{--y: 80,--}}
                    {{--floating: true,--}}
                    {{--borderWidth: 1,--}}
                    {{--backgroundColor: ((Highcharts.theme && Highcharts.theme.legendBackgroundColor) || '#FFFFFF'),--}}
                    {{--shadow: true--}}
                {{--},--}}
                {{--credits: {--}}
                    {{--enabled: false--}}
                {{--},--}}
                {{--series: [{--}}
                    {{--name: 'Year 1800',--}}
                    {{--data: [107, 31, 635, 203, 2]--}}
                {{--}, {--}}
                    {{--name: 'Year 1900',--}}
                    {{--data: [133, 156, 947, 408, 6]--}}
                {{--}, {--}}
                    {{--name: 'Year 2012',--}}
                    {{--data: [1052, 954, 4250, 740, 38]--}}
                {{--}]--}}
            {{--});--}}
        {{--});--}}
    {{--</script>--}}

    <script type="text/javascript">

        $(document).ready(function () {
                $(chart).highcharts({!! json_encode($chart)!!});
        });

    </script>


    <script src="https://code.highcharts.com/highcharts.js"></script>
    <script src="https://code.highcharts.com/modules/exporting.js"></script>

    <div id="chart" style="min-width: 310px; max-width: 800px; height: 400px; margin: 0 auto"></div>






    {{--<div class="row">--}}
        {{--<div class="col-md-3 col-lg-offset-1">--}}
            {{--@if ( session()->has('message') )--}}
                {{--<div class="alert alert-success alert-dismissable">{{ session()->get('message') }}</div>--}}
            {{--@endif--}}
            {{--@if (count($errors) > 0)--}}
                {{--<div class="alert alert-danger">--}}
                    {{--<ul>--}}
                        {{--@foreach ($errors->all() as $error)--}}
                            {{--<li>{{ $error }}</li>--}}
                        {{--@endforeach--}}
                    {{--</ul>--}}
                {{--</div>--}}
            {{--@endif--}}

            {{--<form action="{{ route('categories') }}" class="form-group">--}}
                {{--<input type="hidden" name="_token" id="token" value="{{ csrf_token() }}">--}}
                {{--<div class="row">--}}
                    {{--<div class="col-md-6">--}}
                        {{--<div class="panel panel-default">--}}
                            {{--<div class="panel-heading">Year</div>--}}
                            {{--<div class="panel-body">--}}
                                {{--@foreach($yearBoxes as $checkbox)--}}
                                    {{--<div class="checkbox">--}}
                                        {{--<label>--}}
                                            {{--<input tabindex="1" type="checkbox" name="year[]" id="{{$checkbox['year']}}" value="{{$checkbox['year']}}" {{ ($checkbox['yearChecked']) ? 'checked=checked' : '' }}>{{$checkbox['year']}}--}}
                                        {{--</label>--}}
                                    {{--</div>--}}
                                {{--@endforeach--}}
                            {{--</div>--}}
                        {{--</div>--}}
                    {{--</div>--}}
                    {{--<div class="col-md-6">--}}
                        {{--<div class="panel panel-default">--}}
                            {{--<div class="panel-heading">Priority</div>--}}
                            {{--<div class="panel-body">--}}
                                {{--@foreach($priorityBoxes as $checkbox)--}}
                                    {{--<div class="checkbox">--}}
                                        {{--<label>--}}
                                            {{--<input tabindex="1" type="checkbox" name="priority[]" id="{{$checkbox['priority']}}" value="{{$checkbox['priority']}}" {{ ($checkbox['priorityChecked']) ? 'checked=checked' : '' }}>{{$checkbox['priority']}}--}}
                                        {{--</label>--}}
                                    {{--</div>--}}
                                {{--@endforeach--}}
                            {{--</div>--}}
                        {{--</div>--}}
                    {{--</div>--}}
                {{--</div>--}}
                {{--<input type="submit" value="Update">--}}
            {{--</form>--}}
        {{--</div>--}}

        {{--<div class="col-md-7">--}}
            {{--<div id="chart" style="height:800px;"></div>--}}
        {{--</div>--}}
    {{--</div>--}}

    {{--<script type="text/javascript">--}}
        {{--$(document).ready(function() {--}}
            {{--$(function () {--}}
                {{--$('#chart').highcharts({!! json_encode($chart)!!});--}}
        {{--});--}}
    {{--});--}}

    {{--</script>--}}
@stop