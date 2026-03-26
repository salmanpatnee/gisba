@extends('layouts.site')

@section('title', 'NIS2 Implementation Toolkit — Pricing | GISBA Consultants')
@section('meta_description', 'Purchase the GISBA NIS2 Implementation Toolkit — £1,500 GBP+VAT. Includes 16 frameworks, video guidance, audit checklists, and 1-year platform access.')

@php
  /**
   * Stripe Payment Link
   * Replace the value below with your Stripe payment link URL.
   */
  $stripePaymentLink = 'https://buy.stripe.com/eVqaEXbyj67u9jSbt86c01U';
@endphp

@section('banner')
  <div class="d-flex justify-content-between align-items-center flex-wrap gap-2">
    <span><i class="bi bi-shield-check me-2"></i>NIS2 Implementation Toolkit — Pricing</span>
    <div class="d-flex gap-3">
      <a href="{{ route('nis2-toolkit') }}"><i class="bi bi-arrow-left me-1"></i>Back to Toolkit</a>
      <a href="{{ route('contact-us') }}"><i class="bi bi-envelope me-1"></i>Contact</a>
    </div>
  </div>
@endsection

@section('footer_tagline')
  NIS2 Implementation Toolkit<br />
  Global Cybersecurity Consulting &amp; Training.
@endsection

@section('content')

  <div class="nis2-pricing-page">
    <div class="container">

      <div class="pricing-page-header">
        <h1 class="pricing-page-title">NIS2 Implementation Toolkit</h1>
        <p class="pricing-page-subtitle">One complete package. Everything you need to achieve EU NIS2 compliance.</p>
      </div>

      <div class="pricing-table-wrap">

        {{-- ── PRICING CARD ─────────────────────────────────────── --}}
        <div class="pt-card">

          <div class="pt-card-header">
            <div class="pt-plan-name">Complete Toolkit</div>
            <div class="pt-price">
              <span class="pt-currency">£</span>1,500
            </div>
            <div class="pt-billing">GBP + VAT &nbsp;·&nbsp; One-time purchase</div>
          </div>

          <div class="pt-card-body">

            <ul class="pt-features">
              <li><i class="bi bi-check-circle-fill"></i>Access to NIS2.GISBA.Net</li>
              <li><i class="bi bi-check-circle-fill"></i>16 implementation frameworks</li>
              <li><i class="bi bi-check-circle-fill"></i>Policy and procedure templates</li>
              <li><i class="bi bi-check-circle-fill"></i>Completed implementation examples</li>
              <li><i class="bi bi-check-circle-fill"></i>Video guidance for every framework</li>
              <li><i class="bi bi-check-circle-fill"></i>Compliance and audit checklists</li>
              <li><i class="bi bi-check-circle-fill"></i>Editable Word &amp; Excel templates</li>
              <li><i class="bi bi-check-circle-fill"></i>1-year platform access</li>
            </ul>

            {{-- Replace $stripePaymentLink at the top of this file with your Stripe payment link --}}
            <a href="{{ $stripePaymentLink }}" class="pt-btn">
              Buy Now &nbsp;<i class="bi bi-arrow-right"></i>
            </a>

            <p class="pt-secure-note">
              <i class="bi bi-shield-lock"></i> Secure checkout &nbsp;·&nbsp; Same-day access
            </p>

          </div>
        </div>

      </div>

      <div class="pricing-page-footnote">
        <p>
          <i class="bi bi-tag me-1"></i>
          One-time fee of £1,500 GBP+VAT — less than one week of a professional cybersecurity consultant.
          The average compliance consultant charges ~€800/day; a 20-day engagement costs ~€16,000.
        </p>
        <p class="mt-2">
          Not ready to purchase yet?
          <a href="{{ route('contact-us') }}">Contact us</a> to request a demo first.
        </p>
      </div>

    </div>
  </div>

  @push('scripts')
  <style>
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

    /* Decorative watermark number */
    .pt-card-header::before {
      content: '£';
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

    /* ── Buy Now button ────────────────────────────────────────── */
    .pt-btn {
      display: flex;
      align-items: center;
      justify-content: center;
      gap: 8px;
      width: 100%;
      padding: 14px 24px;
      background: var(--navy);
      color: #fff !important;
      font-size: 15px;
      font-weight: 700;
      border-radius: 10px;
      text-decoration: none !important;
      transition: background 0.2s, box-shadow 0.2s, transform 0.15s;
      box-shadow: 0 4px 18px rgba(0, 51, 102, 0.25);
    }

    .pt-btn:hover {
      background: var(--navy-mid);
      box-shadow: 0 6px 24px rgba(0, 51, 102, 0.35);
      transform: translateY(-1px);
      color: #fff !important;
    }

    .pt-btn i {
      font-size: 14px;
      transition: transform 0.2s;
    }

    .pt-btn:hover i {
      transform: translateX(3px);
    }

    /* ── Secure note ───────────────────────────────────────────── */
    .pt-secure-note {
      font-size: 11.5px;
      color: var(--text-muted);
      text-align: center;
      margin-top: 12px;
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

    .pricing-page-footnote a {
      color: var(--text-link);
    }

    /* ── Responsive ────────────────────────────────────────────── */
    @media (max-width: 480px) {
      .pt-card {
        max-width: 100%;
        border-radius: 14px;
      }

      .pt-card-header {
        padding: 32px 24px 28px;
      }

      .pt-card-body {
        padding: 24px 24px 28px;
      }

      .pt-price {
        font-size: 3.2rem;
      }

      .pricing-page-title {
        font-size: 1.4rem;
      }
    }
  </style>
  @endpush

@endsection
