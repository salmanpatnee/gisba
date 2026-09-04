@extends('layouts.site')

@section('title', 'GISBA Consultants | Cybersecurity, GRC & Compliance Consulting Since 2006')
@section('meta_description', 'GISBA Consultants — 20 years of global cybersecurity consulting. Serving Fortune 500 companies and C-level executives across three continents with NIS2, DORA, GRC, vCISO, ISO, and Project Management services.')

@section('banner')
  <div class="d-flex justify-content-between align-items-center flex-wrap gap-2">
    <span><i class="bi bi-award-fill me-2"></i>GISBA Consultants — Celebrating 20 Years of Global Cybersecurity Excellence Since 2006</span>
    <div class="d-flex gap-3">
      {{-- <a href="#about"><i class="bi bi-info-circle me-1"></i>About</a> --}}
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

  <style>
    .pwyca-section {
      margin-top: 44px;
    }
    .pwyca-card-header {
      display: flex;
      align-items: center;
      gap: 18px;
      margin-bottom: 18px;
    }
    .pwyca-icon-badge {
      flex-shrink: 0;
      width: 54px;
      height: 54px;
      border-radius: 50%;
      display: flex;
      align-items: center;
      justify-content: center;
      font-size: 22px;
      color: #fff;
      background: linear-gradient(135deg, var(--accent) 0%, #e3c877 100%);
      box-shadow: 0 8px 18px rgba(200, 168, 75, 0.4);
      animation: pwyca-pulse 2.8s ease-in-out infinite;
    }
    .pwyca-card-kicker {
      display: inline-block;
      font-size: 11px;
      font-weight: 800;
      letter-spacing: 0.09em;
      text-transform: uppercase;
      color: var(--accent);
      margin: 0 0 5px;
    }
    .pwyca-card-title {
      font-size: 19px;
      font-weight: 800;
      color: var(--navy);
      line-height: 1.3;
      margin: 0;
      border-left: none;
      padding-left: 0;
    }
    @keyframes pwyca-pulse {
      0%, 100% { box-shadow: 0 8px 18px rgba(200, 168, 75, 0.4); transform: scale(1); }
      50% { box-shadow: 0 8px 26px rgba(200, 168, 75, 0.65); transform: scale(1.05); }
    }
    .pwyca-card {
      background: linear-gradient(180deg, #ffffff 0%, var(--bg-section-alt, #f7f9fc) 100%);
      border: 1px solid var(--border-mid);
      border-top: 4px solid var(--accent);
      border-radius: var(--radius-md);
      padding: 26px 24px;
      box-shadow: 0 10px 30px rgba(0, 51, 102, 0.08);
    }
    .pwyca-courses-label {
      display: flex;
      align-items: center;
      gap: 8px;
      font-size: 12px;
      font-weight: 800;
      letter-spacing: 0.06em;
      text-transform: uppercase;
      color: var(--navy);
      margin-bottom: 14px;
    }
    .pwyca-courses-label i {
      color: var(--accent);
    }
    .pwyca-course-card {
      position: relative;
      height: 100%;
      background: #fff;
      border: 1px solid var(--border-mid);
      border-radius: var(--radius-md);
      padding: 22px 18px 20px;
      text-align: center;
      transition: transform 0.2s ease, box-shadow 0.2s ease, border-color 0.2s ease;
    }
    .pwyca-course-card:hover {
      transform: translateY(-4px);
      border-color: var(--accent);
      box-shadow: 0 14px 28px rgba(0, 51, 102, 0.12);
    }
    .pwyca-course-card-icon {
      width: 50px;
      height: 50px;
      margin: 0 auto 12px;
      border-radius: 50%;
      display: flex;
      align-items: center;
      justify-content: center;
      font-size: 20px;
      color: #fff;
      background: linear-gradient(135deg, var(--navy) 0%, var(--navy-light) 100%);
    }
    .pwyca-course-card-name {
      font-size: 15.5px;
      font-weight: 800;
      letter-spacing: 0.03em;
      text-transform: uppercase;
      color: var(--navy);
      margin-bottom: 4px;
    }
    .pwyca-course-card-price {
      font-size: 12.5px;
      color: var(--text-muted);
      margin-bottom: 16px;
    }
    .pwyca-course-card-price strong {
      color: var(--accent);
      font-weight: 800;
    }
    .pwyca-course-card-label {
      display: block;
      font-size: 10.5px;
      font-weight: 700;
      letter-spacing: 0.07em;
      text-transform: uppercase;
      color: var(--text-muted);
      margin-bottom: 8px;
    }
    .pwyca-percent-field {
      border-radius: var(--radius-sm) 0 0 var(--radius-sm) !important;
      border-color: var(--border-mid);
      font-size: 18px;
      font-weight: 800;
      text-align: center;
      color: var(--navy);
      padding: 10px 6px;
    }
    .pwyca-percent-suffix {
      border-radius: 0 var(--radius-sm) var(--radius-sm) 0 !important;
      border-color: var(--border-mid);
      background: rgba(200, 168, 75, 0.14);
      color: var(--accent);
      font-weight: 800;
      font-size: 15px;
    }
    .pwyca-divider {
      height: 1px;
      background: linear-gradient(90deg, transparent, var(--border-mid) 15%, var(--border-mid) 85%, transparent);
      margin: 26px 0 20px;
    }
    @media (max-width: 576px) {
      .pwyca-card-header {
        gap: 12px;
      }
      .pwyca-icon-badge {
        width: 44px;
        height: 44px;
        font-size: 18px;
      }
      .pwyca-card-title {
        font-size: 16.5px;
      }
    }
  </style>

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
                <div class="hero-actions mb-3">
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
             MAIN CONTENT
        ============================================================ --}}
        <div class="col-12">
          <main class="main-content">

            {{-- --------------------------------------------------------
                 ABOUT — GISBA Overview Hero (hidden — re-enable to restore)
            -------------------------------------------------------- --}}
            {{-- <section id="about">
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

            <hr class="content-divider" /> --}}

            {{-- --------------------------------------------------------
                 AVAILABLE COURSES
            -------------------------------------------------------- --}}
            <section id="courses">
              <h2 class="section-heading">Available Courses</h2>
              <p>Advance your career with our globally recognized certification training programs.</p>
              <div class="row g-4" style="margin-top:4px;">
                <div class="col-6 col-md-3">
                  <a href="{{ route('crisc-course') }}" class="course-card">
                    <div class="course-card-img-wrap">
                      <img src="{{ asset('assets/images/CRISC Banner.jpeg') }}" alt="CRISC Course">
                    </div>
                    <div class="course-card-body">
                      <span class="course-card-eyebrow">Online Course</span>
                      <div class="course-card-title">CRISC</div>
                      <p class="course-card-desc">One of the most in-demand certifications for cybersecurity and IT risk professionals.</p>
                      <div class="course-card-meta">
                        <span><i class="bi bi-person-badge"></i> Expert-Led</span>
                        <span><i class="bi bi-camera-video"></i> Live Sessions</span>
                      </div>
                      <span class="btn-hero-primary"><i class="bi bi-arrow-right me-2"></i>View Course Details</span>
                    </div>
                  </a>
                </div>
                <div class="col-6 col-md-3">
                  <a href="{{ route('cissp') }}" class="course-card">
                    <div class="course-card-img-wrap">
                      <img src="{{ asset('assets/images/CISSP Banner.png') }}" alt="CISSP Course">
                    </div>
                    <div class="course-card-body">
                      <span class="course-card-eyebrow">Live Online Training</span>
                      <div class="course-card-title">CISSP</div>
                      <p class="course-card-desc">One of the world's most recognized and respected certifications for experienced security professionals.</p>
                      <div class="course-card-meta">
                        <span><i class="bi bi-person-badge"></i> Expert-Led</span>
                        <span><i class="bi bi-camera-video"></i> Live Sessions</span>
                      </div>
                      <span class="btn-hero-primary"><i class="bi bi-arrow-right me-2"></i>View Course Details</span>
                    </div>
                  </a>
                </div>
                <div class="col-6 col-md-3">
                  <a href="{{ route('pmp') }}" class="course-card">
                    <div class="course-card-img-wrap">
                      <img src="{{ asset('assets/images/PMP Banner.jpeg') }}" alt="PMP Course">
                    </div>
                    <div class="course-card-body">
                      <span class="course-card-eyebrow">Live Online Training</span>
                      <div class="course-card-title">PMP</div>
                      <p class="course-card-desc">Exam-ready content, practice questions &amp; expert guidance — everything you need to pass the PMP exam.</p>
                      <div class="course-card-meta">
                        <span><i class="bi bi-person-badge"></i> Expert-Led</span>
                        <span><i class="bi bi-camera-video"></i> Live Sessions</span>
                      </div>
                      <span class="btn-hero-primary"><i class="bi bi-arrow-right me-2"></i>View Course Details</span>
                    </div>
                  </a>
                </div>
                <div class="col-6 col-md-3">
                  <a href="{{ route('prince2') }}" class="course-card">
                    <div class="course-card-img-wrap">
                      <img src="{{ asset('assets/images/PRINCE2  Banner.jpeg') }}" alt="PRINCE2 Course">
                    </div>
                    <div class="course-card-body">
                      <span class="course-card-eyebrow">Live Online Training</span>
                      <div class="course-card-title">PRINCE2</div>
                      <p class="course-card-desc">One of the world's most widely recognized structured project management methods.</p>
                      <div class="course-card-meta">
                        <span><i class="bi bi-person-badge"></i> Expert-Led</span>
                        <span><i class="bi bi-camera-video"></i> Live Sessions</span>
                      </div>
                      <span class="btn-hero-primary"><i class="bi bi-arrow-right me-2"></i>View Course Details</span>
                    </div>
                  </a>
                </div>
              </div>
            </section>

            <hr class="content-divider" />

            {{-- --------------------------------------------------------
                 PAY-WHAT-YOU-CAN-AFFORD DISCOUNT REQUEST
            -------------------------------------------------------- --}}
            <section id="discount-request" class="pwyca-section">
              <div class="pwyca-card-header">
                <div class="pwyca-icon-badge"><i class="bi bi-percent"></i></div>
                <div>
                  <p class="pwyca-card-kicker">Pay-What-You-Can-Afford Program</p>
                  <h2 class="pwyca-card-title">Request a Discount for One or More Courses Below</h2>
                </div>
              </div>

              <p>We believe that financial limitations should not prevent motivated professionals and students from accessing high-quality professional training.</p>
              <p>All GISBA courses have a standard published price. However, if the standard fee is beyond your current budget, you may request a special discount under our Pay-What-You-Can-Afford Program.</p>
              <p>Tell us the amount you can reasonably afford, and we will review your request and do our best to accommodate you, subject to seat availability.</p>

              <div id="discount-form-alert" role="alert" aria-live="polite" style="display:none;" class="mt-3"></div>

              <div class="pwyca-card mt-3">

                <form id="discount-request-form-el" action="{{ route('cissp.discount-request') }}" method="post" novalidate>

                  <p class="pwyca-courses-label"><i class="bi bi-mortarboard-fill"></i> Select your course(s) &amp; requested discount</p>

                  <div class="row g-3">
                    <div class="col-12 col-sm-6 col-md-4">
                      <div class="pwyca-course-card">
                        <div class="pwyca-course-card-icon"><i class="bi bi-mortarboard-fill"></i></div>
                        <div class="pwyca-course-card-name">PMP</div>
                        <div class="pwyca-course-card-price">Std. Price <strong>$999</strong></div>
                        <label class="pwyca-course-card-label" for="discount-pmp-percentage">Requested Discount</label>
                        <div class="input-group">
                          <input type="number" class="form-control pwyca-percent-field" id="discount-pmp-percentage" name="pmp_discount_percentage"
                                 placeholder="0" min="0" max="100" step="1" />
                          <span class="input-group-text pwyca-percent-suffix">%</span>
                        </div>
                        <div class="invalid-feedback d-block" id="err-discount-pmp-percentage"></div>
                      </div>
                    </div>

                    <div class="col-12 col-sm-6 col-md-4">
                      <div class="pwyca-course-card">
                        <div class="pwyca-course-card-icon"><i class="bi bi-mortarboard-fill"></i></div>
                        <div class="pwyca-course-card-name">CRISC</div>
                        <div class="pwyca-course-card-price">Std. Price <strong>$999</strong></div>
                        <label class="pwyca-course-card-label" for="discount-crisc-percentage">Requested Discount</label>
                        <div class="input-group">
                          <input type="number" class="form-control pwyca-percent-field" id="discount-crisc-percentage" name="crisc_discount_percentage"
                                 placeholder="0" min="0" max="100" step="1" />
                          <span class="input-group-text pwyca-percent-suffix">%</span>
                        </div>
                        <div class="invalid-feedback d-block" id="err-discount-crisc-percentage"></div>
                      </div>
                    </div>

                    <div class="col-12 col-sm-6 col-md-4">
                      <div class="pwyca-course-card">
                        <div class="pwyca-course-card-icon"><i class="bi bi-mortarboard-fill"></i></div>
                        <div class="pwyca-course-card-name">PRINCE2</div>
                        <div class="pwyca-course-card-price">Std. Price <strong>$999</strong></div>
                        <label class="pwyca-course-card-label" for="discount-prince2-percentage">Requested Discount</label>
                        <div class="input-group">
                          <input type="number" class="form-control pwyca-percent-field" id="discount-prince2-percentage" name="prince2_discount_percentage"
                                 placeholder="0" min="0" max="100" step="1" />
                          <span class="input-group-text pwyca-percent-suffix">%</span>
                        </div>
                        <div class="invalid-feedback d-block" id="err-discount-prince2-percentage"></div>
                      </div>
                    </div>
                  </div>

                  <div class="pwyca-divider"></div>

                  <div class="row g-3">

                    <div class="col-12 col-sm-6">
                      <label for="discount-name" class="form-label" style="font-weight:600; font-size:13.5px; color:var(--text-heading);">Full Name <span class="text-danger">*</span></label>
                      <input type="text" class="form-control" id="discount-name" name="name"
                             placeholder="Your full name" required
                             minlength="2" maxlength="100"
                             style="border-color:var(--border-mid); border-radius:var(--radius-sm); font-size:14px;" />
                      <div class="invalid-feedback" id="err-discount-name"></div>
                    </div>

                    <div class="col-12 col-sm-6">
                      <label for="discount-email" class="form-label" style="font-weight:600; font-size:13.5px; color:var(--text-heading);">Official Email <span class="text-danger">*</span></label>
                      <input type="email" class="form-control" id="discount-email" name="email"
                             placeholder="name@company.com" required maxlength="150"
                             style="border-color:var(--border-mid); border-radius:var(--radius-sm); font-size:14px;" />
                      <div class="invalid-feedback" id="err-discount-email"></div>
                    </div>

                    <div class="col-12">
                      <div class="form-check">
                        <input class="form-check-input" type="checkbox" id="discount-consent" name="consent" required />
                        <label class="form-check-label" for="discount-consent" style="font-size:13.5px;">
                          I consent to the use of my information by GISBA for training preparation, follow-ups, CPE verification/confirmation, and related activities. <span class="text-danger">*</span>
                        </label>
                      </div>
                      <div class="invalid-feedback d-block" id="err-discount-consent"></div>
                    </div>

                    <div class="col-12">
                      <button type="submit" id="discount-submit-btn" class="btn-hero-primary" style="border:none; cursor:pointer;">
                        <i class="bi bi-send me-2"></i>Send Request
                      </button>
                    </div>

                  </div>
                </form>
              </div>
            </section>

            <hr class="content-divider" />

            {{-- --------------------------------------------------------
                 TRAINING SCHEDULE 2026
            -------------------------------------------------------- --}}
            <section id="schedule">
              <h2 class="section-heading">Training Schedule 2026</h2>
              <p>Upcoming cohort dates for our live, instructor-led certification courses. Seats are limited — early registration is recommended.</p>

              <div class="schedule-table-wrap">
                <table class="schedule-table">
                  <thead>
                    <tr>
                      <th>Course</th>
                      <th>Recent Cohort</th>
                      <th>Upcoming Cohort</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                      <td>
                        <span class="schedule-course-cell"><i class="bi bi-mortarboard"></i>CRISC</span>
                      </td>
                      <td>
                        <span class="schedule-status is-closed"><i class="bi bi-x-circle-fill"></i>Closed</span>
                        <span class="schedule-date is-closed-text">31st Aug 2026</span>
                      </td>
                      <td>
                        <span class="schedule-status is-open"><i class="bi bi-check-circle-fill"></i>Enrolling</span>
                        <span class="schedule-date">14th - 17th Sep 2026</span>
                        <a href="{{ route('crisc-course') }}" class="schedule-cta">View Course <i class="bi bi-arrow-right"></i></a>
                      </td>
                    </tr>
                    <tr>
                      <td>
                        <span class="schedule-course-cell"><i class="bi bi-shield-lock"></i>CISSP</span>
                      </td>
                      <td>
                        <span class="schedule-status is-closed"><i class="bi bi-x-circle-fill"></i>Closed</span>
                        <span class="schedule-date is-closed-text">07th &ndash; 10th Sep 2026</span>
                      </td>
                      <td>
                        <span class="schedule-status is-open"><i class="bi bi-check-circle-fill"></i>Enrolling</span>
                        <span class="schedule-date">21st &ndash; 24th Sep 2026</span>
                        <a href="{{ route('cissp') }}" class="schedule-cta">View Course <i class="bi bi-arrow-right"></i></a>
                      </td>
                    </tr>
                    <tr>
                      <td>
                        <span class="schedule-course-cell"><i class="bi bi-award"></i>PMP</span>
                      </td>
                      <td>
                        <span class="schedule-status is-closed"><i class="bi bi-x-circle-fill"></i>Closed</span>
                        <span class="schedule-date is-closed-text">14th Sep 2026</span>
                      </td>
                      <td>
                        <span class="schedule-status is-open"><i class="bi bi-check-circle-fill"></i>Enrolling</span>
                        <span class="schedule-date">28th Sep &ndash; 1st Oct 2026</span>
                        <a href="{{ route('pmp') }}" class="schedule-cta">View Course <i class="bi bi-arrow-right"></i></a>
                      </td>
                    </tr>
                    <tr>
                      <td>
                        <span class="schedule-course-cell"><i class="bi bi-diagram-3"></i>PRINCE2 Foundation</span>
                      </td>
                      <td>
                        <span class="schedule-status is-closed"><i class="bi bi-x-circle-fill"></i>Closed</span>
                        <span class="schedule-date is-closed-text">20th &ndash; 21st Sep 2026</span>
                      </td>
                      <td>
                        <span class="schedule-status is-open"><i class="bi bi-check-circle-fill"></i>Enrolling</span>
                        <span class="schedule-date">26th&ndash;27th Sep &amp; 3rd&ndash;4th Oct 2026</span>
                        <a href="{{ route('prince2') }}" class="schedule-cta">View Course <i class="bi bi-arrow-right"></i></a>
                      </td>
                    </tr>
                  </tbody>
                </table>
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
                  <i class="bi bi-diagram-3-fill"></i>
                  <div>
                    <strong style="display:block; font-size:13.5px; color:var(--navy);">Project Management</strong>
                    <span style="font-size:12.5px; color:var(--text-muted);">Establishing efficient project structures, especially in IT and cybersecurity.</span>
                  </div>
                </div>
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
                 SECURE AI DEPLOYMENT SERVICE (hidden — re-enable to restore)
            -------------------------------------------------------- --}}
            {{-- <section id="secure-ai-deployment">
              <h2 class="section-heading">Secure AI Deployment Service</h2>
              <p>Enabling organizations to safely adopt and manage AI systems in alignment with ISO/IEC 42001.</p>

              <div class="inclusion-card mt-3" style="display:flex; flex-direction:column; gap:0; overflow:hidden;">
                <div style="width:100%; padding:0;">
                  <img src="{{ asset('assets/images/secure-ai-system.jpeg') }}" alt="Secure AI Management System - ISO/IEC 42001 Compliant" style="width:100%; height:auto; object-fit:cover; min-height:350px;" />
                </div>

                <div style="padding:24px;">
                  <div class="inclusion-body">

                    <p>
                      Secure AI Deployment Service enables organizations to safely adopt and manage AI systems in alignment with ISO/IEC 42001. The service includes the appointment of a dedicated Secure AI Officer who leads AI governance, risk management, and deployment oversight, ensuring that AI solutions are secure, compliant, and responsibly managed throughout their lifecycle. Working in close collaboration with Cybersecurity, Legal, Compliance, and business teams, this service provides end-to-end support—from use-case approval and risk assessment to monitoring and continuous improvement—ensuring trusted, controlled, and business-aligned AI deployment.
                    </p>

                    <div class="highlight-box">
                      <i class="bi bi-lightbulb-fill"></i>
                      <span>Ensuring <strong>trusted, controlled, and business-aligned AI deployment</strong> for your organization.</span>
                    </div>
                  </div>
                </div>
              </div>
            </section>

            <hr class="content-divider" /> --}}

            {{-- --------------------------------------------------------
                 FLAGSHIP SERVICES — 6 Services
            -------------------------------------------------------- --}}
            <section id="services">
              <h2 class="section-heading">Our Flagship Services</h2>
              <p>Comprehensive consulting solutions for modern business challenges across Europe and beyond.</p>

              {{-- 1. NIS2 (hidden — re-enable to restore) --}}
              {{-- <div class="inclusion-card mt-3">
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
                  <a href="{{ route('nis2-toolkit') }}" class="btn-hero-primary d-inline-flex mt-3" style="font-size:13px; padding:9px 18px;">
                    <i class="bi bi-arrow-right me-2"></i>Learn More &amp; Get Toolkit
                  </a>
                </div>
              </div>

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
              </div> --}}

              {{-- 1. GRC --}}
              <div class="inclusion-card mt-3">
                <div class="inclusion-number">1</div>
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

              {{-- 2. vCISO --}}
              <div class="inclusion-card">
                <div class="inclusion-number">2</div>
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

              {{-- 3. ISO --}}
              <div class="inclusion-card">
                <div class="inclusion-number">3</div>
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

              {{-- 4. Project Management --}}
              <div class="inclusion-card">
                <div class="inclusion-number">4</div>
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
                 EUROPEAN PARTNERS — existing section, preserved (hidden — re-enable to restore)
            -------------------------------------------------------- --}}
            {{-- <section id="european-partners">
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

            <hr class="content-divider" /> --}}

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
            {{-- <section id="pricing">
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

            <hr class="content-divider" /> --}}

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
                  <a href="{{ route('contact-us') }}" class="btn-hero-secondary">
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

