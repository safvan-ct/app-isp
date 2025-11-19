@extends('layouts.app')

@section('content')
    <div class="container mt-5 notranslate" style="max-width: 600px;">

        <h3 class="mb-1 text-center">Contact Us</h3>
        <p class="text-center mb-3">
            Email: <a href="mailto:islamicstudyportal@gmail.com">islamicstudyportal@gmail.com</a>
            We will get back to you as soon as possible.
        </p>

        <p class="text-center">വിഷയങ്ങളിലെ തെറ്റുകൾ, അപാകതകൾ, അല്ലെങ്കിൽ വ്യക്തതയില്ലാത്ത ഭാഗങ്ങൾ കണ്ടെത്തിയാൽ ദയവായി ഞങ്ങളെ
            നേരിട്ട് അറിയിക്കൂ. നിങ്ങളുടെ നിർദ്ദേശങ്ങളും തിരുത്തലുകളും സ്വീകരിച്ച് ഉള്ളടക്കം കൂടുതൽ വിശ്വസനീയവും
            ഉപകാരപ്രദവും ആക്കുന്നത് ഞങ്ങളുടെ ലക്ഷ്യമാണ്.
        </p>

        <p class="text-center">പുതിയ വിഷയങ്ങൾ, പഠന വിഭാഗങ്ങൾ, അല്ലെങ്കിൽ ഇസ്ലാമിക ചോദ്യങ്ങൾ നിങ്ങൾക്ക്
            നിർദ്ദേശിക്കാനുണ്ടെങ്കിൽ അത് ഞങ്ങളിലേക്ക് അയയ്ക്കൂ. മലയാളം ഇസ്ലാമിക് പഠന പോർട്ടൽ കൂടുതൽ സമ്പന്നമാകാൻ നിങ്ങളുടെ
            സഹകരണം വളരെ വിലപ്പെട്ടതാണ്.
        </p>

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
