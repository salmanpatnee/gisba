@extends('layouts.site')

@section('title', 'Reset Password — GISBA Members')
@section('meta_description', 'Choose a new password for your GISBA members account.')

@section('banner')
  <div class="d-flex justify-content-between align-items-center flex-wrap gap-2">
    <span><i class="bi bi-people me-2"></i>Members Area</span>
    <a href="{{ route('home') }}"><i class="bi bi-house me-1"></i>Home</a>
  </div>
@endsection

@section('footer_tagline')
  GISBA Members — Exclusive Resources<br />
  Expert content for cybersecurity and project management professionals.
@endsection

@section('content')

<section style="padding:80px 0;min-height:60vh;display:flex;align-items:center;">
  <div class="container">
    <div style="max-width:440px;margin:0 auto;">

      <div style="text-align:center;margin-bottom:36px;">
        <div style="width:64px;height:64px;background:rgba(0,33,80,0.08);border-radius:50%;display:flex;align-items:center;justify-content:center;font-size:26px;color:var(--navy);margin:0 auto 20px;">
          <i class="bi bi-shield-lock"></i>
        </div>
        <h1 style="font-family:var(--font-display);font-size:1.8rem;color:var(--navy);font-weight:900;margin-bottom:8px;">Reset Your Password</h1>
        <p style="color:#666;font-size:14px;margin:0;">Choose a new password for your account.</p>
      </div>

      @if ($errors->any())
        <div style="background:#fef2f2;border:1px solid #fecaca;border-radius:8px;padding:14px 18px;margin-bottom:24px;">
          @foreach ($errors->all() as $error)
            <p style="margin:0;font-size:14px;color:#dc2626;"><i class="bi bi-exclamation-circle me-2"></i>{{ $error }}</p>
          @endforeach
        </div>
      @endif

      <form method="POST" action="{{ route('members.password.update') }}" style="background:#fff;border:1px solid #e5e7eb;border-radius:10px;padding:32px;">
        @csrf

        <input type="hidden" name="token" value="{{ $token }}" />

        <div style="margin-bottom:20px;">
          <label style="display:block;font-size:13px;font-weight:600;color:#374151;margin-bottom:6px;">Email Address</label>
          <input
            type="email"
            name="email"
            value="{{ old('email', $email) }}"
            required
            autocomplete="email"
            style="width:100%;padding:10px 14px;border:1px solid #d1d5db;border-radius:6px;font-size:15px;color:#111;outline:none;box-sizing:border-box;"
            placeholder="you@example.com"
          />
        </div>

        <div style="margin-bottom:20px;">
          <label style="display:block;font-size:13px;font-weight:600;color:#374151;margin-bottom:6px;">New Password</label>
          <input
            type="password"
            name="password"
            required
            autocomplete="new-password"
            style="width:100%;padding:10px 14px;border:1px solid #d1d5db;border-radius:6px;font-size:15px;color:#111;outline:none;box-sizing:border-box;"
            placeholder="••••••••••••"
          />
        </div>

        <div style="margin-bottom:28px;">
          <label style="display:block;font-size:13px;font-weight:600;color:#374151;margin-bottom:6px;">Confirm New Password</label>
          <input
            type="password"
            name="password_confirmation"
            required
            autocomplete="new-password"
            style="width:100%;padding:10px 14px;border:1px solid #d1d5db;border-radius:6px;font-size:15px;color:#111;outline:none;box-sizing:border-box;"
            placeholder="••••••••••••"
          />
        </div>

        <button
          type="submit"
          style="width:100%;background:var(--navy);color:#fff;font-weight:700;font-size:16px;padding:13px;border:none;border-radius:6px;cursor:pointer;letter-spacing:0.3px;">
          Reset Password
        </button>
      </form>

    </div>
  </div>
</section>

@endsection
