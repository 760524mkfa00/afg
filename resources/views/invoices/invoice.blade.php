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
            <div class="col-md-3">
                <div class="panel panel-default">
                    <div class="panel-heading"><strong>Team</strong></div>
                    <div class="panel-body">
                        {{ $data->description }}
                        <hr />
                        <table class="table table-bordered">
                            <tbody>
                            <tr>
                                <td>Contractor/Vendor/Supplier</td>
                                <td>{{ $data->cvs }}</td>
                            </tr>
                            <tr>
                                <td>Fees</td>
                                <td>$ {{ number_format($data->fees,2) }}</td>
                            </tr>
                            <tr>
                                <td>Hold Back</td>
                                <td>$ {{ number_format($data->holdback,2) }}</td>
                            </tr>
                            <tr>
                                <td>Sub Totals</td>
                                <td>$ {{ number_format($data->subtotal,2) }}</td>
                            </tr>
                            <tr>
                                <td>Totals</td>
                                <td>$ {{ number_format($data->total,2) }}</td>
                            </tr>
                            <tr>
                                <td>Owing</td>
                                <td>$ {{ number_format($data->owing,2) }}</td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <div class="col-md-9">
                <div class="panel panel-default">
                    <div class="panel-heading"><strong>Invoices</strong></div>
                    <div class="panel-body">
                        <table class="table table-bordered">
                            <thead>
                                <th>Edit</th>
                                <th>Scope of Work</th>
                                <th>Invoice #</th>
                                <th>Fees</th>
                                <th>Hold Back</th>
                                <th>Sub Total</th>
                                <th>Tax Rate</th>
                                <th>Total</th>
                            </thead>
                            <tbody>
                            @foreach($data->invoices as $invoice)
                                <tr>
                                    <td><a href="{{ route('invoice.edit', [$invoice->id, $data->id]) }}"><i class="fa fa-pencil-square-o"></i></a></td>
                                    <td>{{ $invoice->scope }}</td>
                                    <td>{{ $invoice->invoice }}</td>
                                    <td>{{ number_format($invoice->fees,2) }}</td>
                                    <td>{{ number_format(($invoice->holdback > 0) ? $invoice->fees * 0.1 : 0,2) }}</td>
                                    <td>{{ number_format($invoice->fees - (($invoice->holdback > 0) ? $invoice->fees * 0.1 : 0),2) }}</td>
                                    <td>{{ ($invoice->taxRates->rate / 100) }}</td>
                                    <td>
                                        {{ number_format(
                                            (($invoice->fees - (($invoice->holdback > 0) ? $invoice->fees * 0.1 : 0))
                                            * (1 + ($invoice->taxRates->rate / 100)))
                                        , 2)}}
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                        <a href="{{ route('invoice.create', $data->id) }}" class="btn btn-primary">Add Invoice</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function () {
            setTimeout(function(){
                $('.alert').fadeTo("slow", 0.1, function(){
                    $('.alert').alert('close')
                });
            }, 3000)
        });

    </script>

@stop
