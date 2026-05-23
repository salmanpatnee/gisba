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
        </div>
      </div>
    </div>
  </div>
</div>

<section style="padding:60px 0 80px;background:var(--bg-page);">
  <div class="container">

    @if($chapters->isEmpty())
      <div style="text-align:center;padding:60px 0;color:#888;">
        <i class="bi bi-journal-x" style="font-size:3rem;display:block;margin-bottom:16px;color:#ccc;"></i>
        <p>No chapters available yet. Check back soon.</p>
      </div>
    @else
      <div class="row g-4">
        @foreach($chapters as $chapter)
          <div class="col-12 col-md-6 col-lg-4">
            <div class="chapter-card">
              <img src="{{ $chapter->image_url }}" alt="{{ $chapter->title }}" class="chapter-card-img">
              <div class="chapter-card-body">
                <h2 class="chapter-card-title">{{ $chapter->title }}</h2>
                @if($chapter->description)
                  <p class="chapter-card-desc">{{ Str::limit($chapter->description, 120) }}</p>
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

      @if($chapters->hasPages())
        <div class="d-flex justify-content-center mt-5">
          {{ $chapters->links() }}
        </div>
      @endif
    @endif

  </div>
</section>

@endsection
