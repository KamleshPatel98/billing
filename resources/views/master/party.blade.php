@extends('layout.masters')
@section('content')
    <div class="mt-1">
        <div class="card">
            <div class="row">
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-header bg-success">
                            <h5>Party Details</h5>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('party.create') }}" method="get">
                                <div class="row">
                                    <div class="col-md-">Name </div>
                                    <div class="col-md-4">
                                        <input type="text" name="party_name" value="@isset($party_name) {{ $party_name }} @endisset" class="form-control">
                                    </div>
                                    <div class="col-md-">Mobile   </div>
                                    <div class="col-md-4">
                                        <input type="tel" name="party_mobile" value="@isset($party_mobile) {{ $party_mobile }} @endisset" class="form-control">
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
                                            <th>Party Type</th>
                                            <th>Opening Balance</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($parties as $row)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $row->party_name }}</td>
                                                <td>{{ $row->party_mobile }}</td>
                                                <td>{{ $row->party_address }}</td>
                                                <td>{{ $row->party_type }}</td>
                                                <td>{{ $row->party_opening_bal }}</td>
                                                <td>{{ $row->party_status=='1'?'Active':'Inactive' }}</td>
                                                <td>
                                                    <div class="d-flex justify-content-center">
                                                        <div class="mr-2">
                                                            <a href="{{route('party.edit',$row->id)}}" class="btn btn-sm btn-secondary text-light" rel="tooltip">
                                                                Edit
                                                            </a>
                                                        </div>
                                                        <div>
                                                            <form action="{{route('party.destroy',$row->id)}}" method="post">
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
                                {{ $parties->links('pagination::bootstrap-5') }}
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card shadow">
                        <div class="card-header bg-success"><h5>@isset($edit) Update Party @endisset @empty($edit) Add Party @endempty </h5></div>
                        <x-alert></x-alert>
                        <div class="card-body">
                            @isset($edit)
                                @foreach ($edit as $party)
                                        
                                @endforeach
                                <form action="{{ route('party.update',$party->id) }}" method="POST">
                                    @csrf
                                    @method('PUT')
                            @endisset
                            @empty($edit)
                                <form action="{{ route('party.store') }}" method="POST">
                                    @csrf
                            @endempty
                                <div class="mt-1">
                                    <lable class="form-label">Name<span class="text-danger">*</span></lable>
                                    <input type="text" name="party_name"  value="@isset($edit) {{ $party->party_name }} @endisset" class="form-control">
                                </div>
                                <div class="mt-1">
                                    <lable class="form-label">Mobile<span class="text-danger">*</span></lable>
                                    <input type="tel" name="party_mobile"  value="@isset($edit) {{ $party->party_mobile }} @endisset" class="form-control">
                                </div>
                                <div class="mt-"1>
                                    <lable class="form-label">Address<span class="text-danger">*</span></lable>
                                    <textarea name="party_address" name="party_address" cols="30" class="form-control">@isset($edit) {{ $party->party_address }} @endisset</textarea>
                                </div>
                                <div class="mt-1">
                                    <lable class="form-label">Opening Balance<span class="text-danger">*</span></lable>
                                    <input type="number" name="party_opening_bal"  value="{{ isset($edit) ? $party->party_opening_bal : '' }}" class="form-control">
                                </div>
                                <div class="mt-1">
                                    <lable class="form-label"> Type</lable>
                                    <select name="party_type" id="" class="form-control">
                                        <option value="Supplier" {{ isset($edit) ? $party->party_type == 'Supplier' ? 'selected' : '' : ''}}>Supplier</option>
                                        <option value="Customer" {{ isset($edit) ? $party->party_type == 'Customer' ? 'selected' : '' : ''}}>Customer</option>
                                    </select>
                                </div>
                                <div class="mt-1">
                                    <lable class="form-label"> Status</lable>
                                    <select name="party_status" id="" class="form-control">
                                        <option value="1" {{ isset($edit) ? $party->party_status == '1' ? 'selected' : '' : ''}}>Active</option>
                                        <option value="0" {{ isset($edit) ? $party->party_status == '0' ? 'selected' : '' : ''}}>Inactive</option>
                                    </select>
                                </div>
                                
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