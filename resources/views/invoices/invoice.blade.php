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
                                <td>Sub Totals</td>
                                <td>Sub Totals</td>
                            </tr>
                            <tr>
                                <td>Totals</td>
                                <td>Totals</td>
                            </tr>
                            <tr>
                                <td>Owing</td>
                                <td>Owing</td>
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
                                <th>Disbursements</th>
                                <th>Tax Rate</th>
                                <th>Total</th>
                            </thead>
                            <tbody>
                            @foreach($data->invoices as $invoice)
                                <tr>
                                    <td><a href="#"><i class="fa fa-pencil-square-o"></i></a></td>
                                    <td>{{ $invoice->scope }}</td>
                                    <td>{{ $invoice->invoice }}</td>
                                    <td>{{ $invoice->fees }}</td>
                                    <td>{{ $invoice->holdback }}</td>
                                    <td>{{ $invoice->disbursements }}</td>
                                    <td>{{ $invoice->taxRate_id }}</td>
                                    <td>Some Calculated Value</td>
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
