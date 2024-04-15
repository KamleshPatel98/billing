@extends('layout.masters')
@section('content')
<div class="mt-1">
    <div class="card">
        <div class="row">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header bg-success">
                        <h5>Item Details</h5>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive mt-2 shadow">
                            <table class="table table-striped table-bordered">
                                <thead class="text-center">
                                    <tr>
                                        <th>SN.</th>
                                        <th>category Name</th>
                                        <th>Item Name</th>
                                        <th>Item Price</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($items as $row)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $row->category->category_name }}</td>
                                            <td>{{ $row->item_name }}</td>
                                            <td>{{ $row->item_price }}</td>
                                            <td>
                                                <div class="d-flex justify-content-center">
                                                    <div class="mr-2">
                                                        <a href="{{route('item.edit',$row->id)}}" class="btn btn-sm btn-secondary text-light" rel="tooltip">
                                                            Edit
                                                        </a>
                                                    </div>
                                                    <div>
                                                        <form action="{{route('item.destroy',$row->id)}}" method="post">
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
                            {{ $items->links('pagination::bootstrap-5') }}
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card shadow">
                    <div class="card-header bg-success"><h5>@isset($edit) Update Item @endisset @empty($edit) Add Item @endempty </h5></div>
                    <x-alert></x-alert>
                    <div class="card-body">
                        @isset($edit)
                            @foreach ($edit as $item)
                                    
                            @endforeach
                            <form action="{{ route('item.update',$item->id) }}" method="POST">
                                @csrf
                                @method('PUT')
                        @endisset
                        @empty($edit)
                            <form action="{{ route('item.store') }}" method="POST">
                                @csrf
                        @endempty
                            <div class="mt-1">
                                <lable class="form-label">Category Name<span class="text-danger"> *</span></lable>
                                    <select name="category_id" id="" class="form-control">
                                        <option value="">Select</option>
                                        @foreach ($categories as $row)
                                            <option value="{{ $row->id }}" {{ isset($edit) ? $item->category_id == $row->id ? 'selected' : '' : '' }}>{{ $row->category_name }}</option>
                                        @endforeach
                                    </select>
                            </div>
                            <div class="mt-1">
                                <lable class="form-label">Item Name <span class="text-danger">*</span></lable>
                                <input type="text" name="item_name"  value="{{ isset($edit) ? $item->item_name : '' }}" class="form-control">
                            </div>
                            <div class="mt-1">
                                <lable class="form-label">Item Price <span class="text-danger">*</span></lable>
                                <input type="number" name="item_price"  value="{{ isset($edit) ? $item->item_price : '' }}" class="form-control">
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