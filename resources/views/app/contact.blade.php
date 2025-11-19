@extends('layouts.app')

@section('content')
    <div class="container mt-5 notranslate" style="max-width: 600px;">

        <h3 class="mb-1 text-center">Contact Us</h3>
        <p class="text-center">Email: <a href="mailto:islamicstudyportal@gmail.com">islamicstudyportal@gmail.com</a></p>

        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <form action="{{ route('contact.send') }}" method="POST" class="card p-4 shadow-sm">
            @csrf

            <div class="mb-3">
                <label class="form-label">Your Name</label>
                <input type="text" name="name" class="form-control @error('name') is-invalid @enderror"
                    value="{{ old('name') }}">
                @error('name')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label class="form-label">Email Address</label>
                <input type="email" name="email" class="form-control @error('email') is-invalid @enderror"
                    value="{{ old('email') }}">
                @error('email')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label class="form-label">Message</label>
                <textarea name="message" rows="4" class="form-control @error('message') is-invalid @enderror">{{ old('message') }}</textarea>
                @error('message')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <button class="btn btn-success w-100">Send Message</button>
        </form>
    </div>
@endsection
