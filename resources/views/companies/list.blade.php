@extends('layouts.app')
@section('content')
<div class="container">
    <div class="card" style="padding-bottom: 10px;">
        <div class="card-header">
            <div class="col-md-6" style="float: left"><h2> Companies</h2></div>
            <div class="col-md-6" style="float: right;text-align: right;">
                <a class="btn btn-link" href="{{ url('companies/create') }}"> Create</a>
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
                <th>Email</th>
                <th>Logo</th>
                <th>Website</th>  
                <th>Created at</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($companies as $compa)
            <tr>
                <td>{{ $compa->id }}</td>
                <td>{{ $compa->name }}</td>
                <td>{{ $compa->email }}</td>
                <td><img src="{{ asset('storage/'.$compa->logo) }}" class="img-thumbnail" width="75" /></td>
                <td><a class="btn btn-link" target="_black" href="{{ $compa->website }}"> {{$compa->website}}</a></td>
                <td>{{ date('d-m-Y', strtotime($compa->created_at)) }}</td>
                <td>
                    <form action="{{ route('companies.destroy', $compa->id) }}" method="post">
                        <a href="{{ route('companies.edit', $compa->id) }}" class="btn btn-primary">Edit</a>
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
    {!! $companies->links() !!}
</div>
@endsection
