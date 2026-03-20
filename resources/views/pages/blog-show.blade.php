@extends('layouts.site')

@section('title', ($post->meta_title ?? $post->title) . ' | GISBA Blog')
@section('meta_description', $post->meta_description ?? $post->excerpt)

@section('banner')
  <div class="d-flex justify-content-between align-items-center flex-wrap gap-2">
    <span><i class="bi bi-journal-text me-2"></i>GISBA Blog &mdash; {{ $post->category->value }}</span>
    <div class="d-flex gap-3">
      <a href="{{ route('blog') }}"><i class="bi bi-arrow-left me-1"></i>All Articles</a>
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
/* ─── Article Hero ──────────────────────────────────────────── */
.article-hero-wrap { padding-bottom: 0; }
.article-hero { padding: 40px 36px; border-radius: var(--radius-lg); }
.article-breadcrumb { display: flex; align-items: center; gap: 8px; font-size: 12px; color: rgba(255,255,255,0.6); margin-bottom: 20px; flex-wrap: wrap; }
.article-breadcrumb a { color: rgba(255,255,255,0.6); text-decoration: none; transition: color 0.2s; }
.article-breadcrumb a:hover { color: var(--accent); }
.article-breadcrumb i { font-size: 10px; }
.article-category-badge { display: inline-block; font-size: 10.5px; font-weight: 700; letter-spacing: 0.8px; text-transform: uppercase; background: rgba(200,168,75,0.15); color: var(--accent); border: 1px solid rgba(200,168,75,0.35); padding: 3px 12px; border-radius: 20px; margin-bottom: 14px; }
.article-hero-title { font-family: var(--font-display); font-size: clamp(1.5rem, 3vw, 2.1rem); color: #fff; font-weight: 900; line-height: 1.25; margin-bottom: 18px; }
.article-meta { display: flex; align-items: center; gap: 18px; flex-wrap: wrap; }
.article-meta-item { display: flex; align-items: center; gap: 6px; font-size: 12.5px; color: rgba(255,255,255,0.65); }
.article-meta-item i { color: var(--accent); font-size: 12px; }

/* ─── Article Layout ────────────────────────────────────────── */
.article-layout { padding: 48px 0 64px; background: var(--bg-page); }

/* ─── Article Image ─────────────────────────────────────────── */
.article-featured-img { width: 100%; aspect-ratio: 16/7; object-fit: cover; border-radius: var(--radius-lg); box-shadow: var(--shadow-hover); margin-bottom: 36px; display: block; }

/* ─── Article Content ───────────────────────────────────────── */
.article-content-wrap { background: var(--bg-white); border: 1px solid var(--border-light); border-radius: var(--radius-lg); padding: 36px 40px; box-shadow: var(--shadow-card); }
@media (max-width: 575px) { .article-content-wrap { padding: 24px 20px; } }

.article-body { font-size: 15px; color: var(--text-body); line-height: 1.8; }
.article-body p { margin-bottom: 18px; }
.article-body .blog-lead { font-size: 16.5px; color: var(--navy); font-weight: 500; line-height: 1.7; border-left: 4px solid var(--accent); padding-left: 18px; margin-bottom: 28px; }
.article-body h2 { font-family: var(--font-display); font-size: 1.2rem; color: var(--navy); font-weight: 700; margin: 32px 0 12px; padding-bottom: 8px; border-bottom: 1px solid var(--border-light); }
.article-body h3 { font-family: var(--font-display); font-size: 1.05rem; color: var(--navy); font-weight: 700; margin: 22px 0 8px; }
.article-body ul.blog-list { list-style: none; padding: 0; margin-bottom: 18px; }
.article-body ul.blog-list li { padding: 9px 14px 9px 36px; position: relative; border-bottom: 1px solid var(--border-light); font-size: 14px; line-height: 1.6; }
.article-body ul.blog-list li:last-child { border-bottom: none; }
.article-body ul.blog-list li::before { content: "\F270"; font-family: "bootstrap-icons"; position: absolute; left: 10px; top: 10px; color: var(--accent); font-size: 13px; }
.article-body ul.blog-list li strong { color: var(--navy); }
.blog-callout { display: flex; align-items: flex-start; gap: 14px; background: #f0f4fa; border: 1px solid var(--border-light); border-left: 4px solid var(--navy-light); border-radius: var(--radius-md); padding: 16px 20px; margin: 22px 0; font-size: 14px; line-height: 1.6; color: var(--text-body); }
.blog-callout i { color: var(--navy-light); font-size: 1.1rem; flex-shrink: 0; margin-top: 2px; }
.blog-callout--gold { background: #fff8e6; border-left-color: var(--accent); }
.blog-callout--gold i { color: var(--accent); }

/* ─── Sidebar ───────────────────────────────────────────────── */
.article-sidebar-card { background: var(--bg-white); border: 1px solid var(--border-light); border-radius: var(--radius-md); padding: 22px 24px; box-shadow: var(--shadow-card); margin-bottom: 20px; }
.article-sidebar-card-title { font-size: 12px; font-weight: 700; text-transform: uppercase; letter-spacing: 0.8px; color: var(--navy); border-bottom: 2px solid var(--accent); padding-bottom: 8px; margin-bottom: 16px; }
.related-post-item { display: flex; align-items: flex-start; gap: 12px; padding: 10px 0; border-bottom: 1px solid var(--border-light); text-decoration: none; transition: background 0.2s; }
.related-post-item:last-child { border-bottom: none; padding-bottom: 0; }
.related-post-item:hover .related-post-title { color: var(--navy-light); }
.related-post-img { width: 60px; height: 44px; object-fit: cover; border-radius: var(--radius-sm); flex-shrink: 0; }
.related-post-title { font-size: 12.5px; font-weight: 600; color: var(--navy); line-height: 1.4; display: block; margin-bottom: 3px; }
.related-post-date { font-size: 11px; color: var(--text-muted); }
.author-info { display: flex; align-items: center; gap: 14px; }
.author-avatar { width: 48px; height: 48px; border-radius: 50%; background: linear-gradient(135deg, #001f4d 0%, #003b82 100%); display: flex; align-items: center; justify-content: center; color: var(--accent); font-size: 1.2rem; flex-shrink: 0; }
.author-name { font-size: 13px; font-weight: 700; color: var(--navy); display: block; margin-bottom: 2px; }
.author-role { font-size: 11.5px; color: var(--text-muted); }

/* ─── Article CTA ───────────────────────────────────────────── */
.article-bottom-cta { background: linear-gradient(135deg, #001f4d 0%, #003b82 100%); border-radius: var(--radius-lg); padding: 32px 36px; margin-top: 28px; }
.article-bottom-cta h3 { font-family: var(--font-display); font-size: 1.1rem; color: #fff; font-weight: 700; margin-bottom: 8px; }
.article-bottom-cta p { font-size: 13.5px; color: rgba(255,255,255,0.72); margin-bottom: 18px; }

/* ─── Back link ─────────────────────────────────────────────── */
.back-link { display: inline-flex; align-items: center; gap: 7px; font-size: 13px; font-weight: 600; color: var(--navy-light); text-decoration: none; margin-bottom: 24px; transition: gap 0.2s, color 0.2s; }
.back-link:hover { gap: 11px; color: var(--navy); }
.back-link i { font-size: 12px; }
</style>

{{-- ── Article Hero ──────────────────────────────────────────────── --}}
<div class="page-layout article-hero-wrap">
  <div class="container">
    <div class="hero-section article-hero">
      <nav class="article-breadcrumb" aria-label="Breadcrumb">
        <a href="{{ route('home') }}"><i class="bi bi-house"></i> Home</a>
        <i class="bi bi-chevron-right"></i>
        <a href="{{ route('blog') }}">Blog</a>
        <i class="bi bi-chevron-right"></i>
        <span style="color:rgba(255,255,255,0.85);">{{ $post->category->value }}</span>
      </nav>
      <span class="article-category-badge">{{ $post->category->value }}</span>
      <h1 class="article-hero-title">{{ $post->title }}</h1>
      <div class="article-meta">
        <span class="article-meta-item"><i class="bi bi-calendar3"></i> {{ $post->formatted_date }}</span>
        <span class="article-meta-item"><i class="bi bi-person"></i> {{ $post->author }}</span>
      </div>
    </div>
  </div>
</div>

{{-- ── Article Body ──────────────────────────────────────────────── --}}
<section class="article-layout">
  <div class="container">
    <div class="row g-4">

      {{-- Main Content --}}
      <div class="col-12 col-lg-8">

        <a href="{{ route('blog') }}" class="back-link"><i class="bi bi-arrow-left"></i> Back to All Articles</a>

        <img
          src="{{ $post->image_url }}"
          alt="{{ $post->title }}"
          class="article-featured-img"
          loading="eager"
        />

        <div class="article-content-wrap">
          <div class="article-body">
            {!! $post->body !!}
          </div>

          <hr style="border-color:var(--border-light);margin:28px 0 22px;">

          <div class="d-flex align-items-center justify-content-between flex-wrap gap-3">
            <div class="article-meta" style="gap:14px;">
              <span class="article-meta-item" style="color:var(--text-muted);"><i class="bi bi-calendar3" style="color:var(--accent);"></i> {{ $post->formatted_date }}</span>
              <span class="article-meta-item" style="color:var(--text-muted);"><i class="bi bi-tag" style="color:var(--accent);"></i> {{ $post->category->value }}</span>
            </div>
            <a href="{{ route('blog') }}" class="back-link" style="margin-bottom:0;">
              <i class="bi bi-arrow-left"></i> All Articles
            </a>
          </div>
        </div>

        {{-- Bottom CTA --}}
        <div class="article-bottom-cta">
          <h3>Ready to take action on {{ $post->category === \App\Enums\Category::Compliance ? 'NIS2 compliance' : 'cyber resilience' }}?</h3>
          <p>Our expert consultants are ready to help you build and implement a tailored programme that meets regulatory requirements and protects what matters most.</p>
          <div class="d-flex gap-3 flex-wrap">
            <a href="{{ route('nis2') }}" class="btn-hero-primary">Explore NIS2 Toolkit</a>
            <a href="{{ route('contact-us') }}" class="btn-hero-secondary">Speak to a Consultant</a>
          </div>
        </div>

      </div>

      {{-- Sidebar --}}
      <div class="col-12 col-lg-4">
        <div style="position:sticky;top:16px;">

          {{-- Author --}}
          <div class="article-sidebar-card">
            <div class="article-sidebar-card-title">About the Author</div>
            <div class="author-info">
              <div class="author-avatar"><i class="bi bi-people-fill"></i></div>
              <div>
                <span class="author-name">{{ $post->author }}</span>
                <span class="author-role">GISBA Cybersecurity &amp; Compliance Consultants</span>
              </div>
            </div>
            <p style="font-size:12.5px;color:var(--text-muted);margin-top:12px;margin-bottom:0;line-height:1.6;">Practising consultants with hands-on experience delivering ISO 27001, NIS2, and business continuity programmes across global organisations since 2006.</p>
          </div>

          {{-- Related Articles --}}
          @if($related->count() > 0)
          <div class="article-sidebar-card">
            <div class="article-sidebar-card-title">Related Articles</div>
            @foreach($related as $relatedPost)
            <a href="{{ route('blog.show', $relatedPost->slug) }}" class="related-post-item">
              <img src="{{ $relatedPost->image_url }}" alt="{{ $relatedPost->title }}" class="related-post-img">
              <div>
                <span class="related-post-title">{{ $relatedPost->title }}</span>
                <span class="related-post-date"><i class="bi bi-calendar3 me-1"></i>{{ $relatedPost->formatted_date }}</span>
              </div>
            </a>
            @endforeach
          </div>
          @endif

          {{-- Quick Links --}}
          <div class="article-sidebar-card">
            <div class="article-sidebar-card-title">Our Services</div>
            <ul style="list-style:none;padding:0;margin:0;">
              <li style="padding:7px 0;border-bottom:1px solid var(--border-light);">
                <a href="{{ route('nis2') }}" style="font-size:13px;font-weight:600;color:var(--navy);text-decoration:none;display:flex;align-items:center;gap:8px;transition:color 0.2s;" onmouseover="this.style.color='var(--navy-light)'" onmouseout="this.style.color='var(--navy)'">
                  <i class="bi bi-shield-check" style="color:var(--accent);"></i> NIS2 Implementation Toolkit
                </a>
              </li>
              <li style="padding:7px 0;">
                <a href="{{ route('training') }}" style="font-size:13px;font-weight:600;color:var(--navy);text-decoration:none;display:flex;align-items:center;gap:8px;transition:color 0.2s;" onmouseover="this.style.color='var(--navy-light)'" onmouseout="this.style.color='var(--navy)'">
                  <i class="bi bi-mortarboard" style="color:var(--accent);"></i> Training Course Development
                </a>
              </li>
            </ul>
          </div>

        </div>
      </div>

    </div>
  </div>
</section>

@endsection
