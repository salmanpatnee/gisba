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
        <div class="pt-card" style="position:relative; overflow:visible;" x-data="{
               fullPrice: {{ (float) $pricing->prince2_price }},
               coupon: '{{ old('coupon_code') }}',
               applied: false,
               invalid: false,
               discountedPrice: '0.00',
               checkCoupon() {
                 const code = this.coupon.trim().toUpperCase();
                 if (['MEPAK50'].includes(code)) {
                   this.discountedPrice = '499.99';
                   this.applied = true;
                   this.invalid = false;
                 } else if (['ISACA50', 'ISACA90', 'MEPAK90'].includes(code)) {
                   this.discountedPrice = (Math.floor(this.fullPrice * 0.10 * 100) / 100).toFixed(2);
                   this.applied = true;
                   this.invalid = false;
                 } else {
                   this.applied = false;
                   this.invalid = true;
                 }
               }
             }">

          <div class="pt-ribbon">
            <i class="bi bi-people-fill me-1"></i>Limited to {{ $pricing->prince2_capacity }} Participants
          </div>

          <div class="pt-card-header" style="padding-top:28px;">
            <div class="pt-plan-name">PRINCE2 Live Online Training</div>

            <div class="pt-price" :style="applied ? 'font-size:2.75rem;' : ''">
              <template x-if="!applied">
                <span><span class="pt-currency">$</span><span x-text="fullPrice.toFixed(2)"></span></span>
              </template>
              <template x-if="applied">
                <span style="display:inline-flex; align-items:baseline; gap:10px;">
                  <span style="text-decoration:line-through; opacity:0.5; font-size:0.55em;">${{ number_format((float) $pricing->prince2_price, 2) }}</span>
                  <span><span class="pt-currency">$</span><span x-text="discountedPrice"></span></span>
                </span>
              </template>
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
                <input type="text"
                       id="name"
                       name="name"
                       placeholder="Your Name"
                       value="{{ old('name') }}"
                       class="form-control @error('name') is-invalid @enderror"
                       required>
                @error('name')
                  <div class="invalid-feedback">{{ $message }}</div>
                @enderror
              </div>

              <div class="mb-3">
                <input type="email"
                       id="email"
                       name="email"
                       placeholder="Your Email Address"
                       value="{{ old('email') }}"
                       class="form-control @error('email') is-invalid @enderror"
                       required>
                @error('email')
                  <div class="invalid-feedback">{{ $message }}</div>
                @enderror
              </div>

              <div class="mb-3">
                <div class="input-group">
                  <input type="text"
                         id="coupon_code"
                         name="coupon_code"
                         placeholder="Coupon Code (optional)"
                         x-model="coupon"
                         @input="applied = false; invalid = false;"
                         @keydown.enter.prevent="checkCoupon()"
                         value="{{ old('coupon_code') }}"
                         class="form-control @error('coupon_code') is-invalid @enderror"
                         :class="{ 'is-invalid': invalid }"
                         style="text-transform:uppercase;">
                  <button type="button" class="pt-coupon-apply-btn" @click="checkCoupon()">Apply</button>
                </div>
                @error('coupon_code')
                  <div class="invalid-feedback d-block">{{ $message }}</div>
                @enderror
                <div class="text-danger mt-1" style="font-size:13px;" x-show="invalid" x-cloak>Invalid coupon code.</div>
                <div class="text-success fw-semibold mt-1" style="font-size:13px;" x-show="applied" x-cloak>
                  <i class="bi bi-check-circle-fill"></i> Coupon applied — new price: $<span x-text="discountedPrice"></span>
                </div>
              </div>

              <div class="mb-3 form-check">
                <input type="checkbox"
                       id="consent"
                       class="form-check-input"
                       required>
                <label for="consent" class="form-check-label" style="font-size:12.5px;">
                  I consent to the use of my information by GISBA for training preparation, follow-ups, CPE verification/confirmation, and related activities.
                </label>
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
    <style>
      [x-cloak]{display:none!important;}
      .pt-card-body{padding:24px 36px 28px;}
      .pt-features{margin-bottom:20px; gap:9px;}
      .pt-features li{font-size:13.5px;}
      #coupon_code::placeholder{text-transform:none;}

      .pt-coupon-apply-btn {
        padding: 0 18px;
        font-size: 13.5px;
        font-weight: 700;
        color: var(--navy);
        background: rgba(200, 168, 75, 0.15);
        border: 1px solid #ced4da;
        border-left: none;
        border-top-right-radius: 8px;
        border-bottom-right-radius: 8px;
        transition: background 0.15s, color 0.15s;
      }

      .pt-coupon-apply-btn:hover {
        background: var(--accent);
        color: #fff;
      }

      .pt-coupon-apply-btn:active {
        background: #b3944a;
        color: #fff;
      }
    </style>
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.14.1/dist/cdn.min.js" defer></script>
  @endpush

@endsection
