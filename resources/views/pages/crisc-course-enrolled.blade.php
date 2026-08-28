@extends('layouts.site')

@section('title', 'Enrollment Confirmed — CRISC Online Course')
@section('meta_description', 'Your enrollment in the GISBA CRISC Online Course is confirmed.')

@section('banner')
  <div class="d-flex justify-content-between align-items-center flex-wrap gap-2">
    <span><i class="bi bi-check-circle me-2"></i>Enrollment Confirmed</span>
    <a href="{{ route('home') }}"><i class="bi bi-house me-1"></i>Home</a>
  </div>
@endsection

@section('footer_tagline')
  CRISC Online Course<br />
  Global Cybersecurity Consulting &amp; Training.
@endsection

@section('content')

  <style>
    .enrollment-hero-section {
      position: relative;
      overflow: hidden;
      min-height: 68vh;
      display: flex;
      align-items: center;
      padding: 90px 0;
      background: #faf9f5;
      background-image: radial-gradient(circle at 1px 1px, rgba(0, 51, 102, 0.07) 1px, transparent 0);
      background-size: 24px 24px;
    }

    .enrollment-hero-section::before,
    .enrollment-hero-section::after {
      content: '';
      position: absolute;
      border-radius: 50%;
      filter: blur(10px);
      pointer-events: none;
    }

    .enrollment-hero-section::before {
      width: 420px;
      height: 420px;
      top: -180px;
      right: -140px;
      background: radial-gradient(circle, rgba(200, 168, 75, 0.16), transparent 70%);
    }

    .enrollment-hero-section::after {
      width: 380px;
      height: 380px;
      bottom: -200px;
      left: -160px;
      background: radial-gradient(circle, rgba(0, 51, 102, 0.10), transparent 70%);
    }

    .enrollment-card {
      position: relative;
      z-index: 1;
      max-width: 560px;
      margin: 0 auto;
      background: #fff;
      border-radius: 6px;
      box-shadow: 0 30px 60px -24px rgba(0, 51, 102, 0.28), 0 0 0 1px rgba(0, 51, 102, 0.06);
      padding: 60px 52px 48px;
      text-align: center;
      animation: cardRise 0.7s cubic-bezier(0.16, 1, 0.3, 1) both;
    }

    .enrollment-card::before {
      content: '';
      position: absolute;
      inset: 9px;
      border: 1px solid rgba(200, 168, 75, 0.35);
      border-radius: 3px;
      pointer-events: none;
    }

    .enrollment-corner {
      position: absolute;
      width: 22px;
      height: 22px;
      border-color: var(--accent);
      border-style: solid;
      border-width: 0;
      opacity: 0.8;
    }

    .enrollment-corner-tl { top: 14px; left: 14px; border-top-width: 2px; border-left-width: 2px; }
    .enrollment-corner-tr { top: 14px; right: 14px; border-top-width: 2px; border-right-width: 2px; }
    .enrollment-corner-bl { bottom: 14px; left: 14px; border-bottom-width: 2px; border-left-width: 2px; }
    .enrollment-corner-br { bottom: 14px; right: 14px; border-bottom-width: 2px; border-right-width: 2px; }

    @keyframes cardRise {
      from { opacity: 0; transform: translateY(26px); }
      to { opacity: 1; transform: translateY(0); }
    }

    .enrollment-eyebrow {
      display: flex;
      align-items: center;
      justify-content: center;
      gap: 12px;
      margin-bottom: 26px;
      color: var(--accent);
      font-size: 11px;
      font-weight: 700;
      letter-spacing: 0.22em;
      text-transform: uppercase;
    }

    .enrollment-eyebrow::before,
    .enrollment-eyebrow::after {
      content: '';
      width: 26px;
      height: 1px;
      background: rgba(200, 168, 75, 0.6);
    }

    .enrollment-seal {
      position: relative;
      width: 86px;
      height: 86px;
      border-radius: 50%;
      margin: 0 auto 30px;
      display: flex;
      align-items: center;
      justify-content: center;
      background: radial-gradient(circle at 32% 28%, #0a4d8f, var(--navy) 70%);
      box-shadow: 0 0 0 4px #fff, 0 0 0 6px rgba(200, 168, 75, 0.55), 0 14px 30px rgba(0, 51, 102, 0.35);
      animation: sealPop 0.6s 0.15s cubic-bezier(0.34, 1.56, 0.64, 1) both;
    }

    .enrollment-seal::before {
      content: '';
      position: absolute;
      inset: -13px;
      border-radius: 50%;
      border: 1.5px dashed rgba(200, 168, 75, 0.5);
      animation: sealSpin 34s linear infinite;
    }

    .enrollment-seal i {
      font-size: 32px;
      color: var(--accent);
    }

    @keyframes sealPop {
      from { opacity: 0; transform: scale(0.55); }
      to { opacity: 1; transform: scale(1); }
    }

    @keyframes sealSpin {
      to { transform: rotate(360deg); }
    }

    .enrollment-heading {
      position: relative;
      display: inline-block;
      font-family: var(--font-display);
      font-size: 2.1rem;
      font-weight: 800;
      color: var(--navy);
      margin-bottom: 22px;
      padding-bottom: 14px;
    }

    .enrollment-heading::after {
      content: '';
      position: absolute;
      left: 50%;
      bottom: 0;
      transform: translateX(-50%);
      width: 54px;
      height: 3px;
      border-radius: 2px;
      background: var(--accent);
    }

    .enrollment-message {
      color: #555;
      font-size: 16.5px;
      line-height: 1.85;
      max-width: 430px;
      margin: 0 auto 32px;
    }

    .enrollment-message strong {
      color: var(--navy);
    }

    .enrollment-divider {
      display: flex;
      align-items: center;
      justify-content: center;
      gap: 14px;
      margin: 0 auto 32px;
      max-width: 220px;
    }

    .enrollment-divider span {
      flex: 1;
      height: 1px;
      background: rgba(0, 51, 102, 0.14);
    }

    .enrollment-divider i {
      width: 6px;
      height: 6px;
      background: var(--accent);
      transform: rotate(45deg);
      flex-shrink: 0;
    }

    .btn-enrollment-cta {
      display: inline-flex;
      align-items: center;
      gap: 10px;
      background: linear-gradient(135deg, var(--navy), #0059ad);
      color: #fff;
      font-weight: 700;
      font-size: 16px;
      letter-spacing: 0.3px;
      padding: 15px 42px;
      border-radius: 4px;
      text-decoration: none;
      box-shadow: 0 12px 26px -6px rgba(0, 51, 102, 0.45);
      transition: transform 0.2s ease, box-shadow 0.2s ease, background 0.3s ease;
      margin-bottom: 30px;
    }

    .btn-enrollment-cta:hover {
      color: #fff;
      transform: translateY(-2px);
      box-shadow: 0 16px 32px -6px rgba(0, 51, 102, 0.55);
      background: linear-gradient(135deg, #0059ad, var(--navy));
    }

    .enrollment-support {
      background: linear-gradient(135deg, rgba(200, 168, 75, 0.10), rgba(200, 168, 75, 0.03));
      border: 1px solid rgba(200, 168, 75, 0.35);
      border-radius: 4px;
      padding: 16px 22px;
      font-size: 13px;
      color: #5b5b5b;
    }

    .enrollment-support i {
      color: var(--accent);
    }

    .enrollment-support a {
      color: var(--navy);
      font-weight: 600;
    }

    @media (max-width: 576px) {
      .enrollment-card { padding: 48px 26px 36px; }
      .enrollment-heading { font-size: 1.7rem; }
    }
  </style>

  <section class="enrollment-hero-section">
    <div class="container">
      <div class="enrollment-card">

        <span class="enrollment-corner enrollment-corner-tl"></span>
        <span class="enrollment-corner enrollment-corner-tr"></span>
        <span class="enrollment-corner enrollment-corner-bl"></span>
        <span class="enrollment-corner enrollment-corner-br"></span>

        <p class="enrollment-eyebrow">Enrollment Confirmed</p>

        <div class="enrollment-seal">
          <i class="bi bi-check-lg"></i>
        </div>

        <h1 class="enrollment-heading">You're Enrolled!</h1>

        <p class="enrollment-message">
          @if($enrollmentName)
            Thanks, {{ $enrollmentName }} — your seat in the CRISC Online Course is confirmed.
          @else
            Your seat in the CRISC Online Course is confirmed.
          @endif
          We've received your payment. Our team will get in touch with you shortly via
          @if($enrollmentEmail)
            <strong>{{ $enrollmentEmail }}</strong>
          @else
            your provided email address
          @endif
          with your course schedule and details.
          A free copy of "CRISC and Beyond" is reserved for you.
        </p>

        <div class="enrollment-divider"><span></span><i></i><span></span></div>

        <a href="{{ route('crisc-course') }}" class="btn-enrollment-cta">
          <i class="bi bi-mortarboard"></i>Back to Course Details
        </a>

        <div class="enrollment-support">
          <i class="bi bi-info-circle me-2"></i>
          Questions before the course? <a href="{{ route('contact-us') }}">Contact us</a>.
        </div>

      </div>
    </div>
  </section>

@endsection
