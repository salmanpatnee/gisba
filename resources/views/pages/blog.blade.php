@extends('layouts.site')

@section('title', 'Blog | GISBA Consultants — Cybersecurity Insights & Compliance Guidance')
@section('meta_description', 'Expert insights on NIS2 compliance, cybersecurity frameworks, ISO standards, and digital resilience from the GISBA consulting team.')

@section('banner')
  <div class="d-flex justify-content-between align-items-center flex-wrap gap-2">
    <span><i class="bi bi-journal-text me-2"></i>GISBA Blog — Cybersecurity Insights &amp; Compliance Guidance</span>
    <div class="d-flex gap-3">
      <a href="{{ route('home') }}"><i class="bi bi-house me-1"></i>Home</a>
      <a href="{{ route('contact-us') }}"><i class="bi bi-envelope me-1"></i>Contact</a>
    </div>
  </div>
@endsection

@section('footer_tagline')
  Cybersecurity Insights &amp; Compliance Guidance<br />
  Expert Perspectives from the GISBA Consulting Team.
@endsection

@section('content')

<style>
/* ─── Blog Hero ─────────────────────────────────────────────── */
.blog-hero { padding: 40px 36px 44px; border-radius: var(--radius-lg); }
.blog-hero-label { display: inline-block; font-size: 11px; font-weight: 700; letter-spacing: 1.4px; text-transform: uppercase; color: var(--accent); background: rgba(200,168,75,0.12); border: 1px solid rgba(200,168,75,0.3); padding: 4px 14px; border-radius: 20px; margin-bottom: 16px; }
.blog-hero-title { font-family: var(--font-display); font-size: clamp(1.6rem, 3.5vw, 2.4rem); color: var(--text-white); font-weight: 900; line-height: 1.2; margin-bottom: 14px; }
.blog-hero-title span { color: var(--accent); }
.blog-hero-desc { color: rgba(255,255,255,0.78); font-size: 15.5px; line-height: 1.7; max-width: 520px; margin-bottom: 0; }

/* ─── Knowledge Base Section ────────────────────────────────── */
.kb-section { padding: 60px 0 80px; background: var(--bg-page); }
.kb-section-header { margin-bottom: 48px; }
.kb-section-label { font-size: 11px; font-weight: 700; letter-spacing: 1.2px; text-transform: uppercase; color: var(--accent); display: block; margin-bottom: 6px; }
.kb-section-title { font-family: var(--font-display); font-size: 1.25rem; color: var(--navy); font-weight: 700; margin-bottom: 4px; }
.kb-accent-bar { width: 40px; height: 3px; background: var(--accent); border-radius: 2px; }
.kb-count-badge { display: inline-flex; align-items: center; gap: 6px; font-size: 12px; font-weight: 600; color: var(--text-muted); background: var(--bg-section-alt); border: 1px solid var(--border-light); padding: 4px 12px; border-radius: 20px; }

/* ─── Category Card ─────────────────────────────────────────── */
.kb-card {
  background: var(--bg-white);
  border: 1px solid var(--border-light);
  border-radius: var(--radius-lg);
  overflow: hidden;
  box-shadow: var(--shadow-card);
  transition: box-shadow 0.25s ease, transform 0.25s ease;
  height: 100%;
  display: flex;
  flex-direction: column;
}
.kb-card:hover { box-shadow: var(--shadow-hover); transform: translateY(-3px); }

.kb-card-header {
  padding: 12px 16px 10px;
  border-bottom: 1px solid var(--border-light);
  background: linear-gradient(135deg, var(--navy) 0%, rgba(0,33,80,0.92) 100%);
  position: relative;
  overflow: hidden;
}
.kb-card-header::before {
  content: '';
  position: absolute;
  top: -16px; right: -16px;
  width: 60px; height: 60px;
  background: rgba(200,168,75,0.1);
  border-radius: 50%;
}
.kb-card-icon {
  width: 26px; height: 26px;
  background: rgba(200,168,75,0.15);
  border: 1px solid rgba(200,168,75,0.3);
  border-radius: 6px;
  display: inline-flex; align-items: center; justify-content: center;
  font-size: 12px;
  color: var(--accent);
  position: relative; z-index: 1;
  margin-right: 8px;
  vertical-align: middle;
}
.kb-card-category-name {
  font-family: var(--font-display);
  font-size: 0.82rem;
  font-weight: 800;
  color: #ffffff;
  line-height: 1.3;
  margin: 0;
  position: relative; z-index: 1;
  letter-spacing: 0.01em;
  display: inline;
  vertical-align: middle;
}

