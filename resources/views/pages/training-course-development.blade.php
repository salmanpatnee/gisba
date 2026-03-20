@extends('layouts.site')

@section('title', 'Cybersecurity Training Development Services | Corporate Cybersecurity Course Development')
@section('meta_description', 'Professional cybersecurity training development services including awareness training, risk management, cloud security, incident response, and secure software development courses.')

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
          <section class="hero-section container">
            <div class="row align-items-center">
              <div class="col-md-6">
                <h1 class="hero-title">
                  Cybersecurity Training<br />
                  <span>Development Services</span>
                </h1>
                <p class="hero-subtitle">Professional Corporate Cybersecurity Course Development</p>
                <p class="hero-desc">
                  GISBA designs and develops custom cybersecurity training programs, eLearning content, and corporate courses aligned with international security standards and modern enterprise requirements.
                </p>
              </div>
              <div class="col-md-6 text-center">
                <img class="image-content img-fluid" src="{{ asset('assets/images/cybersecurity_ training.jpg') }}" alt="Cybersecurity Training Development">
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
                <li><a href="#services"><i class="bi bi-journal-bookmark"></i> Our Services</a></li>
                <li><a href="#courses"><i class="bi bi-grid"></i> Courses We Develop</a></li>
                <li><a href="#awareness"><i class="bi bi-eye"></i> Awareness Training</a></li>
                <li><a href="#third-party"><i class="bi bi-link-45deg"></i> Third-Party Assurance</a></li>
                <li><a href="#secure-dev"><i class="bi bi-code-slash"></i> Secure Development</a></li>
                <li><a href="#network"><i class="bi bi-hdd-network"></i> Network Security</a></li>
                <li><a href="#risk"><i class="bi bi-exclamation-triangle"></i> Risk Management</a></li>
                <li><a href="#incident"><i class="bi bi-bell"></i> Incident Management</a></li>
                <li><a href="#continuity"><i class="bi bi-arrow-repeat"></i> Business Continuity</a></li>
                <li><a href="#cloud"><i class="bi bi-cloud-check"></i> Cloud Security</a></li>
                <li><a href="#ai"><i class="bi bi-robot"></i> Secure AI</a></li>
                <li><a href="#project-mgmt"><i class="bi bi-kanban"></i> Project Management</a></li>
                <li><a href="#why-gisba"><i class="bi bi-award"></i> Why GISBA</a></li>
                <li><a href="#contact"><i class="bi bi-envelope"></i> Contact</a></li>
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

            <section id="about" class="hero-section">
              <div class="hero-badge"><i class="bi bi-mortarboard-fill me-2"></i>Corporate Training Development</div>
              <h1 class="hero-title">Cybersecurity Training<br /><span>Development Services</span></h1>
              <p class="hero-subtitle">Professional Cybersecurity Course Development for Corporate Training Programs</p>
              <p class="hero-desc">Organizations across industries face increasing cyber threats and strict regulatory requirements. As a result, companies must continuously educate their workforce and technical teams through effective cybersecurity training programs.</p>
              <p class="hero-desc"><strong>GISBA Consultants Co. W.L.L.</strong> provides Cybersecurity Training Development Services designed to help organizations, training institutions, and consulting firms deliver high-quality cybersecurity education programs.</p>
              <p class="hero-desc">Our experts develop custom cybersecurity course content, training materials, and learning frameworks aligned with international security standards and modern enterprise requirements.</p>
              <p class="hero-desc">We help organizations design professional cybersecurity training courses that improve awareness, strengthen security posture, and support regulatory compliance.</p>
              <div class="hero-actions">
                <a href="#courses" class="btn-hero-primary"><i class="bi bi-journal-bookmark me-2"></i>Explore Our Courses</a>
                <a href="#contact" class="btn-hero-secondary"><i class="bi bi-envelope me-1"></i>Get in Touch</a>
              </div>
            </section>

            <hr class="content-divider" />

            <section id="services">
              <h2 class="section-heading">Custom Cybersecurity Course Development Services</h2>
              <p>Our Cybersecurity Training Development Services include the design and development of structured corporate training programs covering multiple domains of cybersecurity, risk management, and digital resilience.</p>
              <p class="mt-3">We develop training programs that include:</p>
              <div class="requirement-grid">
                <div class="requirement-item"><i class="bi bi-person-video3"></i><span>Instructor-led training materials</span></div>
                <div class="requirement-item"><i class="bi bi-display"></i><span>eLearning course content</span></div>
                <div class="requirement-item"><i class="bi bi-file-slides"></i><span>Training presentations and modules</span></div>
                <div class="requirement-item"><i class="bi bi-briefcase"></i><span>Practical case studies and exercises</span></div>
                <div class="requirement-item"><i class="bi bi-clipboard2-check"></i><span>Assessment quizzes and certification preparation</span></div>
                <div class="requirement-item"><i class="bi bi-journal-text"></i><span>Corporate training manuals and guides</span></div>
              </div>
              <p class="mt-4">Our training development services are tailored for:</p>
              <div class="audience-grid mt-2">
                <div class="audience-item"><i class="bi bi-building"></i><span>Corporate training departments</span></div>
                <div class="audience-item"><i class="bi bi-shield-check"></i><span>Cybersecurity consulting firms</span></div>
                <div class="audience-item"><i class="bi bi-bank"></i><span>Government institutions</span></div>
                <div class="audience-item"><i class="bi bi-mortarboard-fill"></i><span>Training academies</span></div>
                <div class="audience-item"><i class="bi bi-book"></i><span>Universities and professional learning providers</span></div>
              </div>
            </section>

            <hr class="content-divider" />

            <section id="courses">
              <h2 class="section-heading">Cybersecurity Courses We Develop</h2>
              <p>GISBA provides course development services for a wide range of cybersecurity and technology topics. Each course is designed with practical, real-world content aligned to international frameworks and enterprise requirements.</p>
            </section>

            <section id="awareness">
              <div class="inclusion-card">
                <div class="inclusion-number">1</div>
                <div class="inclusion-body">
                  <h4 class="inclusion-title">Cybersecurity Awareness Training Development</h4>
                  <p>Cybersecurity Awareness Training is essential for building a strong security culture within organizations. Our cybersecurity awareness course development focuses on educating employees about common cyber threats and safe digital practices.</p>
                  <p>Training modules typically cover:</p>
                  <ul>
                    <li>Phishing and social engineering awareness</li>
                    <li>Password and identity security</li>
                    <li>Safe email and internet practices</li>
                    <li>Data protection and privacy awareness</li>
                    <li>Mobile device and remote working security</li>
                    <li>Insider threat awareness</li>
                  </ul>
                  <p class="inclusion-note"><i class="bi bi-people-fill me-1"></i>Designed for all employees across the organization. Supports compliance with cybersecurity regulations and standards.</p>
                </div>
              </div>
            </section>

            <section id="third-party">
              <div class="inclusion-card">
                <div class="inclusion-number">2</div>
                <div class="inclusion-body">
                  <h4 class="inclusion-title">Third-Party Cybersecurity Assurance Training</h4>
                  <p>Third-party vendors and service providers often introduce significant cybersecurity risks. Organizations must establish structured processes to assess and monitor vendor security.</p>
                  <p>Our Third-Party Cybersecurity Assurance Training teaches organizations how to manage vendor cybersecurity risks effectively.</p>
                  <p>The course covers:</p>
                  <ul>
                    <li>Third-party cybersecurity risk management frameworks</li>
                    <li>Vendor security assessment processes</li>
                    <li>Security due diligence for suppliers</li>
                    <li>Contractual cybersecurity requirements</li>
                    <li>Ongoing monitoring of vendor security posture</li>
                  </ul>
                  <p class="inclusion-note"><i class="bi bi-person-badge-fill me-1"></i>Ideal for risk managers, procurement teams, and cybersecurity professionals responsible for vendor management.</p>
                </div>
              </div>
            </section>

            <section id="secure-dev">
              <div class="inclusion-card">
                <div class="inclusion-number">3</div>
                <div class="inclusion-body">
                  <h4 class="inclusion-title">Secure Software Development Training</h4>
                  <p>Secure software development practices are critical to preventing vulnerabilities and protecting digital systems. Our Secure Software Development Guidance Training helps development teams integrate security into the software development lifecycle.</p>
                  <p>Course topics include:</p>
                  <ul>
                    <li>Secure Software Development Lifecycle (SSDLC)</li>
                    <li>OWASP Top 10 vulnerabilities</li>
                    <li>Secure coding practices</li>
                    <li>Secure API development</li>
                    <li>Code review and vulnerability management</li>
                    <li>DevSecOps practices</li>
                  </ul>
                  <p class="inclusion-note"><i class="bi bi-code-slash me-1"></i>Designed for software developers, DevOps engineers, and software architects.</p>
                </div>
              </div>
            </section>

            <section id="network">
              <div class="inclusion-card">
                <div class="inclusion-number">4</div>
                <div class="inclusion-body">
                  <h4 class="inclusion-title">Secure Network Implementation Training</h4>
                  <p>A secure network infrastructure forms the backbone of enterprise cybersecurity. Our Secure Network Implementation Training helps technical teams design and deploy secure network environments.</p>
                  <p>Training modules cover:</p>
                  <ul>
                    <li>Network security architecture</li>
                    <li>Firewall configuration and management</li>
                    <li>Network segmentation strategies</li>
                    <li>Intrusion detection and prevention systems</li>
                    <li>Secure remote access solutions</li>
                    <li>Zero-trust network principles</li>
                  </ul>
                  <p class="inclusion-note"><i class="bi bi-hdd-network-fill me-1"></i>Designed for network engineers, IT administrators, and cybersecurity teams.</p>
                </div>
              </div>
            </section>

            <section id="risk">
              <div class="inclusion-card">
                <div class="inclusion-number">5</div>
                <div class="inclusion-body">
                  <h4 class="inclusion-title">Cybersecurity Risk Management Training</h4>
                  <p>Cybersecurity risk management enables organizations to identify and mitigate security threats effectively. Our Risk Management Training provides structured guidance on implementing enterprise cybersecurity risk frameworks.</p>
                  <p>Key learning areas include:</p>
                  <ul>
                    <li>Risk identification and assessment</li>
                    <li>Risk analysis and prioritization</li>
                    <li>Risk treatment strategies</li>
                    <li>Risk monitoring and reporting</li>
                    <li>Enterprise risk management frameworks</li>
                  </ul>
                  <p class="inclusion-note"><i class="bi bi-exclamation-triangle-fill me-1"></i>Designed for risk managers, security leaders, and compliance professionals.</p>
                </div>
              </div>
            </section>

            <section id="incident">
              <div class="inclusion-card">
                <div class="inclusion-number">6</div>
                <div class="inclusion-body">
                  <h4 class="inclusion-title">Cybersecurity Incident Management Training</h4>
                  <p>Organizations must be prepared to detect, respond to, and recover from cybersecurity incidents. Our Cybersecurity Incident Management Training teaches teams how to build and operate effective incident response programs.</p>
                  <p>The training covers:</p>
                  <ul>
                    <li>Incident response frameworks and processes</li>
                    <li>Cyber incident classification</li>
                    <li>Incident detection and analysis</li>
                    <li>Incident containment and recovery</li>
                    <li>Digital forensics fundamentals</li>
                    <li>Post-incident review and lessons learned</li>
                  </ul>
                  <p class="inclusion-note"><i class="bi bi-bell-fill me-1"></i>Ideal for security operations teams and incident response professionals.</p>
                </div>
              </div>
            </section>

            <section id="continuity">
              <div class="inclusion-card">
                <div class="inclusion-number">7</div>
                <div class="inclusion-body">
                  <h4 class="inclusion-title">Business Continuity and Cyber Resilience Training</h4>
                  <p>Cyber incidents and operational disruptions can significantly impact business operations. Our Business Continuity and Cyber Resilience Training helps organizations develop strategies to maintain operations during disruptions.</p>
                  <p>Topics include:</p>
                  <ul>
                    <li>Business continuity management frameworks</li>
                    <li>Business impact analysis</li>
                    <li>Disaster recovery planning</li>
                    <li>Cyber resilience strategies</li>
                    <li>Crisis management and communication</li>
                    <li>Testing and exercising continuity plans</li>
                  </ul>
                  <p class="inclusion-note"><i class="bi bi-arrow-repeat me-1"></i>Designed for business leaders, resilience teams, and operational managers.</p>
                </div>
              </div>
            </section>

            <section id="cloud">
              <div class="inclusion-card">
                <div class="inclusion-number">8</div>
                <div class="inclusion-body">
                  <h4 class="inclusion-title">Cloud Security Framework Training</h4>
                  <p>As organizations migrate to cloud environments, cloud security skills become essential. Our Cloud Security Framework Training provides guidance on implementing secure cloud infrastructures.</p>
                  <p>Training modules include:</p>
                  <ul>
                    <li>Cloud security architecture</li>
                    <li>Shared responsibility models</li>
                    <li>Cloud identity and access management</li>
                    <li>Data protection in cloud environments</li>
                    <li>Cloud risk management</li>
                    <li>Cloud governance and compliance</li>
                  </ul>
                  <p class="inclusion-note"><i class="bi bi-cloud-check-fill me-1"></i>Designed for cloud architects, cybersecurity teams, and IT professionals.</p>
                </div>
              </div>
            </section>

            <section id="ai">
              <div class="inclusion-card">
                <div class="inclusion-number">9</div>
                <div class="inclusion-body">
                  <h4 class="inclusion-title">Secure AI Deployment Training</h4>
                  <p>Artificial intelligence systems introduce new cybersecurity and governance challenges. Our Secure AI Deployment Training helps organizations manage security risks associated with AI technologies.</p>
                  <p>Course topics include:</p>
                  <ul>
                    <li>AI governance frameworks</li>
                    <li>Security risks in machine learning systems</li>
                    <li>Data privacy and ethical AI practices</li>
                    <li>Secure AI model deployment</li>
                    <li>Monitoring AI systems for vulnerabilities</li>
                  </ul>
                  <p class="inclusion-note"><i class="bi bi-robot me-1"></i>Designed for AI engineers, data scientists, and cybersecurity professionals.</p>
                </div>
              </div>
            </section>

            <hr class="content-divider" />

            <section id="project-mgmt">
              <h2 class="section-heading">Project Management Course Development</h2>
              <p>In addition to cybersecurity courses, GISBA provides project management training content development aligned to leading international frameworks.</p>

              <div class="inclusion-card mt-3">
                <div class="inclusion-number">10</div>
                <div class="inclusion-body">
                  <h4 class="inclusion-title">Project Management Course Development (PMP Based)</h4>
                  <p>We provide Project Management training content development based on the PMP framework.</p>
                  <p>Course modules typically include:</p>
                  <ul>
                    <li>Project initiation and planning</li>
                    <li>Scope, schedule, and cost management</li>
                    <li>Risk management in projects</li>
                    <li>Stakeholder communication</li>
                    <li>Agile and hybrid project management practices</li>
                  </ul>
                  <p class="inclusion-note"><i class="bi bi-kanban-fill me-1"></i>Supports organizations developing PMP-aligned project management training programs.</p>
                </div>
              </div>

              <div class="inclusion-card">
                <div class="inclusion-number">11</div>
                <div class="inclusion-body">
                  <h4 class="inclusion-title">Project Management Course Development (PRINCE2 Based)</h4>
                  <p>Our PRINCE2-based training content development focuses on structured project governance and controlled project delivery.</p>
                  <p>Training modules include:</p>
                  <ul>
                    <li>PRINCE2 principles and methodology</li>
                    <li>Project governance and roles</li>
                    <li>Managing project stages and processes</li>
                    <li>Risk and issue management</li>
                    <li>Quality and performance management</li>
                  </ul>
                  <p class="inclusion-note"><i class="bi bi-diagram-3-fill me-1"></i>Suitable for organizations implementing PRINCE2 project management frameworks.</p>
                </div>
              </div>
            </section>

            <hr class="content-divider" />

            <section id="why-gisba">
              <h2 class="section-heading">Why Choose GISBA for Cybersecurity Training Development?</h2>
              <p>Organizations choose GISBA for Cybersecurity Training Development Services because of our deep consulting expertise and industry certifications.</p>
              <div class="checklist-group">
                <div class="checklist-item"><i class="bi bi-check-circle-fill"></i><span>Training content developed by certified cybersecurity professionals</span></div>
                <div class="checklist-item"><i class="bi bi-check-circle-fill"></i><span>Alignment with global cybersecurity frameworks and standards</span></div>
                <div class="checklist-item"><i class="bi bi-check-circle-fill"></i><span>Practical, real-world training content</span></div>
                <div class="checklist-item"><i class="bi bi-check-circle-fill"></i><span>Customizable training modules</span></div>
                <div class="checklist-item"><i class="bi bi-check-circle-fill"></i><span>Corporate-focused training design</span></div>
              </div>
              <div class="highlight-box mt-3">
                <i class="bi bi-star-fill me-2"></i>
                Our goal is to help organizations <strong>build skilled cybersecurity teams</strong> and strong security awareness cultures.
              </div>
              <div class="expert-card mt-4">
                <div class="expert-avatar"><i class="bi bi-person-circle"></i></div>
                <div class="expert-info">
                  <div class="expert-name">Javed A. Abbasi</div>
                  <div class="expert-title">Principal Consultant — GISBA Consultants Co. W.L.L.</div>
                  <div class="cert-badges mt-2">
                    <span class="cert-badge"><i class="bi bi-patch-check"></i> MBA (MIS)</span>
                    <span class="cert-badge"><i class="bi bi-patch-check"></i> CISSP</span>
                    <span class="cert-badge"><i class="bi bi-patch-check"></i> CISA</span>
                    <span class="cert-badge"><i class="bi bi-patch-check"></i> CISM</span>
                    <span class="cert-badge"><i class="bi bi-patch-check"></i> CGEIT</span>
                    <span class="cert-badge"><i class="bi bi-patch-check"></i> ITIL Master</span>
                    <span class="cert-badge"><i class="bi bi-patch-check"></i> MBCP</span>
                    <span class="cert-badge"><i class="bi bi-patch-check"></i> PMP</span>
                  </div>
                </div>
              </div>
              <div class="info-box mt-3">
                <i class="bi bi-globe2 me-2 text-primary"></i>
                GISBA Consultants has been serving organizations worldwide since <strong>2006</strong>,
                supporting clients across <strong>three continents</strong> and advising C-level executives
                and Fortune 500 companies on cybersecurity governance, risk management, and regulatory compliance.
              </div>
            </section>

            <hr class="content-divider" />

            <section class="cta-section">
              <h2 class="cta-title">Start Your Cybersecurity Training Program Today</h2>
              <p class="cta-desc">If your organization requires custom cybersecurity training course development, our experts can help. Contact GISBA Consultants Co. W.L.L. to discuss your training program requirements.</p>
              <a href="#contact" class="btn-hero-primary"><i class="bi bi-envelope me-2"></i>Contact Us to Get Started</a>
            </section>

            <hr class="content-divider" />

            <section id="contact">
              <h2 class="section-heading">Contact Us for Cybersecurity Course Development</h2>
              <p>For questions about our Training Course Development Services, contact us directly.</p>
              <div class="row g-4 mt-1">
                <div class="col-12">
                  <div class="contact-card">
                    <div class="contact-card-title"><i class="bi bi-building me-2"></i>GISBA Consultants Co. W.L.L.</div>
                    <div class="contact-card-body">
                      {{-- <p><i class="bi bi-geo-alt me-2 text-primary"></i>Office #2062, Building #2004<br />Road #1527, Block #115<br />Area HIDD, Kingdom of Bahrain</p>
                      <p><i class="bi bi-telephone me-2 text-primary"></i><a href="tel:+97338397453">+973 3839 7453</a></p> --}}
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
