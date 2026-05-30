@extends('layouts.site')

@section('title', 'PMP Quick Review Training — Chapters | GISBA Members')
@section('meta_description', 'Access all PMP Quick Review Training chapters. Videos, documents, checklists, and glossary for each chapter.')

@section('banner')
  <div class="d-flex justify-content-between align-items-center flex-wrap gap-2">
    <span><i class="bi bi-star-fill me-2"></i>PMP Quick Review Training</span>
    <div class="d-flex gap-3 align-items-center">
      <a href="{{ route('members.chapters.index') }}"><i class="bi bi-arrow-left me-1"></i>Library</a>
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
.chapter-card { background: var(--bg-white); border: 1px solid var(--border-light); border-radius: var(--radius-lg); overflow: hidden; box-shadow: var(--shadow-card); transition: box-shadow 0.25s, transform 0.25s; height: 100%; display: flex; flex-direction: column; position: relative; cursor: pointer; }
.chapter-card:hover { box-shadow: var(--shadow-hover); transform: translateY(-3px); }
.chapter-card-img { width: 100%; height: 200px; object-fit: cover; }
.chapter-card-body { padding: 18px 20px; flex: 1; display: flex; flex-direction: column; }
.chapter-card-title { font-family: var(--font-display); font-size: 1rem; font-weight: 700; color: var(--navy); margin-bottom: 8px; line-height: 1.35; }
.chapter-card-desc { font-size: 13px; color: #555; line-height: 1.6; flex: 1; margin-bottom: 16px; }
.btn-view { font-size: 12.5px; font-weight: 600; color: var(--navy); text-decoration: none; display: flex; align-items: center; gap: 4px; }
.btn-view:hover { color: var(--accent); }
.section-header { display: flex; align-items: center; gap: 16px; margin-bottom: 32px; }
.section-badge { flex-shrink: 0; width: 36px; height: 36px; border-radius: 50%; background: var(--navy); color: #fff; font-family: var(--font-display); font-size: 14px; font-weight: 800; display: flex; align-items: center; justify-content: center; }
.section-title { font-family: var(--font-display); font-size: clamp(1.05rem, 2.2vw, 1.3rem); font-weight: 800; color: var(--navy); margin: 0; }
.section-divider { border: none; border-top: 2px solid var(--border-light); margin: 60px 0 56px; }
.section-coming-soon { text-align: center; padding: 48px 24px; background: var(--bg-white); border: 1px dashed var(--border-light); border-radius: var(--radius-lg); color: #999; }
.section-coming-soon i { font-size: 2.4rem; display: block; margin-bottom: 14px; color: #ccc; }
.section-coming-soon p { margin: 0; font-size: 14px; line-height: 1.6; }

/* ── Overall course progress (hero) ─────────────────────────── */
.overall-progress { margin-top: 26px; max-width: 560px; }
.overall-progress-head { display: flex; align-items: center; justify-content: space-between; gap: 12px; margin-bottom: 10px; flex-wrap: wrap; }
.overall-progress-label { font-size: 12px; font-weight: 700; letter-spacing: 0.6px; text-transform: uppercase; color: #fff; display: flex; align-items: center; }
.overall-progress-stat { font-size: 12.5px; font-weight: 700; color: var(--accent); }
.op-track { height: 10px; border-radius: 999px; background: rgba(255,255,255,0.16); overflow: hidden; }
.op-fill { height: 100%; border-radius: 999px; background: linear-gradient(90deg, var(--accent), #e0c468); transition: width 0.7s ease; position: relative; overflow: hidden; }
.op-fill::after { content: ''; position: absolute; inset: 0; background: linear-gradient(90deg, transparent, rgba(255,255,255,0.4), transparent); transform: translateX(-100%); animation: opShimmer 2.4s ease-in-out infinite; }
@keyframes opShimmer { to { transform: translateX(100%); } }

/* ── Per-chapter card progress ──────────────────────────────── */
.chapter-card-media { position: relative; }
.chapter-complete-badge { position: absolute; top: 12px; right: 12px; display: inline-flex; align-items: center; gap: 5px; background: rgba(16,185,129,0.95); color: #fff; font-size: 11px; font-weight: 700; letter-spacing: 0.3px; padding: 4px 10px; border-radius: 20px; box-shadow: 0 2px 8px rgba(0,0,0,0.18); }
.chapter-complete-badge i { font-size: 12px; }
.chapter-progress { margin-bottom: 16px; }
.chapter-progress-head { display: flex; align-items: center; justify-content: space-between; margin-bottom: 6px; }
.chapter-progress-label { font-size: 10.5px; font-weight: 700; letter-spacing: 0.7px; text-transform: uppercase; color: var(--text-muted); }
.chapter-progress-count { font-size: 11px; font-weight: 700; color: var(--navy); }
.cp-track { height: 6px; border-radius: 999px; background: rgba(0,51,102,0.08); overflow: hidden; }
.cp-fill { height: 100%; border-radius: 999px; background: linear-gradient(90deg, var(--accent), #e0c468); transition: width 0.6s ease; }

@media (prefers-reduced-motion: reduce) { .op-fill::after { animation: none; } }
</style>

<div class="page-layout" style="padding-bottom:0;">
  <div class="container">
    <div class="hero-section library-hero" style="padding: 40px 36px 44px; border-radius: var(--radius-lg);">
      <div class="row align-items-center g-4">
        <div class="col-12">
          <span style="font-size:11px;font-weight:700;letter-spacing:1.4px;text-transform:uppercase;color:var(--accent);background:rgba(200,168,75,0.12);border:1px solid rgba(200,168,75,0.3);padding:4px 14px;border-radius:20px;display:inline-block;margin-bottom:16px;">
            <i class="bi bi-star-fill me-1"></i> Members Only
          </span>
          <h1 style="font-family:var(--font-display);font-size:clamp(1.6rem,3.5vw,2.4rem);color:#fff;font-weight:900;line-height:1.2;margin-bottom:14px;">
            PMP Quick Review <span style="color:var(--accent);">Training</span>
          </h1>
          <p style="color:rgba(255,255,255,0.78);font-size:15.5px;line-height:1.7;max-width:520px;margin:0;">
            All chapters with videos, documents, checklists, and glossary resources.
          </p>
          @if($totalResources > 0)
            <div class="overall-progress">
              <div class="overall-progress-head">
                <span class="overall-progress-label"><i class="bi bi-mortarboard-fill me-2"></i>Your Progress</span>
                <span class="overall-progress-stat">{{ $totalWatched }} / {{ $totalResources }} videos &middot; {{ $overallPercent }}%</span>
              </div>
              <div class="op-track" role="progressbar" aria-valuenow="{{ $overallPercent }}" aria-valuemin="0" aria-valuemax="100">
                <div class="op-fill" style="width:{{ $overallPercent }}%"></div>
              </div>
            </div>
          @endif
        </div>
      </div>
    </div>
  </div>
</div>

<section style="padding:60px 0 80px;background:var(--bg-page);">
  <div class="container">

    {{-- Part 1 --}}
    <div class="section-header">
      <div class="section-badge">1</div>
      <h2 class="section-title">PMBOK 8th Edition Review Training</h2>
    </div>

    @if($part1->isEmpty())
      <div class="section-coming-soon">
        <i class="bi bi-journal-x"></i>
        <p>No chapters available yet. Check back soon.</p>
      </div>
    @else
      <div class="row g-4">
        @foreach($part1 as $chapter)
          <div class="col-12 col-md-6 col-lg-4">
            <div class="chapter-card">
              <div class="chapter-card-media">
                <img src="{{ $chapter->image_url }}" alt="{{ $chapter->title }}" class="chapter-card-img">
                @if($chapter->isCompletedBy(auth()->user()))
                  <span class="chapter-complete-badge"><i class="bi bi-patch-check-fill"></i> Completed</span>
                @endif
              </div>
              <div class="chapter-card-body">
                <h3 class="chapter-card-title">{{ $chapter->title }}</h3>
                @if($chapter->description)
                  <p class="chapter-card-desc">{{ Str::limit($chapter->description, 120) }}</p>
                @endif
                @php($chTotal = $chapter->totalResourceCount())
                @if($chTotal > 0)
                  <div class="chapter-progress">
                    <div class="chapter-progress-head">
                      <span class="chapter-progress-label">Progress</span>
                      <span class="chapter-progress-count">{{ $chapter->watchedResourceCount(auth()->user()) }}/{{ $chTotal }}</span>
                    </div>
                    <div class="cp-track">
                      <div class="cp-fill" style="width:{{ $chapter->progressPercent(auth()->user()) }}%"></div>
                    </div>
                  </div>
                @endif
                <div style="display:flex;align-items:center;justify-content:flex-end;">
                  <a href="{{ route('members.chapters.show', $chapter->slug) }}" class="btn-view stretched-link">
                    View Chapter <i class="bi bi-arrow-right"></i>
                  </a>
                </div>
              </div>
            </div>
          </div>
        @endforeach
      </div>
    @endif

    <hr class="section-divider">

    {{-- Part 2 --}}
    <div class="section-header">
      <div class="section-badge">2</div>
      <h2 class="section-title">PMP Exam Content Outline Mapping Trainings</h2>
    </div>

    @if($part2->isEmpty())
      <div class="section-coming-soon">
        <i class="bi bi-clock-history"></i>
        <p>Coming soon — these chapters are currently in development.<br>Check back for updates.</p>
      </div>
    @else
      <div class="row g-4">
        @foreach($part2 as $chapter)
          <div class="col-12 col-md-6 col-lg-4">
            <div class="chapter-card">
              <div class="chapter-card-media">
                <img src="{{ $chapter->image_url }}" alt="{{ $chapter->title }}" class="chapter-card-img">
                @if($chapter->isCompletedBy(auth()->user()))
                  <span class="chapter-complete-badge"><i class="bi bi-patch-check-fill"></i> Completed</span>
                @endif
              </div>
              <div class="chapter-card-body">
                <h3 class="chapter-card-title">{{ $chapter->title }}</h3>
                @if($chapter->description)
                  <p class="chapter-card-desc">{{ Str::limit($chapter->description, 120) }}</p>
                @endif
                @php($chTotal = $chapter->totalResourceCount())
                @if($chTotal > 0)
                  <div class="chapter-progress">
                    <div class="chapter-progress-head">
                      <span class="chapter-progress-label">Progress</span>
                      <span class="chapter-progress-count">{{ $chapter->watchedResourceCount(auth()->user()) }}/{{ $chTotal }}</span>
                    </div>
                    <div class="cp-track">
                      <div class="cp-fill" style="width:{{ $chapter->progressPercent(auth()->user()) }}%"></div>
                    </div>
                  </div>
                @endif
                <div style="display:flex;align-items:center;justify-content:flex-end;">
                  <a href="{{ route('members.chapters.show', $chapter->slug) }}" class="btn-view stretched-link">
                    View Chapter <i class="bi bi-arrow-right"></i>
                  </a>
                </div>
              </div>
            </div>
          </div>
        @endforeach
      </div>
    @endif

    <hr class="section-divider">

    {{-- Part 3 --}}
    <div class="section-header">
      <div class="section-badge">3</div>
      <h2 class="section-title">Practical Tips and Others</h2>
    </div>

    @if($part3->isEmpty())
      <div class="section-coming-soon">
        <i class="bi bi-journal-x"></i>
        <p>No chapters available yet. Check back soon.</p>
      </div>
    @else
      <div class="row g-4">
        @foreach($part3 as $chapter)
          <div class="col-12 col-md-6 col-lg-4">
            <div class="chapter-card">
              <div class="chapter-card-media">
                <img src="{{ $chapter->image_url }}" alt="{{ $chapter->title }}" class="chapter-card-img">
                @if($chapter->isCompletedBy(auth()->user()))
                  <span class="chapter-complete-badge"><i class="bi bi-patch-check-fill"></i> Completed</span>
                @endif
              </div>
              <div class="chapter-card-body">
                <h3 class="chapter-card-title">{{ $chapter->title }}</h3>
                @if($chapter->description)
                  <p class="chapter-card-desc">{{ Str::limit($chapter->description, 120) }}</p>
                @endif
                @php($chTotal = $chapter->totalResourceCount())
                @if($chTotal > 0)
                  <div class="chapter-progress">
                    <div class="chapter-progress-head">
                      <span class="chapter-progress-label">Progress</span>
                      <span class="chapter-progress-count">{{ $chapter->watchedResourceCount(auth()->user()) }}/{{ $chTotal }}</span>
                    </div>
                    <div class="cp-track">
                      <div class="cp-fill" style="width:{{ $chapter->progressPercent(auth()->user()) }}%"></div>
                    </div>
                  </div>
                @endif
                <div style="display:flex;align-items:center;justify-content:flex-end;">
                  <a href="{{ route('members.chapters.show', $chapter->slug) }}" class="btn-view stretched-link">
                    View Chapter <i class="bi bi-arrow-right"></i>
                  </a>
                </div>
              </div>
            </div>
          </div>
        @endforeach
      </div>
    @endif

  </div>
</section>

@endsection
