@extends('layouts.site')

@section('title', 'CISSP Live Online Training | GISBA Consultants')
@section('meta_description', 'Join the GISBA CISSP Live Online Training — a live, instructor-led programme for experienced cybersecurity professionals, limited to ' . $pricing->cissp_capacity . ' participants.')

@section('banner')
  <div class="d-flex justify-content-between align-items-center flex-wrap gap-2">
    <span><i class="bi bi-shield-lock me-2"></i>CISSP Live Online Training</span>
    <div class="d-flex gap-3">
      <a href="#what-is-cissp"><i class="bi bi-info-circle me-1"></i>About</a>
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

  <div class="page-layout" style="padding-bottom:0;">
    <div class="container">
      <div class="col-12">
        <main class="img-content">
          <section id="title" class="hero-section container">
            <div class="hero-banner-image mb-4">
              <img class="img-fluid rounded" src="{{ asset('assets/images/CISSP Banner.png') }}" alt="CISSP Live Online Training">
            </div>
            <div class="row align-items-center">
              <div class="col-12">
                <h1 class="hero-title">
                  CISSP<br />
                  <span>Live Online Training</span>
                </h1>
                <p class="hero-subtitle">
                  CISSP is one of the world's most recognized and respected cybersecurity certifications for experienced information security professionals, managers, consultants, architects, and security leaders.
                </p>
                <p class="hero-desc">
                  Led by an experienced cybersecurity course leader who has delivered professional training for Fortune 500 companies, this live, intentionally small-group programme combines structured exam preparation with practical insights, interactive discussions, comprehensive course material, and plenty of quizzes to reinforce your understanding.
                </p>
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
                <li><a href="#what-is-cissp"><i class="bi bi-shield-check"></i> What is CISSP?</a></li>
                <li><a href="#schedule"><i class="bi bi-calendar-event"></i> Schedule &amp; Capacity</a></li>
                <li><a href="#instructor"><i class="bi bi-person-badge"></i> Instructor</a></li>
                <li><a href="#who-should-attend"><i class="bi bi-people"></i> Who Should Attend</a></li>
                <li><a href="#what-you-receive"><i class="bi bi-box-seam"></i> What You Receive</a></li>
                <li><a href="#why-choose"><i class="bi bi-star"></i> Why Choose Us</a></li>
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
              <h2 class="section-heading">Pricing — CISSP Live Online Training</h2>
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
                  <i class="bi bi-people-fill me-1"></i>Limited to {{ $pricing->cissp_capacity }} Participants
                </div>

                <div class="pricing-header" style="padding-top:28px;">
                  <div class="pricing-label">Live Online Training</div>

                  <div style="font-size:1.75rem; font-weight:800; color:#fff; margin:10px 0 2px; letter-spacing:-.02em;">
                    ${{ number_format((float) $pricing->cissp_price, 2) }}
                  </div>

                  <div class="pricing-sublabel">
                    @if($pricing->cissp_date)
                      {{ $pricing->dateRangeFor('cissp') }}
                      @if($pricing->cissp_time_start)
                        &middot; {{ $pricing->cissp_time_start }}&ndash;{{ $pricing->cissp_time_end }} ({{ $pricing->cissp_timezone }})
                      @endif
                    @else
                      Date to be announced &middot; {{ $pricing->cissp_timezone }}
                    @endif
                  </div>
                </div>

                <div class="pricing-body">
                  <p class="pricing-includes-title">Your enrollment includes:</p>
                  <div class="pricing-includes">
                    <div class="pricing-include-item"><i class="bi bi-check-lg"></i> Live, instructor-led CISSP training</div>
                    <div class="pricing-include-item"><i class="bi bi-check-lg"></i> Comprehensive CISSP course material</div>
                    <div class="pricing-include-item"><i class="bi bi-check-lg"></i> Plenty of practice quizzes and knowledge checks</div>
                    <div class="pricing-include-item"><i class="bi bi-check-lg"></i> Small-group format — max {{ $pricing->cissp_capacity }} participants</div>
                    <div class="pricing-include-item"><i class="bi bi-check-lg"></i> Direct access to an experienced cybersecurity trainer</div>
                    <div class="pricing-include-item"><i class="bi bi-check-lg"></i> Certificate of Participation</div>
                  </div>
                  <div class="d-flex flex-row gap-2 mt-3">
                    <span class="btn-closed flex-fill">
                      <span class="btn-closed-label"><i class="bi bi-slash-circle"></i>Session Closed</span>
                      <span class="btn-closed-date">07th – 10th Sep 2026</span>
                    </span>
                    <a href="{{ route('cissp.pricing') }}" class="btn-hero-primary flex-fill text-center">
                      <i class="bi bi-calendar-check me-2"></i>Reserve Your Seat
                    </a>
                  </div>
                </div>
              </div>
            </section>

            <section id="what-is-cissp">
              <h2 class="section-heading mt-4">What is CISSP?</h2>
              <p>
                The <strong>Certified Information Systems Security Professional (CISSP)</strong> certification is designed for experienced
                cybersecurity professionals who want to demonstrate broad technical and managerial knowledge across information security.
              </p>
              <p>The CISSP Common Body of Knowledge covers eight major domains:</p>
              <div class="requirement-grid">
                <div class="requirement-item"><i class="bi bi-diagram-3-fill"></i><span>Security and Risk Management</span></div>
                <div class="requirement-item"><i class="bi bi-hdd-network-fill"></i><span>Asset Security</span></div>
                <div class="requirement-item"><i class="bi bi-bricks"></i><span>Security Architecture and Engineering</span></div>
                <div class="requirement-item"><i class="bi bi-broadcast"></i><span>Communication and Network Security</span></div>
                <div class="requirement-item"><i class="bi bi-person-badge-fill"></i><span>Identity and Access Management (IAM)</span></div>
                <div class="requirement-item"><i class="bi bi-clipboard2-check-fill"></i><span>Security Assessment and Testing</span></div>
                <div class="requirement-item"><i class="bi bi-gear-fill"></i><span>Security Operations</span></div>
                <div class="requirement-item"><i class="bi bi-code-slash"></i><span>Software Development Security</span></div>
              </div>
              <div class="info-box">
                <i class="bi bi-lightbulb-fill me-2 text-primary"></i>
                Our CISSP Live Online Training helps participants connect topics across different domains, identify important
                examination concepts, and develop the mindset required to approach CISSP questions effectively.
              </div>
            </section>

            <hr class="content-divider" />

            <section id="schedule">
              <h2 class="section-heading">Schedule &amp; Capacity</h2>
              <p>This is a live, instructor-led online CISSP training program conducted according to a structured training schedule.</p>
              <div class="checklist-group">
                <div class="checklist-item"><i class="bi bi-calendar3"></i><span>Date: {{ $pricing->dateRangeFor('cissp') ?? 'To be announced' }}</span></div>
                @php($cisspTime = $pricing->cissp_time_start ? "{$pricing->cissp_time_start}\u{2013}{$pricing->cissp_time_end}" : 'TBC')
                <div class="checklist-item"><i class="bi bi-clock"></i><span>Time: {{ $cisspTime }} ({{ $pricing->cissp_timezone }})</span></div>
                <div class="checklist-item"><i class="bi bi-people-fill"></i><span>Capacity: limited to {{ $pricing->cissp_capacity }} participants</span></div>
              </div>
              <p class="mt-3">
                Keeping the group intentionally small creates a more effective learning environment, with greater opportunities to
                interact directly with the instructor, discuss difficult CISSP topics, ask questions, work through practice questions,
                and clarify concepts that are frequently misunderstood during exam preparation.
              </p>
            </section>

            <hr class="content-divider" />

            <section id="instructor">
              <h2 class="section-heading">Your Instructor</h2>
              <p>
                The CISSP Live Online Training is led by an experienced cybersecurity course leader with extensive professional
                training and consulting experience, who has conducted professional training programs for Fortune 500 companies.
              </p>
              <p>
                Rather than relying entirely on theoretical explanations, complex CISSP concepts are connected with practical
                situations, organizational challenges, and real-world cybersecurity decision-making — giving participants both
                structured CISSP exam preparation and practical professional experience.
              </p>
            </section>

            <hr class="content-divider" />

            <section id="who-should-attend">
              <h2 class="section-heading">Who Should Attend?</h2>
              <p>This training is designed for <strong>experienced IT and cybersecurity professionals</strong> preparing for CISSP certification or wanting to strengthen their knowledge across the major cybersecurity domains, including:</p>
              <div class="audience-grid">
                <div class="audience-item"><i class="bi bi-person-badge-fill"></i><span>Chief Information Security Officers</span></div>
                <div class="audience-item"><i class="bi bi-shield-fill-check"></i><span>Cybersecurity &amp; Information Security Managers</span></div>
                <div class="audience-item"><i class="bi bi-clipboard2-check-fill"></i><span>Security Consultants &amp; Architects</span></div>
                <div class="audience-item"><i class="bi bi-diagram-3-fill"></i><span>Security Engineers &amp; Analysts</span></div>
                <div class="audience-item"><i class="bi bi-hdd-network-fill"></i><span>IT Managers, Directors &amp; Auditors</span></div>
                <div class="audience-item"><i class="bi bi-kanban-fill"></i><span>Risk, Governance &amp; Compliance Professionals</span></div>
                <div class="audience-item"><i class="bi bi-broadcast-pin"></i><span>Network &amp; Infrastructure Security Professionals</span></div>
                <div class="audience-item"><i class="bi bi-mortarboard-fill"></i><span>Professionals Preparing for CISSP Certification</span></div>
              </div>
            </section>

            <hr class="content-divider" />

            <section id="what-you-receive">
              <h2 class="section-heading">What You Receive</h2>
              <div class="checklist-group">
                <div class="checklist-item"><i class="bi bi-check-circle-fill"></i><span>Live instructor-led sessions with direct access to an experienced cybersecurity instructor</span></div>
                <div class="checklist-item"><i class="bi bi-check-circle-fill"></i><span>Comprehensive course material covering all eight CISSP domains</span></div>
                <div class="checklist-item"><i class="bi bi-check-circle-fill"></i><span>Plenty of quizzes and knowledge checks to reinforce key concepts</span></div>
                <div class="checklist-item"><i class="bi bi-check-circle-fill"></i><span>Practical exam preparation from a risk-based, real-world perspective</span></div>
                <div class="checklist-item"><i class="bi bi-check-circle-fill"></i><span>Highly interactive sessions with continuous instructor participation</span></div>
                <div class="checklist-item"><i class="bi bi-check-circle-fill"></i><span>A limited group for more individual interaction and clarification</span></div>
              </div>
            </section>

            <hr class="content-divider" />

            <section id="why-choose">
              <h2 class="section-heading">Why Choose Our CISSP Live Online Training?</h2>
              <p>
                CISSP covers an extensive range of cybersecurity topics, and preparing for the examination independently can become
                overwhelming. The challenge is often not understanding individual technologies but learning how to connect technical,
                managerial, governance, and risk concepts and apply them appropriately.
              </p>
              <p>
                Our training provides a structured path through the CISSP domains, helping participants concentrate on important
                concepts while understanding how different areas of cybersecurity relate to each other. The course leader's experience
                delivering professional training for Fortune 500 companies brings an additional practical dimension to the program.
              </p>
            </section>

            <hr class="content-divider" />

            <section id="method">
              <h2 class="section-heading">Delivery Method</h2>
              <p>After enrollment:</p>
              <ul>
                <li>You'll receive confirmation of your registration and joining instructions for the live online sessions before the training begins.</li>
                <li>Participants will receive the applicable CISSP course material for use during the program.</li>
                <li>Quizzes and knowledge checks will be conducted throughout the training to reinforce important CISSP concepts.</li>
                <li>The program covers the eight CISSP domains in a structured manner while emphasizing practical understanding and examination preparation.</li>
              </ul>
            </section>

          </main>
        </div>

      </div>
    </div>
  </div>

@endsection
