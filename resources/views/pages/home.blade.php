@extends('layouts.site')

@section('title', 'NIS2 Implementation Kit | NIS2 Compliance Toolkit for EU Directive 2022/2555')
@section('meta_description', 'Accelerate NIS2 Directive compliance with the GISBA NIS2 Implementation Kit. Includes policies, templates, implementation frameworks, and audit checklists for corporates.')

@section('banner')
  <div class="d-flex justify-content-between align-items-center flex-wrap gap-2">
    <span><i class="bi bi-shield-lock me-2"></i>GISBA: NIS2 Implementation Kit — EU Directive 2022/2555 Compliance Toolkit</span>
    <div class="d-flex gap-3">
      <a href="#about"><i class="bi bi-info-circle me-1"></i>About</a>
      <a href="#whats-included"><i class="bi bi-box-seam me-1"></i>Included</a>
      <a href="#pricing"><i class="bi bi-tag me-1"></i>Pricing</a>
      <a href="#contact"><i class="bi bi-envelope me-1"></i>Contact</a>
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

      <div class="col-12">
        <main class="img-content">
          <section class="hero-section container">
            <div class="row align-items-center">
              <div class="col-md-6">
                <h1 class="hero-title">
                  GISBA Consultants
                  <span>Co. W.L.L.</span>
                </h1>
                <p class="hero-desc">
                  GISBA Consultants has been serving organizations worldwide since 2006, supporting clients across three continents and advising C-level executives and Fortune 500 companies on Cybersecurity Governance, Risk Management, Regulatory Compliance, Project Management, ISO Implementations, and Training Courses.
                </p>
                <p class="hero-desc">
                  Recently, we made a strategic shift to meet the latest NIS2 requirements by transforming our experience into a digital NIS2 Implementation Kit.
                </p>
              </div>
              <div class="col-md-6 text-center">
                <img class="image-content img-fluid" src="{{ asset('assets/images/financial_institution.jpg') }}" alt="GISBA Cybersecurity Consulting">
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
                <li><a href="#about"><i class="bi bi-info-circle"></i> About</a></li>
                <li><a href="#european-partners"><i class="bi bi-people-fill"></i> European Partners</a></li>
                <li><a href="#what-is-nis2"><i class="bi bi-shield-check"></i> What is NIS2?</a></li>
                <li><a href="#fast-track"><i class="bi bi-lightning-charge"></i> Fast Track</a></li>
                <li><a href="#experts"><i class="bi bi-person-badge"></i> Our Experts</a></li>
                <li><a href="#whats-included"><i class="bi bi-box-seam"></i> What's Included</a></li>
                <li><a href="#who-should-use"><i class="bi bi-people"></i> Who Should Use</a></li>
                <li><a href="#why-gisba"><i class="bi bi-award"></i> Why GISBA</a></li>
                <li><a href="#pricing"><i class="bi bi-tag"></i> Pricing</a></li>
                {{-- <li><a href="#satisfaction-guarantee"><i class="bi bi-shield-fill-check"></i> Guarantee</a></li>
                <li><a href="#contact"><i class="bi bi-envelope"></i> Contact</a></li> --}}
              </ul>
            </nav>
            <div class="sidebar-contact">
              <strong><i class="bi bi-envelope me-1"></i>Contact GISBA</strong>
              <a href="mailto:support@gisba.net">support@gisba.net</a><br />
              {{-- <a href="tel:+97338397453">+973 3839 7453</a> --}}
            </div>
          </aside>
        </div>

        <div class="col-12 col-md-9">
          <main class="main-content">

            <section class="hero-section">
              <div class="hero-badge">
                <i class="bi bi-shield-lock-fill me-2"></i>EU Directive 2022/2555
              </div>
              <h1 class="hero-title">NIS2 Implementation Kit<br /><span>for Corporates</span></h1>
              <p class="hero-subtitle">Complete NIS2 Compliance Toolkit for EU Directive 2022/2555</p>
              <p class="hero-desc">
                Implement NIS2 Directive (EU) 2022/2555 compliance faster using a professionally developed
                NIS2 Implementation Kit designed for corporate organizations. The GISBA NIS2 Implementation
                Kit provides ready-to-deploy frameworks, policy templates, implementation guidance, and audit
                checklists that help organizations accelerate their NIS2 cybersecurity compliance program.
              </p>
              <p class="hero-desc">
                Developed by <strong>GISBA Consultants Co. W.L.L.</strong>, this toolkit consolidates
                <strong>20+ years of global cybersecurity consulting experience</strong> into a practical
                solution that allows organizations to implement NIS2 quickly, efficiently, and cost-effectively.
              </p>
              <div class="hero-actions">
                <a href="#pricing" class="btn-hero-primary">
                  <i class="bi bi-calendar-check me-2"></i>Request a Demo and Payment Link
                </a>
                {{-- <a href="{{ route('contact-us') }}#enquiry-form-el" class="btn-demo">
                  <i class="bi bi-calendar-check me-2"></i>Request a Free Demo and a Framework
                </a> --}}
              </div>
            </section>

            <hr class="content-divider" />

            <section id="european-partners">
              <h2 class="section-heading">Our European partners for NIS2</h2>
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
                  <a href="#contact" class="btn-hero-primary d-block text-center mt-3">
                    <i class="bi bi-calendar-check me-2"></i>Request a Demo and Payment Link
                  </a>
                </div>
              </div>
              {{-- <div class="info-box mt-3">
                <strong><i class="bi bi-info-circle me-2"></i>VAT Reverse Charge</strong><br />
                In accordance with international VAT regulations for cross-border B2B services, VAT must
                be accounted for by the customer under the reverse charge mechanism.<br />
                <span class="text-muted" style="font-size:13px;">Supplier: GISBA Consultants Co. W.L.L. — Kingdom of Bahrain</span>
              </div> --}}
            </section>

            {{-- <hr class="content-divider" />

            <section id="satisfaction-guarantee">
              <h2 class="section-heading">Satisfaction Guarantee</h2>
              <div class="guarantee-box">
                <i class="bi bi-shield-fill-check guarantee-icon"></i>
                <div>
                  If you are not satisfied with the toolkit, you may request a <strong>full refund within
                  three days of purchase</strong>. We are confident the NIS2 Implementation Kit will
                  significantly accelerate your compliance project.
                </div>
              </div>
            </section>

            <hr class="content-divider" />

            <section id="contact">
              <h2 class="section-heading">Contact GISBA Consultants</h2>
              <p>For questions about the NIS2 Implementation Kit, contact us.</p>
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
            <section>
              <div class="info-box mt-3">
                <strong>Bahrain: A Regional Hub for Business and Consulting</strong><br />
                <p>Bahrain was a British protectorate until it gained independence in 1971, which has contributed to the widespread use of English in the country today. English is commonly spoken in business, tourism, and education. The people of Bahrain are generally known for their hospitality and welcoming nature.</p>
                <p>The country enjoys a warm climate with sunshine for most of the year. Bahrain also offers attractive beaches and a variety of water sports and recreational activities. In addition, Bahrain hosts the Formula 1 Bahrain Grand Prix annually at the Bahrain International Circuit, attracting many international tourists and motorsport enthusiasts.</p>
                <p>Bahrain serves as an important regional hub for business and tourism. Its international environment and modern infrastructure make it a popular destination for expatriates from many countries.</p>
              </div>
            </section> --}}

          </main>
        </div>

      </div>
    </div>
  </div>

@endsection
