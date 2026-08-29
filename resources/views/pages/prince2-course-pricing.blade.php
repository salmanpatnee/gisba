@extends('layouts.site')

@section('title', 'PRINCE2 Live Online Training — Enrollment | GISBA Consultants')
@section('meta_description', 'Enroll in the GISBA PRINCE2 Live Online Training — $' . number_format((float) $pricing->prince2_price, 2) . '. Limited to ' . $pricing->prince2_capacity . ' participants.')

@section('banner')
  <div class="d-flex justify-content-between align-items-center flex-wrap gap-2">
    <span><i class="bi bi-diagram-3 me-2"></i>PRINCE2 Live Online Training — Enrollment</span>
    <div class="d-flex gap-3">
      <a href="{{ route('prince2') }}"><i class="bi bi-arrow-left me-1"></i>Back to Course</a>
      <a href="{{ route('contact-us') }}"><i class="bi bi-envelope me-1"></i>Contact</a>
    </div>
  </div>
@endsection

@section('footer_tagline')
  PRINCE2 Live Online Training<br />
  Global Project Management Consulting &amp; Training.
@endsection

@section('content')

  <div class="nis2-pricing-page">
    <div class="container">

      <div class="pricing-page-header">
        <h1 class="pricing-page-title">PRINCE2 Live Online Training</h1>
        <p class="pricing-page-subtitle">A live, instructor-led course limited to {{ $pricing->prince2_capacity }} participants — with a continuous PRINCE2-to-PMBOK comparison.</p>
      </div>

      @if (session('info'))
        <div class="alert alert-info text-center" style="max-width:420px;margin:0 auto 20px;">{{ session('info') }}</div>
      @endif

      @error('prince2')
        <div class="alert alert-danger text-center" style="max-width:420px;margin:0 auto 20px;">{{ $message }}</div>
      @enderror

      <div class="pricing-table-wrap">

        {{-- ── PRICING CARD ─────────────────────────────────────── --}}
        <div class="pt-card" style="position:relative; overflow:visible;">

          <div class="pt-ribbon">
            <i class="bi bi-people-fill me-1"></i>Limited to {{ $pricing->prince2_capacity }} Participants
          </div>

          <div class="pt-card-header" style="padding-top:36px;">
            <div class="pt-plan-name">PRINCE2 Live Online Training</div>

            <div class="pt-price">
              <span class="pt-currency">$</span>{{ number_format((float) $pricing->prince2_price, 2) }}
            </div>
            <div class="pt-billing">
              One-time fee &nbsp;·&nbsp;
              @if($pricing->prince2_date)
                {{ $pricing->dateRangeFor('prince2') }}
                @if($pricing->prince2_time_start)
                  , {{ $pricing->prince2_time_start }}&ndash;{{ $pricing->prince2_time_end }} ({{ $pricing->prince2_timezone }})
                @endif
              @else
                Date to be announced
              @endif
            </div>
          </div>

          <div class="pt-card-body">

            <ul class="pt-features">
              <li><i class="bi bi-check-circle-fill"></i>Live instructor-led PRINCE2 training</li>
              <li><i class="bi bi-check-circle-fill"></i>Comprehensive PRINCE2 course material</li>
              <li><i class="bi bi-check-circle-fill"></i>Live comparison between PRINCE2 and PMBOK</li>
              <li><i class="bi bi-check-circle-fill"></i>Plenty of quizzes and knowledge checks</li>
              <li><i class="bi bi-check-circle-fill"></i>Small-group format — max {{ $pricing->prince2_capacity }} participants</li>
            </ul>

            <form action="{{ route('prince2.checkout') }}" method="POST">
              @csrf

              <div class="mb-3">
                <label for="name" class="form-label fw-semibold" style="font-size:13px;">Your Name</label>
                <input type="text"
                       id="name"
                       name="name"
                       value="{{ old('name') }}"
                       class="form-control @error('name') is-invalid @enderror"
                       required>
                @error('name')
                  <div class="invalid-feedback">{{ $message }}</div>
                @enderror
              </div>

              <div class="mb-3">
                <label for="email" class="form-label fw-semibold" style="font-size:13px;">Your Email Address</label>
                <input type="email"
                       id="email"
                       name="email"
                       value="{{ old('email') }}"
                       class="form-control @error('email') is-invalid @enderror"
                       required>
                @error('email')
                  <div class="invalid-feedback">{{ $message }}</div>
                @enderror
              </div>

              <button type="submit" class="pt-btn">
                <i class="bi bi-paypal"></i> Reserve Your Seat with PayPal
              </button>
            </form>

            <p class="pt-secure-note">
              <i class="bi bi-shield-lock"></i> Secure checkout via PayPal
            </p>

          </div>
        </div>

      </div>

      <div class="pricing-page-footnote">
        <p>
          Not ready to enroll yet?
          <a href="{{ route('contact-us') }}">Contact us</a> with any questions about the course.
        </p>
      </div>

    </div>
  </div>

  @push('scripts')
    @include('partials._course-pricing-page-styles')
  @endpush

@endsection
