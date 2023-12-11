@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row align-items-center justify-content-center" >
        <div class="card p-4 col-12 ">
            <h2 class="h2 fw-bold">
                Login
            </h2>
            <p class="">Masuk untuk melanjutkan ke dashboard</p>
            <form method="POST" action="{{ route('login') }}">
                @csrf

                <x-forms.input name="email" id="email" label="Masukkan email" :isRequired='true' placeholder="Masukkan email" type="email"></x-forms.input>
                <x-forms.input name="password" id="password" label="Masukkan password" :isRequired='true' placeholder="Masukkan password" type="password"></x-forms.input>

                <div class="row mb-3">
                    <div class="col-md-10 ">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                            <label class="form-check-label" for="remember">
                                {{ __('Remember Me') }}
                            </label>
                        </div>
                    </div>
                </div>

                <div class="row mb-0">
                    <div class="col-12 ">
                        <button type="submit" class="w-100 btn btn-primary">
                            {{ __('Login') }}
                        </button>
                    </div>
                    <div class="col-12 ">
                        @if (Route::has('password.request'))
                            <a class="px-0 btn btn-link fw-bold" href="{{ route('password.request') }}" style="color: #879fff; text-decoration:none">
                                {{ __('Forgot Your Password?') }}
                            </a>
                        @endif
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
