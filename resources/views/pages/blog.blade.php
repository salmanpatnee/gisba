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

/* ─── Blog Grid Section ─────────────────────────────────────── */
.blog-section { padding: 60px 0 80px; background: var(--bg-page); }
.blog-section-header { margin-bottom: 40px; }
.blog-section-label { font-size: 11px; font-weight: 700; letter-spacing: 1.2px; text-transform: uppercase; color: var(--accent); display: block; margin-bottom: 6px; }
.blog-section-title { font-family: var(--font-display); font-size: 1.25rem; color: var(--navy); font-weight: 700; margin-bottom: 4px; }
.blog-accent-bar { width: 40px; height: 3px; background: var(--accent); border-radius: 2px; }

/* ─── Blog Card ─────────────────────────────────────────────── */
.blog-card { background: var(--bg-white); border: 1px solid var(--border-light); border-radius: var(--radius-lg); overflow: hidden; box-shadow: var(--shadow-card); transition: box-shadow 0.25s ease, transform 0.25s ease; display: flex; flex-direction: column; height: 100%; }
.blog-card:hover { box-shadow: var(--shadow-hover); transform: translateY(-4px); }
.blog-card-img-wrap { position: relative; overflow: hidden; aspect-ratio: 16/9; }
.blog-card-img-wrap img { width: 100%; height: 100%; object-fit: cover; transition: transform 0.45s ease; display: block; }
.blog-card:hover .blog-card-img-wrap img { transform: scale(1.06); }
.blog-card-overlay { position: absolute; inset: 0; background: linear-gradient(to top, rgba(0,33,80,0.5) 0%, transparent 50%); opacity: 0; transition: opacity 0.3s ease; }
.blog-card:hover .blog-card-overlay { opacity: 1; }
.blog-card-category { position: absolute; top: 14px; left: 14px; font-size: 10.5px; font-weight: 700; letter-spacing: 0.8px; text-transform: uppercase; background: var(--accent); color: var(--navy); padding: 3px 10px; border-radius: 20px; }
.blog-card-body { padding: 22px 24px; flex: 1; display: flex; flex-direction: column; }
.blog-card-meta { display: flex; align-items: center; gap: 14px; font-size: 11.5px; color: var(--text-muted); margin-bottom: 10px; }
.blog-card-meta i { font-size: 11px; color: var(--accent); }
.blog-card-title { font-family: var(--font-display); font-size: 1.05rem; color: var(--navy); font-weight: 700; line-height: 1.4; margin-bottom: 10px; }
.blog-card-excerpt { font-size: 13.5px; color: var(--text-muted); line-height: 1.65; flex: 1; margin-bottom: 18px; }
.blog-card-footer { display: flex; align-items: center; justify-content: space-between; border-top: 1px solid var(--border-light); padding-top: 14px; }
.blog-card-author { font-size: 11.5px; color: var(--text-muted); font-weight: 500; }
.btn-read-more { display: inline-flex; align-items: center; gap: 6px; font-size: 12.5px; font-weight: 700; color: var(--navy-light); text-decoration: none; transition: gap 0.2s ease, color 0.2s ease; }
.btn-read-more:hover { color: var(--navy); gap: 10px; }
.btn-read-more i { font-size: 12px; }

/* ─── Empty Placeholder Card ─────────────────────────────────── */
.blog-card-placeholder { background: var(--bg-section-alt); border: 2px dashed var(--border-mid); border-radius: var(--radius-lg); min-height: 340px; display: flex; flex-direction: column; align-items: center; justify-content: center; text-align: center; padding: 32px; }
.blog-card-placeholder i { font-size: 2rem; color: var(--border-mid); margin-bottom: 12px; }
.blog-card-placeholder p { font-size: 13px; color: var(--text-muted); margin: 0; }

/* ─── Reveal animation ──────────────────────────────────────── */
.blog-reveal { opacity: 0; transform: translateY(20px); transition: opacity 0.5s ease, transform 0.5s ease; }
.blog-reveal.visible { opacity: 1; transform: translateY(0); }
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

{{-- ── Blog Grid ─────────────────────────────────────────────────── --}}
<section class="blog-section">
  <div class="container">

    <div class="blog-section-header blog-reveal">
      <span class="blog-section-label">Latest Articles</span>
      <h2 class="blog-section-title">Recent Insights &amp; Perspectives</h2>
      <div class="blog-accent-bar mt-2"></div>
    </div>

    <div class="row g-4">

      @foreach($posts as $index => $post)
      <div class="col-12 col-md-6 col-lg-4 blog-reveal" style="transition-delay: {{ $index * 0.1 }}s;">
        <div class="blog-card">
          <div class="blog-card-img-wrap">
            <img src="{{ $post->image_url }}" alt="{{ $post->title }}" loading="lazy">
            <div class="blog-card-overlay"></div>
            <span class="blog-card-category">{{ $post->category->value }}</span>
          </div>
          <div class="blog-card-body">
            <div class="blog-card-meta">
              <span><i class="bi bi-calendar3"></i> {{ $post->formatted_date }}</span>
              {{-- <span><i class="bi bi-person"></i> {{ $post->author }}</span> --}}
            </div>
            <h2 class="blog-card-title">{{ $post->title }}</h2>
            <p class="blog-card-excerpt">{{ $post->excerpt }}</p>
            <div class="blog-card-footer">
              <span class="blog-card-author"><i class="bi bi-person me-1"></i>{{ $post->author }}</span>
              <a href="{{ route('blog.show', $post->slug) }}" class="btn-read-more">
                Read More <i class="bi bi-arrow-right"></i>
              </a>
            </div>
          </div>
        </div>
      </div>
      @endforeach

      {{-- Placeholder card to fill the 3-column grid --}}
      @if($posts->count() % 3 !== 0)
        @for($i = 0; $i < (3 - ($posts->count() % 3)); $i++)
        <div class="col-12 col-md-6 col-lg-4 blog-reveal d-none d-lg-block">
          <div class="blog-card-placeholder">
            <i class="bi bi-pencil-square"></i>
            <p><strong style="color:var(--navy);display:block;margin-bottom:4px;">More Articles Coming Soon</strong>New insights and expert perspectives are added regularly.</p>
          </div>
        </div>
        @endfor
      @endif

    </div>

    @if($posts->hasPages())
    <div class="mt-5 d-flex justify-content-center">
      {{ $posts->links() }}
    </div>
    @endif

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

  document.querySelectorAll('.blog-reveal').forEach(el => revealObserver.observe(el));
})();
</script>
@endpush
