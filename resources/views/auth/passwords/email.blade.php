@extends('layouts.app')

@section('content')
<div class="kt-grid kt-grid--ver kt-grid--root">
            <div class="kt-grid kt-grid--hor kt-grid--root  kt-login kt-login--v3 kt-login--signin" id="kt_login">
                <div class="kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor" style="background-image: url(./assets/media//bg/bg-3.jpg);">
                    <div class="kt-grid__item kt-grid__item--fluid kt-login__wrapper">
                        <div class="kt-login__container">
                            <div class="kt-login__logo">
                                <a href="#">
                                      <img src="./assets/media/logos/logo-5.png" style="width: 40%;">
                                </a>
                            </div>
                                @if (session('status'))
                                    <div class="alert alert-success" role="alert">
                                        {{ session('status') }}
                                    </div>
                                @endif
                            <div class="kt-login__signin">
                                <div class="kt-login__head">
                                    <h3 class="kt-login__title">{{ __('Reset Password') }}</h3>
                                </div>
                               
                        <form method="POST" class="kt-form" action="{{ route('password.email') }}">
                                    @csrf

                                    <div class="input-group">
                                       <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                                    </div>
                                    
                                    
                                    <div class="kt-login__actions">
                                        <button  class="btn btn-brand btn-elevate kt-login__btn-primary">  {{ __('Send Password Reset Link') }}</button>
                                    </div>
                                </form>
                            </div>
                            
                            
                            
                        </div>
                    </div>
                </div>
            </div>
        </div>
@endsection
