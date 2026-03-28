@extends('layouts.site')

@section('title', 'Payment Successful | GISBA')
@section('meta_description', 'Your payment was successful. Your NIS2 Implementation Toolkit is ready for download.')

@section('banner')
  <div class="d-flex justify-content-between align-items-center flex-wrap gap-2">
    <span><i class="bi bi-shield-check me-2"></i>GISBA Consultants Co. W.L.L. — Secure Payment Processing</span>
    <div class="d-flex gap-3">
      <a href="{{ route('home') }}"><i class="bi bi-house me-1"></i>Home</a>
      <a href="{{ route('contact-us') }}"><i class="bi bi-envelope me-1"></i>Contact Us</a>
    </div>
  </div>
@endsection

@section('footer_tagline')
  Global Cybersecurity Consulting &amp; Training.<br />
  Kingdom of Bahrain.
@endsection

@section('content')

  <style>
    .payment-success-section {
      min-height: 70vh;
      display: flex;
      align-items: center;
      padding: 60px 0;
      background: linear-gradient(135deg, #f8f9fa 0%, #e8eef8 100%);
    }

    .success-card {
      background: #fff;
      border-radius: 16px;
      box-shadow: 0 8px 40px rgba(0, 0, 0, 0.10);
      padding: 56px 48px;
      text-align: center;
      animation: fadeInUp 0.6s ease both;
    }

    @keyframes fadeInUp {
      from {
        opacity: 0;
        transform: translateY(28px);
      }
      to {
        opacity: 1;
        transform: translateY(0);
      }
    }

    .success-icon-wrap {
      width: 96px;
      height: 96px;
      border-radius: 50%;
      background: linear-gradient(135deg, #28a745, #20c997);
      display: flex;
      align-items: center;
      justify-content: center;
      margin: 0 auto 28px;
      animation: popIn 0.5s 0.3s cubic-bezier(0.175, 0.885, 0.32, 1.275) both;
    }

    @keyframes popIn {
      from {
        opacity: 0;
        transform: scale(0.6);
      }
      to {
        opacity: 1;
        transform: scale(1);
      }
    }

    .success-icon-wrap i {
      font-size: 48px;
      color: #fff;
    }

    .success-heading {
      font-family: 'Merriweather', serif;
      font-size: 2rem;
      font-weight: 700;
      color: #1a2e3b;
      margin-bottom: 12px;
    }

    .success-subheading {
      font-size: 1.1rem;
      color: #28a745;
      font-weight: 600;
      margin-bottom: 20px;
    }

    .success-message {
      font-size: 1rem;
      color: #555;
      line-height: 1.75;
      max-width: 500px;
      margin: 0 auto 32px;
    }

    /* Download block */
    .toolkit-download-block {
      background: #f0faf4;
      border: 1px solid #b2dfcb;
      border-radius: 12px;
      padding: 24px 28px;
      margin-bottom: 28px;
    }

    .toolkit-download-label {
      font-size: 0.78rem;
      font-weight: 600;
      letter-spacing: 0.08em;
      text-transform: uppercase;
      color: #1a7f4b;
      margin-bottom: 4px;
    }

    .toolkit-download-name {
      font-family: 'Merriweather', serif;
      font-size: 1.05rem;
      font-weight: 700;
      color: #1a2e3b;
      margin-bottom: 18px;
    }

    .btn-download-toolkit {
      display: inline-flex;
      align-items: center;
      gap: 8px;
      background: linear-gradient(135deg, #1a7f4b, #28a745);
      border: none;
      color: #fff;
      font-weight: 600;
      font-size: 1rem;
      padding: 13px 32px;
      border-radius: 8px;
      transition: opacity 0.2s, transform 0.15s, box-shadow 0.2s;
      text-decoration: none;
      box-shadow: 0 4px 16px rgba(40, 167, 69, 0.30);
    }

    .btn-download-toolkit:hover {
      opacity: 0.92;
      color: #fff;
      transform: translateY(-1px);
      box-shadow: 0 6px 22px rgba(40, 167, 69, 0.40);
      text-decoration: none;
    }

    /* Email notice */
    .success-notice {
      background: #e8eef8;
      border: 1px solid #b3caf0;
      border-radius: 10px;
      padding: 16px 20px;
      font-size: 0.92rem;
      color: #003366;
      display: flex;
      align-items: flex-start;
      gap: 12px;
      text-align: left;
      max-width: 520px;
      margin: 0 auto 32px;
    }

    .success-notice i {
      font-size: 18px;
      flex-shrink: 0;
      margin-top: 1px;
    }

    .success-divider {
      border: none;
      border-top: 1px solid #e9ecef;
      margin: 32px 0;
    }

    /* Secondary CTAs */
    .secondary-actions {
      display: flex;
      flex-wrap: wrap;
      justify-content: center;
      gap: 12px;
      margin-bottom: 32px;
    }

    .btn-home-primary {
      background: linear-gradient(135deg, #003366, #0066cc);
      border: none;
      color: #fff;
      font-weight: 600;
      font-size: 1rem;
      padding: 12px 28px;
      border-radius: 8px;
      transition: opacity 0.2s, transform 0.15s;
      text-decoration: none;
      display: inline-flex;
      align-items: center;
      gap: 7px;
    }

    .btn-home-primary:hover {
      opacity: 0.9;
      color: #fff;
      transform: translateY(-1px);
      text-decoration: none;
    }

    .btn-outline-contact {
      background: transparent;
      border: 2px solid #003366;
      color: #003366;
      font-weight: 600;
      font-size: 1rem;
      padding: 10px 24px;
      border-radius: 8px;
      transition: background 0.2s, color 0.2s, transform 0.15s;
      text-decoration: none;
      display: inline-flex;
      align-items: center;
      gap: 7px;
    }

    .btn-outline-contact:hover {
      background: #003366;
      color: #fff;
      transform: translateY(-1px);
      text-decoration: none;
    }

    .support-section {
      background: #f8f9fa;
      border-radius: 10px;
      padding: 20px 24px;
      font-size: 0.9rem;
      color: #6c757d;
    }

    .support-section a {
      color: #0066cc;
      font-weight: 600;
      text-decoration: none;
    }

    .support-section a:hover {
      text-decoration: underline;
    }

    @media (max-width: 576px) {
      .success-card { padding: 40px 24px; }
    }
  </style>

  <section class="payment-success-section">
    <div class="container">
      <div class="row justify-content-center">
        <div class="col-12 col-md-8 col-lg-6">

          <div class="success-card">

            <!-- Success Icon -->
            <div class="success-icon-wrap">
              <i class="bi bi-check-lg"></i>
            </div>

            <!-- Headings -->
            <p class="success-subheading">Payment Successful</p>
            <h1 class="success-heading">Thank You for Your Purchase!</h1>

            <!-- Confirmation Message -->
            <p class="success-message">
              Your payment has been processed and confirmed. Your
              <strong>NIS2 Implementation Toolkit</strong> is ready for immediate download below.
              We appreciate your trust in GISBA Consultants.
            </p>

            <!-- Toolkit Download -->
            @if ($settings->toolkit_zip_path)
              <div class="toolkit-download-block">
                <p class="toolkit-download-label">Ready to Download</p>
                <p class="toolkit-download-name">NIS2 Implementation Toolkit</p>
                <a href="{{ Storage::disk('public')->url($settings->toolkit_zip_path) }}"
                   class="btn-download-toolkit"
                   download>
                  <i class="bi bi-download"></i> Download Toolkit
                </a>
              </div>
            @endif

            <!-- Email Notice -->
            <div class="success-notice">
              <i class="bi bi-envelope-check-fill"></i>
              <span>A <strong>purchase confirmation</strong> has been sent to your email. Please check your inbox (and spam folder) if you don't see it shortly.</span>
            </div>

            <!-- Secondary CTAs -->
            <div class="secondary-actions">
              <a href="{{ route('home') }}" class="btn-home-primary">
                <i class="bi bi-house"></i> Return to Homepage
              </a>
              <a href="{{ route('contact-us') }}" class="btn-outline-contact">
                <i class="bi bi-chat-dots"></i> Contact Us
              </a>
            </div>

            <hr class="success-divider" />

            <!-- Support -->
            <div class="support-section">
              <i class="bi bi-headset me-2"></i>
              <strong>Need help?</strong> Our team is here for you. Reach out at
              <a href="mailto:support@gisba.net">support@gisba.net</a>
              and we'll respond within one business day.
            </div>

          </div>

        </div>
      </div>
    </div>
  </section>

@endsection
