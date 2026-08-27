@extends('layouts.site')

@section('title', 'CRISC Online Course | GISBA Consultants')
@section('meta_description', 'Join the GISBA CRISC Online Course — a live, instructor-led programme for IT risk and cybersecurity professionals, limited to 12 participants.')

@section('banner')
  <div class="d-flex justify-content-between align-items-center flex-wrap gap-2">
    <span><i class="bi bi-mortarboard me-2"></i>CRISC Online Course — Limited to 12 Participants</span>
    <div class="d-flex gap-3">
      <a href="#what-is-crisc"><i class="bi bi-info-circle me-1"></i>About</a>
      <a href="#schedule"><i class="bi bi-calendar-event me-1"></i>Schedule</a>
      <a href="#instructor"><i class="bi bi-person-badge me-1"></i>Instructor</a>
      <a href="{{ route('contact-us') }}"><i class="bi bi-envelope me-1"></i>Contact</a>
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
                  CRISC<br />
                  <span>Online Course</span>
                </h1>
                <p class="hero-subtitle">
                  CRISC has become one of the most in-demand certifications for cybersecurity and IT risk professionals. Following the successful completion of our first CRISC course, we're pleased to announce our second CRISC Online Course.
                </p>
                <p class="hero-desc">
                  This live, instructor-led course is limited to just 12 participants and is conducted by the author of multiple books, including <em>CRISC and Beyond</em>. Every participant receives a free copy of the author's book.
                </p>
                <div class="hero-actions mb-3">
                  <a href="{{ route('crisc-course.pricing') }}" class="btn-hero-primary">
                    <i class="bi bi-calendar-check me-2"></i>Reserve Your Seat — ${{ number_format((float) $pricing->crisc_price, 2) }}
                  </a>
                </div>
              </div>
              <div class="col-md-6 text-center">
                <img class="image-content img-fluid" src="{{ asset('assets/images/compliance.png') }}" alt="CRISC Online Course">
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
                <li><a href="#pricing"><i class="bi bi-tag"></i> Pricing</a></li>
                <li><a href="#what-is-crisc"><i class="bi bi-shield-check"></i> What is CRISC?</a></li>
                <li><a href="#schedule"><i class="bi bi-calendar-event"></i> Schedule &amp; Capacity</a></li>
                <li><a href="#instructor"><i class="bi bi-person-badge"></i> Instructor</a></li>
                <li><a href="#who-should-attend"><i class="bi bi-people"></i> Who Should Attend</a></li>
                <li><a href="#what-you-receive"><i class="bi bi-box-seam"></i> What You Receive</a></li>
                <li><a href="#method"><i class="bi bi-link-45deg"></i> Delivery Method</a></li>
              </ul>
            </nav>
            <div class="sidebar-contact">
              <strong><i class="bi bi-envelope me-1"></i>Contact GISBA</strong>
              <a href="{{ route('contact-us') }}">Contact Us</a>
            </div>
          </aside>
        </div>

        <div class="col-12 col-md-9">
          <main class="main-content">

            <section id="pricing">
              <h2 class="section-heading">Pricing — CRISC Online Course</h2>
              <div class="pricing-card" style="position:relative; overflow:visible;">

                <div style="
                  position:absolute;
                  top:-14px; left:50%; transform:translateX(-50%);
                  background:linear-gradient(90deg,#e63946,#c1121f);
                  color:#fff;
                  font-size:11px; font-weight:700; letter-spacing:.12em; text-transform:uppercase;
                  padding:5px 22px;
                  border-radius:20px;
                  box-shadow:0 3px 10px rgba(198,18,31,.35);
                  white-space:nowrap;
                  z-index:10;
                ">
                  <i class="bi bi-people-fill me-1"></i>Limited to {{ $pricing->crisc_capacity }} Participants
                </div>

                <div class="pricing-header" style="padding-top:28px;">
                  <div class="pricing-label">Live Online Course</div>

                  <div style="font-size:1.75rem; font-weight:800; color:#fff; margin:10px 0 2px; letter-spacing:-.02em;">
                    ${{ number_format((float) $pricing->crisc_price, 2) }}
                  </div>

                  <div class="pricing-sublabel">
                    {{ optional($pricing->crisc_date)->format('F j, Y') }} &middot; {{ $pricing->crisc_time_start }}&ndash;{{ $pricing->crisc_time_end }} ({{ $pricing->crisc_timezone }})
                  </div>
                </div>

                <div class="pricing-body">
                  <p class="pricing-includes-title">Your enrollment includes:</p>
                  <div class="pricing-includes">
                    <div class="pricing-include-item"><i class="bi bi-check-lg"></i> Live, instructor-led sessions</div>
                    <div class="pricing-include-item"><i class="bi bi-check-lg"></i> A free copy of "CRISC and Beyond"</div>
                    <div class="pricing-include-item"><i class="bi bi-check-lg"></i> Small-group format — max {{ $pricing->crisc_capacity }} participants</div>
                    <div class="pricing-include-item"><i class="bi bi-check-lg"></i> Direct access to the author and instructor</div>
                  </div>
                  <p style="font-size:12.5px; color:var(--text-muted); margin-top:16px; margin-bottom:0;">
                    <i class="bi bi-hourglass-split me-1"></i>{{ $pricing->crisc_seats_remaining }} of {{ $pricing->crisc_capacity }} seats remaining — enrollment closes once the course is full.
                  </p>
                  <div class="d-flex flex-column gap-2 mt-3">
                    <a href="{{ route('crisc-course.pricing') }}" class="btn-hero-primary d-block text-center">
                      <i class="bi bi-calendar-check me-2"></i>Reserve Your Seat
                    </a>
                  </div>
                </div>
              </div>
            </section>

            <section id="what-is-crisc">
              <h2 class="section-heading mt-4">What is CRISC?</h2>
              <p>
                <strong>Certified in Risk and Information Systems Control (CRISC)</strong> is one of the most
                respected certifications for professionals who identify and manage IT and enterprise risk,
                and design, implement, and maintain information systems controls.
              </p>
              <p>This course covers the core domains professionals need to master, including:</p>
              <div class="requirement-grid">
                <div class="requirement-item"><i class="bi bi-diagram-3-fill"></i><span>IT risk identification</span></div>
                <div class="requirement-item"><i class="bi bi-exclamation-triangle-fill"></i><span>IT risk assessment</span></div>
                <div class="requirement-item"><i class="bi bi-bell-fill"></i><span>Risk response and reporting</span></div>
                <div class="requirement-item"><i class="bi bi-link-45deg"></i><span>Risk and control monitoring</span></div>
                <div class="requirement-item"><i class="bi bi-clipboard2-check-fill"></i><span>Information systems control design</span></div>
                <div class="requirement-item"><i class="bi bi-clipboard2-check-fill"></i><span>Information systems control implementation</span></div>
              </div>
              <div class="info-box">
                <i class="bi bi-lightbulb-fill me-2 text-primary"></i>
                CRISC is one of the most demanding certifications for cybersecurity and IT professionals to earn.
                <strong>This live course is designed to help you prepare with direct guidance from a practising expert.</strong>
              </div>
            </section>

            <hr class="content-divider" />

            <section id="schedule">
              <h2 class="section-heading">Schedule &amp; Capacity</h2>
              <p>This is a live, one-day online course held on a single scheduled date.</p>
              <div class="checklist-group">
                <div class="checklist-item"><i class="bi bi-calendar3"></i><span>Date: {{ optional($pricing->crisc_date)->format('F j, Y') }}</span></div>
                <div class="checklist-item"><i class="bi bi-clock"></i><span>Time: {{ $pricing->crisc_time_start }}&ndash;{{ $pricing->crisc_time_end }} ({{ $pricing->crisc_timezone }})</span></div>
                <div class="checklist-item"><i class="bi bi-people-fill"></i><span>Capacity: limited to {{ $pricing->crisc_capacity }} participants</span></div>
              </div>
              <p class="mt-3">
                Keeping the group small ensures every participant gets direct interaction with the instructor
                and time to work through real-world risk scenarios together.
              </p>
            </section>

            <hr class="content-divider" />

            <section id="instructor">
              <h2 class="section-heading">Your Instructor</h2>
              <p>
                This course is conducted by the author of multiple books, including <strong>CRISC and Beyond</strong>.
                Every participant receives a free copy of the book as part of their enrollment.
              </p>
              <p>The course draws on decades of hands-on IT risk management and cybersecurity governance consulting experience across global organizations.</p>
            </section>

            <hr class="content-divider" />

            <section id="who-should-attend">
              <h2 class="section-heading">Who Should Attend?</h2>
              <p>This course is designed for <strong>IT and cybersecurity professionals working with enterprise risk</strong>, including:</p>
              <div class="audience-grid">
                <div class="audience-item"><i class="bi bi-person-badge-fill"></i><span>IT Risk Managers</span></div>
                <div class="audience-item"><i class="bi bi-shield-fill-check"></i><span>Cybersecurity Leaders</span></div>
                <div class="audience-item"><i class="bi bi-clipboard2-check-fill"></i><span>Compliance Managers</span></div>
                <div class="audience-item"><i class="bi bi-exclamation-octagon-fill"></i><span>IT Auditors</span></div>
                <div class="audience-item"><i class="bi bi-diagram-3-fill"></i><span>IT Governance Leaders</span></div>
                <div class="audience-item"><i class="bi bi-kanban-fill"></i><span>Professionals Preparing for CRISC Certification</span></div>
              </div>
            </section>

            <hr class="content-divider" />

            <section id="what-you-receive">
              <h2 class="section-heading">What You Receive</h2>
              <div class="checklist-group">
                <div class="checklist-item"><i class="bi bi-check-circle-fill"></i><span>A full live session with direct instructor access</span></div>
                <div class="checklist-item"><i class="bi bi-check-circle-fill"></i><span>A free copy of "CRISC and Beyond"</span></div>
                <div class="checklist-item"><i class="bi bi-check-circle-fill"></i><span>Small-group format with limited seats</span></div>
                <div class="checklist-item"><i class="bi bi-check-circle-fill"></i><span>Practical guidance grounded in real consulting experience</span></div>
              </div>
            </section>

            <hr class="content-divider" />

            <section id="method">
              <h2 class="section-heading">Delivery Method</h2>
              <p>After enrollment:</p>
              <ul>
                <li>You'll receive joining instructions for the live online session ahead of the course date.</li>
                <li>The session runs live on {{ optional($pricing->crisc_date)->format('F j, Y') }}, {{ $pricing->crisc_time_start }}&ndash;{{ $pricing->crisc_time_end }} ({{ $pricing->crisc_timezone }}).</li>
                <li>Your free copy of "CRISC and Beyond" will be arranged following enrollment.</li>
              </ul>
            </section>

          </main>
        </div>

      </div>
    </div>
  </div>

@endsection
