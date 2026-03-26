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
        <div class="pt-card" style="position:relative; overflow:visible;">

          {{-- Limited Time Offer ribbon --}}
          <div class="pt-ribbon">
            <i class="bi bi-lightning-charge-fill me-1"></i>Limited Time Offer
          </div>

          <div class="pt-card-header" style="padding-top:36px;">
            <div class="pt-plan-name">Complete Toolkit</div>

            {{-- Discount badge + original price --}}
            <div class="pt-discount-row">
              <span class="pt-discount-badge">40% OFF</span>
              <span class="pt-original-price">£2,495 GBP+VAT</span>
            </div>

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

            {{-- Payment Options --}}
            <div class="pt-payment-options">

              <p class="pt-payment-label">Choose your payment method</p>

              <div class="pt-btn-group">
                <a href="{{ $stripePaymentLink }}" class="pt-btn pt-btn-stripe">
                  {{-- Stripe "S" mark --}}
                  <svg class="pt-stripe-icon" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true"><path d="M13.976 9.15c-2.172-.806-3.356-1.426-3.356-2.409 0-.831.683-1.305 1.901-1.305 2.227 0 4.515.858 6.09 1.631l.89-5.494C18.252.975 15.697 0 12.165 0 9.667 0 7.589.654 6.104 1.872 4.56 3.147 3.757 4.992 3.757 7.218c0 4.039 2.467 5.76 6.476 7.219 2.585.92 3.445 1.574 3.445 2.583 0 .98-.84 1.545-2.354 1.545-1.875 0-4.965-.921-6.99-2.109l-.9 5.555C5.175 22.99 8.385 24 11.714 24c2.641 0 4.843-.624 6.328-1.813 1.664-1.305 2.525-3.236 2.525-5.732 0-4.128-2.524-5.851-6.591-7.305z"/></svg>
                  Pay with Stripe
                </a>
                <button type="button" id="bankToggleBtn" class="pt-btn pt-btn-bank" onclick="toggleBankDetails()">
                  <i class="bi bi-bank2"></i>
                  Bank Transfer
                  <i id="bankChevron" class="bi bi-chevron-down" style="font-size:11px;"></i>
                </button>
              </div>

              {{-- Bank Details Panel --}}
              <div id="bankDetailsPanel" class="pt-bank-details" style="display:none;">
                <div class="pt-bank-header">
                  <i class="bi bi-building-check"></i>
                  <span>Bank Transfer Details</span>
                </div>
                <div class="pt-bank-grid">
                  <div class="pt-bank-row">
                    <span class="pt-bank-key">Account Name</span>
                    <span class="pt-bank-val">DAIC SOLUTIONS LIMITED</span>
                  </div>
                  <div class="pt-bank-row">
                    <span class="pt-bank-key">Account Number</span>
                    <span class="pt-bank-val pt-bank-mono">05249732</span>
                  </div>
                  <div class="pt-bank-row">
                    <span class="pt-bank-key">Sort Code</span>
                    <span class="pt-bank-val pt-bank-mono">04-00-03</span>
                  </div>
                  <div class="pt-bank-row pt-bank-row--iban">
                    <span class="pt-bank-key">IBAN</span>
                    <span class="pt-bank-val pt-bank-mono">GB40 MONZ 0400 0305 2497 32</span>
                  </div>
                </div>
                <p class="pt-bank-note">
                  <i class="bi bi-info-circle"></i>
                  Please use your company name as the payment reference. Access will be granted once payment is confirmed — typically within 1 business day.
                </p>
              </div>

            </div>

            <script>
              function toggleBankDetails() {
                var panel = document.getElementById('bankDetailsPanel');
                var btn = document.getElementById('bankToggleBtn');
                var chevron = document.getElementById('bankChevron');
                var isOpen = panel.style.display !== 'none';
                panel.style.display = isOpen ? 'none' : 'block';
                btn.classList.toggle('pt-btn-bank--active', !isOpen);
                chevron.className = 'bi ' + (isOpen ? 'bi-chevron-down' : 'bi-chevron-up');
              }
            </script>

            <p class="pt-secure-note">
              <i class="bi bi-shield-lock"></i> Secure checkout &nbsp;·&nbsp; Same-day access
            </p>

          </div>
        </div>

      </div>

      {{-- Trusted by / Partner Logos --}}
      <div class="pt-trust-section">
        <p class="pt-trust-label">In partnership with</p>
        <div class="pt-logos-row">
          <div class="pt-logo-item">
            <img src="/assets/images/visionaryalpha.png" alt="Visionary Alpha" class="pt-logo-img">
          </div>
          <div class="pt-logo-divider"></div>
          <div class="pt-logo-item">
            <img src="/assets/images/daic.png" alt="DAIC" class="pt-logo-img">
          </div>
          <div class="pt-logo-divider"></div>
          <div class="pt-logo-item">
            <img src="/assets/images/logo.jpg" alt="GISBA" class="pt-logo-img">
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
    /* ── Limited Time ribbon ───────────────────────────────────── */
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

    /* ── Discount row ───────────────────────────────────────────── */
    .pt-discount-row {
      display: flex;
      align-items: center;
      justify-content: center;
      gap: 10px;
      margin: 10px 0 4px;
    }

    .pt-discount-badge {
      background: #e63946;
      color: #fff;
      font-size: 13px;
      font-weight: 800;
      letter-spacing: 0.06em;
      padding: 3px 10px;
      border-radius: 6px;
    }

    .pt-original-price {
      font-size: 1.1rem;
      font-weight: 700;
      color: rgba(255, 255, 255, 0.8);
      text-decoration: line-through;
      text-decoration-color: #e63946;
      text-decoration-thickness: 2px;
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

    .pt-btn-group {
      display: flex;
      flex-direction: column;
      gap: 10px;
      margin-bottom: 0;
    }

    /* ── Base button shared styles ─────────────────────────────── */
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
    }

    /* ── Stripe button ─────────────────────────────────────────── */
    .pt-btn-stripe {
      background: #635bff;
      color: #fff !important;
      box-shadow: 0 4px 18px rgba(99, 91, 255, 0.35);
    }

    .pt-btn-stripe:hover {
      background: #4f46e5;
      box-shadow: 0 6px 24px rgba(99, 91, 255, 0.45);
      transform: translateY(-1px);
      color: #fff !important;
    }

    .pt-stripe-icon {
      width: 15px;
      height: 15px;
      flex-shrink: 0;
    }

    /* ── Bank Transfer button ──────────────────────────────────── */
    .pt-btn-bank {
      background: #f4f7fb;
      color: var(--navy) !important;
      border: 1.5px solid #d0daea;
      box-shadow: none;
    }

    .pt-btn-bank:hover,
    .pt-btn-bank--active {
      background: #eaf0f9;
      border-color: #b0c4de;
      box-shadow: 0 2px 10px rgba(0, 51, 102, 0.1);
      transform: translateY(-1px);
      color: var(--navy) !important;
    }

    .pt-btn-bank i {
      font-size: 15px;
    }

    /* ── Bank details panel ────────────────────────────────────── */
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

    .pt-bank-grid {
      padding: 14px 16px 10px;
      display: flex;
      flex-direction: column;
      gap: 9px;
    }

    .pt-bank-row {
      display: flex;
      justify-content: space-between;
      align-items: center;
      gap: 8px;
      flex-wrap: wrap;
    }

    .pt-bank-key {
      font-size: 11.5px;
      color: var(--text-muted);
      font-weight: 500;
      white-space: nowrap;
    }

    .pt-bank-val {
      font-size: 13px;
      font-weight: 700;
      color: var(--navy);
      text-align: right;
    }

    .pt-bank-mono {
      font-family: 'Courier New', monospace;
      letter-spacing: 0.04em;
    }

    .pt-bank-row--iban .pt-bank-val {
      font-size: 12px;
      letter-spacing: 0.06em;
    }

    .pt-bank-note {
      font-size: 11px;
      color: #5a738a;
      padding: 10px 16px 14px;
      border-top: 1px solid #dce9f7;
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

    /* ── Partner logos ─────────────────────────────────────────── */
    .pt-trust-section {
      margin-top: 48px;
      text-align: center;
    }

    .pt-trust-label {
      font-size: 11px;
      font-weight: 700;
      letter-spacing: 0.1em;
      text-transform: uppercase;
      color: var(--text-muted);
      margin-bottom: 20px;
    }

    .pt-logos-row {
      display: flex;
      align-items: center;
      justify-content: center;
      gap: 0;
      flex-wrap: wrap;
    }

    .pt-logo-item {
      padding: 0 28px;
      display: flex;
      align-items: center;
      justify-content: center;
    }

    .pt-logo-img {
      max-height: 44px;
      max-width: 130px;
      width: auto;
      object-fit: contain;
    }

    .pt-logo-divider {
      width: 1px;
      height: 32px;
      background: #d0daea;
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

      .pt-logo-item {
        padding: 0 16px;
      }

      .pt-logo-img {
        max-height: 36px;
        max-width: 100px;
      }

      .pt-bank-row--iban .pt-bank-val {
        font-size: 11px;
      }
    }
  </style>
  @endpush

@endsection
