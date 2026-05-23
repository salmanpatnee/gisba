@extends('layouts.site')

@section('title', $chapter->title.' — Takeaways | GISBA Members')
@section('meta_description', 'Download takeaway materials for '.$chapter->title.'.')

@section('banner')
  <div class="d-flex justify-content-between align-items-center flex-wrap gap-2">
    <span><i class="bi bi-file-earmark-text me-2"></i>Takeaways</span>
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
.rp-count-badge {
  margin-left: auto;
  background: rgba(16,185,129,0.1);
  color: #10b981;
  font-size: 11px;
  font-weight: 700;
  padding: 3px 10px;
  border-radius: 20px;
  border: 1px solid rgba(16,185,129,0.2);
}
.rp-title {
  font-family: var(--font-display);
  font-size: clamp(1.2rem, 2.2vw, 1.6rem);
  color: var(--navy);
  font-weight: 900;
  margin: 0;
  line-height: 1.25;
}
</style>

<div class="rp-header">
  <div class="container">
    <div class="rp-meta">
      <span class="rp-type-label"><i class="bi bi-file-earmark-text-fill"></i> Takeaways</span>
      <span class="rp-sep">•</span>
      <a href="{{ route('members.chapters.show', $chapter->slug) }}" class="rp-chapter-link">{{ $chapter->title }}</a>
      @if($chapter->resources->isNotEmpty())
        <span class="rp-count-badge">{{ $chapter->resources->count() }} {{ Str::plural('file', $chapter->resources->count()) }}</span>
      @endif
    </div>
    <h1 class="rp-title">{{ $chapter->title }}</h1>
  </div>
</div>

<section style="padding-bottom:80px;">
  <div class="container">

    <div style="background:var(--bg-white);border:1px solid var(--border-light);border-radius:var(--radius-lg);box-shadow:var(--shadow-card);overflow:hidden;">
      @include('pages.members.chapters._resource-table')
    </div>

    <div style="margin-top:48px;padding-top:24px;border-top:1px solid var(--border-light);">
      <a href="{{ route('members.chapters.show', $chapter->slug) }}" style="font-size:14px;font-weight:600;color:var(--navy);text-decoration:none;display:inline-flex;align-items:center;gap:6px;">
        <i class="bi bi-arrow-left"></i> Back to Chapter
      </a>
    </div>

  </div>
</section>

@endsection
