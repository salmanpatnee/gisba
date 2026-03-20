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
                <li><a href="#what-is-nis2"><i class="bi bi-shield-check"></i> What is NIS2?</a></li>
                <li><a href="#fast-track"><i class="bi bi-lightning-charge"></i> Fast Track</a></li>
                <li><a href="#experts"><i class="bi bi-person-badge"></i> Our Experts</a></li>
                <li><a href="#whats-included"><i class="bi bi-box-seam"></i> What's Included</a></li>
                {{-- <li><a href="#includes"><i class="bi bi-journal-bookmark"></i> Toolkit Includes</a></li> --}}
                <li><a href="#who-should-use"><i class="bi bi-people"></i> Who Should Use</a></li>
                {{-- <li><a href="#audience"><i class="bi bi-grid"></i> Audience</a></li> --}}
                {{-- <li><a href="#why-gisba"><i class="bi bi-award"></i> Why GISBA</a></li> --}}
                <li><a href="#format"><i class="bi bi-eye"></i> File Format</a></li>
                <li><a href="#method"><i class="bi bi-link-45deg"></i> Delivery Method</a></li>
                <li><a href="#pricing"><i class="bi bi-tag"></i> Pricing</a></li>
                <li><a href="{{ route('nis2.pricing') }}"><i class="bi bi-cart-check"></i> Buy Now</a></li>
              </ul>
            </nav>
            <div class="sidebar-contact">
              <strong><i class="bi bi-envelope me-1"></i>Contact GISBA</strong>
              <a href="mailto:support@gisba.net">support@gisba.net</a>
            </div>
          </aside>
        </div>

        <div class="col-12 col-md-9">
          <main class="main-content">

            <section id="what-is-nis2">
              <h2 class="section-heading">What is NIS2 Compliance?</h2>
              <p>
                The <strong>Network and Information Systems Directive (NIS2 – EU Directive 2022/2555)</strong>
                is the European Union's updated cybersecurity directives designed to strengthen the security
                and resilience of critical infrastructure and digital services across the EU.
              </p>
              <p>Organizations affected by the directive must implement:</p>
              <div class="requirement-grid">
                <div class="requirement-item"><i class="bi bi-diagram-3-fill"></i><span>Cybersecurity governance frameworks</span></div>
                <div class="requirement-item"><i class="bi bi-exclamation-triangle-fill"></i><span>Risk management framework</span></div>
                <div class="requirement-item"><i class="bi bi-bell-fill"></i><span>Incident reporting mechanisms</span></div>
                <div class="requirement-item"><i class="bi bi-link-45deg"></i><span>Supply chain security measures</span></div>
                <div class="requirement-item"><i class="bi bi-clipboard2-check-fill"></i><span>Compliance monitoring and audits</span></div>
                <div class="requirement-item"><i class="bi bi-clipboard2-check-fill"></i><span>Business continuity and crises management</span></div>
              </div>
              <div class="info-box">
                <i class="bi bi-lightbulb-fill me-2 text-primary"></i>
                Implementing these requirements can be complex and time-consuming without structured frameworks
                and templates. <strong>The GISBA NIS2 Implementation Kit simplifies the entire process.</strong>
              </div>
            </section>

            <hr class="content-divider" />

            <section id="fast-track">
              <h2 class="section-heading">NIS2 Implementation Kit – Fast Track Your Compliance</h2>
              <p>The GISBA NIS2 Implementation Kit is designed to help organizations:</p>
              <div class="checklist-group">
                <div class="checklist-item"><i class="bi bi-check-circle-fill"></i><span>Accelerate NIS2 Directive implementation</span></div>
                <div class="checklist-item"><i class="bi bi-check-circle-fill"></i><span>Avoid months of policy development</span></div>
                <div class="checklist-item"><i class="bi bi-check-circle-fill"></i><span>Reduce dependency on expensive consultants</span></div>
                <div class="checklist-item"><i class="bi bi-check-circle-fill"></i><span>Implement cybersecurity governance frameworks quickly</span></div>
              </div>
              <p class="mt-3">
                Instead of building compliance programs from scratch, your team receives
                <strong>ready-to-customise frameworks and templates</strong> aligned with NIS2 requirements.
              </p>
            </section>

            <hr class="content-divider" />

            <section id="experts">
              <h2 class="section-heading">Built by Global Cybersecurity Experts</h2>
              <p>The NIS2 Implementation Kit was developed under the leadership of a Principal Consultant with 25 years of experience, holding CISSP, CISA, CISM, CGEIT, CRISC, MBCP, ITIL Master, and PMP certifications, along with a team of senior consultants.</p>
            </section>

            <hr class="content-divider" />

            <section id="whats-included">
              <h2 class="section-heading">What is Included in the NIS2 Implementation Kit?</h2>
              <p>
                The GISBA NIS2 Compliance Toolkit provides comprehensive frameworks covering NIS2
                implementation requirements. Each framework includes the following components.
              </p>

              <div class="inclusion-card">
                <div class="inclusion-number">1</div>
                <div class="inclusion-body">
                  <h4 class="inclusion-title">NIS2 Implementation Framework</h4>
                  <p>The implementation kit includes all editable policies, procedures, roles and responsibilities, KPIs, and forms. The following sixteen (16) frameworks are part of the package.</p>
                  <ol>
                    <li>Cybersecurity Governance Framework</li>
                    <li>Policies and Procedure Management Framework</li>
                    <li>Risk Management Framework</li>
                    <li>Human Resource Framework</li>
                    <li>Cybersecurity Training & Awareness Framework</li>
                    <li>Asset Management Framework</li>
                    <li>Identity and Access Management Framework</li>
                    <li>Network Security Framework</li>
                    <li>Cryptography Framework</li>
                    <li>Backup & Recovery Management Framework</li>
                    <li>Vulnerability & Penetration Testing Framework</li>
                    <li>Incident Handling Framework</li>
                    <li>Physical Security Framework</li>
                    <li>Application Development Framework</li>
                    <li>Business Continuity and Crises Management Framework</li>
                    <li>Supply Chain Framework</li>
                  </ol>
                  <p class="inclusion-note">These documents provide the foundation of your NIS2 compliance program.</p>
                </div>
              </div>

              <div class="inclusion-card">
                <div class="inclusion-number">2</div>
                <div class="inclusion-body">
                  <h4 class="inclusion-title">Completed Implementation Example</h4>
                  <p>To help organizations understand how to implement the frameworks, the toolkit includes completed examples for a fictitious organization. This provides a clear demonstration of:</p>
                  <ul>
                    <li>How templates should be completed</li>
                    <li>How policies should be structured</li>
                    <li>How compliance documentation should be organized</li>
                  </ul>
                </div>
              </div>

              <div class="inclusion-card">
                <div class="inclusion-number">3</div>
                <div class="inclusion-body">
                  <h4 class="inclusion-title">NIS2 Implementation Video Guidance</h4>
                  <p>Each framework includes video explanations covering:</p>
                  <ul>
                    <li>Domain overview</li>
                    <li>NIS2 requirements explanation</li>
                    <li>Step-by-step implementation guidance</li>
                  </ul>
                  <p class="inclusion-note">This ensures teams understand both the technical requirements and practical implementation steps.</p>
                </div>
              </div>

              <div class="inclusion-card">
                <div class="inclusion-number">4</div>
                <div class="inclusion-body">
                  <h4 class="inclusion-title">NIS2 Implementation and Audit Checklist</h4>
                  <p>The toolkit includes structured audit and implementation checklists to help organizations:</p>
                  <ul>
                    <li>Track compliance progress</li>
                    <li>Prepare for regulatory audits</li>
                    <li>Verify framework implementation</li>
                  </ul>
                </div>
              </div>
            </section>

            {{-- <hr class="content-divider" />

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
            </section> --}}

            <hr class="content-divider" />

            <section id="who-should-use">
              <h2 class="section-heading">Who Should Use the NIS2 Implementation Kit?</h2>
              <p>This toolkit is designed for <strong>corporate organizations implementing NIS2 cybersecurity compliance</strong>, including:</p>
              <div class="audience-grid">
                <div class="audience-item"><i class="bi bi-person-badge-fill"></i><span>Chief Information Security Officers (CISOs)</span></div>
                <div class="audience-item"><i class="bi bi-shield-fill-check"></i><span>Cybersecurity Leaders</span></div>
                <div class="audience-item"><i class="bi bi-clipboard2-check-fill"></i><span>Compliance Managers</span></div>
                <div class="audience-item"><i class="bi bi-exclamation-octagon-fill"></i><span>Risk Management Teams</span></div>
                <div class="audience-item"><i class="bi bi-diagram-3-fill"></i><span>IT Governance Leaders</span></div>
                <div class="audience-item"><i class="bi bi-kanban-fill"></i><span>Security Project Managers</span></div>
              </div>
              <div class="info-box mt-3">
                <i class="bi bi-info-circle-fill me-2 text-primary"></i>
                Organizations implementing EU cybersecurity regulations can significantly reduce implementation time using structured frameworks.
              </div>
            </section>

            {{-- <hr class="content-divider" />

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
            </section> --}}

            <hr class="content-divider" />

            <section id="why-gisba">
              <h2 class="section-heading">Why Choose GISBA NIS2 Implementation Kit?</h2>
              <p>Organizations choose GISBA because of its deep consulting expertise and practical implementation approach. Benefits include:</p>
              <div class="checklist-group">
                <div class="checklist-item"><i class="bi bi-check-circle-fill"></i><span>Developed by certified cybersecurity professionals</span></div>
                <div class="checklist-item"><i class="bi bi-check-circle-fill"></i><span>Based on decades of enterprise consulting experience</span></div>
                <div class="checklist-item"><i class="bi bi-check-circle-fill"></i><span>Ready-to-deploy compliance frameworks</span></div>
                <div class="checklist-item"><i class="bi bi-check-circle-fill"></i><span>Easy-to-edit implementation templates</span></div>
                <div class="checklist-item"><i class="bi bi-check-circle-fill"></i><span>Video guidance for faster implementation</span></div>
                <div class="checklist-item"><i class="bi bi-check-circle-fill"></i><span>Implementation and audit checklists</span></div>
              </div>
            </section>

            <hr class="content-divider" />

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
                <li>After the demo has been delivered, we will provide the payment link.</li>
                <li>Upon receipt of payment, the complete “NIS2 Implementation Kit” access link will be provided on the same day.</li>
              </ul>
            </section>

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
                  <div class="d-flex flex-column gap-2 mt-3">
                    <a href="{{ route('nis2.pricing') }}" class="btn-hero-primary d-block text-center">
                      <i class="bi bi-cart-check me-2"></i>View Pricing &amp; Buy Now
                    </a>
                    <a href="{{ route('contact-us') }}" class="btn-hero-secondary d-block text-center" style="color: var(--navy) !important; border-color: var(--border-mid);">
                      <i class="bi bi-calendar-check me-2"></i>Request a Demo
                    </a>
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
