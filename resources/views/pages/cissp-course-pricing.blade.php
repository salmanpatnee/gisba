@extends('layouts.site')

@section('title', 'CISSP Live Online Training — Enrollment | GISBA Consultants')
@section('meta_description', 'Enroll in the GISBA CISSP Live Online Training — $' . number_format((float) $pricing->cissp_price, 2) . '. Limited to ' . $pricing->cissp_capacity . ' participants.')

@section('banner')
  <div class="d-flex justify-content-between align-items-center flex-wrap gap-2">
    <span><i class="bi bi-shield-lock me-2"></i>CISSP Live Online Training — Enrollment</span>
    <div class="d-flex gap-3">
      <a href="{{ route('cissp') }}"><i class="bi bi-arrow-left me-1"></i>Back to Course</a>
      <a href="{{ route('contact-us') }}"><i class="bi bi-envelope me-1"></i>Contact</a>
    </div>
  </div>
@endsection

@section('footer_tagline')
  CISSP Live Online Training<br />
  Global Cybersecurity Consulting &amp; Training.
@endsection

@section('content')

  <div class="nis2-pricing-page">
    <div class="container">

      <div class="pricing-page-header">
        <h1 class="pricing-page-title">CISSP Live Online Training</h1>
        <p class="pricing-page-subtitle">A live, instructor-led course limited to {{ $pricing->cissp_capacity }} participants for experienced cybersecurity professionals.</p>
      </div>

      @if (session('info'))
        <div class="alert alert-info text-center" style="max-width:420px;margin:0 auto 20px;">{{ session('info') }}</div>
      @endif

      @error('cissp')
        <div class="alert alert-danger text-center" style="max-width:420px;margin:0 auto 20px;">{{ $message }}</div>
      @enderror

      <div class="pricing-table-wrap">

        {{-- ── PRICING CARD ─────────────────────────────────────── --}}
        <div class="pt-card" style="position:relative; overflow:visible;">

          <div class="pt-ribbon">
            <i class="bi bi-people-fill me-1"></i>Limited to {{ $pricing->cissp_capacity }} Participants
          </div>

          <div class="pt-card-header" style="padding-top:36px;">
            <div class="pt-plan-name">CISSP Live Online Training</div>

            <div class="pt-price">
              <span class="pt-currency">$</span>{{ number_format((float) $pricing->cissp_price, 2) }}
            </div>
            <div class="pt-billing">
              One-time fee &nbsp;·&nbsp;
              @if($pricing->cissp_date)
                {{ $pricing->dateRangeFor('cissp') }}
                @if($pricing->cissp_time_start)
                  , {{ $pricing->cissp_time_start }}&ndash;{{ $pricing->cissp_time_end }} ({{ $pricing->cissp_timezone }})
                @endif
              @else
                Date to be announced
              @endif
            </div>
          </div>

          <div class="pt-card-body">

            <ul class="pt-features">
              <li><i class="bi bi-check-circle-fill"></i>Live, instructor-led CISSP training</li>
              <li><i class="bi bi-check-circle-fill"></i>Comprehensive CISSP course material</li>
              <li><i class="bi bi-check-circle-fill"></i>Plenty of practice quizzes and knowledge checks</li>
              <li><i class="bi bi-check-circle-fill"></i>Small-group format — max {{ $pricing->cissp_capacity }} participants</li>
              <li><i class="bi bi-check-circle-fill"></i>Direct access to an experienced cybersecurity trainer</li>
            </ul>

            @if ($pricing->cissp_seats_remaining > 0)
              <p class="pt-payment-label">{{ $pricing->cissp_seats_remaining }} of {{ $pricing->cissp_capacity }} seats remaining</p>

              <form action="{{ route('cissp.checkout') }}" method="POST">
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
                  <label for="email" class="form-label fw-semibold" style="font-size:13px;">Your Business Email Address</label>
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
            @else
              <div class="pt-bank-details" style="display:block;">
                <div class="pt-bank-header">
                  <i class="bi bi-exclamation-circle"></i>
                  <span>Course Fully Booked</span>
                </div>
                <p class="pt-bank-note" style="border-top:none;">
                  <i class="bi bi-info-circle"></i>
                  All {{ $pricing->cissp_capacity }} seats have been reserved. <a href="{{ route('contact-us') }}">Contact us</a> to join the waitlist for the next session.
                </p>
              </div>
            @endif

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
