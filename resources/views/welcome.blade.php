@extends('layouts.app')

@section('content')

    <style>
        .panel-default > .panel-heading {
            background-color:#7A021F ;
            color: #ffffff;
            font-size: 1.4em;
        }

        .panel-default > .panel-heading a {
            color: #ffffff;
        }
    </style>

<div class="container island">
    <div class="row">
        <div class="col-md-12" style="text-align: center;">
            <img src="{{ asset('img/AFG-sml.png') }}" alt="AFG" width="">
            <hr/>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">Annual Facilities Grant</div>

                <div class="panel-body">
                    The Annual Facilities Grant helps make decisions how funding will be distributed.
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-6">
            <div class="panel panel-default">
                <div class="panel-heading"><a href="{!! $global['permalink'] !!}">Latest from {!! $global['title'] !!}</a></div>
                <div class="panel-body">
                    @foreach ($global['items'] as $item)
                        <div class="item">
                            <h4><a href="{!! $item->get_permalink() !!}">{!! $item->get_title() !!}</a></h4>
                            <p><small>Posted on {!! $item->get_date('j F Y | g:i a') !!}</small></p>
                            <p>{!! $item->get_description() !!}</p>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="panel panel-default">
                <div class="panel-heading"><a href="{!! $financial['permalink'] !!}">Latest from {!! $financial['title'] !!}</a></div>
                <div class="panel-body">
                    @foreach ($financial['items'] as $item)
                        <div class="item">
                            <h4><a href="{!! $item->get_permalink() !!}">{!! $item->get_title() !!}</a></h4>
                            <p><small>Posted on {!! $item->get_date('j F Y | g:i a') !!}</small></p>
                            <p>{!! $item->get_description() !!}</p>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
