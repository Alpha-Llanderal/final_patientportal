@extends('layouts.app')
@section('title', 'HealthHub Connect')
@section('content')

<!-- MAIN CONTENT -->
<main>
    <!-- Logo and Title Section -->
    <section class="portal-container">
        <div class="card text-center p-4 mx-auto" style="max-width: 600px;">
            <div class="portal-logo mb-3">
                <img src="img/logo.png" alt="HealthHub Logo" class="img-fluid mb-3">
                <h2 class="fw-bold">Patient Portal</h2>

                @if(session('success'))
                    <div class="alert alert-success mb-3">
                        {{ session('success') }}
                    </div>
                @endif

                <!-- Login Form -->
                <form method="POST" action="{{ route('login') }}" class="mt-4">
                    @csrf
                    <div class="mb-3">
                        <input type="email" 
                               class="form-control @error('email') is-invalid @enderror" 
                               name="email" 
                               value="{{ old('email') }}" 
                               placeholder="Enter your email" 
                               required 
                               autofocus>
                        @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <input type="password" 
                               class="form-control @error('password') is-invalid @enderror" 
                               name="password" 
                               placeholder="Enter your password" 
                               required>
                        @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <button type="submit" class="btn btn-success">
                        <i class="bi bi-box-arrow-in-right"></i> Login
                    </button>
                </form>
            </div>
        </div>
    </section>
</main>

@endsection