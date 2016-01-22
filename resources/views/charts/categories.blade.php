@extends('layouts.app')

@section('content')

    <div class="row">
        <div class="col-md-5 col-lg-offset-1">
            @if (count($errors) > 0)
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <form action="/chart" class="form-group">
                <input type="hidden" name="_token" id="token" value="{{ csrf_token() }}">
                        @foreach ($years as $year)
                            <input tabindex="1" type="checkbox" name="year[]" id="{{$year}}" value="{{$year}}">{{$year}}<br/>
                        @endforeach

                        @foreach ($priorities as $priority)
                            <input tabindex="1" type="checkbox" name="priority[]" id="{{$priority}}" value="{{$priority}}">{{$priority}}<br/>
                        @endforeach
                <input type="submit" value="Update">
            </form>
        </div>

        <div class="col-md-5">
            <div id="chart" style="height:800px;"></div>
        </div>
    </div>

    <script type="text/javascript">
        $(function(){
            $('#chart').highcharts({!! json_encode($chart)!!});
        });


//        $(document).ready(function () {
//
//            var categories = [];
//
//            // Listen for 'change' event, so this triggers when the user clicks on the checkboxes labels
//            $('input[name="year[]"]').on('change', function (e) {
//
//                e.preventDefault();
//                year = []; // reset
//
//                $('input[name="year[]"]:checked').each(function()
//                {
//                    year.push($(this).val());
//                });
//                token = $('#token').val();
//                $.ajax({
//                    'url' : '/chart',
//                    'data' : {
//                        y:year,
//                        _token:token
//                    },
//                    'success': function(data) {
//
//                        visitorData(data);
//
//                    }
//                });
//            });
//            function visitorData (data) {
//                $('#chart').highcharts(data);
//            }
//        });
    </script>
@stop