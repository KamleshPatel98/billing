@extends('layout.masters')
@section('content')
<div class="mt-1">
    <div class="card">
        <div class="row">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header bg-success">
                        <h5>Product Category Details</h5>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive mt-2 shadow">
                            <table class="table table-striped table-bordered">
                                <thead class="text-center">
                                    <tr>
                                        <th>SN.</th>
                                        <th>Name</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($categories as $row)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $row->category_name }}</td>
                                            <td>
                                                <div class="d-flex justify-content-center">
                                                    <div class="mr-2">
                                                        <a href="{{route('category.edit',$row->id)}}" class="btn btn-sm btn-secondary text-light" rel="tooltip">
                                                            Edit
                                                        </a>
                                                    </div>
                                                    <div>
                                                        <form action="{{route('category.destroy',$row->id)}}" method="post">
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
                            {{ $categories->links('pagination::bootstrap-5') }}
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card shadow">
                    <div class="card-header bg-success"><h5>@isset($edit) Update Product Category @endisset @empty($edit) Add Product Category @endempty </h5></div>
                    <x-alert></x-alert>
                    <div class="card-body">
                        @isset($edit)
                            @foreach ($edit as $category)
                                    
                            @endforeach
                            <form action="{{ route('category.update',$category->id) }}" method="POST">
                                @csrf
                                @method('PUT')
                        @endisset
                        @empty($edit)
                            <form action="{{ route('category.store') }}" method="POST">
                                @csrf
                        @endempty
                            <div class="mt-1">
                                <lable class="form-label">Name<span class="text-danger">*</span></lable>
                                <input type="text" name="category_name"  value="@isset($edit) {{ $category->category_name }} @endisset" class="form-control">
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