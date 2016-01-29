@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-md-3 col-lg-offset-1">
            @if ( session()->has('message') )
                <div class="alert alert-success alert-dismissable">{{ session()->get('message') }}</div>
            @endif
            @if (count($errors) > 0)
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('comparison') }}" class="form-group">
                <input type="hidden" name="_token" id="token" value="{{ csrf_token() }}">
                <div class="row">
                    <div class="col-md-6">
                        <div class="panel panel-default" id="panel1">
                            <div class="panel-heading">Year<input type="checkbox" name="checkAll" id="checkAll" class="pull-right"></div>
                            <div class="panel-body">
                                @foreach($yearBoxes as $checkbox)
                                    <div class="checkbox">
                                        <label>
                                            <input tabindex="1" type="checkbox" name="year[]" id="{{$checkbox['line']}}" value="{{$checkbox['line']}}" {{ ($checkbox['lineChecked']) ? 'checked=checked' : '' }}>{{$checkbox['line']}}
                                        </label>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="panel panel-default" id="panel2">
                            <div class="panel-heading">Priority<input type="checkbox" name="checkAll" id="checkAll" class="pull-right"></div>
                            <div class="panel-body">
                                @foreach($priorityBoxes as $checkbox)
                                    <div class="checkbox">
                                        <label>
                                            <input tabindex="1" type="checkbox" name="priority[]" id="{{$checkbox['line']}}" value="{{$checkbox['line']}}" {{ ($checkbox['lineChecked']) ? 'checked=checked' : '' }}>{{$checkbox['line']}}
                                        </label>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
                <input type="submit" value="Update" class="btn btn-primary">
            </form>
        </div>

        <div class="col-md-7">
            <div id="chart" style="height:800px; width:100%;"></div>
        </div>
    </div>

    <script type="text/javascript">

        $(document).ready(function () {
            $(chart).highcharts({!! json_encode($chart)!!});
        });

        $("#panel1 #checkAll").click(function () {
            if ($("#panel1 #checkAll").is(':checked')) {
                $("#panel1 input[type=checkbox]").each(function () {
                    $(this).prop("checked", true);
                });

            } else {
                $("#panel1 input[type=checkbox]").each(function () {
                    $(this).prop("checked", false);
                });
            }
        });

        $("#panel2 #checkAll").click(function () {
            if ($("#panel2 #checkAll").is(':checked')) {
                $("#panel2 input[type=checkbox]").each(function () {
                    $(this).prop("checked", true);
                });

            } else {
                $("#panel2 input[type=checkbox]").each(function () {
                    $(this).prop("checked", false);
                });
            }
        });
    </script>

    <script src="https://code.highcharts.com/highcharts.js"></script>
    <script src="https://code.highcharts.com/modules/data.js"></script>
    <script src="https://code.highcharts.com/modules/drilldown.js"></script>
    <script src="https://code.highcharts.com/modules/exporting.js"></script>

@stop