@extends('layouts.site')

@section('title', 'GISBA Consultants | Cybersecurity, GRC & Compliance Consulting Since 2006')
@section('meta_description', 'GISBA Consultants — 20 years of global cybersecurity consulting. Serving Fortune 500 companies and C-level executives across three continents with NIS2, DORA, GRC, vCISO, ISO, and Project Management services.')

@section('banner')
  <div class="d-flex justify-content-between align-items-center flex-wrap gap-2">
    <span><i class="bi bi-award-fill me-2"></i>GISBA Consultants — Celebrating 20 Years of Global Cybersecurity Excellence Since 2006</span>
    <div class="d-flex gap-3">
      <a href="#about"><i class="bi bi-info-circle me-1"></i>About</a>
      <a href="#services"><i class="bi bi-grid me-1"></i>Services</a>
      <a href="#why-gisba"><i class="bi bi-star me-1"></i>Why Us</a>
      <a href="{{ route('contact-us') }}"><i class="bi bi-envelope me-1"></i>Contact</a>
    </div>
  </div>
@endsection

@section('footer_tagline')
  Cybersecurity Governance, Risk Management &amp; Compliance Consulting<br />
  Serving Europe, Asia &amp; beyond.
@endsection

@section('content')

  <div class="page-layout">
    <div class="container">

      {{-- ============================================================
           TOP INTRO HERO — full-width with image
      ============================================================ --}}
      <div class="col-12">
        <main class="img-content">
          <section class="hero-section container">
            <div class="row align-items-center">
              <div class="col-md-6">
                <div class="hero-badge mb-3">
                  <i class="bi bi-award-fill me-2"></i>Celebrating 20 Years of Excellence — Since 2006
                </div>
                <h1 class="hero-title">
                  GISBA Consultants
                  <span>Co. W.L.L.</span>
                </h1>
                <p class="hero-desc">
                  GISBA Consultants has been serving organizations worldwide since 2006, celebrating two decades of supporting clients across three continents and advising C-level executives and Fortune 500 companies on Cybersecurity Governance, Risk Management, Regulatory Compliance, Project Management, ISO Implementations, and Training Services.
                </p>
                <p class="hero-desc">
                  We are at the forefront to address emerging trends and requirements, providing clients with the best possible solutions that are effective, easy to implement, and meet both business and regulatory requirements.
                </p>
                <div class="hero-actions">
                  <a href="#services" class="btn-hero-primary">
                    <i class="bi bi-grid-fill me-2"></i>Our Services
                  </a>
                  <a href="{{ route('contact-us') }}" class="btn-hero-secondary">
                    <i class="bi bi-envelope me-2"></i>Contact Us
                  </a>
                </div>
              </div>
              <div class="col-md-6 text-center">
                <img class="image-content img-fluid" src="{{ asset('assets/images/financial_institution.jpg') }}" alt="GISBA Cybersecurity Consulting">
              </div>
            </div>
          </section>
        </main>
      </div>

      <div class="row g-4">

        {{-- ============================================================
             SIDEBAR
        ============================================================ --}}
        <div class="col-12 col-md-3">
          <aside class="sidebar">
            <nav class="sidebar-nav">
              <p class="sidebar-nav-title">Quick Links</p>
              <ul>
                <li><a href="#about"><i class="bi bi-info-circle"></i> About GISBA</a></li>
                <li><a href="#expertise"><i class="bi bi-grid"></i> Our Expertise</a></li>
                <li><a href="#services"><i class="bi bi-briefcase"></i> Our Services</a></li>
                <li><a href="#european-partners"><i class="bi bi-people-fill"></i> European Partners</a></li>
                <li><a href="#why-gisba"><i class="bi bi-star-fill"></i> Why Choose Us</a></li>
                <li><a href="#pricing"><i class="bi bi-tag"></i> Pricing</a></li>
              </ul>
            </nav>
            <div class="sidebar-contact">
              <strong><i class="bi bi-envelope me-1"></i>Contact GISBA</strong>
              <a href="mailto:support@gisba.net">support@gisba.net</a>
            </div>
          </aside>
        </div>

        {{-- ============================================================
             MAIN CONTENT
        ============================================================ --}}
        <div class="col-12 col-md-9">
          <main class="main-content">

            {{-- --------------------------------------------------------
                 ABOUT — GISBA Overview Hero
            -------------------------------------------------------- --}}
            <section id="about">
              <div class="hero-section">
                <div class="hero-badge">
                  <i class="bi bi-shield-lock-fill me-2"></i>Global Cybersecurity &amp; Compliance Consultancy
                </div>
                <h1 class="hero-title">GISBA Consultants<br /><span>Co. W.L.L.</span></h1>
                <p class="hero-subtitle">20 Years of Excellence — Serving Three Continents Since 2006</p>
                <p class="hero-desc">
                  GISBA Consultants has been serving organizations worldwide since 2006. We are celebrating two decades of serving and supporting clients across three continents and advising C-level executives and Fortune 500 companies on Cybersecurity Governance, Risk Management, Regulatory Compliance, Project Management, ISO Implementations, and Training Services.
                </p>
                <p class="hero-desc">
                  We are at the forefront to address the emerging trends and requirements from the consulting perspectives — ensuring that we provide our clients the best possible solution in the most effective and efficient manner which is not only easy to implement but also meets the business and the regulator requirements in order to enhance the competitive edge of the organization to achieve their ultimate goals and objectives.
                </p>
                <div class="hero-actions">
                  <a href="#services" class="btn-hero-primary">
                    <i class="bi bi-grid-fill me-2"></i>Explore Our Services
                  </a>
                  <a href="{{ route('contact-us') }}" class="btn-hero-secondary">
                    <i class="bi bi-calendar-check me-2"></i>Schedule a Consultation
                  </a>
                </div>
              </div>
            </section>

            <hr class="content-divider" />

            {{-- --------------------------------------------------------
                 OUR EXPERTISE — 4 Areas
            -------------------------------------------------------- --}}
            <section id="expertise">
              <h2 class="section-heading">Our Expertise</h2>
              <p>We provide a comprehensive range of consulting services tailored to modern business challenges:</p>
              <div class="requirement-grid" style="margin-top:16px;">
                <div class="requirement-item">
                  <i class="bi bi-shield-lock-fill"></i>
                  <div>
                    <strong style="display:block; font-size:13.5px; color:var(--navy);">Cybersecurity Governance &amp; Risk</strong>
                    <span style="font-size:12.5px; color:var(--text-muted);">Helping organizations build resilient and secure environments.</span>
                  </div>
                </div>
                <div class="requirement-item">
                  <i class="bi bi-bar-chart-fill"></i>
                  <div>
                    <strong style="display:block; font-size:13.5px; color:var(--navy);">Regulatory Compliance</strong>
                    <span style="font-size:12.5px; color:var(--text-muted);">Ensuring alignment with global standards and regulatory frameworks.</span>
                  </div>
                </div>
                <div class="requirement-item">
                  <i class="bi bi-diagram-3-fill"></i>
                  <div>
                    <strong style="display:block; font-size:13.5px; color:var(--navy);">Project Management</strong>
                    <span style="font-size:12.5px; color:var(--text-muted);">Establishing efficient project structures, especially in IT and cybersecurity.</span>
                  </div>
                </div>
                <div class="requirement-item">
                  <i class="bi bi-mortarboard-fill"></i>
                  <div>
                    <strong style="display:block; font-size:13.5px; color:var(--navy);">Training Services</strong>
                    <span style="font-size:12.5px; color:var(--text-muted);">Empowering teams with knowledge, tools, and best practices.</span>
                  </div>
                </div>
              </div>
            </section>

            <hr class="content-divider" />

            {{-- --------------------------------------------------------
                 FLAGSHIP SERVICES — 6 Services
            -------------------------------------------------------- --}}
            <section id="services">
              <h2 class="section-heading">Our Flagship Services</h2>
              <p>Comprehensive consulting solutions for modern business challenges across Europe and beyond.</p>

              {{-- 1. NIS2 --}}
              <div class="inclusion-card mt-3">
                <div class="inclusion-number">1</div>
                <div class="inclusion-body">
                  <div class="inclusion-title">
                    <i class="bi bi-shield-check me-2" style="color:var(--navy-light);"></i>NIS2 Implementation Services
                  </div>
                  <p style="font-size:13.5px; color:var(--text-body); margin-bottom:10px;">
                    We provide a comprehensive toolkit for implementing NIS2, offering an efficient and effective solution for EU Directive 2022/2555 compliance.
                  </p>
                  <div class="checklist-group" style="gap:6px;">
                    <div class="checklist-item" style="padding:8px 12px;">
                      <i class="bi bi-check-circle-fill"></i>
                      <span style="font-size:13px;">Efficient and structured implementation approach</span>
                    </div>
                    <div class="checklist-item" style="padding:8px 12px;">
                      <i class="bi bi-check-circle-fill"></i>
                      <span style="font-size:13px;">Designed for quick adoption</span>
                    </div>
                    <div class="checklist-item" style="padding:8px 12px;">
                      <i class="bi bi-check-circle-fill"></i>
                      <span style="font-size:13px;">Ensures full regulatory alignment</span>
                    </div>
                  </div>
                  <a href="{{ route('nis2') }}" class="btn-hero-primary d-inline-flex mt-3" style="font-size:13px; padding:9px 18px;">
                    <i class="bi bi-arrow-right me-2"></i>Learn More &amp; Get Toolkit
                  </a>
                </div>
              </div>

              {{-- 2. DORA --}}
              <div class="inclusion-card">
                <div class="inclusion-number">2</div>
                <div class="inclusion-body">
                  <div class="inclusion-title">
                    <i class="bi bi-bank me-2" style="color:var(--navy-light);"></i>DORA Implementation Services
                  </div>
                  <p style="font-size:13.5px; color:var(--text-body); margin-bottom:10px;">
                    We provide DORA implementation services, supported by a comprehensive toolkit for the European market and backed by our DORA compliance management system.
                  </p>
                  <div class="checklist-group" style="gap:6px;">
                    <div class="checklist-item" style="padding:8px 12px;">
                      <i class="bi bi-check-circle-fill"></i>
                      <span style="font-size:13px;">End-to-end implementation support</span>
                    </div>
                    <div class="checklist-item" style="padding:8px 12px;">
                      <i class="bi bi-check-circle-fill"></i>
                      <span style="font-size:13px;">Backed by our <strong>DORA Compliance Management System</strong></span>
                    </div>
                    <div class="checklist-item" style="padding:8px 12px;">
                      <i class="bi bi-check-circle-fill"></i>
                      <span style="font-size:13px;">Includes tools, frameworks, and expert guidance</span>
                    </div>
                  </div>
                </div>
              </div>

              {{-- 3. GRC --}}
              <div class="inclusion-card">
                <div class="inclusion-number">3</div>
                <div class="inclusion-body">
                  <div class="inclusion-title">
                    <i class="bi bi-clipboard-data me-2" style="color:var(--navy-light);"></i>Governance, Risk &amp; Compliance (GRC)
                  </div>
                  <p style="font-size:13.5px; color:var(--text-body); margin-bottom:10px;">
                    We provide GRC services using a range of tools and expert resources to ensure effective implementation of best practices across multiple standards and domains. Our unique expertise in compliance management enables us to achieve compliance in the shortest possible time while meeting all regulatory and contractual requirements.
                  </p>
                  <div class="checklist-group" style="gap:6px;">
                    <div class="checklist-item" style="padding:8px 12px;">
                      <i class="bi bi-check-circle-fill"></i>
                      <span style="font-size:13px;">Rapid compliance achievement</span>
                    </div>
                    <div class="checklist-item" style="padding:8px 12px;">
                      <i class="bi bi-check-circle-fill"></i>
                      <span style="font-size:13px;">Coverage across multiple standards and domains</span>
                    </div>
                    <div class="checklist-item" style="padding:8px 12px;">
                      <i class="bi bi-check-circle-fill"></i>
                      <span style="font-size:13px;">Efficient handling of regulatory &amp; contractual requirements</span>
                    </div>
                  </div>
                  <div class="highlight-box mt-3">
                    <i class="bi bi-lightbulb-fill"></i>
                    <span><strong>Our strength:</strong> Achieving compliance in the <strong>shortest possible time without compromising quality</strong></span>
                  </div>
                </div>
              </div>

              {{-- 4. vCISO --}}
              <div class="inclusion-card">
                <div class="inclusion-number">4</div>
                <div class="inclusion-body">
                  <div class="inclusion-title">
                    <i class="bi bi-person-badge me-2" style="color:var(--navy-light);"></i>Virtual CISO (vCISO) Services
                  </div>
                  <p style="font-size:13.5px; color:var(--text-body); margin-bottom:10px;">
                    We offer vCISO services supported by highly experienced consultants with over 35 years of combined expertise. Our services include pre-developed documentation, training videos, and on-site support across the UK, France, and Portugal.
                  </p>
                  <div class="cert-badges mb-2">
                    <span class="cert-badge"><i class="bi bi-award"></i> CISSP</span>
                    <span class="cert-badge"><i class="bi bi-award"></i> CISA</span>
                    <span class="cert-badge"><i class="bi bi-award"></i> CISM</span>
                    <span class="cert-badge"><i class="bi bi-award"></i> CGEIT</span>
                    <span class="cert-badge"><i class="bi bi-award"></i> CRISC</span>
                    <span class="cert-badge"><i class="bi bi-award"></i> MBCP</span>
                    <span class="cert-badge"><i class="bi bi-award"></i> ITIL Master</span>
                    <span class="cert-badge"><i class="bi bi-award"></i> PMP</span>
                  </div>
                  <div class="checklist-group" style="gap:6px;">
                    <div class="checklist-item" style="padding:8px 12px;">
                      <i class="bi bi-check-circle-fill"></i>
                      <span style="font-size:13px;">35+ years of expert consulting experience</span>
                    </div>
                    <div class="checklist-item" style="padding:8px 12px;">
                      <i class="bi bi-check-circle-fill"></i>
                      <span style="font-size:13px;">Pre-developed documentation &amp; training videos</span>
                    </div>
                    <div class="checklist-item" style="padding:8px 12px;">
                      <i class="bi bi-check-circle-fill"></i>
                      <span style="font-size:13px;">On-site support: UK, France &amp; Portugal</span>
                    </div>
                  </div>
                </div>
              </div>

              {{-- 5. ISO --}}
              <div class="inclusion-card">
                <div class="inclusion-number">5</div>
                <div class="inclusion-body">
                  <div class="inclusion-title">
                    <i class="bi bi-patch-check me-2" style="color:var(--navy-light);"></i>ISO Implementation Services
                  </div>
                  <p style="font-size:13.5px; color:var(--text-body); margin-bottom:10px;">
                    We have over 25 years of experience implementing ISO standards, beginning with ISO 27001's predecessor BS 7799 in 2001. GISBA assures clients of our strong domain expertise and decades of experience delivering consulting services worldwide.
                  </p>
                  <div class="requirement-grid" style="margin:10px 0;">
                    <div class="requirement-item">
                      <i class="bi bi-shield-check"></i>
                      <div>
                        <strong style="display:block; font-size:13px;">ISO 27001</strong>
                        <span style="font-size:12px; color:var(--text-muted);">Since BS7799 – 2001</span>
                      </div>
                    </div>
                    <div class="requirement-item">
                      <i class="bi bi-gear-fill"></i>
                      <div>
                        <strong style="display:block; font-size:13px;">ISO 20000</strong>
                        <span style="font-size:12px; color:var(--text-muted);">Since BS15000 – 2004</span>
                      </div>
                    </div>
                    <div class="requirement-item">
                      <i class="bi bi-exclamation-triangle-fill"></i>
                      <div>
                        <strong style="display:block; font-size:13px;">ISO 22301</strong>
                        <span style="font-size:12px; color:var(--text-muted);">Since BS25999 – 2006</span>
                      </div>
                    </div>
                  </div>
                  <div class="highlight-box">
                    <i class="bi bi-lightbulb-fill"></i>
                    <span>We don't just implement standards — we bring <strong>deep historical expertise</strong> that ensures success.</span>
                  </div>
                </div>
              </div>

              {{-- 6. Project Management --}}
              <div class="inclusion-card">
                <div class="inclusion-number">6</div>
                <div class="inclusion-body">
                  <div class="inclusion-title">
                    <i class="bi bi-kanban me-2" style="color:var(--navy-light);"></i>Project Management Services
                  </div>
                  <p style="font-size:13.5px; color:var(--text-body); margin-bottom:10px;">
                    We are experts in establishing Project Management Offices (PMOs), especially for IT and cybersecurity. We have also made valuable contributions to PMBOK, and our principal consultant's name has appeared in the official PMBOK publication.
                  </p>
                  <div class="checklist-group" style="gap:6px;">
                    <div class="checklist-item" style="padding:8px 12px;">
                      <i class="bi bi-check-circle-fill"></i>
                      <span style="font-size:13px;">Proven methodologies aligned with PMBOK</span>
                    </div>
                    <div class="checklist-item" style="padding:8px 12px;">
                      <i class="bi bi-check-circle-fill"></i>
                      <span style="font-size:13px;">Industry-recognized expertise</span>
                    </div>
                    <div class="checklist-item" style="padding:8px 12px;">
                      <i class="bi bi-check-circle-fill"></i>
                      <span style="font-size:13px;">Contributions to official PMBOK publications</span>
                    </div>
                  </div>
                </div>
              </div>

            </section>

            <hr class="content-divider" />

            {{-- --------------------------------------------------------
                 EUROPEAN PARTNERS — existing section, preserved
            -------------------------------------------------------- --}}
            <section id="european-partners">
              <h2 class="section-heading">Our European Partners for NIS2</h2>
              <p>We work alongside trusted European organisations to bring NIS2 expertise directly to organisations across the EU.</p>
              <div class="partners-grid">
                <div class="partner-card">
                  <img src="{{ asset('assets/images/visionaryalpha.png') }}" alt="Visionary Alpha" class="partner-logo" />
                </div>
                <div class="partner-card">
                  <img src="{{ asset('assets/images/daic.png') }}" alt="DAIC" class="partner-logo" />
                </div>
              </div>
            </section>

            <hr class="content-divider" />

            {{-- --------------------------------------------------------
                 WHY CHOOSE GISBA — 5 Differentiators
            -------------------------------------------------------- --}}
            <section id="why-gisba">
              <h2 class="section-heading">Why Choose GISBA?</h2>
              <div class="checklist-group mt-3">
                <div class="checklist-item">
                  <i class="bi bi-globe2" style="font-size:20px;"></i>
                  <div>
                    <strong>Proven Global Experience</strong>
                    <p style="margin:0; font-size:13px; color:var(--text-muted);">Serving clients across three continents since 2006</p>
                  </div>
                </div>
                <div class="checklist-item">
                  <i class="bi bi-person-lines-fill" style="font-size:20px;"></i>
                  <div>
                    <strong>Trusted by Executives</strong>
                    <p style="margin:0; font-size:13px; color:var(--text-muted);">Advising Fortune 500 companies and C-level leaders</p>
                  </div>
                </div>
                <div class="checklist-item">
                  <i class="bi bi-cpu-fill" style="font-size:20px;"></i>
                  <div>
                    <strong>Deep Technical Expertise</strong>
                    <p style="margin:0; font-size:13px; color:var(--text-muted);">Decades of hands-on implementation experience</p>
                  </div>
                </div>
                <div class="checklist-item">
                  <i class="bi bi-check2-all" style="font-size:20px;"></i>
                  <div>
                    <strong>Regulator-Focused Approach</strong>
                    <p style="margin:0; font-size:13px; color:var(--text-muted);">Ensuring compliance with confidence</p>
                  </div>
                </div>
                <div class="checklist-item">
                  <i class="bi bi-lightning-charge-fill" style="font-size:20px;"></i>
                  <div>
                    <strong>Efficient Delivery</strong>
                    <p style="margin:0; font-size:13px; color:var(--text-muted);">Fast, practical, and cost-effective solutions</p>
                  </div>
                </div>
              </div>
            </section>

            <hr class="content-divider" />

            {{-- --------------------------------------------------------
                 OUR MISSION
            -------------------------------------------------------- --}}
            <section id="mission">
              <h2 class="section-heading">Our Mission</h2>
              <div class="info-box" style="display:flex; align-items:flex-start; gap:14px;">
                <i class="bi bi-bullseye" style="font-size:22px; color:var(--navy-light); flex-shrink:0; margin-top:2px;"></i>
                <p style="margin:0; font-size:14.5px; color:var(--text-body); line-height:1.75;">
                  To provide organizations with practical, effective, and forward-thinking consulting solutions that not only meet regulatory requirements but also <strong>enhance business performance and competitive advantage</strong>.
                </p>
              </div>
            </section>

            <hr class="content-divider" />

            {{-- --------------------------------------------------------
                 PRICING — existing section, preserved
            -------------------------------------------------------- --}}
            <section id="pricing">
              <h2 class="section-heading">Pricing — NIS2 Implementation Kit</h2>
              <div class="pricing-card">
                <div class="pricing-header">
                  <div class="pricing-label">Complete Toolkit</div>
                  <div style="font-size:1.3rem; font-weight:700; color:#fff; margin:6px 0 2px;">£1,500 GBP+VAT</div>
                  <div class="pricing-sublabel">One-time purchase · 1-year platform access</div>
                </div>
                <div class="pricing-body">
                  <p class="pricing-includes-title">Your purchase includes:</p>
                  <div class="pricing-includes">
                    <div class="pricing-include-item"><i class="bi bi-check-lg"></i> Access to NIS2.GISBA.Net</div>
                    <div class="pricing-include-item"><i class="bi bi-check-lg"></i> Downloadable implementation frameworks</div>
                    <div class="pricing-include-item"><i class="bi bi-check-lg"></i> Policy and procedure templates</div>
                    <div class="pricing-include-item"><i class="bi bi-check-lg"></i> Completed implementation examples</div>
                    <div class="pricing-include-item"><i class="bi bi-check-lg"></i> Video implementation guidance</div>
                    <div class="pricing-include-item"><i class="bi bi-check-lg"></i> Compliance and audit checklists</div>
                  </div>
                  <p style="font-size:12.5px; color:var(--text-muted); margin-top:16px; margin-bottom:0;">
                    <i class="bi bi-tag me-1"></i>One-time fee of £1,500 GBP+VAT — less than one week of a professional cybersecurity consultant.
                  </p>
                  <p style="font-size:12.5px; color:var(--text-muted); margin-top:16px; margin-bottom:0; text-align: justify;">
                    <i class="bi bi-tag me-1"></i><b>Cost Justification:</b> Most SMEs operate under tight budget constraints. The average daily rate for a compliance consultant is approximately €800, and engaging one for 20 days would cost around €16,000. Therefore, purchasing the toolkit—which requires only minimal customization—results in significant cost savings compared to hiring a consultant.
                  </p>
                  <a href="{{ route('contact-us') }}" class="btn-hero-primary d-block text-center mt-3">
                    <i class="bi bi-calendar-check me-2"></i>Request a Demo and Payment Link
                  </a>
                </div>
              </div>
            </section>

            <hr class="content-divider" />

            {{-- --------------------------------------------------------
                 CALL TO ACTION
            -------------------------------------------------------- --}}
            <section id="cta">
              <div class="cta-section">
                <h2 class="cta-title">Ready to Strengthen Your Cybersecurity &amp; Compliance?</h2>
                <p class="cta-desc">Partner with GISBA Consultants and take your organization to the next level. Two decades of expertise — working for you.</p>
                <div class="hero-actions" style="justify-content:center;">
                  <a href="{{ route('contact-us') }}" class="btn-hero-primary">
                    <i class="bi bi-calendar-check me-2"></i>Schedule a Consultation
                  </a>
                  <a href="mailto:support@gisba.net" class="btn-hero-secondary">
                    <i class="bi bi-envelope me-2"></i>Contact Us Today
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
