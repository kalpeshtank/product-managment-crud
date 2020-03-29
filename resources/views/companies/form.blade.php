@extends('layouts.app')
@section('content')
<div class="container">
    <div class="card" style="padding-bottom: 10px;">
        <div class="card-header">
            <div class="col-md-6" style="float: left"><h3>{{$title}}</h3></div>
            <div class="col-md-6" style="float: right;text-align: right;">
                <a class="btn btn-link" href="{{ url('companies') }}" > View Companies</a>
            </div>
        </div>
        <div class="card-body">
            <div class="card-body">
                <form method="POST" action="{{ isset($companies) ?  route('companies.store','id='. $companies->id) : route('companies.store')  }}" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group row">
                        <label for="name" class="col-md-4 col-form-label text-md-right">Name</label>
                        <div class="col-md-6">
                            <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ isset($companies->name)? $companies->name : old('name') }}"  autocomplete="name" autofocus>
                            @error('name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="email" class="col-md-4 col-form-label text-md-right">Email</label>
                        <div class="col-md-6">
                            <input id="email" type="text" class="form-control @error('email') is-invalid @enderror" name="email" value="{{  isset($companies->email)? $companies->name : old('email') }}"  autocomplete="email">
                            @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="logo" class="col-md-4 col-form-label text-md-right">Logo</label>
                        <div class="col-md-6">
                            <input id="logo" type="file" class="@error('logo') is-invalid @enderror" name="logo" value="{{ old('logo') }}"  autocomplete="logo">
                            @if(isset($companies))
                            <img src="{{ asset('storage/'.$companies->logo) }}" class="img-thumbnail" width="100" />
                            <input type="hidden" name="hidden_image" value="{{ $companies->logo }}" />
                            @endif
                            @error('logo')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="website" class="col-md-4 col-form-label text-md-right">Website</label>
                        <div class="col-md-6">
                            <input id="website" type="text" class="form-control @error('website') is-invalid @enderror" name="website" value="{{ isset($companies->website)? $companies->website: old('website') }}"  autocomplete="website">
                            @error('website')
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
