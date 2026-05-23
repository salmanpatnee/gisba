@extends('layouts.site')

@section('title', $chapter->title.' — PMP Quick Review | GISBA Members')
@section('meta_description', $chapter->description ?? 'Access resources for '.$chapter->title.' in PMP Quick Review Training.')

@section('banner')
  <div class="d-flex justify-content-between align-items-center flex-wrap gap-2">
    <span><i class="bi bi-star-fill me-2"></i>PMP Quick Review Training</span>
    <div class="d-flex gap-3 align-items-center">
      <a href="{{ route('members.chapters.index') }}"><i class="bi bi-arrow-left me-1"></i>All Chapters</a>
      <a href="{{ route('home') }}"><i class="bi bi-house me-1"></i>Home</a>
      <form method="POST" action="{{ route('members.logout') }}" style="margin:0;">
        @csrf
        <button type="submit" style="background:none;border:none;padding:0;color:inherit;cursor:pointer;font-size:inherit;"><i class="bi bi-box-arrow-right me-1"></i>Log Out</button>
      </form>
    </div>
  </div>
@endsection

@section('footer_tagline')
  GISBA Members — PMP Quick Review Training<br />
  Structured learning resources for PMP certification.
@endsection

@section('content')

<style>
/* ── Chapter image card ─────────────────────────────────────── */
.chapter-img-card {
  border-radius: var(--radius-lg);
  overflow: hidden;
  box-shadow: var(--shadow-card);
  background: var(--bg-white);
  border: 1px solid var(--border-light);
}
.chapter-img-card img {
  width: 100%;
  height: auto;
  display: block;
}
.chapter-img-card-body {
  padding: 24px 26px 28px;
}
.chapter-badge {
  font-size: 10.5px;
  font-weight: 700;
  letter-spacing: 1.3px;
  text-transform: uppercase;
  color: var(--accent);
  background: rgba(200,168,75,0.12);
  border: 1px solid rgba(200,168,75,0.3);
  padding: 3px 12px;
  border-radius: 20px;
  display: inline-block;
  margin-bottom: 14px;
}
.chapter-title {
  font-family: var(--font-display);
  font-size: clamp(1.25rem, 2.2vw, 1.7rem);
  color: var(--navy);
  font-weight: 900;
  line-height: 1.25;
  margin-bottom: 14px;
}
.chapter-desc {
  font-size: 14.5px;
  color: #555;
  line-height: 1.75;
  margin: 0;
}

/* ── Resource panel ─────────────────────────────────────────── */
.resources-panel {
  background: var(--bg-white);
  border: 1px solid var(--border-light);
  border-radius: var(--radius-lg);
  box-shadow: var(--shadow-card);
  overflow: hidden;
}
.resources-panel-header {
  padding: 20px 26px 16px;
  border-bottom: 1px solid var(--border-light);
}
.resources-panel-title {
  font-family: var(--font-display);
  font-size: 0.9rem;
  font-weight: 700;
  color: var(--navy);
  text-transform: uppercase;
  letter-spacing: 0.8px;
  margin: 0;
}

/* ── Resource row ───────────────────────────────────────────── */
.resource-row {
  display: flex;
  align-items: center;
  gap: 16px;
  padding: 18px 26px;
  text-decoration: none;
  color: var(--navy);
  border-bottom: 1px solid var(--border-light);
  border-left: 3px solid transparent;
  transition: background 0.18s, border-left-color 0.18s, transform 0.18s;
  position: relative;
}
.resource-row:last-child { border-bottom: none; }
.resource-row:hover {
  background: var(--bg-section-alt);
  border-left-color: var(--accent);
  color: var(--navy);
  text-decoration: none;
}
.resource-row-icon {
  width: 48px;
  height: 48px;
  border-radius: 12px;
  display: flex;
  align-items: center;
  justify-content: center;
  font-size: 22px;
  flex-shrink: 0;
}
.resource-row-text { flex: 1; min-width: 0; }
.resource-row-name {
  font-size: 14.5px;
  font-weight: 700;
  color: var(--navy);
  line-height: 1.3;
  margin-bottom: 3px;
}
.resource-row-sub {
  font-size: 12px;
  color: #888;
  line-height: 1.4;
}
.resource-row-action {
  font-size: 12px;
  font-weight: 600;
  color: var(--accent);
  white-space: nowrap;
  display: flex;
  align-items: center;
  gap: 4px;
  flex-shrink: 0;
}
.resource-row:hover .resource-row-action { color: var(--navy-mid); }

/* ── Chapter nav ────────────────────────────────────────────── */
.chapter-nav {
  display: flex;
  align-items: center;
  justify-content: space-between;
  padding: 28px 0 0;
  margin-top: 40px;
  border-top: 1px solid var(--border-light);
  gap: 12px;
  flex-wrap: wrap;
}
.chapter-nav-link {
  display: flex;
  align-items: center;
  gap: 10px;
  padding: 12px 18px;
  background: var(--bg-white);
  border: 1px solid var(--border-light);
  border-radius: var(--radius-md);
  text-decoration: none;
  color: var(--navy);
  font-size: 13.5px;
  font-weight: 600;
  box-shadow: var(--shadow-card);
  transition: box-shadow 0.2s, transform 0.2s;
  max-width: 200px;
}
.chapter-nav-link:hover {
  box-shadow: var(--shadow-hover);
  transform: translateY(-2px);
  color: var(--navy);
  text-decoration: none;
}
.chapter-nav-link-label {
  font-size: 10.5px;
  font-weight: 700;
  letter-spacing: 0.8px;
  text-transform: uppercase;
  color: #999;
  display: block;
  margin-bottom: 2px;
}
.chapter-nav-link-title {
  font-size: 13px;
  color: var(--navy);
  white-space: nowrap;
  overflow: hidden;
  text-overflow: ellipsis;
}
.chapter-nav-back {
  font-size: 13.5px;
  font-weight: 600;
  color: var(--text-muted);
  text-decoration: none;
  display: flex;
  align-items: center;
  gap: 6px;
}
.chapter-nav-back:hover { color: var(--navy); text-decoration: none; }
</style>

