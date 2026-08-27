@extends('layouts.site')

@section('title', 'CRISC Online Course — Enrollment | GISBA Consultants')
@section('meta_description', 'Enroll in the GISBA CRISC Online Course — $' . number_format((float) $pricing->crisc_price, 2) . '. Limited to ' . $pricing->crisc_capacity . ' participants.')

@section('banner')
  <div class="d-flex justify-content-between align-items-center flex-wrap gap-2">
    <span><i class="bi bi-mortarboard me-2"></i>CRISC Online Course — Enrollment</span>
    <div class="d-flex gap-3">
      <a href="{{ route('crisc-course') }}"><i class="bi bi-arrow-left me-1"></i>Back to Course</a>
      <a href="{{ route('contact-us') }}"><i class="bi bi-envelope me-1"></i>Contact</a>
    </div>
  </div>
@endsection

@section('footer_tagline')
  CRISC Online Course<br />
  Global Cybersecurity Consulting &amp; Training.
@endsection

@section('content')

  <div class="nis2-pricing-page">
    <div class="container">

      <div class="pricing-page-header">
        <h1 class="pricing-page-title">CRISC Online Course</h1>
        <p class="pricing-page-subtitle">A live, instructor-led course limited to {{ $pricing->crisc_capacity }} participants — includes a free copy of "CRISC and Beyond".</p>
      </div>

      @if (session('info'))
        <div class="alert alert-info text-center" style="max-width:420px;margin:0 auto 20px;">{{ session('info') }}</div>
      @endif

      @error('crisc')
        <div class="alert alert-danger text-center" style="max-width:420px;margin:0 auto 20px;">{{ $message }}</div>
      @enderror

      <div class="pricing-table-wrap">

        {{-- ── PRICING CARD ─────────────────────────────────────── --}}
        <div class="pt-card" style="position:relative; overflow:visible;">

          <div class="pt-ribbon">
            <i class="bi bi-people-fill me-1"></i>Limited to {{ $pricing->crisc_capacity }} Participants
          </div>

          <div class="pt-card-header" style="padding-top:36px;">
            <div class="pt-plan-name">CRISC Online Course</div>

            <div class="pt-price">
              <span class="pt-currency">$</span>{{ number_format((float) $pricing->crisc_price, 2) }}
            </div>
            <div class="pt-billing">One-time fee &nbsp;·&nbsp; {{ optional($pricing->crisc_date)->format('F j, Y') }}, {{ $pricing->crisc_time_start }}&ndash;{{ $pricing->crisc_time_end }} ({{ $pricing->crisc_timezone }})</div>
          </div>

          <div class="pt-card-body">

            <ul class="pt-features">
              <li><i class="bi bi-check-circle-fill"></i>Live, instructor-led sessions</li>
              <li><i class="bi bi-check-circle-fill"></i>A free copy of "CRISC and Beyond"</li>
              <li><i class="bi bi-check-circle-fill"></i>Small-group format — max {{ $pricing->crisc_capacity }} participants</li>
              <li><i class="bi bi-check-circle-fill"></i>Direct access to the author and instructor</li>
            </ul>

            @if ($pricing->crisc_seats_remaining > 0)
              <p class="pt-payment-label">{{ $pricing->crisc_seats_remaining }} of {{ $pricing->crisc_capacity }} seats remaining</p>

              <form action="{{ route('crisc-course.checkout') }}" method="POST">
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
                  All {{ $pricing->crisc_capacity }} seats have been reserved. <a href="{{ route('contact-us') }}">Contact us</a> to join the waitlist for the next session.
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
  <style>
    /* ── Limited seats ribbon ───────────────────────────────────── */
    .pt-ribbon {
      position: absolute;
      top: -14px;
      left: 50%;
      transform: translateX(-50%);
      background: linear-gradient(90deg, #e63946, #c1121f);
      color: #fff;
      font-size: 11px;
      font-weight: 700;
      letter-spacing: 0.12em;
      text-transform: uppercase;
      padding: 5px 22px;
      border-radius: 20px;
      box-shadow: 0 3px 10px rgba(198, 18, 31, 0.35);
      white-space: nowrap;
      z-index: 10;
    }

    /* ── Page wrapper ──────────────────────────────────────────── */
    .nis2-pricing-page {
      padding: 52px 0 64px;
      background: var(--bg-page);
    }

    /* ── Page heading ──────────────────────────────────────────── */
    .pricing-page-header {
      text-align: center;
      margin-bottom: 40px;
    }

    .pricing-page-title {
      font-family: var(--font-display);
      font-size: 1.75rem;
      font-weight: 900;
      color: var(--navy);
      margin-bottom: 8px;
    }

    .pricing-page-subtitle {
      font-size: 15px;
      color: var(--text-muted);
      margin: 0;
    }

    /* ── Card centering ────────────────────────────────────────── */
    .pricing-table-wrap {
      display: flex;
      justify-content: center;
      padding-top: 20px;
    }

    /* ── Pricing card ──────────────────────────────────────────── */
    .pt-card {
      width: 100%;
      max-width: 420px;
      border-radius: 20px;
      overflow: hidden;
      box-shadow: 0 16px 56px rgba(0, 51, 102, 0.18);
    }

    /* ── Card header (gradient) ────────────────────────────────── */
    .pt-card-header {
      background: linear-gradient(160deg, #001f4d 0%, #003b82 55%, #0055b3 100%);
      text-align: center;
      padding: 40px 36px 36px;
      position: relative;
      overflow: hidden;
    }

    .pt-card-header::before {
      content: '$';
      position: absolute;
      top: -10px;
      right: 16px;
      font-family: var(--font-display);
      font-size: 9rem;
      font-weight: 900;
      color: rgba(255, 255, 255, 0.06);
      line-height: 1;
      pointer-events: none;
      user-select: none;
    }

    .pt-plan-name {
      font-family: var(--font-display);
      font-size: 1.25rem;
      font-weight: 900;
      color: #fff;
      letter-spacing: 0.2px;
      margin-bottom: 6px;
    }

    .pt-price {
      font-family: var(--font-display);
      font-size: 4rem;
      font-weight: 900;
      color: var(--accent);
      line-height: 1.05;
      margin: 12px 0 8px;
    }

    .pt-currency {
      font-size: 2rem;
      vertical-align: top;
      margin-top: 10px;
      display: inline-block;
    }

    .pt-billing {
      font-size: 12.5px;
      color: rgba(255, 255, 255, 0.55);
    }

    /* ── Card body ─────────────────────────────────────────────── */
    .pt-card-body {
      background: #fff;
      padding: 32px 36px 36px;
    }

    /* ── Features list ─────────────────────────────────────────── */
    .pt-features {
      list-style: none;
      padding: 0;
      margin: 0 0 28px;
      display: flex;
      flex-direction: column;
      gap: 12px;
    }

    .pt-features li {
      display: flex;
      align-items: center;
      gap: 12px;
      font-size: 14.5px;
      font-weight: 500;
      color: var(--text-body);
      margin: 0;
    }

    .pt-features li i {
      color: #28a745;
      font-size: 16px;
      flex-shrink: 0;
    }

    /* ── Payment options ───────────────────────────────────────── */
    .pt-payment-label {
      font-size: 11px;
      font-weight: 700;
      letter-spacing: 0.08em;
      text-transform: uppercase;
      color: var(--text-muted);
      text-align: center;
      margin-bottom: 14px;
    }

    /* ── PayPal button ─────────────────────────────────────────── */
    .pt-btn {
      display: flex;
      align-items: center;
      justify-content: center;
      gap: 9px;
      width: 100%;
      padding: 14px 20px;
      font-size: 14.5px;
      font-weight: 700;
      border-radius: 10px;
      text-decoration: none !important;
      transition: background 0.2s, box-shadow 0.2s, transform 0.15s;
      cursor: pointer;
      border: none;
      line-height: 1.2;
      background: #0070ba;
      color: #fff !important;
      box-shadow: 0 4px 18px rgba(0, 112, 186, 0.35);
    }

    .pt-btn:hover {
      background: #005ea6;
      box-shadow: 0 6px 24px rgba(0, 112, 186, 0.45);
      transform: translateY(-1px);
      color: #fff !important;
    }

    .pt-btn i {
      font-size: 15px;
    }

    /* ── Fully-booked panel ────────────────────────────────────── */
    .pt-bank-details {
      margin-top: 14px;
      border-radius: 10px;
      border: 1.5px solid #d8e6f5;
      background: #f6faff;
      overflow: hidden;
    }

    .pt-bank-header {
      display: flex;
      align-items: center;
      gap: 8px;
      padding: 12px 16px 10px;
      border-bottom: 1px solid #dce9f7;
      font-size: 12px;
      font-weight: 800;
      letter-spacing: 0.06em;
      text-transform: uppercase;
      color: #004080;
    }

    .pt-bank-header i {
      font-size: 14px;
      color: #0057b3;
    }

    .pt-bank-note {
      font-size: 11px;
      color: #5a738a;
      padding: 10px 16px 14px;
      margin: 0;
      display: flex;
      gap: 6px;
      line-height: 1.55;
    }

    .pt-bank-note i {
      flex-shrink: 0;
      margin-top: 1px;
      color: #4a7fb5;
    }

    /* ── Secure note ───────────────────────────────────────────── */
    .pt-secure-note {
      font-size: 11.5px;
      color: var(--text-muted);
      text-align: center;
      margin-top: 14px;
      margin-bottom: 0;
      display: flex;
      align-items: center;
      justify-content: center;
      gap: 6px;
    }

    /* ── Footnote ──────────────────────────────────────────────── */
    .pricing-page-footnote {
      max-width: 560px;
      margin: 36px auto 0;
      text-align: center;
      font-size: 12.5px;
      color: var(--text-muted);
      line-height: 1.65;
    }
  </style>
  @endpush

@endsection
