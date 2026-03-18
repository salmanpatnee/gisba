@extends('layouts.site')

@section('title', 'Digital Refund Policy | GISBA Consultants')
@section('meta_description', 'Digital refund policy for GISBA Consultants Co. W.L.L. Understand eligibility, timelines, and how to request a refund.')

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
              <h1 class="section-heading" style="font-size:1.9rem;">Refund Policy</h1>

              <hr class="content-divider" />

              <h3 class="section-heading" style="font-size:1.2rem;">1. Nature of the Product</h3>
              <p>All products sold on <strong>GISBA.net</strong> are digital downloadable products, including implementation frameworks, policy templates, guidance materials, and supporting documentation related to the NIS2 Implementation Toolkit.</p>
              <p>Because digital products are delivered instantly and cannot be returned once accessed or downloaded, all sales are generally considered final.</p>
              <p>However, <strong>GISBA Consultants Co. W.L.L.</strong> provides a limited refund policy to ensure customer satisfaction and fair usage.</p>

              <h3 class="section-heading" style="font-size:1.2rem;">2. Refund Eligibility</h3>
              <p>Customers may request a refund within <strong>three (3) calendar days</strong> of the purchase date under the following circumstances:</p>

              <p style="font-size: 1rem; font-weight: 600;">a) Duplicate Payment</p>
              <p>If a customer accidentally completes multiple payments for the same product.</p>

              <p style="font-size: 1rem; font-weight: 600;">b) Technical Issues Preventing Access</p>
              <p>If a verified technical issue prevents the customer from accessing or downloading the purchased product and the issue cannot be resolved by our support team.</p>

              <p style="font-size: 1rem; font-weight: 600;">c) Accidental Purchase</p>
              <p>If the purchase was made unintentionally and the product has not been downloaded, accessed, or used.</p>

              <p style="font-size: 1rem; font-weight: 600;">d) Customer Not Fully Satisfied</p>
              <p>If the customer is not fully satisfied with the product, a refund request may be submitted within three (3) calendar days of purchase in accordance with the refund request procedure outlined below.</p>

              <h3 class="section-heading" style="font-size:1.2rem;">3. Non-Refundable Situations</h3>
              <p>Refunds will not be granted in the following situations:</p>
              <ul>
                <li>The product has already been downloaded or accessed</li>
                <li>The customer has used or modified the templates or materials</li>
                <li>The customer changed their mind after accessing the product</li>
                <li>The customer misunderstood the product description</li>
                <li>The request is submitted more than three (3) days after purchase</li>
              </ul>

              <h3 class="section-heading" style="font-size:1.2rem;">4. Refund Request Procedure</h3>
              <p>To request a refund, customers must contact GISBA support within <strong>three (3) days</strong> of purchase.</p>
              <p>Refund requests must include:</p>
              <ul>
                <li>Full name used during purchase</li>
                <li>Email address used for purchase</li>
                <li>Order confirmation or payment reference</li>
                <li>Reason for the refund request</li>
              </ul>
              <p>Refund requests should be submitted to: <a href="mailto:support@gisba.net">support@gisba.net</a></p>
              <p>Our support team typically responds within one business day.</p>

              <h3 class="section-heading" style="font-size:1.2rem;">5. Refund Processing</h3>
              <p>If a refund request is approved:</p>
              <ul>
                <li>The refund will be issued to the original payment method</li>
                <li>Processing time may take 5–10 business days depending on the customer's bank or payment provider</li>
                <li>Any applicable payment processing fees may be deducted where permitted</li>
              </ul>

              <h3 class="section-heading" style="font-size:1.2rem;">6. Chargebacks and Payment Disputes</h3>
              <p>Customers are encouraged to contact GISBA support before initiating a chargeback or payment dispute with their bank or payment provider.</p>
              <p>We are committed to resolving issues quickly and fairly.</p>
              <p>Submitting fraudulent or unjustified chargebacks after accessing the digital product may result in revocation of product access and restriction from future purchases.</p>

              <div class="row g-4 mt-1">
                <div class="col-12">
                  <div class="contact-card">
                    <div class="contact-card-title">
                      <i class="bi bi-building me-2"></i>GISBA Consultants Co. W.L.L.
                    </div>
                    <p>For refund requests or assistance, please contact.</p>
                    <div class="contact-card-body">
                      <p><i class="bi bi-geo-alt me-2 text-primary"></i>Office #2062, Building #2004<br />Road #1527, Block #115<br />Area HIDD, Kingdom of Bahrain</p>
                      <p><i class="bi bi-telephone me-2 text-primary"></i><a href="tel:+97338397453">+973 3839 7453</a></p>
                      <p><i class="bi bi-envelope me-2 text-primary"></i><a href="mailto:support@gisba.net">support@gisba.net</a></p>
                    </div>
                  </div>
                </div>
              </div>
            </section>

          </main>
        </div>
      </div>
    </div>
  </div>

@endsection
