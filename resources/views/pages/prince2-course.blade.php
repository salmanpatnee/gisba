@extends('layouts.site')

@section('title', 'PRINCE2 Live Online Training | GISBA Consultants')
@section('meta_description', 'Join the GISBA PRINCE2 Live Online Training — a live, instructor-led programme comparing PRINCE2 with PMBOK, limited to ' . $pricing->prince2_capacity . ' participants.')

@section('banner')
  <div class="d-flex justify-content-between align-items-center flex-wrap gap-2">
    <span><i class="bi bi-diagram-3 me-2"></i>PRINCE2 Live Online Training — Limited to {{ $pricing->prince2_capacity }} Participants</span>
    <div class="d-flex gap-3">
      <a href="#what-is-prince2"><i class="bi bi-info-circle me-1"></i>About</a>
      <a href="#schedule"><i class="bi bi-calendar-event me-1"></i>Schedule</a>
      <a href="#leader"><i class="bi bi-person-badge me-1"></i>Course Leader</a>
      <a href="{{ route('contact-us') }}"><i class="bi bi-envelope me-1"></i>Contact</a>
    </div>
  </div>
@endsection

@section('footer_tagline')
  Project Management Training Development Services<br />
  Global Project Management Consulting &amp; Training.
@endsection

@section('content')

  <div class="page-layout" style="padding-bottom:0;">
    <div class="container">
      <div class="col-12">
        <main class="img-content">
          <section id="title" class="hero-section container">
            <div class="hero-banner-image mb-4">
              <img class="img-fluid rounded" src="{{ asset('assets/images/PRINCE2  Banner.jpeg') }}" alt="PRINCE2 Live Online Training">
            </div>
            <div class="row align-items-center">
              <div class="col-12">
                <h1 class="hero-title">
                  PRINCE2<br />
                  <span>Live Online Training</span>
                </h1>
                <p class="hero-subtitle">
                  PRINCE2 is one of the world's most widely recognized structured project management methods, providing a practical and scalable approach for managing projects of different sizes, complexities, and industries.
                </p>
                <p class="hero-desc">
                  Led by the author of the <em>Encyclopaedia of Project Management</em>, this training goes beyond simply teaching the methodology — it provides an in-depth understanding of PRINCE2 while continuously comparing its approach with PMBOK throughout the course.
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
                <li><a href="#what-is-prince2"><i class="bi bi-diagram-3"></i> What is PRINCE2?</a></li>
                <li><a href="#vs-pmbok"><i class="bi bi-arrow-left-right"></i> PRINCE2 vs PMBOK</a></li>
                <li><a href="#schedule"><i class="bi bi-calendar-event"></i> Schedule &amp; Capacity</a></li>
                <li><a href="#leader"><i class="bi bi-person-badge"></i> Course Leader</a></li>
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
              <h2 class="section-heading">Pricing — PRINCE2 Live Online Training</h2>
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
                  <i class="bi bi-people-fill me-1"></i>Limited to {{ $pricing->prince2_capacity }} Participants
                </div>

                <div class="pricing-header" style="padding-top:28px;">
                  <div class="pricing-label">Live Online Training</div>

                  <div style="font-size:1.75rem; font-weight:800; color:#fff; margin:10px 0 2px; letter-spacing:-.02em;">
                    ${{ number_format((float) $pricing->prince2_price, 2) }}
                  </div>

                  <div class="pricing-sublabel">
                    @if($pricing->prince2_date)
                      {{ $pricing->dateRangeFor('prince2') }}
                      @if($pricing->prince2_time_start)
                        &middot; {{ $pricing->prince2_time_start }}&ndash;{{ $pricing->prince2_time_end }} ({{ $pricing->prince2_timezone }})
                      @endif
                    @else
                      Date to be announced &middot; {{ $pricing->prince2_timezone }}
                    @endif
                  </div>
                </div>

                <div class="pricing-body">
                  <p class="pricing-includes-title">Your enrollment includes:</p>
                  <div class="pricing-includes">
                    <div class="pricing-include-item"><i class="bi bi-check-lg"></i> Live instructor-led PRINCE2 training</div>
                    <div class="pricing-include-item"><i class="bi bi-check-lg"></i> Comprehensive PRINCE2 course material</div>
                    <div class="pricing-include-item"><i class="bi bi-check-lg"></i> Live comparison between PRINCE2 and PMBOK throughout the training</div>
                    <div class="pricing-include-item"><i class="bi bi-check-lg"></i> Plenty of quizzes and knowledge checks</div>
                    <div class="pricing-include-item"><i class="bi bi-check-lg"></i> Small-group format — max {{ $pricing->prince2_capacity }} participants</div>
                    <div class="pricing-include-item"><i class="bi bi-check-lg"></i> 35 PDU Hours Certificate of Completion</div>
                  </div>
                  <p style="font-size:12.5px; color:var(--text-muted); margin-top:16px; margin-bottom:0;">
                    <i class="bi bi-hourglass-split me-1"></i>{{ $pricing->prince2_seats_remaining }} of {{ $pricing->prince2_capacity }} seats remaining — enrollment closes once the course reaches capacity.
                  </p>
                  <div class="d-flex flex-row gap-2 mt-3">
                    <span class="btn-closed flex-fill">
                      <span class="btn-closed-label"><i class="bi bi-slash-circle"></i>Session Closed</span>
                      <span class="btn-closed-date">05th Oct 2026</span>
                    </span>
                    <a href="{{ route('prince2.pricing') }}" class="btn-hero-primary flex-fill text-center">
                      <i class="bi bi-calendar-check me-2"></i>Reserve Your Seat
                    </a>
                  </div>
                </div>
              </div>
            </section>

            <section id="what-is-prince2">
              <h2 class="section-heading mt-4">What is PRINCE2?</h2>
              <p>
                <strong>PRINCE2 Project Management</strong> is a structured project management method designed to provide organizations
                and project professionals with a clear framework for directing, managing, and delivering projects successfully.
              </p>
              <p>The current PRINCE2 Project Management (Version 7) framework includes:</p>
              <div class="requirement-grid">
                <div class="requirement-item"><i class="bi bi-flag-fill"></i><span>Seven PRINCE2 Principles</span></div>
                <div class="requirement-item"><i class="bi bi-gear-fill"></i><span>Seven PRINCE2 Practices</span></div>
                <div class="requirement-item"><i class="bi bi-diagram-3-fill"></i><span>Seven PRINCE2 Processes</span></div>
                <div class="requirement-item"><i class="bi bi-people-fill"></i><span>People as an integrated element</span></div>
                <div class="requirement-item"><i class="bi bi-sliders"></i><span>Tailoring to the project environment</span></div>
                <div class="requirement-item"><i class="bi bi-arrow-repeat"></i><span>Traditional, agile, incremental &amp; hybrid delivery</span></div>
              </div>
              <div class="info-box">
                <i class="bi bi-lightbulb-fill me-2 text-primary"></i>
                Our PRINCE2 Live Online Training helps participants understand not only what PRINCE2 requires, but also why the
                methodology works, how it can be applied, and how it compares with other project management approaches.
              </div>
            </section>

            <hr class="content-divider" />

            <section id="vs-pmbok">
              <h2 class="section-heading">PRINCE2 vs PMBOK — Learn Both Perspectives</h2>
              <p>
                One of the distinctive features of this training is the continuous live comparison between PRINCE2 and the PMBOK
                methodology throughout the course. Rather than studying PRINCE2 in isolation, participants will understand how its
                principles, practices, processes, governance structure, roles, controls, and management products relate to concepts
                commonly used within the PMBOK framework.
              </p>
              <p>This live comparison is particularly valuable for professionals who already have experience with PMI-based project management or who want to understand the wider project management landscape rather than preparing for a certification in isolation.</p>
            </section>

            <hr class="content-divider" />

            <section id="schedule">
              <h2 class="section-heading">Schedule &amp; Capacity</h2>
              <p>This is a live, instructor-led online PRINCE2 training program delivered according to a structured training schedule.</p>
              <div class="checklist-group">
                <div class="checklist-item"><i class="bi bi-calendar3"></i><span>Date: {{ $pricing->dateRangeFor('prince2') ?? 'To be announced' }}</span></div>
                @php($prince2Time = $pricing->prince2_time_start ? "{$pricing->prince2_time_start}\u{2013}{$pricing->prince2_time_end}" : 'TBC')
                <div class="checklist-item"><i class="bi bi-clock"></i><span>Time: {{ $prince2Time }} ({{ $pricing->prince2_timezone }})</span></div>
                <div class="checklist-item"><i class="bi bi-people-fill"></i><span>Capacity: limited to {{ $pricing->prince2_capacity }} participants</span></div>
              </div>
              <p class="mt-3">
                The training group is intentionally kept small, giving participants more opportunities to interact directly with the
                course leader, ask questions, discuss practical project situations, participate in quizzes, and clarify difficult concepts.
              </p>
            </section>

            <hr class="content-divider" />

            <section id="leader">
              <h2 class="section-heading">Your Course Leader</h2>
              <p>
                The PRINCE2 Live Online Training is led by the author of the <strong>Encyclopaedia of Project Management</strong>,
                bringing extensive project management knowledge and professional experience into every session. The course leader has
                conducted professional training for Fortune 500 companies.
              </p>
              <p>
                Throughout the program, the course leader connects PRINCE2 concepts with practical project management situations and
                continuously compares them with corresponding PMBOK concepts.
              </p>
            </section>

            <hr class="content-divider" />

            <section id="who-should-attend">
              <h2 class="section-heading">Who Should Attend?</h2>
              <p>This training is suitable for professionals who manage projects, participate in projects, provide project governance or assurance, or want to develop a structured understanding of project management, including:</p>
              <div class="audience-grid">
                <div class="audience-item"><i class="bi bi-person-badge-fill"></i><span>Project &amp; Program Managers</span></div>
                <div class="audience-item"><i class="bi bi-diagram-2-fill"></i><span>PMO Managers &amp; Professionals</span></div>
                <div class="audience-item"><i class="bi bi-clipboard2-check-fill"></i><span>Project Directors &amp; Sponsors</span></div>
                <div class="audience-item"><i class="bi bi-people-fill"></i><span>Business Analysts &amp; Change Managers</span></div>
                <div class="audience-item"><i class="bi bi-exclamation-octagon-fill"></i><span>Risk &amp; Quality Managers</span></div>
                <div class="audience-item"><i class="bi bi-award-fill"></i><span>PMP-Certified Professionals</span></div>
                <div class="audience-item"><i class="bi bi-briefcase-fill"></i><span>Consultants &amp; Product Managers</span></div>
                <div class="audience-item"><i class="bi bi-mortarboard-fill"></i><span>Professionals Preparing for PRINCE2 Certification</span></div>
              </div>
            </section>

            <hr class="content-divider" />

            <section id="what-you-receive">
              <h2 class="section-heading">What You Receive</h2>
              <div class="checklist-group">
                <div class="checklist-item"><i class="bi bi-check-circle-fill"></i><span>Live instructor-led sessions with direct interaction with the course leader</span></div>
                <div class="checklist-item"><i class="bi bi-check-circle-fill"></i><span>Access to knowledge from the author of the Encyclopedia of Project Management</span></div>
                <div class="checklist-item"><i class="bi bi-check-circle-fill"></i><span>Live PRINCE2 and PMBOK comparison throughout the training</span></div>
                <div class="checklist-item"><i class="bi bi-check-circle-fill"></i><span>Comprehensive course material covering PRINCE2 Project Management</span></div>
                <div class="checklist-item"><i class="bi bi-check-circle-fill"></i><span>Plenty of quizzes and knowledge checks</span></div>
                <div class="checklist-item"><i class="bi bi-check-circle-fill"></i><span>A limited group for more individual interaction and clarification</span></div>
              </div>
            </section>

            <hr class="content-divider" />

            <section id="method">
              <h2 class="section-heading">Delivery Method</h2>
              <p>After enrollment:</p>
              <ul>
                <li>You'll receive confirmation of your registration and joining instructions for the online sessions before the training begins.</li>
                <li>Participants will receive applicable PRINCE2 course material for use during the program.</li>
                <li>Relevant PRINCE2 concepts will be continuously compared with PMBOK concepts during the training.</li>
                <li>Participants will complete quizzes and knowledge checks throughout the sessions.</li>
              </ul>
            </section>

          </main>
        </div>

      </div>
    </div>
  </div>

@endsection
