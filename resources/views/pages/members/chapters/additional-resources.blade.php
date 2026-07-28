@extends('layouts.site')

@section('title', $chapter->title.' — Additional Optional Resources | GISBA Members')
@section('meta_description', 'Additional optional resources for '.$chapter->title.'.')

@section('banner')
  <div class="d-flex justify-content-between align-items-center flex-wrap gap-2">
    <span><i class="bi bi-journal-text me-2"></i>Additional Optional Resources</span>
    <div class="d-flex gap-3 align-items-center">
      <a href="{{ route('members.chapters.show', $chapter->slug) }}"><i class="bi bi-arrow-left me-1"></i>{{ $chapter->title }}</a>
      <a href="{{ route('members.chapters.index') }}">All Chapters</a>
    </div>
  </div>
@endsection

@section('footer_tagline')
  GISBA Members — PMP Comprehensive Training Aligned with PMBOK 8th Edition<br />
  Structured learning resources for PMP certification.
@endsection

@section('content')

<style>
.rp-header {
  background: var(--bg-white);
  border-top: 4px solid #10b981;
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
  color: #10b981;
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
.rp-title {
  font-family: var(--font-display);
  font-size: clamp(1.2rem, 2.2vw, 1.6rem);
  color: var(--navy);
  font-weight: 900;
  margin: 0;
  line-height: 1.25;
}

.additional-resources-card {
  background: var(--bg-white);
  border: 1px solid var(--border-light);
  border-radius: var(--radius-lg);
  box-shadow: var(--shadow-card);
  padding: 32px 36px;
  font-size: 15px;
  line-height: 1.75;
  color: #374151;
}
.additional-resources-card img { max-width: 100%; height: auto; }
</style>

<div class="rp-header">
  <div class="container">
    <div class="rp-meta">
      <span class="rp-type-label"><i class="bi bi-journal-text"></i> Additional Optional Resources</span>
      <span class="rp-sep">•</span>
      <a href="{{ route('members.chapters.show', $chapter->slug) }}" class="rp-chapter-link">{{ $chapter->title }}</a>
    </div>
    <h1 class="rp-title">{{ $chapter->title }}</h1>
  </div>
</div>

<section style="padding-bottom:80px;">
  <div class="container">

    @if($chapter->additional_resources)
      <div class="additional-resources-card">{!! $chapter->additional_resources !!}</div>
    @else
      <div style="text-align:center;padding:72px 0;color:#9ca3af;">
        <i class="bi bi-journal-text" style="font-size:3rem;display:block;margin-bottom:16px;color:#d1d5db;"></i>
        <p style="font-size:14.5px;margin:0;">No additional resources added yet. Check back soon.</p>
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
