@extends('layouts.app')

@section('content')
    <script>
        $(document).ready(function(){
            $("#demo").on("hide.bs.collapse", function(){
                $(".btn").html('<span class="glyphicon glyphicon-collapse-down"></span> Open');
            });
            $("#demo").on("show.bs.collapse", function(){
                $(".btn").html('<span class="glyphicon glyphicon-collapse-up"></span> Close');
            });
        });
    </script>
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h4 class="panel-title">
                        <a data-toggle="collapse" data-target="#collapseOne"
                           href="#collapseOne">
                            Yearly's
                        </a>
                    </h4>
                </div>
                <div id="collapseOne" class="panel-collapse collapse in">
                    <div class="panel-body">
                        <div class="row" >
                            <div class="col-md-12">
                                @foreach($data as $key => $value)
                                    <div class="col-md-3" style="">
                                        <div class="col-md-12" style="border: solid 1px #ddd; margin-bottom: 20px; min-height:200px; position: relative;">
                                            <div class="row">
                                                <div class="col-md-12" style="border-bottom: solid 1px #cccccc; padding:10px; background-color: #ddd;text-align: center; font-weight: bold;">
                                                    <th>{!! $key !!}</th>
                                                </div>
                                            </div>
                                            <div class="row" style="padding-top: 5px;">
                                                @foreach($value as $test)
                                                    <div class="col-md-6">{!! $test['priority'] !!}</div>
                                                    <div class="col-md-6">{!! number_format($test['subTotal'],2,'.',',') !!}</div>
                                                @endforeach

                                                <div class="col-md-12" style="position: absolute; bottom: 5px;">
                                                    <strong>Total: </strong> ${!! number_format($total[$key],2,'.',',') !!}
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
