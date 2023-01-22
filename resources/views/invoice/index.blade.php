@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8 col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>RefNo</th>
                                    <th>Recipient</th>
                                    <th>Total</th>
                                    <th>Created at</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @forEach($invoices as $key => $value)
                                <tr>
                                    <td>{{$value->reference_no}}</td>
                                    <td>{{$value->recipient_name}}</td>
                                    <td>{{$value->total}}</td>
                                    <td>{{$value->created_at}}</td>
                                    <td>
                                        <a href="/invoice/{{$value->id}}" class="btn btn-sm btn-primary">View</a>
                                    </td>
                                </tr>
                                @endForeach
                            </tbody>
                            <tfoot>
                                {{ $invoices->links() }}
                                <span>Total: {{ $invoices->count() }}</span>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