@push('scripts')
<script>
  function setFieldError(inputEl, errEl, message) {
    inputEl.classList.add('is-invalid');
    inputEl.classList.remove('is-valid');
    if (errEl) { errEl.textContent = message; }
  }

  function setFieldValid(inputEl) {
    inputEl.classList.remove('is-invalid');
    inputEl.classList.add('is-valid');
  }

  function validateEmail(email) {
    return /^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email);
  }

  function validateOptionalPercentage(inputEl, errEl) {
    const raw = inputEl.value.trim();
    if (raw === '') {
      inputEl.classList.remove('is-invalid', 'is-valid');
      if (errEl) { errEl.textContent = ''; }
      return true;
    }
    const num = Number(raw);
    if (Number.isNaN(num) || num < 0 || num > 100) {
      setFieldError(inputEl, errEl, 'Please enter a percentage between 0 and 100.');
      return false;
    }
    setFieldValid(inputEl);
    return true;
  }

  function validateDiscountForm() {
    let valid = true;
    const name = document.getElementById('discount-name');
    const email = document.getElementById('discount-email');
    const consent = document.getElementById('discount-consent');
    const pmp = document.getElementById('discount-pmp-percentage');
    const crisc = document.getElementById('discount-crisc-percentage');
    const prince2 = document.getElementById('discount-prince2-percentage');

    if (!name.value.trim() || name.value.trim().length < 2) {
      setFieldError(name, document.getElementById('err-discount-name'), 'Full name must be at least 2 characters.');
      valid = false;
    } else {
      setFieldValid(name);
    }

    if (!email.value.trim()) {
      setFieldError(email, document.getElementById('err-discount-email'), 'Email address is required.');
      valid = false;
    } else if (!validateEmail(email.value.trim())) {
      setFieldError(email, document.getElementById('err-discount-email'), 'Please enter a valid email address.');
      valid = false;
    } else {
      setFieldValid(email);
    }

    const consentErr = document.getElementById('err-discount-consent');
    if (!consent.checked) {
      consentErr.textContent = 'Please consent to the use of your information before submitting.';
      valid = false;
    } else {
      consentErr.textContent = '';
    }

    if (!validateOptionalPercentage(pmp, document.getElementById('err-discount-pmp-percentage'))) { valid = false; }
    if (!validateOptionalPercentage(crisc, document.getElementById('err-discount-crisc-percentage'))) { valid = false; }
    if (!validateOptionalPercentage(prince2, document.getElementById('err-discount-prince2-percentage'))) { valid = false; }

    return valid;
  }

  const discountForm = document.getElementById('discount-request-form-el');
  const discountAlertEl = document.getElementById('discount-form-alert');
  const discountSubmitBtn = document.getElementById('discount-submit-btn');

  function showDiscountAlert(type, message) {
    const iconMap = { success: 'bi-check-circle-fill', danger: 'bi-exclamation-triangle-fill', warning: 'bi-exclamation-circle-fill' };
    discountAlertEl.className = `alert alert-${type} d-flex align-items-start gap-2 mt-3`;
    discountAlertEl.innerHTML = `<i class="bi ${iconMap[type] || 'bi-info-circle-fill'} flex-shrink-0 mt-1"></i><span>${message}</span>`;
    discountAlertEl.style.display = '';
    discountAlertEl.scrollIntoView({ behavior: 'smooth', block: 'nearest' });
  }

  if (discountForm) {
    discountForm.addEventListener('submit', async (e) => {
      e.preventDefault();

      if (!validateDiscountForm()) {
        showDiscountAlert('warning', 'Please correct the highlighted fields before submitting.');
        return;
      }

      discountSubmitBtn.disabled = true;
      discountSubmitBtn.innerHTML = '<span class="spinner-border spinner-border-sm me-2" role="status" aria-hidden="true"></span>Sending…';
      discountAlertEl.style.display = 'none';

      try {
        const response = await fetch(discountForm.action, {
          method: 'POST',
          headers: {
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
            'Accept': 'application/json',
          },
          body: new FormData(discountForm),
        });

        const data = await response.json();

        if (data.success) {
          showDiscountAlert('success', data.message);
          discountForm.reset();
          discountForm.querySelectorAll('.is-valid, .is-invalid').forEach(el => {
            el.classList.remove('is-valid', 'is-invalid');
          });
        } else if (data.errors) {
          const fieldMap = {
            name: ['discount-name', 'err-discount-name'],
            email: ['discount-email', 'err-discount-email'],
            consent: ['discount-consent', 'err-discount-consent'],
            pmp_discount_percentage: ['discount-pmp-percentage', 'err-discount-pmp-percentage'],
            crisc_discount_percentage: ['discount-crisc-percentage', 'err-discount-crisc-percentage'],
            prince2_discount_percentage: ['discount-prince2-percentage', 'err-discount-prince2-percentage'],
          };
          Object.entries(data.errors).forEach(([field, messages]) => {
            const mapped = fieldMap[field];
            if (!mapped) { return; }
            const [inputId, errId] = mapped;
            const inputEl = document.getElementById(inputId);
            const errEl = document.getElementById(errId);
            if (inputEl && errEl) {
              setFieldError(inputEl, errEl, messages[0]);
            }
          });
          showDiscountAlert('danger', data.message || 'Please correct the highlighted fields before submitting.');
        } else {
          showDiscountAlert('danger', data.message || 'Something went wrong. Please try again.');
        }
      } catch (err) {
        showDiscountAlert('danger', 'Something went wrong. Please try again or email us directly.');
      } finally {
        discountSubmitBtn.disabled = false;
        discountSubmitBtn.innerHTML = '<i class="bi bi-send me-2"></i>Send Request';
      }
    });
  }
</script>
@endpush
