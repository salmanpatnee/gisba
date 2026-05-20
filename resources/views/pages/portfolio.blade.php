@extends('layouts.site')

@section('title', 'Software Portfolio | GISBA Consultants')
@section('meta_description', 'GISBA has developed 15+ software solutions across USA, Europe, UK, and Saudi Arabia — GRC platforms, cybersecurity education tools, and ISO implementation automation systems.')

@section('banner')
  <div class="d-flex justify-content-between align-items-center flex-wrap gap-2">
    <span><i class="bi bi-grid-3x3-gap me-2"></i>GISBA Software Portfolio — 15+ Solutions Across 4 Markets</span>
    <div class="d-flex gap-3">
      <a href="#overview"><i class="bi bi-info-circle me-1"></i>Overview</a>
      <a href="#usa"><span class="fi fi-us me-1" style="font-size:12px;"></span>USA</a>
      <a href="#uk"><span class="fi fi-gb me-1" style="font-size:12px;"></span>UK</a>
      <a href="#europe"><span class="fi fi-eu me-1" style="font-size:12px;"></span>Europe</a>
      <a href="#saudi"><span class="fi fi-sa me-1" style="font-size:12px;"></span>Saudi Arabia</a>
    </div>
  </div>
@endsection

@section('footer_tagline')
  15+ Software Solutions Across USA, Europe, UK &amp; Saudi Arabia.<br />
  Global Cybersecurity Consulting &amp; Technology.
@endsection

