@extends('layouts.site')

@section('title', 'Success Stories | GISBA Consultants')
@section('meta_description', 'Explore GISBA success stories — real-world cybersecurity consulting and training engagements delivered across the globe.')

@section('banner')
  <div class="d-flex justify-content-between align-items-center flex-wrap gap-2">
    <span><i class="bi bi-star me-2"></i>GISBA Success Stories — Real-World Cybersecurity Engagements</span>
    <div class="d-flex gap-3">
      <a href="{{ route('home') }}"><i class="bi bi-house me-1"></i>Home</a>
      <a href="{{ route('contact-us') }}"><i class="bi bi-envelope me-1"></i>Contact</a>
    </div>
  </div>
@endsection

@section('footer_tagline')
  Success Stories &amp; Client Engagements<br />
  Global Cybersecurity Consulting &amp; Training.
@endsection

@section('content')

<style>
.ss-nav { background: var(--bg-white); border-bottom: 2px solid var(--border-light); position: sticky; top: 0; z-index: 100; box-shadow: 0 2px 8px rgba(0,51,102,0.07); }
.ss-nav .nav-pills .nav-link { font-size: 12.5px; font-weight: 600; letter-spacing: 0.3px; color: var(--navy); padding: 10px 14px; border-radius: var(--radius-sm); white-space: nowrap; }
.ss-nav .nav-pills .nav-link:hover, .ss-nav .nav-pills .nav-link.active { background: var(--navy); color: #fff; }
.ss-section { padding: 64px 0 48px; }
.ss-section:nth-child(even) { background: var(--bg-section-alt); }
.ss-section-header { margin-bottom: 40px; }
.ss-section-label { display: inline-block; font-size: 11px; font-weight: 700; letter-spacing: 1.2px; text-transform: uppercase; color: var(--accent); margin-bottom: 8px; }
.ss-section-title { font-family: var(--font-display); font-size: clamp(1.35rem, 2.5vw, 1.75rem); color: var(--navy); margin-bottom: 12px; }
.ss-accent-bar { width: 48px; height: 3px; background: var(--accent); border-radius: 2px; margin-bottom: 12px; }
.ss-section-desc { color: var(--text-muted); font-size: 15px; max-width: 600px; }
.ss-featured-card { border-radius: var(--radius-lg); overflow: hidden; box-shadow: var(--shadow-card); background: var(--bg-white); transition: box-shadow 0.25s ease, transform 0.25s ease; display: flex; flex-direction: column; }
.ss-featured-card:hover { box-shadow: var(--shadow-hover); transform: translateY(-4px); }
.ss-featured-card img { width: 100%; height: 360px; object-fit: contain; background: #f0f3f8; display: block; }
.ss-featured-caption { flex: 1; min-height: 80px; padding: 20px 24px; border-top: 3px solid var(--accent); display: flex; align-items: center; background: var(--bg-white); }
.ss-featured-caption h3 { font-family: var(--font-display); font-size: 1rem; color: var(--navy); line-height: 1.45; margin: 0; }
.ss-grid { display: grid; grid-template-columns: repeat(2, 1fr); gap: 28px; }
@media (max-width: 575px) { .ss-grid { grid-template-columns: 1fr; } }
.ss-card { border-radius: var(--radius-md); overflow: hidden; background: var(--bg-white); box-shadow: var(--shadow-card); transition: box-shadow 0.25s ease, transform 0.25s ease; cursor: pointer; display: flex; flex-direction: column; }
.ss-card:hover { box-shadow: var(--shadow-hover); transform: translateY(-3px); }
.ss-card-img-wrap { position: relative; overflow: hidden; aspect-ratio: 16/10; background: #e8edf4; }
.ss-card-img-wrap img { width: 100%; height: 100%; object-fit: contain; background: #f0f3f8; transition: transform 0.4s ease; display: block; }
.ss-card:hover .ss-card-img-wrap img { transform: scale(1.05); }
.ss-card-overlay { position: absolute; inset: 0; background: linear-gradient(to top, rgba(0,33,80,0.65) 0%, transparent 55%); opacity: 0; transition: opacity 0.3s ease; }
.ss-card:hover .ss-card-overlay { opacity: 1; }
.ss-card-body { flex: 1; min-height: 68px; padding: 14px 18px; border-top: 3px solid var(--accent); display: flex; align-items: center; background: var(--bg-white); }
.ss-card-body p { font-size: 13.5px; font-weight: 600; font-family: var(--font-display); color: var(--navy); margin: 0; line-height: 1.45; }
.ss-lightbox { display: none; position: fixed; inset: 0; background: rgba(0,0,0,0.88); z-index: 9999; align-items: center; justify-content: center; padding: 24px; }
.ss-lightbox.active { display: flex; }
.ss-lightbox-inner { position: relative; max-width: 900px; width: 100%; text-align: center; }
.ss-lightbox-inner img { max-width: 100%; max-height: 80vh; border-radius: var(--radius-md); box-shadow: 0 16px 64px rgba(0,0,0,0.6); }
.ss-lightbox-caption { color: rgba(255,255,255,0.9); font-size: 14px; margin-top: 14px; font-weight: 600; }
.ss-lightbox-close { position: absolute; top: -44px; right: 0; background: none; border: none; color: #fff; font-size: 32px; cursor: pointer; line-height: 1; opacity: 0.85; }
.ss-lightbox-close:hover { opacity: 1; }
.ss-reveal { opacity: 0; transform: translateY(24px); transition: opacity 0.55s ease, transform 0.55s ease; }
.ss-reveal.visible { opacity: 1; transform: translateY(0); }
</style>

<div class="page-layout">
  <div class="container">
    <div class="col-12">
      <main class="img-content">
        <section class="hero-section container">
          <div class="row align-items-center">
            <div class="col-md-6">
              <h1 class="hero-title">Success Stories<br /><span>Real-World Engagements</span></h1>
              <p class="hero-subtitle">Measurable Cybersecurity Outcomes Across Industries &amp; Regions</p>
              <p class="hero-desc">A documented record of real-world engagements — measurable outcomes delivered for clients across industries and regions since <strong>2006</strong>.</p>
            </div>
            <div class="col-md-6 text-center">
              <img class="image-content img-fluid" src="{{ asset('assets/images/thumbsup.png') }}" alt="GISBA Success Stories">
            </div>
          </div>
        </section>
      </main>
    </div>
  </div>
</div>

<nav class="ss-nav">
  <div class="container">
    <div class="overflow-auto py-1">
      <ul class="nav nav-pills flex-nowrap gap-1">
        <li class="nav-item"><a class="nav-link" href="#ss-intro">Overview</a></li>
        <li class="nav-item"><a class="nav-link" href="#ss-recognition">Recognition</a></li>
        <li class="nav-item"><a class="nav-link" href="#ss-iso27001">ISO 27001</a></li>
        <li class="nav-item"><a class="nav-link" href="#ss-iso22301">ISO 22301</a></li>
        <li class="nav-item"><a class="nav-link" href="#ss-iso20000">ISO 20000</a></li>
      </ul>
    </div>
  </div>
</nav>

<div class="page-layout" style="padding-top:0;">

  <section id="ss-intro" class="ss-section">
    <div class="container">
      <div class="ss-section-header ss-reveal">
        <span class="ss-section-label">Established 2006</span>
        <h2 class="ss-section-title">Operational and Trusted for 20 Years</h2>
        <div class="ss-accent-bar"></div>
        <p class="ss-section-desc">From inception to global recognition — a visual timeline of GISBA's journey and cumulative achievements.</p>
      </div>
      <div class="row g-4 gy-4">
        <div class="col-md-6 ss-reveal">
          <div class="ss-featured-card" data-img="{{ asset('assets/images/success_stories/Slide3.jpg') }}" data-caption="Operational and Trusted Since 2006 – 20 Years of Consulting Excellence">
            <img src="{{ asset('assets/images/success_stories/Slide3.jpg') }}" alt="Operational and Trusted Since 2006" loading="lazy">
            <div class="ss-featured-caption"><h3>Operational and Trusted Since 2006 – 20 Years of Consulting Excellence</h3></div>
          </div>
        </div>
        <div class="col-md-6 ss-reveal">
          <div class="ss-featured-card" data-img="{{ asset('assets/images/success_stories/Slide4.png') }}" data-caption="Our Achievements">
            <img src="{{ asset('assets/images/success_stories/Slide4.png') }}" alt="Our Achievements" loading="lazy">
            <div class="ss-featured-caption"><h3>Our Achievements — A 20-Year Track Record</h3></div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <section id="ss-recognition" class="ss-section">
    <div class="container">
      <div class="ss-section-header ss-reveal">
        <span class="ss-section-label">Awards & Events</span>
        <h2 class="ss-section-title">Exhibitions, Seminars &amp; Industry Recognition</h2>
        <div class="ss-accent-bar"></div>
        <p class="ss-section-desc">Active participation in global industry events and recognition by leading CIO and consulting award bodies.</p>
      </div>
      <div class="ss-grid">
        @foreach([
          ['Slide5.png', 'Participation in Exhibitions and Seminars'],
          ['Slide6.jpg', 'Participation in Exhibitions and Seminars'],
          ['Slide7.jpg', 'Participation in Exhibitions and Seminars'],
          ['Slide9.jpg', 'Recognized Leadership: CIO Top 100 Award'],
          ['Slide10.jpg', 'Recognized Leadership: Top 50 CIO Award'],
          ['Slide11.png', 'Top Three Consultants of the Year 2025'],
        ] as [$file, $caption])
        <div class="ss-card ss-reveal" data-img="{{ asset('assets/images/success_stories/' . $file) }}" data-caption="{{ $caption }}">
          <div class="ss-card-img-wrap">
            <img src="{{ asset('assets/images/success_stories/' . $file) }}" alt="{{ $caption }}" loading="lazy">
            <div class="ss-card-overlay"></div>
          </div>
          <div class="ss-card-body"><p>{{ $caption }}</p></div>
        </div>
        @endforeach
      </div>
    </div>
  </section>

  <section id="ss-iso27001" class="ss-section">
    <div class="container">
      <div class="ss-section-header ss-reveal">
        <span class="ss-section-label">Information Security</span>
        <h2 class="ss-section-title">ISO 27001: Information Security Management System</h2>
        <div class="ss-accent-bar"></div>
        <p class="ss-section-desc">Decades of leadership in cybersecurity — from early BS 7799 implementations to cutting-edge cloud security and PCI/DSS compliance.</p>
      </div>
      <div class="ss-grid">
        @foreach([
          ['Slide13.png', 'Information Security Professional Since 1997 — 21 Years of Experience'],
          ['Slide14.png', 'BS 7799-2:2002 — Old Name of ISO 27001'],
          ['Slide15.png', 'BS 7799-2:2002 — Old Name of ISO 27001'],
          ['Slide16.jpg', 'Decades of Leadership in Infosec/Cybersecurity'],
          ['Slide17.jpg', 'Decades of Leadership in Infosec/Cybersecurity'],
          ['Slide18.jpg', 'Decades of Leadership in Infosec/Cybersecurity'],
          ['Slide19.jpg', 'Decades of Leadership in Infosec/Cybersecurity'],
          ['Slide20.png', 'Decades of Leadership in Infosec/Cybersecurity'],
          ['Slide21.png', 'Decades of Leadership in Cybersecurity Certification'],
          ['Slide22.jpg', 'PCI/DSS Achievement'],
          ['Slide23.jpg', 'PCI/DSS Achievement'],
          ['Slide25.png', 'Leadership in Cloud Computing Arena'],
          ['Slide26.png', 'Leadership in Cloud Computing Arena'],
        ] as [$file, $caption])
        <div class="ss-card ss-reveal" data-img="{{ asset('assets/images/success_stories/' . $file) }}" data-caption="{{ $caption }}">
          <div class="ss-card-img-wrap">
            <img src="{{ asset('assets/images/success_stories/' . $file) }}" alt="{{ $caption }}" loading="lazy">
            <div class="ss-card-overlay"></div>
          </div>
          <div class="ss-card-body"><p>{{ $caption }}</p></div>
        </div>
        @endforeach
      </div>
    </div>
  </section>

  <section id="ss-iso22301" class="ss-section">
    <div class="container">
      <div class="ss-section-header ss-reveal">
        <span class="ss-section-label">Business Continuity</span>
        <h2 class="ss-section-title">ISO 22301: Business Continuity Management</h2>
        <div class="ss-accent-bar"></div>
        <p class="ss-section-desc">Delivering resilience for enterprises across the GCC and beyond — including government, banking, and critical infrastructure sectors.</p>
      </div>
      <div class="ss-grid">
        @foreach([
          ['Slide28.jpg', 'Leadership in Business Continuity Arena'],
          ['Slide29.png', 'Leadership in Business Continuity Arena'],
          ['Slide30.png', 'Leadership in Business Continuity Arena'],
          ['Slide31.jpg', 'Leadership in Business Continuity Arena'],
          ['Slide32.jpg', 'ISO 22301 for Ministry of Entertainment, Water, & Agriculture'],
          ['Slide33.png', 'Leadership in Business Continuity Arena'],
          ['Slide34.png', 'Leadership in Business Continuity Arena'],
          ['Slide35.jpg', 'ISO 22301 — ANSI Accredited'],
          ['Slide36.jpg', 'Leadership in Business Continuity Arena'],
          ['Slide37.jpg', 'World Continuity Conference in Singapore'],
          ['Slide38.jpg', 'Sponsoring ISACA Events'],
          ['Slide39.jpg', 'Sponsoring ISACA Events'],
          ['Slide40.jpg', 'Sponsoring ISACA Events'],
          ['Slide41.jpg', 'Sponsoring ISACA Events'],
          ['Slide42.jpg', 'Sponsoring ISACA Events'],
        ] as [$file, $caption])
        <div class="ss-card ss-reveal" data-img="{{ asset('assets/images/success_stories/' . $file) }}" data-caption="{{ $caption }}">
          <div class="ss-card-img-wrap">
            <img src="{{ asset('assets/images/success_stories/' . $file) }}" alt="{{ $caption }}" loading="lazy">
            <div class="ss-card-overlay"></div>
          </div>
          <div class="ss-card-body"><p>{{ $caption }}</p></div>
        </div>
        @endforeach
      </div>
    </div>
  </section>

  <section id="ss-iso20000" class="ss-section">
    <div class="container">
      <div class="ss-section-header ss-reveal">
        <span class="ss-section-label">IT Service Management</span>
        <h2 class="ss-section-title">ISO 20000: Service Management System</h2>
        <div class="ss-accent-bar"></div>
        <p class="ss-section-desc">Leading ITSM implementations across banking, government, and enterprise sectors — backed by deep ITIL expertise.</p>
      </div>
      <div class="ss-grid">
        @foreach([
          ['Slide44.png', 'itSMF Recognition: First to Hit ISO 20000'],
          ['Slide45.png', 'ISO 20000 Achievement'],
          ['Slide46.png', 'Al-Rajhi Recognition — ISO 20000'],
          ['Slide47.png', 'ISO 20000 at Hail'],
          ['Slide48.png', 'ITSM Expertise: ITIL Expert'],
          ['Slide49.jpg', 'Leadership in IT Service Management'],
        ] as [$file, $caption])
        <div class="ss-card ss-reveal" data-img="{{ asset('assets/images/success_stories/' . $file) }}" data-caption="{{ $caption }}">
          <div class="ss-card-img-wrap">
            <img src="{{ asset('assets/images/success_stories/' . $file) }}" alt="{{ $caption }}" loading="lazy">
            <div class="ss-card-overlay"></div>
          </div>
          <div class="ss-card-body"><p>{{ $caption }}</p></div>
        </div>
        @endforeach
      </div>
    </div>
  </section>

</div>

<div class="ss-lightbox" id="ssLightbox" role="dialog" aria-modal="true" aria-label="Image viewer">
  <div class="ss-lightbox-inner">
    <button class="ss-lightbox-close" id="ssLightboxClose" aria-label="Close">&times;</button>
    <img id="ssLightboxImg" src="" alt="">
    <p class="ss-lightbox-caption" id="ssLightboxCaption"></p>
  </div>
</div>

@endsection

@push('scripts')
<script>
(function () {
  const lightbox  = document.getElementById('ssLightbox');
  const lbImg     = document.getElementById('ssLightboxImg');
  const lbCaption = document.getElementById('ssLightboxCaption');
  const lbClose   = document.getElementById('ssLightboxClose');

  function openLightbox(src, caption) {
    lbImg.src = src;
    lbImg.alt = caption;
    lbCaption.textContent = caption;
    lightbox.classList.add('active');
    document.body.style.overflow = 'hidden';
  }

  function closeLightbox() {
    lightbox.classList.remove('active');
    document.body.style.overflow = '';
    lbImg.src = '';
  }

  document.querySelectorAll('.ss-card, .ss-featured-card').forEach(card => {
    card.addEventListener('click', () => {
      const src     = card.dataset.img;
      const caption = card.dataset.caption;
      if (src) { openLightbox(src, caption); }
    });
  });

  lbClose.addEventListener('click', closeLightbox);
  lightbox.addEventListener('click', e => { if (e.target === lightbox) { closeLightbox(); } });
  document.addEventListener('keydown', e => { if (e.key === 'Escape') { closeLightbox(); } });

  const sections = document.querySelectorAll('section[id]');
  const navLinks = document.querySelectorAll('.ss-nav .nav-link');

  const observer = new IntersectionObserver(entries => {
    entries.forEach(entry => {
      if (entry.isIntersecting) {
        navLinks.forEach(link => {
          link.classList.toggle('active', link.getAttribute('href') === '#' + entry.target.id);
        });
      }
    });
  }, { rootMargin: '-40% 0px -55% 0px' });

  sections.forEach(s => observer.observe(s));

  const revealObserver = new IntersectionObserver(entries => {
    entries.forEach(entry => {
      if (entry.isIntersecting) {
        entry.target.classList.add('visible');
        revealObserver.unobserve(entry.target);
      }
    });
  }, { threshold: 0.08 });

  document.querySelectorAll('.ss-reveal').forEach(el => revealObserver.observe(el));
})();
</script>
@endpush
