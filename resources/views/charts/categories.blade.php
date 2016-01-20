@extends('layouts.app')

@section('content')

    <div id="container" style="width:90%; height:600px;"></div>

    <script type="text/javascript">
        $(function(){
            $('#container').highcharts({!! json_encode($yourFirstChart)!!});
        });
    </script>
@stop