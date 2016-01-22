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

            <form action="{{ route('categories') }}" class="form-group">
                <input type="hidden" name="_token" id="token" value="{{ csrf_token() }}">
                <div class="row">
                    <div class="col-md-6">
                        <div class="panel panel-default">
                            <div class="panel-heading">Year</div>
                            <div class="panel-body">
                                @foreach($yearBoxes as $checkbox)
                                    <div class="checkbox">
                                        <label>
                                            <input tabindex="1" type="checkbox" name="year[]" id="{{$checkbox['year']}}" value="{{$checkbox['year']}}" {{ ($checkbox['yearChecked']) ? 'checked=checked' : '' }}>{{$checkbox['year']}}
                                        </label>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="panel panel-default">
                            <div class="panel-heading">Priority</div>
                            <div class="panel-body">
                                @foreach($priorityBoxes as $checkbox)
                                    <div class="checkbox">
                                        <label>
                                            <input tabindex="1" type="checkbox" name="priority[]" id="{{$checkbox['priority']}}" value="{{$checkbox['priority']}}" {{ ($checkbox['priorityChecked']) ? 'checked=checked' : '' }}>{{$checkbox['priority']}}
                                        </label>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
                <input type="submit" value="Update">
            </form>
        </div>

        <div class="col-md-7">
            <div id="chart" style="height:800px;"></div>
        </div>
    </div>

    <script type="text/javascript">
        $(document).ready(function() {
            $(function () {
                $('#chart').highcharts({!! json_encode($chart)!!});
        });
    });

    </script>
@stop