<section style="padding: 56px 0 80px; background: var(--bg-page);">
  <div class="container">
    <div class="row g-4 align-items-start">

      {{-- Left: chapter image + info ──────────────────────── --}}
      <div class="col-12 col-lg-4">
        <div class="chapter-img-card">
          <img src="{{ $chapter->image_url }}" alt="{{ $chapter->title }}">
          <div class="chapter-img-card-body">
            <span class="chapter-badge"><i class="bi bi-star-fill me-1"></i>Members Only</span>
            <h1 class="chapter-title">{{ $chapter->title }}</h1>
            @if($chapter->description)
              <p class="chapter-desc">{{ $chapter->description }}</p>
            @endif
          </div>
        </div>
      </div>

      {{-- Right: resource panel ───────────────────────────── --}}
      <div class="col-12 col-lg-8">
        <div class="resources-panel">
          <div class="resources-panel-header">
            <p class="resources-panel-title"><i class="bi bi-collection me-2" style="color:var(--accent);"></i>Chapter Resources</p>
          </div>

          <a href="{{ route('members.chapters.tutorials', $chapter->slug) }}" class="resource-row">
            <span class="resource-row-icon" style="background:rgba(59,130,246,0.1);color:#3b82f6;">
              <i class="bi bi-play-circle-fill"></i>
            </span>
            <div class="resource-row-text">
              <div class="resource-row-name">Tutorials</div>
              <div class="resource-row-sub">Watch chapter tutorial videos at your own pace</div>
            </div>
            <span class="resource-row-action">Watch <i class="bi bi-arrow-right"></i></span>
          </a>

          <a href="{{ route('members.chapters.takeaways', $chapter->slug) }}" class="resource-row">
            <span class="resource-row-icon" style="background:rgba(16,185,129,0.1);color:#10b981;">
              <i class="bi bi-file-earmark-text-fill"></i>
            </span>
            <div class="resource-row-text">
              <div class="resource-row-name">Takeaways</div>
              <div class="resource-row-sub">PDF and Word takeaway materials for this chapter</div>
            </div>
            <span class="resource-row-action">View <i class="bi bi-arrow-right"></i></span>
          </a>

          <div class="resource-row" style="opacity:0.5;cursor:not-allowed;pointer-events:none;">
            <span class="resource-row-icon" style="background:rgba(249,115,22,0.1);color:#f97316;">
              <i class="bi bi-patch-question-fill"></i>
            </span>
            <div class="resource-row-text">
              <div class="resource-row-name">Quizzes</div>
              <div class="resource-row-sub">Test your knowledge on chapter concepts</div>
            </div>
            <span style="font-size:11px;font-weight:700;color:#f97316;background:rgba(249,115,22,0.1);border:1px solid rgba(249,115,22,0.3);padding:3px 10px;border-radius:20px;white-space:nowrap;flex-shrink:0;">Coming Soon</span>
          </div>

          <a href="{{ route('members.chapters.domain-summary', $chapter->slug) }}" class="resource-row">
            <span class="resource-row-icon" style="background:rgba(139,92,246,0.1);color:#8b5cf6;">
              <i class="bi bi-book-fill"></i>
            </span>
            <div class="resource-row-text">
              <div class="resource-row-name">Domain Summary in Poetry</div>
              <div class="resource-row-sub">Chapter concepts expressed through verse</div>
            </div>
            <span class="resource-row-action">Read <i class="bi bi-arrow-right"></i></span>
          </a>
        </div>

        {{-- Prev / Next / Back nav ──────────────────────────── --}}
        <div class="chapter-nav">
          @if($prevChapter)
            <a href="{{ route('members.chapters.show', $prevChapter->slug) }}" class="chapter-nav-link">
              <i class="bi bi-chevron-left" style="font-size:18px;color:var(--accent);flex-shrink:0;"></i>
              <div style="min-width:0;">
                <span class="chapter-nav-link-label">Previous</span>
                <span class="chapter-nav-link-title">{{ $prevChapter->title }}</span>
              </div>
            </a>
          @else
            <div></div>
          @endif

          <a href="{{ route('members.chapters.index') }}" class="chapter-nav-back">
            <i class="bi bi-grid-3x3-gap"></i> All Chapters
          </a>

          @if($nextChapter)
            <a href="{{ route('members.chapters.show', $nextChapter->slug) }}" class="chapter-nav-link" style="flex-direction:row-reverse;text-align:right;">
              <i class="bi bi-chevron-right" style="font-size:18px;color:var(--accent);flex-shrink:0;"></i>
              <div style="min-width:0;">
                <span class="chapter-nav-link-label">Next</span>
                <span class="chapter-nav-link-title">{{ $nextChapter->title }}</span>
              </div>
            </a>
          @else
            <div></div>
          @endif
        </div>

      </div>{{-- /right col --}}

    </div>
  </div>
</section>

@endsection
