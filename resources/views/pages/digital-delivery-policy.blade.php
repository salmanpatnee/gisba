@extends('layouts.site')

@section('title', 'Digital Delivery Policy | GISBA Consultants')
@section('meta_description', 'Digital delivery policy for GISBA Consultants Co. W.L.L. Learn how digital products are delivered after purchase.')

@section('banner')
  <div class="d-flex justify-content-between align-items-center flex-wrap gap-2">
    <span><i class="bi bi-shield-lock me-2"></i>GISBA: NIS2 Implementation Kit — EU Directive 2022/2555 Compliance Toolkit</span>
    <div class="d-flex gap-3">
      <a href="{{ route('home') }}"><i class="bi bi-house me-1"></i>Home</a>
      <a href="{{ route('contact-us') }}"><i class="bi bi-envelope me-1"></i>Contact</a>
    </div>
  </div>
@endsection

@section('footer_tagline')
  NIS2 Implementation Kit — EU Directive 2022/2555<br />
  Global Cybersecurity Consulting &amp; Training.
@endsection

@section('content')

  <div class="page-layout">
    <div class="container">
      <div class="row justify-content-center">
        <div class="col-12 col-md-8">
          <main class="main-content">

            <section>
              <h1 class="section-heading" style="font-size:1.9rem;">Delivery Policy</h1>

              <hr class="content-divider" />

              <p>All products sold on this website are <b>digital products</b>.</p>

              <p>After successful payment:</p>

              <ul>
                <li>The complete NIS2 Implementation Kit access link will be sent via email to the address used during purchase on the same day as payment.</li>
                <li>If the email is not received within 24 hours, please check your spam folder or contact support.</li>
              </ul>

              <p>For delivery issues please contact:</p>

              <p><a href="mailto:support@gisba.net">support@gisba.net</a></p>

              <p>We typically respond within <b>1 business day</b>.</p>
            </section>

          </main>
        </div>
      </div>
    </div>
  </div>

@endsection
