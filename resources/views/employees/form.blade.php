@extends('layouts.app')
@section('content')
<div class="container">
    <div class="card" style="padding-bottom: 10px;">
        <div class="card-header">
            <div class="col-md-6" style="float: left"><h3>{{$title}}</h3></div>
            <div class="col-md-6" style="float: right;text-align: right;">
                <a class="btn btn-link" href="{{ url('employees') }}" > View Employees</a>
            </div>
        </div>
        <div class="card-body">
            <div class="card-body">
                <form method="POST" action="{{ isset($employees) ?  route('employees.store','id='. $employees->id) : route('employees.store')  }}">
                    @csrf
                    <div class="form-group row">
                        <label for="first_name" class="col-md-4 col-form-label text-md-right">First Name</label>
                        <div class="col-md-6">
                            <input id="first_name" type="text" class="form-control @error('first_name') is-invalid @enderror" name="first_name" value="{{ isset($employees->first_name)? $employees->first_name : old('first_name') }}"  autocomplete="first_name" autofocus>
                            @error('first_name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="last_name" class="col-md-4 col-form-label text-md-right">Last Name</label>
                        <div class="col-md-6">
                            <input id="last_name" type="text" class="form-control @error('last_name') is-invalid @enderror" name="last_name" value="{{ isset($employees->last_name)? $employees->last_name : old('last_name') }}"  autocomplete="last_name">
                            @error('last_name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="company"  class="col-md-4 col-form-label text-md-right">Company</label>
                        <div class="col-md-6">
                            <select id="company" name="company" class="form-control @error('company') is-invalid @enderror">
                                <option value=""> Select company</option>
                                @foreach ($companies as $com)
                                <option value="{{$com->id}}"  
                                        @if ($com->id == old('company', isset($employees->company)?$employees->company:''))
                                        selected="selected"
                                        @endif
                                        > {{$com->name}}</option>
                                @endforeach
                            </select>
                            @error('company')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="email" class="col-md-4 col-form-label text-md-right">Email</label>
                        <div class="col-md-6">
                            <input id="email" type="text" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ isset($employees->email)? $employees->email : old('email') }}"  autocomplete="email">
                            @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="phone" class="col-md-4 col-form-label text-md-right">Phone</label>
                        <div class="col-md-6">
                            <input id="phone" type="text" class="form-control @error('phone') is-invalid @enderror" name="phone" value="{{ isset($employees->phone)? $employees->phone : old('phone') }}"  autocomplete="phone">
                            @error('phone')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row mb-0">
                        <div class="col-md-6 offset-md-4">
                            <button type="submit" class="btn btn-primary">{{$button}}</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
