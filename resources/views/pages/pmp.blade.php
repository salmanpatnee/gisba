@extends('layouts.site')

@section('title', 'PMP Resources | GISBA Consultants — Project Management Professional Insights')
@section('meta_description', 'Expert insights on PMP certification, project management frameworks, agile methodologies, and professional development from the GISBA consulting team.')

@section('banner')
  <div class="d-flex justify-content-between align-items-center flex-wrap gap-2">
    <span><i class="bi bi-award me-2"></i>PMP — Project Management Professional Insights</span>
    <div class="d-flex gap-3">
      <a href="{{ route('home') }}"><i class="bi bi-house me-1"></i>Home</a>
      <a href="{{ route('contact-us') }}"><i class="bi bi-envelope me-1"></i>Contact</a>
    </div>
  </div>
@endsection

@section('footer_tagline')
  Project Management Professional Insights<br />
  Expert Perspectives from the GISBA Consulting Team.
@endsection

@section('content')

<style>
/* ─── PMP Hero ─────────────────────────────────────────────── */
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

/* ─── Course Outline Section ────────────────────────────────── */
.outline-section { padding: 60px 0 20px; background: var(--bg-page); }
.outline-head { text-align: center; max-width: 640px; margin: 0 auto 14px; }
.outline-eyebrow { font-size: 11px; font-weight: 700; letter-spacing: 1.4px; text-transform: uppercase; color: var(--accent); display: block; margin-bottom: 8px; }
.outline-title { font-family: var(--font-display); font-size: clamp(1.4rem, 3vw, 2rem); font-weight: 800; color: var(--navy); line-height: 1.2; margin-bottom: 12px; }
.outline-lead { font-size: 14.5px; color: #555; line-height: 1.7; margin: 0; }
.outline-stats { display: flex; flex-wrap: wrap; justify-content: center; gap: 10px; margin: 22px 0 8px; }
.outline-stat { display: inline-flex; align-items: center; gap: 7px; font-size: 12.5px; font-weight: 700; color: var(--navy); background: var(--bg-section-alt); border: 1px solid var(--border-light); padding: 7px 16px; border-radius: 999px; }
.outline-stat i { color: var(--accent); }

.section-header { display: flex; align-items: center; gap: 16px; margin-bottom: 32px; }
.section-badge { flex-shrink: 0; width: 36px; height: 36px; border-radius: 50%; background: var(--navy); color: #fff; font-family: var(--font-display); font-size: 14px; font-weight: 800; display: flex; align-items: center; justify-content: center; }
.section-title { font-family: var(--font-display); font-size: clamp(1.05rem, 2.2vw, 1.3rem); font-weight: 800; color: var(--navy); margin: 0; }
.section-divider { border: none; border-top: 2px solid var(--border-light); margin: 60px 0 56px; }

/* ── Part 2 domain separators ───────────────────────────────── */
.division-group { position: relative; }
.division-group + .division-group { margin-top: 66px; }
.domain-header { position: relative; display: grid; grid-template-columns: auto 1fr auto; align-items: center; column-gap: 24px; padding-bottom: 22px; margin-bottom: 36px; border-bottom: 1px solid var(--border-light); }
.domain-header::after { content: ''; position: absolute; left: 0; bottom: -1.5px; width: 116px; height: 3px; border-radius: 999px; background: linear-gradient(90deg, var(--accent), var(--accent-light)); }
.domain-no { font-family: var(--font-display); font-size: clamp(2.5rem, 6vw, 3.6rem); font-weight: 700; line-height: 1; letter-spacing: -1px; color: transparent; -webkit-text-stroke: 1.5px rgba(200,168,75,0.5); user-select: none; }
.domain-headtext { min-width: 0; }
.domain-eyebrow { display: inline-flex; align-items: center; gap: 8px; font-family: var(--font-body); font-size: 10.5px; font-weight: 700; letter-spacing: 2.2px; text-transform: uppercase; color: var(--accent); margin-bottom: 5px; }
.domain-eyebrow::before { content: ''; width: 6px; height: 6px; background: var(--accent); transform: rotate(45deg); }
.domain-title { font-family: var(--font-display); font-size: clamp(1.2rem, 2.6vw, 1.6rem); font-weight: 800; color: var(--navy); line-height: 1.18; margin: 0; }
.domain-desc { font-size: 12.5px; color: var(--text-muted); line-height: 1.55; margin: 6px 0 0; max-width: 540px; }
.domain-count { flex-shrink: 0; align-self: center; display: inline-flex; align-items: baseline; gap: 6px; font-family: var(--font-display); font-size: 1.05rem; font-weight: 800; color: var(--navy); background: var(--bg-section-alt); border: 1px solid var(--border-light); padding: 8px 16px; border-radius: 999px; white-space: nowrap; }
.domain-count small { font-family: var(--font-body); font-size: 10px; font-weight: 700; letter-spacing: 0.6px; text-transform: uppercase; color: var(--text-muted); }
@media (max-width: 575px) {
  .domain-header { grid-template-columns: auto 1fr; row-gap: 12px; column-gap: 18px; }
  .domain-count { grid-column: 2; justify-self: start; align-self: start; }
}
.section-coming-soon { text-align: center; padding: 48px 24px; background: var(--bg-white); border: 1px dashed var(--border-light); border-radius: var(--radius-lg); color: #999; }
.section-coming-soon i { font-size: 2.4rem; display: block; margin-bottom: 14px; color: #ccc; }
.section-coming-soon p { margin: 0; font-size: 14px; line-height: 1.6; }

/* ── Guest chapter card ─────────────────────────────────────── */
.chapter-card { background: var(--bg-white); border: 1px solid var(--border-light); border-radius: var(--radius-lg); overflow: hidden; box-shadow: var(--shadow-card); transition: box-shadow 0.25s, transform 0.25s; height: 100%; display: flex; flex-direction: column; position: relative; }
.chapter-card:hover { box-shadow: var(--shadow-hover); transform: translateY(-3px); }
.chapter-card-media { position: relative; }
.chapter-card-img { width: 100%; height: 200px; object-fit: cover; }
.chapter-lock-badge { position: absolute; top: 12px; right: 12px; display: inline-flex; align-items: center; gap: 5px; background: rgba(0,33,80,0.92); color: var(--accent); font-size: 10.5px; font-weight: 700; letter-spacing: 0.4px; text-transform: uppercase; padding: 4px 10px; border-radius: 20px; box-shadow: 0 2px 8px rgba(0,0,0,0.2); }
.chapter-lock-badge i { font-size: 11px; }
.chapter-card-body { padding: 18px 20px; flex: 1; display: flex; flex-direction: column; }
.chapter-card-title { font-family: var(--font-display); font-size: 1rem; font-weight: 700; color: var(--navy); margin-bottom: 8px; line-height: 1.35; }
.chapter-card-desc { font-size: 13px; color: #555; line-height: 1.6; flex: 1; margin-bottom: 16px; }
.chapter-card-foot { margin-top: auto; }
.btn-unlock { display: inline-flex; align-items: center; gap: 6px; font-size: 12.5px; font-weight: 700; color: var(--navy); text-decoration: none; transition: color 0.2s, gap 0.2s; }
.btn-unlock i { color: var(--accent); transition: transform 0.2s; }
.chapter-card:hover .btn-unlock { color: var(--accent); gap: 9px; }
.chapter-card:hover .btn-unlock i { transform: scale(1.12); }

/* ─── Rhyme-Based Learning Card ───────────────────────────────── */
.rhyme-section { padding: 56px 0; background: var(--bg-page); }
.rhyme-head { text-align: center; max-width: 640px; margin: 0 auto 32px; }
.rhyme-eyebrow { font-size: 11px; font-weight: 700; letter-spacing: 1.4px; text-transform: uppercase; color: var(--accent); display: block; margin-bottom: 8px; }
.rhyme-title { font-family: var(--font-display); font-size: clamp(1.3rem, 2.8vw, 1.9rem); font-weight: 800; color: var(--navy); line-height: 1.25; margin: 0; }
.rhyme-lead { font-size: 14px; color: #555; line-height: 1.7; margin: 10px auto 16px; max-width: 620px; }
.rhyme-human-badge { display: inline-flex; align-items: center; gap: 7px; background: rgba(200,168,75,0.12); border: 1px solid rgba(200,168,75,0.4); color: var(--navy); font-size: 12.5px; font-weight: 700; padding: 7px 16px; border-radius: 999px; }
.rhyme-human-badge i { color: var(--accent); }

.rhyme-card { background: var(--bg-white); border: 1px solid var(--border-light); border-top: 3px solid var(--accent); border-radius: var(--radius-lg); overflow: hidden; box-shadow: var(--shadow-card); transition: box-shadow 0.25s ease, transform 0.25s ease; height: 100%; }
.rhyme-card:hover { box-shadow: var(--shadow-hover); transform: translateY(-3px); }

.rhyme-card-header { display: flex; align-items: center; gap: 14px; padding: 22px 28px; background: linear-gradient(135deg, var(--navy) 0%, rgba(0,33,80,0.92) 100%); position: relative; overflow: hidden; }
.rhyme-card-header::before { content: ''; position: absolute; top: -22px; right: -22px; width: 90px; height: 90px; background: rgba(200,168,75,0.12); border-radius: 50%; }
.rhyme-card-header::after { content: ''; position: absolute; bottom: -30px; left: 38%; width: 70px; height: 70px; background: rgba(200,168,75,0.08); border-radius: 50%; }
.rhyme-card-icon { flex-shrink: 0; width: 44px; height: 44px; background: rgba(200,168,75,0.15); border: 1px solid rgba(200,168,75,0.35); border-radius: 10px; display: flex; align-items: center; justify-content: center; font-size: 18px; color: var(--accent); position: relative; z-index: 1; }
.rhyme-card-kicker { display: block; font-size: 10.5px; font-weight: 700; letter-spacing: 1.2px; text-transform: uppercase; color: var(--accent); margin-bottom: 3px; position: relative; z-index: 1; }
.rhyme-card-question { font-family: var(--font-display); font-size: 1.1rem; font-weight: 800; color: #fff; margin: 0; position: relative; z-index: 1; }

.rhyme-card-body { padding: 28px; }
.rhyme-quote { background: var(--bg-section-alt); border-left: 3px solid var(--accent); border-radius: 8px; padding: 18px 22px; margin-bottom: 0; }
.rhyme-quote p { font-family: Georgia, 'Times New Roman', serif; font-style: italic; font-size: 15px; line-height: 1.85; color: var(--navy); margin: 0; }
.rhyme-desc { font-size: 13.5px; color: #555; line-height: 1.7; margin: 0; }
.rhyme-desc-wide { max-width: 760px; margin: 28px auto 0; text-align: center; }
@media (max-width: 575px) {
  .rhyme-card-header { padding: 18px 20px; }
  .rhyme-card-body { padding: 22px 20px; }
}

/* ─── Special Offer Card ─────────────────────────────────────── */
.offer-section { padding: 0 0 56px; background: var(--bg-page); }
.offer-card { position: relative; display: flex; align-items: center; gap: 28px; background: var(--bg-white); border: 1px solid var(--border-light); border-radius: var(--radius-lg); padding: 36px 40px; box-shadow: var(--shadow-card); transition: box-shadow 0.25s ease, transform 0.25s ease; overflow: hidden; }
.offer-card:hover { box-shadow: var(--shadow-hover); transform: translateY(-3px); }
.offer-card::before { content: ''; position: absolute; top: 0; left: 0; width: 5px; height: 100%; background: linear-gradient(180deg, var(--navy), var(--navy-mid)); }
.offer-card-icon { flex-shrink: 0; width: 64px; height: 64px; border-radius: var(--radius-md); background: linear-gradient(135deg, var(--navy) 0%, var(--navy-mid) 100%); border: 1px solid rgba(200,168,75,0.35); display: flex; align-items: center; justify-content: center; font-size: 1.7rem; color: var(--accent); }
.offer-card-body { flex: 1; min-width: 0; }
.offer-eyebrow { display: inline-flex; align-items: center; font-size: 11px; font-weight: 700; letter-spacing: 1.2px; text-transform: uppercase; color: var(--accent); margin-bottom: 8px; }
.offer-heading { font-family: var(--font-display); font-size: clamp(1.1rem, 2.4vw, 1.4rem); font-weight: 800; line-height: 1.4; color: var(--navy); margin: 0 0 14px; }
.offer-benefits { list-style: none; margin: 0; padding: 0; display: flex; flex-wrap: wrap; gap: 8px 22px; }
.offer-benefits li { display: flex; align-items: center; gap: 7px; font-size: 13px; color: #555; font-weight: 500; }
.offer-benefits li i { color: var(--accent); font-size: 13px; flex-shrink: 0; }
.offer-card-cta { flex-shrink: 0; }
@media (max-width: 767px) {
  .offer-card { flex-direction: column; align-items: flex-start; padding: 28px 24px; gap: 20px; }
  .offer-card-cta { width: 100%; }
  .offer-card-cta .btn-nis2-buy { width: 100%; justify-content: center; }
}
@media (max-width: 575px) {
  .offer-card { padding: 24px 20px; }
  .offer-benefits { flex-direction: column; gap: 8px; }
}
</style>

{{-- ── Hero ─────────────────────────────────────────────────────── --}}
{{-- <div class="page-layout" style="padding-bottom:0;">
  <div class="container">
    <div class="hero-section blog-hero">
      <div class="row align-items-center g-4">
        <div class="col-12">
          <span class="blog-hero-label"><i class="bi bi-award me-1"></i> PMP Insights</span>
          <h1 class="blog-hero-title">Project Management<br /><span>Professional Resources</span></h1>
          <p class="blog-hero-desc">Practical guidance on PMP certification, project planning, agile frameworks, risk management, and stakeholder engagement — from consultants with real-world delivery experience.</p>
        </div>
      </div>
    </div>
  </div>
</div> --}}

{{-- ── PMP Banner Image ─────────────────────────────────────────── --}}
<div class="page-layout" style="padding-bottom:0;">
  <div class="container">
    <main class="img-content">
      <div class="hero-banner-image">
        <img class="img-fluid rounded" src="{{ asset('assets/images/PMP Banner.jpeg') }}" alt="PMP Live Online Training">
      </div>
    </main>
  </div>
</div>

{{-- ── PMP Training Promo Banner ──────────────────────────────────────── --}}
@include('partials.pmp-banner', ['showBlogLink' => true])

{{-- ── Rhyme-Based Learning ─────────────────────────────────────── --}}
<section class="rhyme-section">
  <div class="container">
    <div class="rhyme-head kb-reveal">
      <span class="rhyme-eyebrow"><i class="bi bi-music-note-beamed me-1"></i> Learning Innovation</span>
      <h2 class="rhyme-title">PMP Concepts You'll Actually Remember — Taught Through Rhyme</h2>
      <p class="rhyme-lead">Every key concept in the training is distilled into a short, human-written rhyme — a memory technique built for exam recall, not novelty.</p>
      <span class="rhyme-human-badge"><i class="bi bi-patch-check-fill"></i> 100% Human-Written — No AI-Generated Rhymes</span>
    </div>

    <div class="row g-4">
      <div class="col-md-6 kb-reveal">
        <div class="rhyme-card">
          <div class="rhyme-card-header">
            <span class="rhyme-card-icon"><i class="bi bi-vinyl-fill"></i></span>
            <div>
              <span class="rhyme-card-kicker">For Example</span>
              <h3 class="rhyme-card-question">What is a Project?</h3>
            </div>
          </div>
          <div class="rhyme-card-body">
            <div class="rhyme-quote">
              <p>
                A project is an initiative, clearly and simply stated,<br>
                Temporary, unique, and progressively elaborated.<br>
                A project must create value and it can be stand-alone,<br>
                Or part of a Portfolio or a Program, this is well known
              </p>
            </div>
          </div>
        </div>
      </div>

      {{-- PLACEHOLDER: illustrative second rhyme — replace with a real second rhyme from course content before shipping --}}
      <div class="col-md-6 kb-reveal" style="transition-delay: 0.08s;">
        <div class="rhyme-card">
          <div class="rhyme-card-header">
            <span class="rhyme-card-icon"><i class="bi bi-vinyl-fill"></i></span>
            <div>
              <span class="rhyme-card-kicker">For Example</span>
              <h3 class="rhyme-card-question">What is Scope?</h3>
            </div>
          </div>
          <div class="rhyme-card-body">
            <div class="rhyme-quote">
              <p>
                Scope defines the boundary of the work to be done,<br>
                What's included and excluded, agreed on by everyone.<br>
                Guard it well against creep, both silent and bold,<br>
                For a project without scope control is a story half-told.
              </p>
            </div>
          </div>
        </div>
      </div>
    </div>

    <p class="rhyme-desc rhyme-desc-wide kb-reveal">All key project management concepts are summarized this way throughout the training — creating a fast, memorable review at the end of every chapter, for both individual learners and educational institutions.</p>
  </div>
</section>

{{-- ── Special Offer ────────────────────────────────────────────── --}}
<section class="offer-section">
  <div class="container">
    <div class="offer-card kb-reveal">
      <div class="offer-card-icon"><i class="bi bi-building-fill-check"></i></div>
      <div class="offer-card-body">
        <span class="offer-eyebrow"><i class="bi bi-briefcase-fill me-1"></i> For Organizations</span>
        <h2 class="offer-heading">Special Offer: Discounted Pricing on Bulk Training for Corporates and Educational Institutions</h2>
        {{-- PLACEHOLDER: illustrative benefits — confirm against actual bulk/corporate policy before shipping --}}
        <ul class="offer-benefits">
          <li><i class="bi bi-check-circle-fill"></i> Custom seat counts for teams &amp; cohorts</li>
          <li><i class="bi bi-check-circle-fill"></i> Dedicated onboarding &amp; progress reporting</li>
          <li><i class="bi bi-check-circle-fill"></i> Invoice billing for procurement teams</li>
        </ul>
      </div>
      <div class="offer-card-cta">
        <a href="{{ route('contact-us') }}" class="btn-nis2-buy">
          Get in Touch <i class="bi bi-arrow-right"></i>
        </a>
      </div>
    </div>
  </div>
</section>

{{-- ── Course Outline (what members get) ─────────────────────────── --}}
@if($outlineChapterCount > 0)
<section class="outline-section">
  <div class="container">

    <div class="outline-head kb-reveal">
      <span class="outline-eyebrow"><i class="bi bi-mortarboard-fill me-1"></i> Inside the Training</span>
      <h2 class="outline-title">What You'll Master in the PMP Comprehensive Training Aligned with PMBOK 8th Edition and PMP July 2026 Exam Outline</h2>
      <p class="outline-lead">Aligned with Exam Content Outline July 2026 Exam</p>
      <div class="outline-stats">
        <span class="outline-stat"><i class="bi bi-journals"></i> {{ $outlineChapterCount }} Chapters</span>
        <span class="outline-stat"><i class="bi bi-patch-check-fill"></i> Tutorials, Quizzes &amp; Takeaways</span>
        <span class="outline-stat"><i class="bi bi-award-fill"></i> Completion Certificate</span>
      </div>
    </div>

    {{-- Part 1 --}}
    @if($outlinePart1->isNotEmpty())
      <div class="section-header kb-reveal">
        <div class="section-badge">1</div>
        <h2 class="section-title">PMBOK 8th Edition Review Training</h2>
      </div>
      <div class="row g-4">
        @foreach($outlinePart1 as $chapter)
          @include('pages._chapter-outline-card', ['chapter' => $chapter])
        @endforeach
      </div>
      <hr class="section-divider">
    @endif

    {{-- Part 2 — PMP Exam Content Outline by domain --}}
    @php($hasPart2 = collect($outlinePart2Divisions)->contains(fn ($d) => $d->isNotEmpty()))
    @if($hasPart2)
      <div class="section-header kb-reveal">
        <div class="section-badge">2</div>
        <h2 class="section-title">PMP Exam Content Outline Mapping Trainings</h2>
      </div>
      @php($divMeta = [
        1 => ['no' => '01', 'name' => 'People',               'desc' => 'Leading, motivating and empowering the project team.'],
        2 => ['no' => '02', 'name' => 'Process',              'desc' => 'Executing the technical work that delivers the project.'],
        3 => ['no' => '03', 'name' => 'Business Environment', 'desc' => 'Aligning the project with organizational strategy and compliance.'],
      ])
      @foreach($outlinePart2Divisions as $divId => $divChapters)
        @continue($divChapters->isEmpty())
        @php($meta = $divMeta[$divId])
        <div class="division-group">
          <header class="domain-header">
            <span class="domain-no" aria-hidden="true">{{ $meta['no'] }}</span>
            <div class="domain-headtext">
              <span class="domain-eyebrow">Domain {{ $meta['no'] }}</span>
              <h3 class="domain-title">{{ $meta['name'] }}</h3>
              <p class="domain-desc">{{ $meta['desc'] }}</p>
            </div>
            <span class="domain-count">{{ $divChapters->count() }} <small>chapters</small></span>
          </header>
          <div class="row g-4">
            @foreach($divChapters as $chapter)
              @include('pages._chapter-outline-card', ['chapter' => $chapter])
            @endforeach
          </div>
        </div>
      @endforeach
      <hr class="section-divider">
    @endif

    {{-- Part 3 --}}
    @if($outlinePart3->isNotEmpty())
      <div class="section-header kb-reveal">
        <div class="section-badge">3</div>
        <h2 class="section-title">Practical Tips and Others</h2>
      </div>
      <div class="row g-4">
        @foreach($outlinePart3 as $chapter)
          @include('pages._chapter-outline-card', ['chapter' => $chapter])
        @endforeach
      </div>
    @endif

  </div>
</section>

{{-- ── Reinforcing CTA after the outline ─────────────────────────── --}}
@include('partials.pmp-banner', ['variant' => 'reinforcing'])
@endif


{{-- ── Knowledge Base Grid ───────────────────────────────────────── --}}
<section class="kb-section" id="knowledge-base" style="scroll-margin-top:80px;">
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
      <div class="col-12 kb-reveal" style="transition-delay: {{ $loop->index * 0.07 }}s;">
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
                <a href="{{ route('pmp.show', $article->slug) }}" class="kb-article-link">
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
