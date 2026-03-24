@extends('layouts.site')

@section('title', 'Payment Successful | GISBA')
@section('meta_description', 'Your payment was successful. Thank you for your purchase from GISBA Consultants.')

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
      margin: 0 auto 36px;
    }

    .success-notice i {
      font-size: 18px;
      flex-shrink: 0;
      margin-top: 1px;
    }

    .success-divider {
      border: none;
      border-top: 1px solid #e9ecef;
      margin: 36px 0;
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

    .btn-home-primary {
      background: linear-gradient(135deg, #003366, #0066cc);
      border: none;
      color: #fff;
      font-weight: 600;
      font-size: 1rem;
      padding: 14px 36px;
      border-radius: 8px;
      transition: opacity 0.2s, transform 0.15s;
      text-decoration: none;
      display: inline-block;
    }

    .btn-home-primary:hover {
      opacity: 0.9;
      color: #fff;
      transform: translateY(-1px);
    }

    .btn-outline-contact {
      background: transparent;
      border: 2px solid #003366;
      color: #003366;
      font-weight: 600;
      font-size: 1rem;
      padding: 12px 32px;
      border-radius: 8px;
      transition: background 0.2s, color 0.2s, transform 0.15s;
      text-decoration: none;
      display: inline-block;
    }

    .btn-outline-contact:hover {
      background: #003366;
      color: #fff;
      transform: translateY(-1px);
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
              Your payment has been processed and confirmed. The complete <strong>NIS2 Implementation Kit</strong> access link will be sent to you on the same day. We appreciate your trust in GISBA Consultants.
            </p>

            <!-- Email Notice -->
            <div class="success-notice">
              <i class="bi bi-envelope-check-fill"></i>
              <span>You will receive the <strong>NIS2 Implementation Kit</strong> access link via email on the same day of payment. Please check your inbox (and spam folder).</span>
            </div>

            <!-- CTA Buttons -->
            <div class="d-flex flex-wrap justify-content-center gap-3">
              <a href="{{ route('home') }}" class="btn-home-primary">
                <i class="bi bi-house me-2"></i>Return to Homepage
              </a>
              <a href="{{ route('contact-us') }}" class="btn-outline-contact">
                <i class="bi bi-chat-dots me-2"></i>Contact Us
              </a>
            </div>

            <hr class="success-divider" />

            <!-- Support Section -->
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