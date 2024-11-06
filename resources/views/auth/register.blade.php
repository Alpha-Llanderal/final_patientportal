@extends('layouts.app')
@section('title', 'HealthHub Connect - Register')
@section('content')

<main>
    <section class="portal-container">
        <div class="card text-center p-4 mx-auto" style="max-width: 600px;">
            <div class="portal-logo mb-3">
                <img src="{{ asset('img/logo.png') }}" alt="HealthHub Logo" class="img-fluid mb-3">
                <h2 class="fw-bold">Patient Registration</h2>

                <form method="POST" action="{{ route('register') }}" class="mt-4">
                    @csrf
                    
                    <!-- First Name -->
                    <div class="mb-3">
                        <input type="text" 
                               class="form-control @error('firstName') is-invalid @enderror" 
                               name="firstName" 
                               value="{{ old('firstName') }}"
                               placeholder="First Name"
                               required 
                               autofocus>
                        @error('firstName')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <!-- Last Name -->
                    <div class="mb-3">
                        <input type="text" 
                               class="form-control @error('lastName') is-invalid @enderror" 
                               name="lastName" 
                               value="{{ old('lastName') }}"
                               placeholder="Last Name"
                               required>
                        @error('lastName')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <!-- Email -->
                    <div class="mb-3">
                        <input type="email" 
                               class="form-control @error('email') is-invalid @enderror" 
                               name="email" 
                               value="{{ old('email') }}"
                               placeholder="Email Address"
                               required>
                        @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <!-- Password -->
                    <div class="mb-3">
                        <input type="password" 
                               class="form-control @error('password') is-invalid @enderror" 
                               name="password"
                               placeholder="Password"
                               required>
                        @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <!-- Confirm Password -->
                    <div class="mb-3">
                        <input type="password" 
                               class="form-control"
                               name="password_confirmation"
                               placeholder="Confirm Password"
                               required>
                    </div>

                    <!-- Submit Button -->
                    <div class="d-flex justify-content-center mt-4">
                        <button type="submit" class="btn btn-primary me-3">
                            <i class="bi bi-person-plus-fill me-1"></i> Register
                        </button>
                        <a href="{{ route('login') }}" class="btn btn-link">
                            Already have an account?
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </section>
</main>

@endsection