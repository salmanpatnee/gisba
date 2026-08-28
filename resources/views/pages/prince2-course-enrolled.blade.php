@extends('layouts.site')

@section('title', 'Enrollment Confirmed — PRINCE2 Live Online Training')
@section('meta_description', 'Your enrollment in the GISBA PRINCE2 Live Online Training is confirmed.')

@section('banner')
  <div class="d-flex justify-content-between align-items-center flex-wrap gap-2">
    <span><i class="bi bi-check-circle me-2"></i>Enrollment Confirmed</span>
    <a href="{{ route('home') }}"><i class="bi bi-house me-1"></i>Home</a>
  </div>
@endsection

@section('footer_tagline')
  PRINCE2 Live Online Training<br />
  Global Project Management Consulting &amp; Training.
@endsection

@section('content')

<section style="padding:80px 0;min-height:60vh;display:flex;align-items:center;">
  <div class="container">
    <div style="max-width:520px;margin:0 auto;text-align:center;">

      <div style="width:80px;height:80px;background:rgba(34,197,94,0.1);border:2px solid rgba(34,197,94,0.3);border-radius:50%;display:flex;align-items:center;justify-content:center;font-size:34px;color:#22c55e;margin:0 auto 28px;">
        <i class="bi bi-check-lg"></i>
      </div>

      <h1 style="font-family:var(--font-display);font-size:2rem;color:var(--navy);font-weight:900;margin-bottom:14px;">
        You're Enrolled!
      </h1>

      <p style="color:#555;font-size:16px;line-height:1.7;margin-bottom:32px;">
        @if($enrollmentName)
          Thanks, {{ $enrollmentName }} — your seat in the PRINCE2 Live Online Training is confirmed.
        @else
          Your seat in the PRINCE2 Live Online Training is confirmed.
        @endif
        A confirmation email with the course schedule has been sent to
        @if($enrollmentEmail)
          <strong>{{ $enrollmentEmail }}</strong>.
        @else
          your inbox.
        @endif
      </p>

      <a href="{{ route('prince2') }}"
         style="display:inline-block;background:var(--navy);color:#fff;font-weight:700;font-size:16px;padding:14px 40px;border-radius:6px;text-decoration:none;letter-spacing:0.3px;margin-bottom:28px;">
        <i class="bi bi-diagram-3 me-2"></i>Back to Course Details
      </a>

      <div style="background:#f8fafc;border:1px solid #e5e7eb;border-radius:8px;padding:16px 20px;font-size:13px;color:#666;">
        <i class="bi bi-info-circle me-2" style="color:var(--accent);"></i>
        Questions before the course? <a href="{{ route('contact-us') }}" style="color:var(--navy);font-weight:600;">Contact us</a>.
      </div>

    </div>
  </div>
</section>

@endsection
