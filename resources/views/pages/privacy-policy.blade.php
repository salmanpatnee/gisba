@extends('layouts.site')

@section('title', 'Privacy Policy | GISBA Consultants')
@section('meta_description', 'Privacy policy for GISBA Consultants Co. W.L.L. Learn how we collect, use, and protect your personal information.')

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
              <h1 class="section-heading" style="font-size:1.9rem;">Privacy Policy</h1>
              <p><strong>GISBA Consultants Co. W.L.L.</strong></p>
              <p class="last-updated">Last Updated: January 2026</p>

              <p>
                GISBA Consultants Co. W.L.L. ("GISBA", "we", "our", or "us") respects
                your privacy and is committed to protecting the personal information you
                provide when using our website
                <a href="https://www.gisba.net" target="_blank" rel="noopener noreferrer">www.gisba.net</a>
                and purchasing our products or services.
              </p>
              <p>This Privacy Policy explains how we collect, use, protect, and disclose your information when you visit our website or interact with our services.</p>

              <h3 class="section-heading" style="font-size:1.2rem;">1. Information We Collect</h3>
              <p>We may collect the following types of information when you visit or use GISBA.net.</p>
              <p style="font-size: 1rem; font-weight: 600;">Personal Information</p>
              <p>Personal information may include:</p>
              <ul>
                <li>Full name</li>
                <li>Email address</li>
                <li>Company name</li>
                <li>Phone number</li>
                <li>Billing information</li>
                <li>Payment details (processed securely through third-party payment providers)</li>
                <li>Any information submitted through contact forms or support requests</li>
              </ul>
              <p>This information is collected when you:</p>
              <ul>
                <li>Contact us through our website</li>
                <li>Request product information or demos</li>
                <li>Purchase digital products</li>
                <li>Subscribe to updates</li>
                <li>Request customer support</li>
              </ul>

              <h3 class="section-heading" style="font-size:1.2rem;">2. Payment Information</h3>
              <p>Payments made on GISBA.net may be processed through secure third-party payment processors such as Stripe or other payment gateways.</p>
              <p>GISBA does not store or process credit card details directly on its servers. All payment information is securely handled by the payment processor in accordance with industry security standards and PCI-DSS compliance requirements.</p>

              <h3 class="section-heading" style="font-size:1.2rem;">3. How We Use Your Information</h3>
              <p>We use the information collected for the following purposes:</p>
              <ul>
                <li>To process and fulfill purchases</li>
                <li>To deliver digital products and download links</li>
                <li>To respond to inquiries and provide customer support</li>
                <li>To improve our website, services, and user experience</li>
                <li>To send important purchase confirmations and product delivery notifications</li>
                <li>To comply with legal obligations</li>
              </ul>
              <p>We do not sell, rent, or trade personal information to third parties.</p>

              <h3 class="section-heading" style="font-size:1.2rem;">4. Digital Product Delivery</h3>
              <p>If you purchase a digital product from GISBA.net, your email address may be used to:</p>
              <ul>
                <li>Deliver download links</li>
                <li>Send purchase confirmations</li>
                <li>Provide product updates or important notices related to your purchase</li>
              </ul>

              <h3 class="section-heading" style="font-size:1.2rem;">5. Cookies and Website Analytics</h3>
              <p>GISBA.net may use cookies or similar technologies to enhance user experience and analyze website usage.</p>
              <p>Cookies may be used to:</p>
              <ul>
                <li>Improve website functionality</li>
                <li>Understand visitor behavior</li>
                <li>Maintain session security</li>
                <li>Analyze website traffic</li>
              </ul>
              <p>You can disable cookies in your browser settings if you prefer not to allow them.</p>

              <h3 class="section-heading" style="font-size:1.2rem;">6. Data Security</h3>
              <p>GISBA takes reasonable technical and organizational measures to protect your personal information from:</p>
              <ul>
                <li>Unauthorized access</li>
                <li>Data loss</li>
                <li>Misuse</li>
                <li>Disclosure</li>
              </ul>
              <p>Our website uses HTTPS encryption to ensure secure communication between your browser and our servers.</p>

              <h3 class="section-heading" style="font-size:1.2rem;">7. Data Retention</h3>
              <p>We retain personal information only for as long as necessary to:</p>
              <ul>
                <li>Provide services and deliver products</li>
                <li>Maintain business records</li>
                <li>Comply with legal and regulatory obligations</li>
                <li>Resolve disputes or enforce agreements</li>
              </ul>

              <h3 class="section-heading" style="font-size:1.2rem;">8. Third-Party Services</h3>
              <p>Our website may use third-party services such as:</p>
              <ul>
                <li>Payment processors (e.g., Stripe)</li>
                <li>Website hosting providers</li>
                <li>Email service providers</li>
              </ul>
              <p>These providers may process limited personal information strictly for the purpose of providing their services.</p>
              <p>Each third-party provider is responsible for maintaining its own privacy and security practices.</p>

              <h3 class="section-heading" style="font-size:1.2rem;">9. International Visitors</h3>
              <p>GISBA provides services globally. By using our website, you understand that your information may be transferred to and processed in jurisdictions where GISBA operates or maintains service providers.</p>

              <h3 class="section-heading" style="font-size:1.2rem;">10. Your Privacy Rights</h3>
              <p>Depending on your jurisdiction, you may have rights regarding your personal data, including:</p>
              <ul>
                <li>Request access to your personal information</li>
                <li>Request correction of inaccurate data</li>
                <li>Request deletion of personal information where applicable</li>
                <li>Request information about how your data is processed</li>
              </ul>
              <p>To exercise these rights, please contact us using the details below.</p>

              <h3 class="section-heading" style="font-size:1.2rem;">11. External Links</h3>
              <p>GISBA.net may contain links to third-party websites. We are not responsible for the privacy practices or content of external websites.</p>
              <p>Users are encouraged to review the privacy policies of any third-party sites they visit.</p>

              <h3 class="section-heading" style="font-size:1.2rem;">12. Changes to This Privacy Policy</h3>
              <p>GISBA may update this Privacy Policy from time to time to reflect changes in legal requirements, technology, or business practices.</p>

              <div class="row g-4 mt-1">
                <div class="col-12">
                  <div class="contact-card">
                    <div class="contact-card-title">
                      <i class="bi bi-building me-2"></i>GISBA Consultants Co. W.L.L.
                    </div>
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
