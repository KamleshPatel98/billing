@extends('layout.masters')
@section('content')
    <div class="mt-1">
        <div class="card">
            <div class="row">
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-header bg-success">
                            <h5>Customer Details</h5>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('customer.create') }}" method="get">
                                <div class="row">
                                    <div class="col-md-">Name </div>
                                    <div class="col-md-4">
                                        <input type="text" name="cust_name" value="@isset($cust_name) {{ $cust_name }} @endisset" class="form-control">
                                    </div>
                                    <div class="col-md-">Mobile   </div>
                                    <div class="col-md-4">
                                        <input type="tel" name="mobile" value="@isset($mobile) {{ $mobile }} @endisset" class="form-control">
                                    </div>
                                    <div class="col-md-2 text-center">
                                        <button class="btn btn-sm btn-primary" type="subit">Search</button>
                                    </div>
                                </div>
                            </form>
                            <div class="table-responsive mt-2 shadow">
                                <table class="table table-striped table-bordered">
                                    <thead class="text-center">
                                        <tr>
                                            <th>SN.</th>
                                            <th>Name</th>
                                            <th>Mobile</th>
                                            <th>Address</th>
                                            <th>Opening Balance</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($customers as $row)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $row->cust_name }}</td>
                                                <td>{{ $row->mobile }}</td>
                                                <td>{{ $row->address }}</td>
                                                <td>{{ $row->opening_bal }}</td>
                                                <td>
                                                    <div class="d-flex justify-content-center">
                                                        <div class="mr-2">
                                                            <a href="{{route('customer.edit',$row->id)}}" class="btn btn-sm btn-secondary text-light" rel="tooltip">
                                                                Edit
                                                            </a>
                                                        </div>
                                                        <div>
                                                            <form action="{{route('customer.destroy',$row->id)}}" method="post">
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
                                {{ $customers->links('pagination::bootstrap-5') }}
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card shadow">
                        <div class="card-header bg-success"><h5>@isset($edit) Update Customer @endisset @empty($edit) Add Customer @endempty </h5></div>
                        <x-alert></x-alert>
                        <div class="card-body">
                            @isset($edit)
                                @foreach ($edit as $customer)
                                        
                                @endforeach
                                <form action="{{ route('customer.update',$customer->id) }}" method="POST">
                                    @csrf
                                    @method('PUT')
                            @endisset
                            @empty($edit)
                                <form action="{{ route('customer.store') }}" method="POST">
                                    @csrf
                            @endempty
                                <div class="mt-1">
                                    <lable class="form-label">Name<span class="text-danger">*</span></lable>
                                    <input type="text" name="cust_name"  value="@isset($edit) {{ $customer->cust_name }} @endisset" class="form-control">
                                </div>
                                <div class="mt-1">
                                    <lable class="form-label">Mobile<span class="text-danger">*</span></lable>
                                    <input type="tel" name="mobile"  value="@isset($edit) {{ $customer->mobile }} @endisset" class="form-control">
                                </div>
                                <div class="mt-"1>
                                    <lable class="form-label">Address<span class="text-danger">*</span></lable>
                                    <textarea name="address" name="address" cols="30" class="form-control">@isset($edit) {{ $customer->address }} @endisset</textarea>
                                </div>
                                <div class="mt-1">
                                    <lable class="form-label">Opening Balance<span class="text-danger">*</span></lable>
                                    <input type="number" name="opening_bal"  value="{{ isset($edit) ? $customer->opening_bal : '' }}" class="form-control">
                                </div>
                                <x-created_at></x-created_at>
                                <div class="mt-3 text-center">
                                    <button class=" col-4 btn btn-sm btn-primary" type="submit">Submit</button>
                                    <button class=" col-4 btn btn-sm btn-danger" type="reset">Reset</button>
                                </div>
                            </form>
                        </div>
                    </div>
                    
                </div>
            </div>
        </div>
    </div>
@endsection