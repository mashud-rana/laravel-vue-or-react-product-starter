@extends('admin.layouts.auth')

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-8 col-lg-6 col-xl-5">
            <div class="card overflow-hidden shadow-lg border-0">
                <div class="bg-primary bg-soft-primary">
                    <div class="row">
                        <div class="col-7">
                            <div class="text-primary p-4">
                                <h5 class="text-primary font-size-20 fw-bold">Welcome Back!</h5>
                                <p class="text-muted">Sign in to continue to {{ config('settings.site_title') }}</p>
                            </div>
                        </div>
                        <div class="col-5 align-self-end">
                            <img src="{{ asset('images/profile-img.png') }}" alt="" class="img-fluid"
                                 onerror="this.style.display='none'">
                        </div>
                    </div>
                </div>
                <div class="card-body pt-0">
                    <div class="p-2">
                        <div class="text-center mb-4 mt-3">
                            <a href="{{ url('/') }}" class="d-block auth-logo">
                                <img src="{{ getStorageImage(config('settings.site_logo'),false,'logo') }}"
                                     alt="logo" height="28" class="logo-dark mx-auto">
                            </a>
                        </div>

                        <form class="mt-4" method="POST" action="{{ route('login') }}">
                            @csrf

                            <div class="mb-3">
                                <label class="form-label" for="email">Email Address</label>
                                <div class="input-group">
                                    <span class="input-group-text bg-light border-end-0">
                                        <i class="mdi mdi-email-outline"></i>
                                    </span>
                                    <input type="email" name="email"
                                           class="form-control border-start-0 ps-0"
                                           value="{{ old('email') }}"
                                           id="email"
                                           placeholder="Enter your email"
                                           required autofocus>
                                </div>
                                @error('email')
                                    <span class="text-danger small">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label class="form-label" for="userpassword">Password</label>
                                <div class="input-group">
                                    <span class="input-group-text bg-light border-end-0">
                                        <i class="mdi mdi-lock-outline"></i>
                                    </span>
                                    <input type="password" name="password" required
                                           class="form-control border-start-0 ps-0"
                                           id="userpassword"
                                           placeholder="Enter your password">
                                </div>
                                @error('password')
                                    <span class="text-danger small">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="form-check mb-3">
                                <input type="checkbox" name="remember"
                                       class="form-check-input"
                                       id="customControlInline">
                                <label class="form-check-label" for="customControlInline">
                                    Remember me
                                </label>
                            </div>

                            <div class="mt-3 d-grid">
                                <button class="btn btn-primary waves-effect waves-light btn-lg" type="submit">
                                    <i class="mdi mdi-login me-1"></i> Log In
                                </button>
                            </div>

                            @if(Route::has('password.request'))
                                <div class="mt-4 text-center">
                                    <a href="{{ route('password.request') }}" class="text-muted">
                                        <i class="mdi mdi-lock me-1"></i> Forgot your password?
                                    </a>
                                </div>
                            @endif

                        </form>

                    </div>
                </div>
            </div>

            <div class="mt-5 text-center">
                <div class="row">
                    <div class="col-md-6 text-center text-md-start">
                        <p class="mb-0 text-muted">
                            Copyright © {{ date('Y') }} {{ config('settings.site_title') }}. All rights reserved.
                        </p>
                    </div>
                    <div class="col-md-6 text-center text-md-end mt-2 mt-md-0">
                        <p class="mb-0 text-muted">
                            Design & Developed By <a href="https://itclanbd.com" target="_blank"
                                                      rel="noopener noreferrer"
                                                      class="text-primary fw-semibold">ITclan BD</a>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <style>
        .bg-soft-primary {
            background-color: rgba(6, 46, 90, 0.1) !important;
        }

        .input-group-text {
            border-right: 0;
        }

        .border-start-0 {
            border-left: 0 !important;
        }

        .border-end-0 {
            border-right: 0 !important;
        }

        .form-control:focus {
            border-color: #ced4da;
            box-shadow: none;
        }

        .input-group:focus-within .input-group-text {
            border-color: rgba(6, 46, 90, 0.4);
        }

        .input-group:focus-within .form-control {
            border-color: rgba(6, 46, 90, 0.4);
        }
    </style>
@endsection