.kb-card-body {
  padding: 10px 16px 14px;
  flex: 1;
}
.kb-article-list {
  list-style: none;
  margin: 0;
  padding: 0;
}
.kb-article-list li {
  border-bottom: 1px solid var(--border-light);
  padding: 0;
}
.kb-article-list li:last-child { border-bottom: none; }

.kb-article-link {
  display: flex;
  align-items: flex-start;
  gap: 7px;
  padding: 6px 0;
  text-decoration: none;
  color: var(--navy);
  font-size: 12.5px;
  font-weight: 500;
  line-height: 1.4;
  transition: color 0.18s ease, gap 0.18s ease;
}
.kb-article-link:hover { color: var(--accent); gap: 10px; }
.kb-article-link::before {
  content: '';
  flex-shrink: 0;
  margin-top: 5px;
  width: 4px; height: 4px;
  border-radius: 50%;
  background: var(--accent);
  opacity: 0.6;
  transition: opacity 0.18s ease, transform 0.18s ease;
}
.kb-article-link:hover::before { opacity: 1; transform: scale(1.3); }

/* ─── Reveal animation ──────────────────────────────────────── */
.kb-reveal { opacity: 0; transform: translateY(18px); transition: opacity 0.48s ease, transform 0.48s ease; }
.kb-reveal.visible { opacity: 1; transform: translateY(0); }
</style>

{{-- ── Hero ─────────────────────────────────────────────────────── --}}
<div class="page-layout" style="padding-bottom:0;">
  <div class="container">
    <div class="hero-section blog-hero">
      <div class="row align-items-center g-4">
        <div class="col-12">
          <span class="blog-hero-label"><i class="bi bi-journal-text me-1"></i> GISBA Insights</span>
          <h1 class="blog-hero-title">Cybersecurity &amp; Compliance<br /><span>Insights from the Field</span></h1>
          <p class="blog-hero-desc">Practical perspectives on NIS2, ISO standards, cyber resilience, and the evolving regulatory landscape — from consultants who deliver these outcomes for clients every day.</p>
        </div>
      </div>
    </div>
  </div>
</div>

{{-- ── NIS2 Kit Promo Banner ──────────────────────────────────────── --}}
@include('partials.nis2-kit-banner')

{{-- ── Knowledge Base Grid ───────────────────────────────────────── --}}
<section class="kb-section">
  <div class="container">

    <div class="kb-section-header kb-reveal">
      <div class="d-flex align-items-end justify-content-between flex-wrap gap-3">
        <div>
          <span class="kb-section-label">Knowledge Base</span>
          <h2 class="kb-section-title">Browse Articles by Category</h2>
          <div class="kb-accent-bar mt-2"></div>
        </div>
        <span class="kb-count-badge">
          <i class="bi bi-grid-3x3-gap" style="color:var(--accent);"></i>
          {{ $categorizedPosts->count() }} {{ Str::plural('Category', $categorizedPosts->count()) }}
        </span>
      </div>
    </div>

    <div class="row g-4">
      @foreach($categorizedPosts as $categoryName => $articles)
      <div class="col-12 col-md-6 col-lg-4 kb-reveal" style="transition-delay: {{ $loop->index * 0.07 }}s;">
        <div class="kb-card">
          <div class="kb-card-header">
            <div class="d-flex align-items-center gap-2" style="position:relative;z-index:1;">
              <span class="kb-card-icon"><i class="bi bi-folder2-open"></i></span>
              <h3 class="kb-card-category-name">{{ $categoryName }}</h3>
            </div>
          </div>
          <div class="kb-card-body">
            <ul class="kb-article-list">
              @foreach($articles as $article)
              <li>
                <a href="{{ route('nis2.show', $article->slug) }}" class="kb-article-link">
                  {{ $article->title }}
                </a>
              </li>
              @endforeach
            </ul>
          </div>
        </div>
      </div>
      @endforeach
    </div>

  </div>
</section>


@endsection

@push('scripts')
<script>
(function () {
  const revealObserver = new IntersectionObserver(entries => {
    entries.forEach(entry => {
      if (entry.isIntersecting) {
        entry.target.classList.add('visible');
        revealObserver.unobserve(entry.target);
      }
    });
  }, { threshold: 0.08 });

  document.querySelectorAll('.kb-reveal').forEach(el => revealObserver.observe(el));
})();
</script>
@endpush
