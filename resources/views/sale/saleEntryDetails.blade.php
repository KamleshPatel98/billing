@extends('layout.masters')

@section('content')
    <div class="container">
        <div class="card mt-5">
            <div class="card-header bg-success">
                <h5>Sale Entry Details</h5>
            </div>
            <x-alert></x-alert>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped table-bordered">
                        <thead>
                            <tr>
                                <th>SNo.</th>
                                <th>Customer</th>
                                <th>Sale Date</th>
                                <th>Sale id</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($sale_entries as $row)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $row->cust_name }}</td>
                                    <td>{{ \Carbon\Carbon::parse($row->sale_date)->format('d-m-Y') }}</td>
                                    <td>{{ $row->sale_id }}</td>
                                    <td>
                                        <div class="d-flex justify-content-center">
                                            <div class="mr-2">
                                                <a href="{{ route('invoice.sale_invoice',$row->sale_id) }}" class="btn btn-sm btn-secondary">View</a>
                                            </div>
                                            <div class="mr-2">
                                                <a href="{{ route('editSaleEntry',$row->sale_id)}}" class="btn btn-sm btn-secondary text-light" rel="tooltip">
                                                    Edit
                                                </a>
                                            </div>
                                            <div>
                                                <form action="{{ route('deleteSaleEntry',$row->sale_id)}}" method="post">
                                                    @csrf
                                                    @method('delete')
                                                    <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure to Delete?')">
                                                        Delete
                                                    </button>
                                                </form>
                                            </div>
                                        </div>
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