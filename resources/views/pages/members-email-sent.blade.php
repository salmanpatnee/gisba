@extends('layouts.site')

@section('title', 'Payment Successful — GISBA Members')
@section('meta_description', 'Your payment was successful. Here are your GISBA members login details.')

@section('banner')
  <div class="d-flex justify-content-between align-items-center flex-wrap gap-2">
    <span><i class="bi bi-check-circle me-2"></i>Payment Successful</span>
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
    <div style="max-width:520px;margin:0 auto;text-align:center;">

      <div style="width:80px;height:80px;background:rgba(34,197,94,0.1);border:2px solid rgba(34,197,94,0.3);border-radius:50%;display:flex;align-items:center;justify-content:center;font-size:34px;color:#22c55e;margin:0 auto 28px;">
        <i class="bi bi-check-lg"></i>
      </div>

      <h1 style="font-family:var(--font-display);font-size:2rem;color:var(--navy);font-weight:900;margin-bottom:14px;">
        Payment Successful!
      </h1>

      @if($memberEmail)

        <p style="color:#555;font-size:16px;line-height:1.7;margin-bottom:32px;">
          Your payment was successful and your membership is now active.
          @if($expiresAt)
            Your 6-month access is valid until <strong>{{ $expiresAt }}</strong>.
          @endif
        </p>

        <div style="background:#f8fafc;border:1px solid #e5e7eb;border-radius:8px;padding:24px 28px;margin-bottom:28px;text-align:left;">
          <p style="margin:0 0 16px;font-size:13px;font-weight:700;color:var(--navy);text-transform:uppercase;letter-spacing:0.8px;">Your Login Credentials</p>
          <p style="margin:0 0 10px;font-size:14px;color:#111;"><span style="color:#888;">Email:</span> <strong>{{ $memberEmail }}</strong></p>
          <p style="margin:0;font-size:14px;color:#111;">
            <span style="color:#888;">Password:</span>
            @if($plainPassword)
              <span style="font-family:monospace;background:#fff;border:1px solid #ddd;padding:2px 8px;border-radius:4px;">{{ $plainPassword }}</span>
            @else
              <em style="color:#666;font-weight:400;">Use your existing password</em>
            @endif
          </p>
        </div>

        <a href="{{ route('members.login') }}"
           style="display:inline-block;background:var(--navy);color:#fff;font-weight:700;font-size:16px;padding:14px 40px;border-radius:6px;text-decoration:none;letter-spacing:0.3px;margin-bottom:28px;">
          <i class="bi bi-box-arrow-in-right me-2"></i>Log In to Members Library
        </a>

        @if($plainPassword)
          <p style="font-size:13px;color:#888;line-height:1.6;margin:0;">
            <strong>Tip:</strong> You can change this password anytime from the Account page after logging in.
          </p>
        @endif

      @else

        <p style="color:#555;font-size:16px;line-height:1.7;margin-bottom:32px;">
          Thanks for your recent purchase. Please log in to your account below.
        </p>

        <a href="{{ route('members.login') }}"
           style="display:inline-block;background:var(--navy);color:#fff;font-weight:700;font-size:16px;padding:14px 40px;border-radius:6px;text-decoration:none;letter-spacing:0.3px;margin-bottom:28px;">
          <i class="bi bi-box-arrow-in-right me-2"></i>Log In to Members Library
        </a>

        <div style="background:#f8fafc;border:1px solid #e5e7eb;border-radius:8px;padding:16px 20px;font-size:13px;color:#666;">
          <i class="bi bi-info-circle me-2" style="color:var(--accent);"></i>
          Forgot your password? <a href="{{ route('members.password.request') }}" style="color:var(--navy);font-weight:600;">Reset it here</a>.
        </div>

      @endif

    </div>
  </div>
</section>

@endsection
