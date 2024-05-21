@extends('layout.masters')

@section('content')
    <div class="container">
        <div class="card mt-5">
            <div class="card-header bg-success">
                <h5>Sale Entry Details</h5>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped table-bordered">
                        <thead>
                            <tr>
                                <th>SNo.</th>
                                <th>Customer</th>
                                <th>Sale Date</th>
                                <th>Item</th>
                                <th>Unit</th>
                                <th>Price</th>
                                <th>Qty</th>
                                <th>Amount</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($sale_entries as $row)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $row->cust_name }}</td>
                                    <td>{{ $row->sale_date }}</td>
                                    <td>{{ $row->item_name }}</td>
                                    <td>{{ $row->unit_name }}</td>
                                    <td>{{ $row->price }}</td>
                                    <td>{{ $row->qty }}</td>
                                    <td>{{ $row->totalPrice }}</td>
                                    <td>
                                        <a href="{{ route('invoice.sale_invoice',$row->bill_no) }}" class="btn btn-sm btn-secondary">View</a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    {{ $sale_entries->links('pagination::bootstrap-5') }}
                </div>
            </div>
        </div>
    </div>
@endsection