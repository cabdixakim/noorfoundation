@extends('layouts.app')

@section('content')
<div class="container mt-20">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Register') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('register') }}">
                        @csrf

                        <div class="form-group row">
                            <label for="username" class="col-md-4 col-form-label text-md-right">{{ __('Username') }}</label>

                            <div class="col-md-6">
                                <input id="username" type="text" class="form-control @error('username') is-invalid @enderror" name="username" value="{{ old('username') }}" required autocomplete="username" autofocus>

                                @error('username')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        {{-- <div class="form-group row">
                            <label for="user_type" class="col-md-4 col-form-label text-md-right">{{ __('Type of user') }}</label>

                            <div class="col-md-6">
                                <input id="user_type" type="text" class="form-control @error('user_type') is-invalid @enderror" name="user_type" value="{{ old('user_type') }}" required autocomplete="user_type" autofocus>

                                
                            </div> --}}
                            
                            <div class="form-group row mb-0">
                                <div class="col-md-4 mx-auto">
                                    @error('user_type')
                                    <span class="text-danger">
                                        <strong>{{ ('Please choose either student or sponsor') }}</strong>
                                    </span>
                                    @enderror
                                    {{-- <small class="bg-gradient-info  text-info">Please tell us the type of user you are</small> --}}
                                </div>
                            </div>
                            <div class="form-group row mt-0">
                                 
                                <div class="col-md-3 mx-auto">
                                   
                                   <div class="d-flex justify-content-between">
                                    <div class="custom-control custom-radio custom-control-inline ">
                                        <input type="radio" id="1" name="user_type" class="custom-control-input" {{ old('user_type') == 'student' ? 'checked' : '' }} value="student">
                                        <label class="custom-control-label" for="1">Student</label>
                                      </div>
                                      <div class="custom-control custom-radio custom-control-inline">
                                        <input type="radio" id="2" name="user_type" class="custom-control-input" {{ old('user_type') == 'sponsor' ? 'checked' : '' }} value="sponsor">
                                        <label class="custom-control-label" for="2">Sponsor</label>
                                      </div>
                                   </div>
                                </div>
                            </div>
                           

                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('Confirm Password') }}</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Register') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
