@extends('layouts.app')

@section('content')
 
<x-content-header :label="'Profile'" />
<x-success/>


<div class="card">
    <div class="card-body">
       
        <form action="{{ route('profile.update') }}" method="POST">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label for="name">{{__('İsim')}}</label>
                <input type="text"
                  class="form-control @error('name') ' is-invalid '  @enderror " name="name" id="name" placeholder="{{__('İsim')}}"
                  value="{{ old('name', auth()->user()->name) }}" required
                  >
                  @error('name')
                  <span class="invalid-feedback" role="alert">
                          <strong>{{ $message }}</strong>
                      </span>
                  @enderror
              </div>

              <div class="form-group">
                <label for="email">{{__('Email')}}</label>
                <input type="email"
                  class="form-control @error('email') ' is-invalid '  @enderror " name="email" id="email" placeholder="{{__('Email')}}"
                  value="{{ old('email', auth()->user()->email) }}" 
                  >
                  @error('email')
                  <span class="invalid-feedback" role="alert">
                          <strong>{{ $message }}</strong>
                      </span>
                  @enderror
              </div>
    

              <div class="form-group">
                <label for="password">{{__('Yeni Parola')}}</label>
                <input type="password"
                  class="form-control @error('password') ' is-invalid '  @enderror " name="password" id="password" placeholder="{{__('Yeni Parola')}}"
                  >
                  @error('password')
                  <span class="invalid-feedback" role="alert">
                          <strong>{{ $message }}</strong>
                      </span>
                  @enderror
              </div>

              <div class="form-group">
                <label for="password_confirmation">{{__('Parola Tekar')}}</label>
                <input type="password"
                  class="form-control @error('password') ' is-invalid '  @enderror " name="password_confirmation" id="password_confirmation" placeholder="{{__('Parola Tekar')}}"
                  >
              </div>

              <div class="">
                  <button type="submit" class="btn btn-sm btn-dark">Kaydet</button>
              </div>

        </form>
    </div>
</div>



    <div class="card-styles">
        <div class="card-style-3 mb-30">
            <div class="card-content">

          


            </div>
        </div>
    </div>
@endsection
