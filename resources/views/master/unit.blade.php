@extends('layout.masters')
@section('content')
<div class="mt-1">
    <div class="card">
        <div class="row">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header bg-success">
                        <h5>Unit Details</h5>
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
                                    @foreach ($units as $row)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $row->unit_name }}</td>
                                            <td>
                                                <div class="d-flex justify-content-center">
                                                    <div class="mr-2">
                                                        <a href="{{route('unit.edit',$row->id)}}" class="btn btn-sm btn-secondary text-light" rel="tooltip">
                                                            Edit
                                                        </a>
                                                    </div>
                                                    <div>
                                                        <form action="{{route('unit.destroy',$row->id)}}" method="post">
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
                            {{ $units->links('pagination::bootstrap-5') }}
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card shadow">
                    <div class="card-header bg-success"><h5>@isset($edit) Update Unit @endisset @empty($edit) Add Unit @endempty </h5></div>
                    <x-alert></x-alert>
                    <div class="card-body">
                        @isset($edit)
                            @foreach ($edit as $unit)
                                    
                            @endforeach
                            <form action="{{ route('unit.update',$unit->id) }}" method="POST">
                                @csrf
                                @method('PUT')
                        @endisset
                        @empty($edit)
                            <form action="{{ route('unit.store') }}" method="POST">
                                @csrf
                        @endempty
                            <div class="mt-1">
                                <lable class="form-label">Name<span class="text-danger">*</span></lable>
                                <input type="text" name="unit_name"  value="@isset($edit) {{ $unit->unit_name }} @endisset" class="form-control">
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