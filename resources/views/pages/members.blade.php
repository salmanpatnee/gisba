@extends('layouts.site')

@section('title', 'GISBA Members — Exclusive Library Access')
@section('meta_description', 'Join the GISBA members-only library for exclusive cybersecurity and project management resources.')

@section('banner')
  <div class="d-flex justify-content-between align-items-center flex-wrap gap-2">
    <span><i class="bi bi-lock me-2"></i>Members — Exclusive Content Library</span>
    <div class="d-flex gap-3">
      <a href="{{ route('home') }}"><i class="bi bi-house me-1"></i>Home</a>
      <a href="{{ route('contact-us') }}"><i class="bi bi-envelope me-1"></i>Contact</a>
    </div>
  </div>
@endsection

@section('footer_tagline')
  GISBA Members — Exclusive Resources<br />
  Expert content for cybersecurity and project management professionals.
@endsection

@section('content')

<style>
.paywall-hero { padding: 60px 0 40px; }
.paywall-card { max-width: 520px; margin: 0 auto; background: #fff; border: 1px solid #e5e7eb; border-radius: 12px; box-shadow: 0 4px 24px rgba(0,33,80,0.08); padding: 40px 40px 36px; }
.paywall-icon { width: 56px; height: 56px; background: rgba(200,168,75,0.12); border: 2px solid rgba(200,168,75,0.3); border-radius: 50%; display: flex; align-items: center; justify-content: center; font-size: 24px; color: var(--accent); margin: 0 auto 20px; }
.paywall-price { font-size: 2.4rem; font-weight: 900; color: var(--navy); line-height: 1; }
.paywall-price sub { font-size: 1rem; font-weight: 500; color: #666; }
.paywall-features { list-style: none; padding: 0; margin: 0 0 28px; }
.paywall-features li { display: flex; align-items: center; gap: 10px; padding: 6px 0; font-size: 14px; color: #444; border-bottom: 1px solid #f3f4f6; }
.paywall-features li:last-child { border-bottom: none; }
.paywall-features li i { color: var(--accent); flex-shrink: 0; }
.btn-paywall { display: block; width: 100%; background: var(--navy); color: #fff; font-weight: 700; font-size: 15px; padding: 14px; border-radius: 8px; border: none; cursor: pointer; transition: background 0.2s; }
.btn-paywall:hover { background: #003070; }
.paywall-secure { font-size: 11.5px; color: #aaa; text-align: center; margin-top: 14px; }
</style>

<section class="paywall-hero">
  <div class="container">
    <div class="text-center mb-4">
      <span style="font-size:11px;font-weight:700;letter-spacing:1.4px;text-transform:uppercase;color:var(--accent);background:rgba(200,168,75,0.1);border:1px solid rgba(200,168,75,0.25);padding:4px 14px;border-radius:20px;">Members Only</span>
      <h1 style="font-family:var(--font-display);font-size:clamp(1.6rem,3vw,2.2rem);color:var(--navy);font-weight:900;margin:16px 0 10px;">Unlock the GISBA Library</h1>
      <p style="color:#555;font-size:15px;max-width:460px;margin:0 auto;">One-time payment. Lifetime access to exclusive cybersecurity &amp; PMP resources.</p>
    </div>

    <div class="paywall-card">
      <div class="paywall-icon"><i class="bi bi-award-fill"></i></div>

      <div class="text-center mb-4">
        <div class="paywall-price">$30 <sub>one-time</sub></div>
        <p style="font-size:13px;color:#888;margin-top:6px;">No subscription. No hidden fees.</p>
      </div>

      <ul class="paywall-features">
        <li><i class="bi bi-check-circle-fill"></i> Full members-only article library</li>
        <li><i class="bi bi-check-circle-fill"></i> Exclusive cybersecurity &amp; PMP guides</li>
        <li><i class="bi bi-check-circle-fill"></i> New content added regularly</li>
        <li><i class="bi bi-check-circle-fill"></i> Magic-link access — no password needed</li>
        <li><i class="bi bi-check-circle-fill"></i> Secure PayPal checkout</li>
      </ul>

      @if($errors->any())
        <div class="alert alert-danger py-2 mb-3 small">
          @foreach($errors->all() as $error) {{ $error }}<br> @endforeach
        </div>
      @endif

      @if(session('info'))
        <div class="alert alert-info py-2 mb-3 small">{{ session('info') }}</div>
      @endif

      <form action="{{ route('members.checkout') }}" method="POST">
        @csrf
        <div class="mb-3">
          <label for="email" class="form-label fw-semibold" style="font-size:13px;">Your Email Address</label>
          <input type="email"
                 id="email"
                 name="email"
                 value="{{ old('email') }}"
                 class="form-control @error('email') is-invalid @enderror"
                 placeholder="you@example.com"
                 required>
          @error('email')
            <div class="invalid-feedback">{{ $message }}</div>
          @enderror
        </div>

        <button type="submit" class="btn-paywall">
          <i class="bi bi-paypal me-2"></i>Pay $30 via PayPal
        </button>
      </form>

      <p class="paywall-secure">
        <i class="bi bi-shield-lock-fill me-1"></i>Secured by PayPal. We never store your payment details.
      </p>
    </div>
  </div>
</section>

@endsection
