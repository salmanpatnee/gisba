@extends('layouts.site')

@section('title', 'NIS2 Implementation Toolkit | GISBA Consultants')
@section('meta_description', 'The GISBA NIS2 Implementation Toolkit — a comprehensive practical toolkit to help organizations prepare for and implement the requirements of the EU NIS2 Directive.')

@section('banner')
  <div class="d-flex justify-content-between align-items-center flex-wrap gap-2">
    <span><i class="bi bi-mortarboard me-2"></i>GISBA: Cybersecurity Training Development Services — Corporate Course Development</span>
    <div class="d-flex gap-3">
      <a href="#about"><i class="bi bi-info-circle me-1"></i>About</a>
      <a href="#courses"><i class="bi bi-journal-bookmark me-1"></i>Courses</a>
      <a href="#why-gisba"><i class="bi bi-award me-1"></i>Why GISBA</a>
      <a href="#contact"><i class="bi bi-envelope me-1"></i>Contact</a>
    </div>
  </div>
@endsection

@section('footer_tagline')
  Cybersecurity Training Development Services<br />
  Global Cybersecurity Consulting &amp; Training.
@endsection

@section('content')

  <div class="page-layout">
    <div class="container">
      <div class="col-12">
        <main class="img-content">
          <section id="title" class="hero-section container">
            <div class="row align-items-center">
              <div class="col-md-6">
                <h1 class="hero-title">
                  NIS2<br />
                  <span>Implementation Toolkit</span>
                </h1>
                <p class="hero-subtitle">
                  The NIS2 Implementation Toolkit is a comprehensive practical toolkit designed to help organizations prepare for and implement the requirements of the EU NIS2 Directive.
                </p>
                <p class="hero-desc">
                  This toolkit provides structured documentation, templates, and implementation guidance to support organizations in establishing compliant cybersecurity governance and operational practices.
                </p>
              </div>
              <div class="col-md-6 text-center">
                <img class="image-content img-fluid" src="{{ asset('assets/images/compliance.png') }}" alt="Cybersecurity">
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
                <li><a href="#title"><i class="bi bi-info-circle"></i> About</a></li>
                <li><a href="#includes"><i class="bi bi-journal-bookmark"></i> Toolkit Includes</a></li>
                <li><a href="#audience"><i class="bi bi-grid"></i> Audience</a></li>
                <li><a href="#format"><i class="bi bi-eye"></i> File Format</a></li>
                <li><a href="#method"><i class="bi bi-link-45deg"></i> Delivery Method</a></li>
                <li><a href="#pricing"><i class="bi bi-code-slash"></i> Pricing</a></li>
                <li><a href="#contact"><i class="bi bi-envelope"></i> Contact</a></li>
              </ul>
            </nav>
            <div class="sidebar-contact">
              <strong><i class="bi bi-envelope me-1"></i>Contact GISBA</strong>
              <a href="mailto:support@gisba.net">support@gisba.net</a><br />
              <a href="tel:+97338397453">+973 3839 7453</a>
            </div>
          </aside>
        </div>

        <div class="col-12 col-md-9">
          <main class="main-content">

            <section id="includes">
              <h2 class="section-heading">What the NIS2 Implementation Toolkit Includes</h2>
              <p>The toolkit contains a structured collection of practical resources including:</p>
              <div class="requirement-grid">
                <div class="requirement-item"><i class="bi bi-person-video3"></i><span>NIS2 compliance implementation roadmap</span></div>
                <div class="requirement-item"><i class="bi bi-display"></i><span>Cybersecurity governance framework templates</span></div>
                <div class="requirement-item"><i class="bi bi-file-slides"></i><span>Risk assessment templates</span></div>
                <div class="requirement-item"><i class="bi bi-briefcase"></i><span>Incident management procedures</span></div>
                <div class="requirement-item"><i class="bi bi-clipboard2-check"></i><span>Security policy templates aligned with NIS2 requirements</span></div>
                <div class="requirement-item"><i class="bi bi-journal-text"></i><span>Compliance monitoring and reporting templates</span></div>
                <div class="requirement-item"><i class="bi bi-journal-text"></i><span>Implementation guidance documents</span></div>
              </div>
            </section>

            <hr class="content-divider" />

            <section id="audience">
              <h2 class="section-heading">Who This Toolkit Is For?</h2>
              <p>The toolkit is designed for:</p>
              <div class="checklist-group">
                <div class="checklist-item"><i class="bi bi-check-circle-fill"></i><span>CISOs and security managers</span></div>
                <div class="checklist-item"><i class="bi bi-check-circle-fill"></i><span>IT governance teams</span></div>
                <div class="checklist-item"><i class="bi bi-check-circle-fill"></i><span>Compliance professionals</span></div>
                <div class="checklist-item"><i class="bi bi-check-circle-fill"></i><span>Organizations required to comply with the NIS2 Directive</span></div>
                <div class="checklist-item"><i class="bi bi-check-circle-fill"></i><span>Consultants assisting clients with NIS2 compliance</span></div>
              </div>
            </section>

            <section id="format">
              <h2 class="section-heading">Format</h2>
              <p>GISBA The toolkit is delivered as a digital download package containing:</p>
              <ul>
                <li>Word templates</li>
                <li>Excel templates</li>
                <li>MP4 Video Explanation</li>
              </ul>
            </section>

            <section id="method">
              <h2 class="section-heading">Delivery Method</h2>
              <p>After successful payment:</p>
              <ul>
                <li>A secure download link will be provided immediately on the confirmation page</li>
                <li>A copy of the download link will also be sent to your email</li>
              </ul>
            </section>

            <section id="pricing">
              <h2 class="section-heading">Pricing — NIS2 Implementation Kit</h2>
              <div class="pricing-card">
                <div class="pricing-header">
                  <div class="pricing-label">Complete Toolkit</div>
                  <div style="font-size:1.3rem; font-weight:700; color:#fff; margin:6px 0 2px;">€1,750</div>
                  <div class="pricing-sublabel">One-time Cost to Download All Templates</div>
                </div>
              </div>
            </section>

            <hr class="content-divider" />

            <section id="contact">
              <h2 class="section-heading">Contact Us</h2>
              <p>For questions about NIS2 Implementation Toolkit, contact us directly.</p>
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
