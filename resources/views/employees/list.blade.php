@extends('layouts.app')
@section('content')
<div class="container">
    <div class="card" style="padding-bottom: 10px;">
        <div class="card-header">
            <div class="col-md-6" style="float: left"><h2> Employees</h2></div>
            <div class="col-md-6" style="float: right;text-align: right;">
                <a class="btn btn-link" href="{{ url('employees/create') }}" > Create</a>
            </div>
        </div>
    </div>
    @if ($message = Session::get('success'))
    <div class="alert alert-success">
        <p>{{ $message }}</p>
    </div>
    @endif
    <table class="table table-bordered" id="companies">
        <thead>
            <tr>
                <th>Id</th>
                <th>Name</th>
                <th>Company</th>
                <th>Website</th>  
                <th>Phone</th>
                <th>Created at</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($employees as $employ)
            <tr>
                <td>{{ $employ->id }}</td>
                <td>{{ $employ->first_name }} {{ $employ->last_name }}</td>
                <td>{{ isset($employ->compnay_data->name)? $employ->compnay_data->name : '-' }}</td>
                <td>{{ $employ->email }}</td>
                <td>{{ $employ->phone }}</td>
                <td>{{ date('d-m-Y', strtotime($employ->created_at)) }}</td>
                <td>
                    <form action="{{ route('employees.destroy', $employ->id) }}" method="post">
                        <a href="{{ route('employees.edit', $employ->id) }}" class="btn btn-primary">Edit</a>
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Delete</button>
                    </form>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="7" style="text-align: center;font-weight: bold">
                    Data Not Found
                </td>
            </tr>
            @endforelse
        </tbody>
    </table>
    {!! $employees->links() !!}
</div>
@endsection
