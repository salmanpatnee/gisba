@extends('layouts.site')

@section('title', 'Contact GISBA Consultants | Cybersecurity &amp; Training Consulting')
@section('meta_description', 'Contact GISBA Consultants Co. W.L.L. for cybersecurity consulting and training course development services. Based in the Kingdom of Bahrain.')

@section('banner')
  <div class="d-flex justify-content-between align-items-center flex-wrap gap-2">
    <span><i class="bi bi-envelope me-2"></i>GISBA Consultants Co. W.L.L. — Global Reach in Consulting &amp; Training</span>
    <div class="d-flex gap-3">
      <a href="{{ route('home') }}"><i class="bi bi-house me-1"></i>Home</a>
      <a href="mailto:sales@gisba.net"><i class="bi bi-envelope me-1"></i>Email Us</a>
    </div>
  </div>
@endsection

@section('footer_tagline')
  Global Cybersecurity Consulting &amp; Training.<br />
  Kingdom of Bahrain.
@endsection

@section('content')

  <div class="page-layout">
    <div class="container">

      <div class="col-12">
        <main class="img-content">
          <section class="hero-section container">
            <div class="row align-items-center">
              <div class="col-md-6">
                <h1 class="hero-title">
                  Contact<br />
                  <span>GISBA Consultants</span>
                </h1>
                <p class="hero-subtitle">Get in Touch with Our Cybersecurity Experts</p>
                <p class="hero-desc">
                  Whether you require Cybersecurity Training Development Services or want to discuss a consulting engagement — our team is ready to help.
                </p>
              </div>
              <div class="col-md-6 text-center">
                <img class="image-content img-fluid" src="{{ asset('assets/images/contact.jpg') }}" alt="Contact GISBA Consultants">
              </div>
            </div>
          </section>
        </main>
      </div>

      <div class="row g-4">

        <div class="col-12 col-md-3">
          <aside class="sidebar">
            <nav class="sidebar-nav">
              <p class="sidebar-nav-title">Quick Links</p>
              <ul>
                <li><a href="#enquiry-form"><i class="bi bi-envelope"></i> Email Us</a></li>
              </ul>
            </nav>
            <div class="sidebar-contact">
              <strong><i class="bi bi-envelope me-1"></i>Contact GISBA</strong>
              <a href="mailto:sales@gisba.net">sales@gisba.net</a>
            </div>
          </aside>
        </div>

        <div class="col-12 col-md-9">
          <main class="main-content">

            <section id="enquiry-form">
              <h2 class="section-heading">Get in Touch</h2>
              <p>For any enquiries, please reach out to us directly by email and we will get back to you as soon as possible.</p>

              <div class="contact-card mt-3">
                <div class="contact-card-body text-center" style="padding:40px 24px;">
                  <i class="bi bi-envelope" style="font-size:32px; color:var(--accent);"></i>
                  <p style="font-weight:600; font-size:13.5px; color:var(--text-heading); margin:12px 0 4px;">Email Us</p>
                  <a href="mailto:sales@gisba.net" class="btn-hero-primary" style="display:inline-flex; margin-top:8px;">
                    <i class="bi bi-envelope me-2"></i>sales@gisba.net
                  </a>
                </div>
              </div>
            </section>

          </main>
        </div>

      </div>
    </div>
  </div>

@endsection
