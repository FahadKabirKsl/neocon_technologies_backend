@extends('admin.authentication.registration.master')

@push('css')
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/sweetalert2.css') }}">
@endpush

@section('content')
    <section>
        <div class="container-fluid p-0">
            <div class="row m-0">
                <div class="col-12 p-0">
                    <div class="login-card">
                        <form action="{{ route('register') }}" method="POST" class="theme-form login-form">
                            @csrf
                            <h4>Create your account</h4>
                            <h6>Enter your personal details to create account</h6>
                            <!-- User Name -->
                            <div class="form-group">
                                <x-input-label for="username" :value="__('User Name')" />
                                <div class="small-group">
                                    <div class="input-group">
                                        <span class="input-group-text"><i class="icon-user"></i></span>
                                        <x-text-input id="username" class="form-control" type="text" name="username"
                                            :value="old('username')" required autofocus autocomplete="username" />
                                    </div>
                                </div>
                            </div>
                            <!-- Name -->
                            <div class="form-group">
                                <x-input-label for="name" :value="__('Name')" />
                                <div class="small-group">
                                    <div class="input-group">
                                        <span class="input-group-text"><i class="icon-user"></i></span>
                                        <x-text-input id="name" class="form-control" type="text" name="name"
                                            :value="old('name')" required autofocus autocomplete="name" />
                                    </div>
                                </div>
                            </div>

                            <!-- Email Address -->
                            <div class="form-group">
                                <x-input-label for="email" :value="__('Email')" />
                                <div class="input-group">
                                    <span class="input-group-text"><i class="icon-email"></i></span>

                                    <x-text-input id="email" class="form-control" type="email" name="email"
                                        :value="old('email')" required autocomplete="username" />
                                </div>
                            </div>

                            <!-- Password -->
                            <div class="form-group">
                                <x-input-label for="password" :value="__('Password')" />
                                <div class="input-group">
                                    <span class="input-group-text"><i class="icon-lock"></i></span>

                                    <x-text-input id="password" class="form-control" type="password" name="password"
                                        required autocomplete="new-password" />
                                    <div class="show-hide"><span class="show"> </span></div>
                                </div>
                            </div>

                            {{-- Password-Confirmation --}}
                            <div class="form-group">
                                <x-input-label for="password_confirmation" :value="__('Confirm Password')" />
                                <div class="input-group">
                                    <span class="input-group-text"><i class="icon-lock"></i></span>

                                    <x-text-input id="password_confirmation" class="form-control"
                                        type="password_confirmation" name="password_confirmation" required
                                        autocomplete="new-password" />
                                    <div class="show-hide"><span class="show"> </span></div>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="checkbox">
                                    <input id="checkbox1" type="checkbox" />
                                    <label class="text-muted" for="checkbox1">Agree with <span>Privacy Policy
                                        </span></label>
                                </div>
                            </div>
                            <div class="form-group">
                                <x-primary-button class="btn btn-primary btn-block">
                                    {{ __('register') }}
                                </x-primary-button>
                            </div>
                            <div class="login-social-title">
                                <h5>signup with</h5>
                            </div>
                            <div class="form-group">
                                <ul class="login-social">
                                    <li>
                                        <a href="https://www.linkedin.com/login" target="_blank"><i
                                                data-feather="linkedin"></i></a>
                                    </li>
                                    <li>
                                        <a href="https://www.linkedin.com/login" target="_blank"><i
                                                data-feather="twitter"></i></a>
                                    </li>
                                    <li>
                                        <a href="https://www.linkedin.com/login" target="_blank"><i
                                                data-feather="facebook"></i></a>
                                    </li>
                                    <li>
                                        <a href="https://www.instagram.com/login" target="_blank"><i
                                                data-feather="instagram"> </i></a>
                                    </li>
                                </ul>
                            </div>
                            <p>Already have an account?<a class="ms-2" href="{{ route('login') }}">Sign in</a></p>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>


    @push('scripts')
        <script src="{{ asset('assets/js/sweet-alert/sweetalert.min.js') }}"></script>
    @endpush
@endsection