@section('content')

  <div class="page-layout">
    <div class="container">
      <div class="col-12">
        <main class="img-content">
          <section id="title" class="hero-section container">
            <div class="row align-items-center">
              <div class="col-md-7">
                <h1 class="hero-title">
                  GISBA Software Portfolio<br />
                  <span>For USA, Europe, UK, and Saudi Arabia</span>
                </h1>
                <p class="hero-subtitle">
                  15+ Software Solutions Across USA, Europe, UK &amp; Saudi Arabia
                </p>
                <p class="hero-desc">
                  Celebrating 20 years of excellence since 2006, GISBA has evolved from a consulting powerhouse into a global software company — building GRC platforms, cybersecurity education tools, and ISO implementation systems deployed across three continents.
                </p>
              </div>
              <div class="col-md-5 text-center">
                <div class="portfolio-globe-visual">
                  <div class="portfolio-stat-ring">
                    <div class="portfolio-stat-inner">
                      <span class="portfolio-stat-number">15<sup>+</sup></span>
                      <span class="portfolio-stat-label">Software<br>Products</span>
                    </div>
                  </div>
                  <div class="portfolio-market-tags">
                    <span class="portfolio-market-tag"><span class="fi fi-us me-1"></span>USA</span>
                    <span class="portfolio-market-tag"><span class="fi fi-gb me-1"></span>UK</span>
                    <span class="portfolio-market-tag"><span class="fi fi-eu me-1"></span>Europe</span>
                    <span class="portfolio-market-tag"><span class="fi fi-sa me-1"></span>Saudi Arabia</span>
                  </div>
                </div>
              </div>
            </div>
          </section>
        </main>
      </div>

      <div class="row g-4">

        <div class="col-12 col-md-3">
          <aside class="sidebar">
            <nav class="sidebar-nav">
              <p class="sidebar-nav-title">Portfolio Navigation</p>
              <ul>
                <li><a href="#overview"><i class="bi bi-info-circle"></i> Overview</a></li>
                <li><a href="#usa"><i class="bi bi-geo-alt"></i> USA</a></li>
                <li><a href="#uk"><i class="bi bi-geo-alt"></i> United Kingdom</a></li>
                <li><a href="#europe"><i class="bi bi-geo-alt"></i> Europe</a></li>
                <li><a href="#saudi"><i class="bi bi-geo-alt"></i> Saudi Arabia</a></li>
                <li><a href="#partnership"><i class="bi bi-handshake"></i> Partnership</a></li>
              </ul>
            </nav>
            <div class="sidebar-contact">
              <strong><i class="bi bi-handshake me-1"></i>Partnership Enquiries</strong>
              <a href="mailto:support@gisba.net">support@gisba.net</a>
            </div>
          </aside>
        </div>

        <div class="col-12 col-md-9">
          <main class="main-content">

            {{-- OVERVIEW --}}
            <section id="overview">
              <h2 class="section-heading">Our Software Journey</h2>
              <p>
                GISBA began its journey in 2006 with a strong foundation in cybersecurity and GRC consulting. During the post-COVID period, we channelled two decades of domain expertise into building software solutions for different markets. Over the last five years, we have transitioned from a consulting-focused to a software-focused organisation — giving us a truly global reach.
              </p>
              <div class="info-box">
                <i class="bi bi-rocket-takeoff-fill me-2 text-primary"></i>
                <strong>From consulting to software:</strong> GISBA's 20 years of hands-on GRC expertise is embedded in every product we build — giving our clients compliance tools shaped by real-world experience.
              </div>

              <div class="portfolio-stats-row">
                <div class="portfolio-stat-card">
                  <div class="portfolio-stat-card-number">20</div>
                  <div class="portfolio-stat-card-label">Years in Business</div>
                </div>
                <div class="portfolio-stat-card">
                  <div class="portfolio-stat-card-number">15+</div>
                  <div class="portfolio-stat-card-label">Software Products</div>
                </div>
                <div class="portfolio-stat-card">
                  <div class="portfolio-stat-card-number">4</div>
                  <div class="portfolio-stat-card-label">Markets Served</div>
                </div>
                <div class="portfolio-stat-card">
                  <div class="portfolio-stat-card-number">3</div>
                  <div class="portfolio-stat-card-label">Continents</div>
                </div>
              </div>
            </section>

            <hr class="content-divider" />

            {{-- USA --}}
            <section id="usa">
              <div class="portfolio-region-header">
                <span class="fi fi-us portfolio-region-flag"></span>
                <h2 class="section-heading mb-0">United States</h2>
              </div>

              <div class="portfolio-product-grid">
                <div class="portfolio-product-card">
                  <div class="portfolio-product-header">
                    <div class="portfolio-product-category">GRC Solution</div>
                    <h3 class="portfolio-product-name">Discount Gateway Portal</h3>
                  </div>
                  <div class="portfolio-product-body">
                    <p>A dedicated GRC solution developed for the US market, providing organisations with streamlined compliance and risk management capabilities.</p>
                    <a href="https://discountgatewayportal.com/" target="_blank" rel="noopener" class="portfolio-product-link">
                      <i class="bi bi-box-arrow-up-right me-1"></i>discountgatewayportal.com
                    </a>
                  </div>
                </div>
              </div>
            </section>

            <hr class="content-divider" />

            {{-- UK --}}
            <section id="uk">
              <div class="portfolio-region-header">
                <span class="fi fi-gb portfolio-region-flag"></span>
                <h2 class="section-heading mb-0">United Kingdom</h2>
              </div>

              <div class="portfolio-product-grid">
                <div class="portfolio-product-card">
                  <div class="portfolio-product-header">
                    <div class="portfolio-product-category">Cybersecurity Platform</div>
                    <h3 class="portfolio-product-name">UK CISO</h3>
                  </div>
                  <div class="portfolio-product-body">
                    <p>A comprehensive CISO platform tailored for UK organisations, supporting information security management and regulatory compliance for the British market.</p>
                    <a href="https://ukciso.net/" target="_blank" rel="noopener" class="portfolio-product-link">
                      <i class="bi bi-box-arrow-up-right me-1"></i>ukciso.net
                    </a>
                  </div>
                </div>
              </div>
            </section>

            <hr class="content-divider" />

            {{-- EUROPE --}}
            <section id="europe">
              <div class="portfolio-region-header">
                <span class="fi fi-eu portfolio-region-flag"></span>
                <h2 class="section-heading mb-0">Europe</h2>
              </div>

              <div class="portfolio-product-grid">
                <div class="portfolio-product-card">
                  <div class="portfolio-product-header">
                    <div class="portfolio-product-category">Cybersecurity Platform</div>
                    <h3 class="portfolio-product-name">Euro CISO</h3>
                  </div>
                  <div class="portfolio-product-body">
                    <p>A dedicated platform for European CISOs and information security professionals, built to align with EU regulatory frameworks including NIS2 and GDPR.</p>
                    <a href="https://eurociso.net/" target="_blank" rel="noopener" class="portfolio-product-link">
                      <i class="bi bi-box-arrow-up-right me-1"></i>eurociso.net
                    </a>
                  </div>
                </div>
              </div>
            </section>

            <hr class="content-divider" />

            {{-- SAUDI ARABIA --}}
            <section id="saudi">
              <div class="portfolio-region-header">
                <span class="fi fi-sa portfolio-region-flag"></span>
                <h2 class="section-heading mb-0">Saudi Arabia</h2>
              </div>

              {{-- GRC Solution --}}
              <h3 class="portfolio-subsection-title"><i class="bi bi-shield-check me-2"></i>GRC Solutions</h3>
              <div class="portfolio-product-grid">
                <div class="portfolio-product-card">
                  <div class="portfolio-product-header">
                    <div class="portfolio-product-category">GRC Platform</div>
                    <h3 class="portfolio-product-name">Compliance 360 GRC</h3>
                  </div>
                  <div class="portfolio-product-body">
                    <p>A comprehensive Governance, Risk &amp; Compliance platform purpose-built for Saudi Arabian organisations navigating NCA, SAMA, and international standards.</p>
                    <div class="portfolio-product-links">
                      <a href="https://compliance360grc.com/" target="_blank" rel="noopener" class="portfolio-product-link">
                        <i class="bi bi-box-arrow-up-right me-1"></i>compliance360grc.com
                      </a>
                      <a href="https://virtualciso.compliance360grc.com/" target="_blank" rel="noopener" class="portfolio-product-link">
                        <i class="bi bi-box-arrow-up-right me-1"></i>Virtual CISO
                      </a>
                      <a href="https://dev.compliance360grc.com/" target="_blank" rel="noopener" class="portfolio-product-link">
                        <i class="bi bi-box-arrow-up-right me-1"></i>Dev Environment
                      </a>
                    </div>
                  </div>
                </div>
              </div>

              {{-- Cybersecurity Education --}}
              <h3 class="portfolio-subsection-title mt-4"><i class="bi bi-mortarboard me-2"></i>Cybersecurity Education</h3>
              <div class="portfolio-product-grid">
                <div class="portfolio-product-card">
                  <div class="portfolio-product-header">
                    <div class="portfolio-product-category">Education Platform</div>
                    <h3 class="portfolio-product-name">Future CISO</h3>
                  </div>
                  <div class="portfolio-product-body">
                    <p>A forward-looking cybersecurity education platform preparing the next generation of Saudi security leaders.</p>
                    <a href="https://futureciso.net/" target="_blank" rel="noopener" class="portfolio-product-link">
                      <i class="bi bi-box-arrow-up-right me-1"></i>futureciso.net
                    </a>
                  </div>
                </div>

                <div class="portfolio-product-card">
                  <div class="portfolio-product-header">
                    <div class="portfolio-product-category">Education Platform</div>
                    <h3 class="portfolio-product-name">Saudi CISO</h3>
                  </div>
                  <div class="portfolio-product-body">
                    <p>Specialised cybersecurity education and CISO development platform tailored to Saudi regulatory requirements and Vision 2030 objectives.</p>
                    <a href="https://saudiciso.net/" target="_blank" rel="noopener" class="portfolio-product-link">
                      <i class="bi bi-box-arrow-up-right me-1"></i>saudiciso.net
                    </a>
                  </div>
                </div>

                <div class="portfolio-product-card">
                  <div class="portfolio-product-header">
                    <div class="portfolio-product-category">Virtual CISO</div>
                    <h3 class="portfolio-product-name">Saudi Virtual CISO</h3>
                  </div>
                  <div class="portfolio-product-body">
                    <p>A virtual CISO service platform enabling Saudi organisations to access on-demand security leadership and strategic guidance.</p>
                    <a href="https://saudivirtualciso.com/" target="_blank" rel="noopener" class="portfolio-product-link">
                      <i class="bi bi-box-arrow-up-right me-1"></i>saudivirtualciso.com
                    </a>
                  </div>
                </div>
              </div>

              {{-- ISO Implementation Automation --}}
              <h3 class="portfolio-subsection-title mt-4"><i class="bi bi-gear me-2"></i>ISO Implementation Automation</h3>
              <p class="mb-3">GISBA's colour-coded Bulb series delivers automated implementation toolkits for major ISO standards — each uniquely branded and purpose-built for its respective framework.</p>

              <div class="portfolio-bulb-grid">
                <div class="portfolio-bulb-card portfolio-bulb-gold">
                  <div class="portfolio-bulb-icon"><i class="bi bi-lightbulb-fill"></i></div>
                  <div class="portfolio-bulb-body">
                    <span class="portfolio-bulb-badge">Golden Bulb</span>
                    <h4 class="portfolio-bulb-name">ISO 42001</h4>
                    <p class="portfolio-bulb-desc">AI Management System</p>
                    <a href="https://ai.compliance360grc.com/" target="_blank" rel="noopener" class="portfolio-bulb-link">
                      <i class="bi bi-box-arrow-up-right me-1"></i>ai.compliance360grc.com
                    </a>
                  </div>
                </div>

                <div class="portfolio-bulb-card portfolio-bulb-blue">
                  <div class="portfolio-bulb-icon"><i class="bi bi-lightbulb-fill"></i></div>
                  <div class="portfolio-bulb-body">
                    <span class="portfolio-bulb-badge">Blue Bulb</span>
                    <h4 class="portfolio-bulb-name">ISO 56001</h4>
                    <p class="portfolio-bulb-desc">Innovation Management</p>
                    <a href="https://innovation.compliance360grc.com/" target="_blank" rel="noopener" class="portfolio-bulb-link">
                      <i class="bi bi-box-arrow-up-right me-1"></i>innovation.compliance360grc.com
                    </a>
                  </div>
                </div>

                <div class="portfolio-bulb-card portfolio-bulb-silver">
                  <div class="portfolio-bulb-icon"><i class="bi bi-lightbulb-fill"></i></div>
                  <div class="portfolio-bulb-body">
                    <span class="portfolio-bulb-badge">Silver Bulb</span>
                    <h4 class="portfolio-bulb-name">ISO 20000</h4>
                    <p class="portfolio-bulb-desc">IT Service Management</p>
                    <a href="https://itsms.compliance360grc.com/" target="_blank" rel="noopener" class="portfolio-bulb-link">
                      <i class="bi bi-box-arrow-up-right me-1"></i>itsms.compliance360grc.com
                    </a>
                  </div>
                </div>

                <div class="portfolio-bulb-card portfolio-bulb-white">
                  <div class="portfolio-bulb-icon"><i class="bi bi-lightbulb-fill"></i></div>
                  <div class="portfolio-bulb-body">
                    <span class="portfolio-bulb-badge">White Bulb</span>
                    <h4 class="portfolio-bulb-name">ISO 22301</h4>
                    <p class="portfolio-bulb-desc">Business Continuity Management</p>
                    <a href="https://bcms.compliance360grc.com/" target="_blank" rel="noopener" class="portfolio-bulb-link">
                      <i class="bi bi-box-arrow-up-right me-1"></i>bcms.compliance360grc.com
                    </a>
                  </div>
                </div>

                <div class="portfolio-bulb-card portfolio-bulb-orange">
                  <div class="portfolio-bulb-icon"><i class="bi bi-lightbulb-fill"></i></div>
                  <div class="portfolio-bulb-body">
                    <span class="portfolio-bulb-badge">Orange Bulb</span>
                    <h4 class="portfolio-bulb-name">PDPL</h4>
                    <p class="portfolio-bulb-desc">Personal Data Protection Law</p>
                    <a href="https://pdpl.compliance360grc.com/" target="_blank" rel="noopener" class="portfolio-bulb-link">
                      <i class="bi bi-box-arrow-up-right me-1"></i>pdpl.compliance360grc.com
                    </a>
                  </div>
                </div>

                <div class="portfolio-bulb-card portfolio-bulb-brown">
                  <div class="portfolio-bulb-icon"><i class="bi bi-lightbulb-fill"></i></div>
                  <div class="portfolio-bulb-body">
                    <span class="portfolio-bulb-badge">Brown Bulb</span>
                    <h4 class="portfolio-bulb-name">ISO 9001</h4>
                    <p class="portfolio-bulb-desc">Quality Management System</p>
                    <a href="https://qms.compliance360grc.com/" target="_blank" rel="noopener" class="portfolio-bulb-link">
                      <i class="bi bi-box-arrow-up-right me-1"></i>qms.compliance360grc.com
                    </a>
                  </div>
                </div>
              </div>
            </section>

            <hr class="content-divider" />

            {{-- PARTNERSHIP --}}
            <section id="partnership">
              <h2 class="section-heading">Partnership Opportunities</h2>
              <p>
                GISBA is keen on partnership and is ready and willing to discuss collaboration for any of our software solutions around the globe. Whether you are a regional distributor, system integrator, or technology partner — we welcome the conversation.
              </p>
              <div class="checklist-group">
                <div class="checklist-item"><i class="bi bi-check-circle-fill"></i><span>Regional distribution partnerships</span></div>
                <div class="checklist-item"><i class="bi bi-check-circle-fill"></i><span>OEM and white-label licensing</span></div>
                <div class="checklist-item"><i class="bi bi-check-circle-fill"></i><span>System integrator agreements</span></div>
                <div class="checklist-item"><i class="bi bi-check-circle-fill"></i><span>Co-development opportunities</span></div>
              </div>
              <div class="mt-4">
                <a href="{{ route('contact-us') }}#enquiry-form" class="btn-hero-primary">
                  <i class="bi bi-envelope me-2"></i>Discuss a Partnership
                </a>
              </div>
            </section>

          </main>
        </div>

      </div>
    </div>
  </div>

