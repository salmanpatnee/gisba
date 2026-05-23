@extends('layouts.site')

@section('title', $chapter->title.' — Tutorials | GISBA Members')
@section('meta_description', 'Watch tutorial lessons for '.$chapter->title.'.')

@section('banner')
  <div class="d-flex justify-content-between align-items-center flex-wrap gap-2">
    <span><i class="bi bi-play-circle me-2"></i>Tutorials</span>
    <div class="d-flex gap-3 align-items-center">
      <a href="{{ route('members.chapters.show', $chapter->slug) }}"><i class="bi bi-arrow-left me-1"></i>{{ $chapter->title }}</a>
      <a href="{{ route('members.chapters.index') }}">All Chapters</a>
    </div>
  </div>
@endsection

@section('footer_tagline')
  GISBA Members — PMP Quick Review Training<br />
  Structured learning resources for PMP certification.
@endsection

@section('content')

<style>
.rp-header {
  background: var(--bg-white);
  border-top: 4px solid #3b82f6;
  border-bottom: 1px solid var(--border-light);
  padding: 24px 0 20px;
  margin-bottom: 40px;
}
.rp-meta {
  display: flex;
  align-items: center;
  gap: 10px;
  flex-wrap: wrap;
  margin-bottom: 8px;
}
.rp-type-label {
  font-size: 13px;
  font-weight: 700;
  color: #3b82f6;
  display: flex;
  align-items: center;
  gap: 6px;
}
.rp-sep { color: #d1d5db; font-size: 13px; }
.rp-chapter-link {
  font-size: 13px;
  color: var(--text-muted);
  text-decoration: none;
  font-weight: 500;
}
.rp-chapter-link:hover { color: var(--navy); text-decoration: none; }
.rp-count-badge {
  margin-left: auto;
  background: rgba(59,130,246,0.1);
  color: #3b82f6;
  font-size: 11px;
  font-weight: 700;
  padding: 3px 10px;
  border-radius: 20px;
  border: 1px solid rgba(59,130,246,0.2);
}
.rp-title {
  font-family: var(--font-display);
  font-size: clamp(1.2rem, 2.2vw, 1.6rem);
  color: var(--navy);
  font-weight: 900;
  margin: 0;
  line-height: 1.25;
}

.video-card {
  background: var(--bg-white);
  border: 1px solid var(--border-light);
  border-radius: var(--radius-lg);
  overflow: hidden;
  box-shadow: var(--shadow-card);
  height: 100%;
  display: flex;
  flex-direction: column;
}
.video-card-player { background: #000; position: relative; }
.video-card-player video { width: 100%; display: block; max-height: 260px; }
.video-card-footer {
  padding: 14px 18px;
  display: flex;
  align-items: center;
  gap: 12px;
  border-top: 1px solid var(--border-light);
}
.video-num {
  font-size: 11px;
  font-weight: 700;
  color: #3b82f6;
  background: rgba(59,130,246,0.1);
  border: 1px solid rgba(59,130,246,0.2);
  width: 28px;
  height: 28px;
  border-radius: 50%;
  display: flex;
  align-items: center;
  justify-content: center;
  flex-shrink: 0;
}
.video-title {
  font-size: 13.5px;
  font-weight: 600;
  color: var(--navy);
  line-height: 1.35;
  flex: 1;
  min-width: 0;
}
</style>

<div class="rp-header">
  <div class="container">
    <div class="rp-meta">
      <span class="rp-type-label"><i class="bi bi-play-circle-fill"></i> Tutorials</span>
      <span class="rp-sep">•</span>
      <a href="{{ route('members.chapters.show', $chapter->slug) }}" class="rp-chapter-link">{{ $chapter->title }}</a>
      @if($chapter->resources->isNotEmpty())
        <span class="rp-count-badge">{{ $chapter->resources->count() }} {{ Str::plural('tutorial', $chapter->resources->count()) }}</span>
      @endif
    </div>
    <h1 class="rp-title">{{ $chapter->title }}</h1>
  </div>
</div>

<section style="padding-bottom:80px;">
  <div class="container">

    @if($chapter->resources->isEmpty())
      <div style="text-align:center;padding:72px 0;color:#9ca3af;">
        <i class="bi bi-camera-video" style="font-size:3rem;display:block;margin-bottom:16px;color:#d1d5db;"></i>
        <p style="font-size:14.5px;margin:0;">No tutorials uploaded yet. Check back soon.</p>
      </div>
    @else
      <div class="row g-4">
        @foreach($chapter->resources as $index => $resource)
          <div class="{{ $chapter->resources->count() === 1 ? 'col-12 col-lg-8 mx-auto' : 'col-12 col-md-6' }}">
            <div class="video-card">
              <div class="video-card-player">
                <video
                  controls
                  controlsList="nodownload"
                  preload="metadata">
                  <source src="{{ route('members.chapters.stream', $resource->id) }}" type="video/mp4">
                  Your browser does not support video playback.
                </video>
              </div>
              <div class="video-card-footer">
                <span class="video-num">{{ str_pad($index + 1, 2, '0', STR_PAD_LEFT) }}</span>
                <span class="video-title">{{ $resource->file_name }}</span>
              </div>
            </div>
          </div>
        @endforeach
      </div>
    @endif

    <div style="margin-top:48px;padding-top:24px;border-top:1px solid var(--border-light);">
      <a href="{{ route('members.chapters.show', $chapter->slug) }}" style="font-size:14px;font-weight:600;color:var(--navy);text-decoration:none;display:inline-flex;align-items:center;gap:6px;">
        <i class="bi bi-arrow-left"></i> Back to Chapter
      </a>
    </div>

  </div>
</section>

@endsection
