@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8 col-lg-12">
            <div class="card">
                <div class="card-header">
                    <a href="/invoice" class="btn btn-sm btn-primary">Back</a>
                </div>
                <div class="card-body">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <td colspan="2">
                                    <h4>Invoice Details</h4>
                                </td>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <th>Reference No:</th>
                                <td>{{$invoice->reference_no}}</td>
                            </tr>
                            <tr>
                                <th>Recipient Name: </th>
                                <td>{{$invoice->recipient_name}}</td>
                            </tr>
                            <tr>
                                <th>Recipient Address: </th>
                                <td>{{$invoice->recipient_address}}</td>
                            </tr>
                            <tr>
                                <th>Sub-Total: </th>
                                <td>{{$invoice->sub_total}}</td>
                            </tr>
                            <tr>
                                <th>Tax Rate: </th>
                                <td>{{$invoice->tax_rate}}</td>
                            </tr>
                            <tr>
                                <th>Tax Amount: </th>
                                <td>{{$invoice->tax_amount}}</td>
                            </tr>
                            <tr>
                                <th>Total: </th>
                                <td>{{$invoice->total}}</td>
                            </tr>
                            <tr>
                                <th>Amount Paid: </th>
                                <td>{{$invoice->amount_paid}}</td>
                            </tr>
                            <tr>
                                <th>Amount Due: </th>
                                <td>{{$invoice->amount_due}}</td>
                            </tr>
                            <tr>
                                <th>Notes</th>
                                <td>{{$invoice->notes}}</td>
                            </tr>
                            <tr>
                                <th>Date Created: </th>
                                <td>{{$invoice->created_at}}</td>
                            </tr>
                        </tbody>
                        <tfoot>

                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <div class="row justify-content-center">
        <div class="col-md-8 col-lg-12">
            <div class="card">
                <div class="card-body">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <td colspan="5">
                                    <h4>Items</h4>
                                </td>
                            </tr>
                            <tr>
                                <th>No</th>
                                <th>Name</th>
                                <th>Price</th>
                                <th>Quantity</th>
                                <th>Total</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($items as $key => $value)
                            <tr>
                                <td>{{$value->no}}</td>
                                <td>{{$value->name}}</td>
                                <td>{{$value->price}}</td>
                                <td>{{$value->quantity}}</td>
                                <td>{{$value->total}}</td>
                            </tr>
                            @endforeach
                        </tbody>
                        <tfoot>

                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