@push('scripts')
<style>
  /* ── Portfolio Hero Visual ─────────────────────────── */
  .portfolio-globe-visual {
    display: flex;
    flex-direction: column;
    align-items: center;
    gap: 18px;
    padding: 20px 0;
  }

  .portfolio-stat-ring {
    width: 160px;
    height: 160px;
    border-radius: 50%;
    border: 4px solid var(--accent);
    background: linear-gradient(135deg, var(--navy) 0%, var(--navy-mid) 100%);
    display: flex;
    align-items: center;
    justify-content: center;
    box-shadow: 0 8px 32px rgba(0,51,102,0.22);
  }

  .portfolio-stat-inner {
    text-align: center;
  }

  .portfolio-stat-number {
    display: block;
    font-family: var(--font-display);
    font-size: 2.8rem;
    font-weight: 900;
    color: var(--accent);
    line-height: 1;
  }

  .portfolio-stat-number sup {
    font-size: 1.2rem;
    vertical-align: super;
  }

  .portfolio-stat-label {
    display: block;
    font-size: 11px;
    font-weight: 600;
    color: #a8c8f0;
    text-transform: uppercase;
    letter-spacing: 0.08em;
    margin-top: 4px;
  }

  .portfolio-market-tags {
    display: flex;
    flex-wrap: wrap;
    gap: 8px;
    justify-content: center;
  }

  .portfolio-market-tag {
    background: var(--navy);
    color: #fff;
    font-size: 12px;
    font-weight: 600;
    padding: 4px 12px;
    border-radius: 20px;
    border: 1px solid var(--accent);
    display: flex;
    align-items: center;
    gap: 4px;
  }

  /* ── Portfolio Stats Row ───────────────────────────── */
  .portfolio-stats-row {
    display: grid;
    grid-template-columns: repeat(4, 1fr);
    gap: 12px;
    margin-top: 20px;
  }

  @media (max-width: 600px) {
    .portfolio-stats-row { grid-template-columns: repeat(2, 1fr); }
  }

  .portfolio-stat-card {
    background: linear-gradient(135deg, var(--navy) 0%, var(--navy-mid) 100%);
    color: #fff;
    border-radius: var(--radius-md);
    padding: 18px 12px;
    text-align: center;
    border-top: 3px solid var(--accent);
    box-shadow: var(--shadow-card);
  }

  .portfolio-stat-card-number {
    font-family: var(--font-display);
    font-size: 2rem;
    font-weight: 900;
    color: var(--accent);
    line-height: 1;
  }

  .portfolio-stat-card-label {
    font-size: 11px;
    font-weight: 600;
    text-transform: uppercase;
    letter-spacing: 0.06em;
    color: #a8c8f0;
    margin-top: 5px;
  }

  /* ── Region Headers ────────────────────────────────── */
  .portfolio-region-header {
    display: flex;
    align-items: center;
    gap: 12px;
    margin-bottom: 18px;
  }

  .portfolio-region-flag {
    font-size: 2rem;
    line-height: 1;
    border-radius: 3px;
    box-shadow: 0 1px 4px rgba(0,0,0,0.18);
  }

  /* ── Product Cards ─────────────────────────────────── */
  .portfolio-product-grid {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(260px, 1fr));
    gap: 16px;
  }

  .portfolio-product-card {
    border: 1px solid var(--border-light);
    border-radius: var(--radius-lg);
    background: var(--bg-white);
    box-shadow: var(--shadow-card);
    overflow: hidden;
    transition: box-shadow 0.2s, transform 0.2s;
  }

  .portfolio-product-card:hover {
    box-shadow: var(--shadow-hover);
    transform: translateY(-2px);
  }

  .portfolio-product-header {
    background: linear-gradient(135deg, var(--navy) 0%, var(--navy-mid) 100%);
    padding: 14px 18px;
  }

  .portfolio-product-category {
    font-size: 10.5px;
    font-weight: 700;
    text-transform: uppercase;
    letter-spacing: 0.1em;
    color: var(--accent);
    margin-bottom: 4px;
  }

  .portfolio-product-name {
    font-family: var(--font-display);
    font-size: 1.05rem;
    font-weight: 700;
    color: #fff;
    margin: 0;
  }

  .portfolio-product-body {
    padding: 14px 18px;
  }

  .portfolio-product-body p {
    font-size: 13.5px;
    color: var(--text-body);
    margin-bottom: 10px;
  }

  .portfolio-product-link {
    display: inline-flex;
    align-items: center;
    font-size: 12.5px;
    font-weight: 600;
    color: var(--navy-light);
    text-decoration: none;
    transition: color 0.15s;
  }

  .portfolio-product-link:hover {
    color: var(--navy);
    text-decoration: underline;
  }

  .portfolio-product-links {
    display: flex;
    flex-wrap: wrap;
    gap: 8px;
  }

  /* ── Subsection Titles ─────────────────────────────── */
  .portfolio-subsection-title {
    font-family: var(--font-body);
    font-size: 0.95rem;
    font-weight: 700;
    text-transform: uppercase;
    letter-spacing: 0.08em;
    color: var(--navy-mid);
    border-left: 3px solid var(--accent);
    padding-left: 10px;
    margin-bottom: 14px;
  }

  /* ── Bulb Cards ────────────────────────────────────── */
  .portfolio-bulb-grid {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(220px, 1fr));
    gap: 14px;
  }

  .portfolio-bulb-card {
    border-radius: var(--radius-md);
    padding: 16px;
    display: flex;
    align-items: flex-start;
    gap: 12px;
    box-shadow: var(--shadow-card);
    border: 1px solid rgba(255,255,255,0.2);
    transition: box-shadow 0.2s, transform 0.2s;
  }

  .portfolio-bulb-card:hover {
    box-shadow: var(--shadow-hover);
    transform: translateY(-2px);
  }

  .portfolio-bulb-icon {
    font-size: 1.6rem;
    line-height: 1;
    flex-shrink: 0;
    margin-top: 2px;
  }

  .portfolio-bulb-badge {
    font-size: 10px;
    font-weight: 700;
    text-transform: uppercase;
    letter-spacing: 0.08em;
    display: inline-block;
    margin-bottom: 3px;
    padding: 2px 7px;
    border-radius: 10px;
    background: rgba(255,255,255,0.25);
  }

  .portfolio-bulb-name {
    font-size: 1rem;
    font-weight: 800;
    margin: 2px 0 2px;
    font-family: var(--font-display);
  }

  .portfolio-bulb-desc {
    font-size: 12px;
    margin: 0 0 8px;
    opacity: 0.85;
  }

  .portfolio-bulb-link {
    font-size: 11.5px;
    font-weight: 600;
    text-decoration: none;
    opacity: 0.9;
  }

  .portfolio-bulb-link:hover {
    opacity: 1;
    text-decoration: underline;
  }

  /* Bulb colour themes */
  .portfolio-bulb-gold  { background: linear-gradient(135deg, #7a5c00 0%, #b8860b 100%); color: #fff8e1; }
  .portfolio-bulb-gold  .portfolio-bulb-icon { color: #ffd700; }
  .portfolio-bulb-gold  .portfolio-bulb-link { color: #fff8e1; }
  .portfolio-bulb-gold  .portfolio-bulb-name { color: #fff8e1; }

  .portfolio-bulb-blue  { background: linear-gradient(135deg, #003a7a 0%, #0055b3 100%); color: #e0f0ff; }
  .portfolio-bulb-blue  .portfolio-bulb-icon { color: #5bc8ff; }
  .portfolio-bulb-blue  .portfolio-bulb-link { color: #a8d8ff; }
  .portfolio-bulb-blue  .portfolio-bulb-name { color: #e0f0ff; }

  .portfolio-bulb-silver { background: linear-gradient(135deg, #4a4a5a 0%, #7a7a8a 100%); color: #f0f0f5; }
  .portfolio-bulb-silver .portfolio-bulb-icon { color: #c8c8d8; }
  .portfolio-bulb-silver .portfolio-bulb-link { color: #d8d8e8; }
  .portfolio-bulb-silver .portfolio-bulb-name { color: #f0f0f5; }

  .portfolio-bulb-white  { background: linear-gradient(135deg, #2c3e50 0%, #4a5568 100%); color: #f8f8f8; }
  .portfolio-bulb-white  .portfolio-bulb-icon { color: #e8e8f0; }
  .portfolio-bulb-white  .portfolio-bulb-link { color: #d0d0e0; }
  .portfolio-bulb-white  .portfolio-bulb-name { color: #f8f8f8; }

  .portfolio-bulb-orange { background: linear-gradient(135deg, #7a3000 0%, #c85000 100%); color: #fff3e0; }
  .portfolio-bulb-orange .portfolio-bulb-icon { color: #ffb347; }
  .portfolio-bulb-orange .portfolio-bulb-link { color: #ffd0a0; }
  .portfolio-bulb-orange .portfolio-bulb-name { color: #fff3e0; }

  .portfolio-bulb-brown  { background: linear-gradient(135deg, #4a2500 0%, #7a3e10 100%); color: #fdf0e0; }
  .portfolio-bulb-brown  .portfolio-bulb-icon { color: #d4956a; }
  .portfolio-bulb-brown  .portfolio-bulb-link { color: #e8c8a0; }
  .portfolio-bulb-brown  .portfolio-bulb-name { color: #fdf0e0; }
</style>
@endpush

@endsection
