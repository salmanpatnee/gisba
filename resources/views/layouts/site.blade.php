<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>@yield('title')</title>
  <meta name="description" content="@yield('meta_description')" />

  <!-- Bootstrap 5.3 CDN -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" />
  <!-- Bootstrap Icons -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet" />
  <!-- Flag Icons (SVG-based country flags) -->
  <link href="https://cdn.jsdelivr.net/npm/flag-icons@7.2.3/css/flag-icons.min.css" rel="stylesheet" />
  <!-- Google Fonts: Merriweather (display) + Source Sans 3 (body) -->
  <link href="https://fonts.googleapis.com/css2?family=Merriweather:wght@400;700;900&family=Source+Sans+3:wght@300;400;500;600;700&display=swap" rel="stylesheet" />
  <!-- Custom Styles -->
  <link href="{{ asset('assets/css/style.css') }}" rel="stylesheet" />
</head>
<body>

  <!-- ============================================================
       TOP BANNER
  ============================================================ -->
  <div class="top-banner">
    <div class="container">
      @yield('banner')
    </div>
  </div>

  <!-- ============================================================
       MASTHEAD / HEADER
  ============================================================ -->
  <header class="masthead">
    <div class="container">
      <div class="masthead-logo-img">
        <a href="{{ route('home') }}" class="masthead-logo">
          <img src="{{ asset('assets/images/logo.jpg') }}" alt="GISBA Logo" class="masthead-logo-img" />
        </a>
      </div>
      <span>Global Reach in Consulting &amp; Training</span>
      <div>
        <div class="masthead-title"></div>
      </div>
    </div>
  </header>

  <!-- ============================================================
       FLAGS STRIP — countries served
  ============================================================ -->
  <div class="flags-strip">
    <div class="container">
      <div class="flag-row">
        <span class="flags-label">
          <i class="bi bi-globe2"></i>
          <span>Global Reach</span>
        </span>
        <span class="flags-divider" aria-hidden="true"></span>
        <div class="flags-list">
          <span class="flag-item" data-country="United Kingdom" title="United Kingdom"><span class="fi fi-gb"></span></span>
          <span class="flag-item" data-country="EU" title="European Union"><span class="fi fi-eu"></span></span>
          <span class="flag-item" data-country="UAE" title="United Arab Emirates"><span class="fi fi-ae"></span></span>
          <span class="flag-item" data-country="Bahrain" title="Bahrain"><span class="fi fi-bh"></span></span>
          <span class="flag-item" data-country="Kuwait" title="Kuwait"><span class="fi fi-kw"></span></span>
          <span class="flag-item" data-country="Jordan" title="Jordan"><span class="fi fi-jo"></span></span>
          <span class="flag-item" data-country="Egypt" title="Egypt"><span class="fi fi-eg"></span></span>
          <span class="flag-item" data-country="Malaysia" title="Malaysia"><span class="fi fi-my"></span></span>
          <span class="flag-item" data-country="Indonesia" title="Indonesia"><span class="fi fi-id"></span></span>
          <span class="flag-item" data-country="South Africa" title="South Africa"><span class="fi fi-za"></span></span>
          <span class="flag-item" data-country="Nigeria" title="Nigeria"><span class="fi fi-ng"></span></span>
          <span class="flag-item" data-country="USA" title="United States"><span class="fi fi-us"></span></span>
          <span class="flag-item" data-country="Canada" title="Canada"><span class="fi fi-ca"></span></span>
          <span class="flag-item" data-country="Australia" title="Australia"><span class="fi fi-au"></span></span>
        </div>
      </div>
    </div>
  </div>

  <!-- ============================================================
       PRIMARY NAVIGATION BAR
  ============================================================ -->
  <nav class="navbar navbar-expand-lg site-navbar" role="navigation" aria-label="Primary navigation">
    <div class="container">

      <!-- Mobile: hamburger toggle -->
      <button class="navbar-toggler site-navbar-toggler" type="button"
              data-bs-toggle="collapse" data-bs-target="#primaryNav"
              aria-controls="primaryNav" aria-expanded="false"
              aria-label="Toggle navigation">
        <span class="toggler-bar"></span>
        <span class="toggler-bar"></span>
        <span class="toggler-bar"></span>
      </button>

      <!-- Nav links -->
      <div class="collapse navbar-collapse" id="primaryNav">
        <ul class="navbar-nav">
          <li class="nav-item">
            <a class="nav-link site-nav-link {{ request()->routeIs('home') ? 'active' : '' }}" href="{{ route('home') }}">
              <i class="bi bi-house"></i>Home
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link site-nav-link {{ request()->routeIs('nis2') ? 'active' : '' }}" href="{{ route('nis2') }}">
              <i class="bi bi-mortarboard"></i>NIS2 Implementation Toolkit
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link site-nav-link {{ request()->routeIs('training') ? 'active' : '' }}" href="{{ route('training') }}">
              <i class="bi bi-mortarboard"></i>Training Course Development Services
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link site-nav-link {{ request()->routeIs('success-stories') ? 'active' : '' }}" href="{{ route('success-stories') }}">
              <i class="bi bi-star"></i>Success Stories
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link site-nav-link {{ request()->routeIs('contact-us') ? 'active' : '' }}" href="{{ route('contact-us') }}">
              <i class="bi bi-envelope"></i>Contact Us
            </a>
          </li>
        </ul>
      </div>

    </div>
  </nav>

  @yield('content')

  <!-- ============================================================
       FOOTER
  ============================================================ -->
  <footer class="site-footer">
    <div class="container">
      <div class="row g-4 align-items-start">

        <div class="col-12 col-md-4">
          <div class="footer-logo-text mb-2">GISBA</div>
          <p style="font-size:12.5px; margin:0;">
            @yield('footer_tagline')
          </p>
        </div>

        <div class="col-12 col-md-4">
          <strong style="color:#fff; font-size:13px; display:block; margin-bottom:8px;">Quick Links</strong>
          <ul style="list-style:none; padding:0; margin:0; font-size:12.5px;">
            <li><a href="{{ route('home') }}">Home</a></li>
            <li><a href="{{ route('nis2') }}">NIS2 Implementation Toolkit</a></li>
            <li><a href="{{ route('training') }}">Training Course Development Services</a></li>
            <li><a href="{{ route('success-stories') }}">Success Stories</a></li>
            <li><a href="{{ route('contact-us') }}">Contact Us</a></li>
          </ul>
        </div>

        <div class="col-12 col-md-4">
          <strong style="color:#fff; font-size:13px; display:block; margin-bottom:8px;">Contact</strong>
          <p style="font-size:12.5px; margin:0;">
            <i class="bi bi-envelope me-1"></i> <a href="mailto:support@gisba.net">support@gisba.net</a><br />
            {{-- <i class="bi bi-telephone me-1"></i> <a href="tel:+97338397453">+973 3839 7453</a><br />
            <i class="bi bi-geo-alt me-1"></i> GISBA Consultants Co. W.L.L.<br />
            Kingdom of Bahrain<br />
            Commercial Registration: 59649-1 --}}
          </p>
        </div>

      </div>

      <hr style="border-color:rgba(255,255,255,0.15); margin:18px 0 14px;" />

      <div class="d-flex flex-wrap justify-content-between align-items-center gap-2">
        <span style="font-size:11.5px;">&copy; 2006 - 2026 GISBA. All rights reserved.</span>
        <span style="font-size:11.5px;">
          <a href="{{ route('privacy-policy') }}">Privacy Policy</a> &nbsp;|&nbsp;
          <a href="{{ route('digital-delivery-policy') }}">Digital Delivery Policy</a> &nbsp;|&nbsp;
          <a href="{{ route('digital-refund-policy') }}">Digital Refund Policy</a> &nbsp;|&nbsp;
          <a href="{{ route('terms-of-use') }}">Terms of Use</a>
        </span>
      </div>
    </div>
  </footer>

  <!-- Bootstrap JS -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

  <script>
    // Sidebar scroll spy
    const links = document.querySelectorAll('.sidebar-nav ul li a');
    const observer = new IntersectionObserver((entries) => {
      entries.forEach(entry => {
        if (entry.isIntersecting) {
          links.forEach(l => l.classList.remove('active'));
          const id = entry.target.id;
          const active = document.querySelector(`.sidebar-nav a[href="#${id}"]`);
          if (active) active.classList.add('active');
        }
      });
    }, { threshold: 0.3 });

    document.querySelectorAll('section[id]').forEach(s => observer.observe(s));
  </script>

  @stack('scripts')

</body>
</html>
