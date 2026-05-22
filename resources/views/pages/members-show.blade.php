@extends('layouts.site')

@section('title', ($post->meta_title ?? $post->title).' | GISBA Members')
@section('meta_description', $post->meta_description ?? $post->excerpt)

@section('banner')
  <div class="d-flex justify-content-between align-items-center flex-wrap gap-2">
    <span><i class="bi bi-star-fill me-2"></i>Members Library</span>
    <div class="d-flex gap-3">
      <a href="{{ route('members.chapters.index') }}"><i class="bi bi-arrow-left me-1"></i>Back to Library</a>
      <a href="{{ route('home') }}"><i class="bi bi-house me-1"></i>Home</a>
    </div>
  </div>
@endsection

@section('footer_tagline')
  GISBA Members — Exclusive Resources<br />
  Expert content for cybersecurity and project management professionals.
@endsection

@section('content')

<style>
.member-article { max-width: 800px; margin: 0 auto; padding: 48px 0 80px; }
.member-article img.hero { width: 100%; border-radius: var(--radius-lg); margin-bottom: 32px; max-height: 380px; object-fit: cover; }
.member-article h1 { font-family: var(--font-display); font-size: clamp(1.5rem, 3vw, 2rem); color: var(--navy); font-weight: 900; margin-bottom: 12px; line-height: 1.25; }
.article-meta { font-size: 12.5px; color: #999; margin-bottom: 32px; display: flex; align-items: center; gap: 16px; flex-wrap: wrap; }
.article-body { font-size: 15.5px; line-height: 1.85; color: #333; }
.article-body h2, .article-body h3 { color: var(--navy); font-family: var(--font-display); margin-top: 2em; }
.article-body a { color: var(--navy); }
.article-body img { max-width: 100%; border-radius: 8px; }
</style>

<div class="container">
  <article class="member-article">
    <img src="{{ $post->image_url }}" alt="{{ $post->title }}" class="hero">

    <h1>{{ $post->title }}</h1>

    <div class="article-meta">
      <span><i class="bi bi-person me-1"></i>{{ $post->author }}</span>
      <span><i class="bi bi-calendar3 me-1"></i>{{ $post->formatted_date }}</span>
      <span style="background:rgba(200,168,75,0.12);border:1px solid rgba(200,168,75,0.25);color:var(--accent);padding:2px 10px;border-radius:20px;font-size:11px;font-weight:700;letter-spacing:0.8px;text-transform:uppercase;">
        <i class="bi bi-star-fill me-1"></i>Members Only
      </span>
    </div>

    <div class="article-body">
      {!! $post->body !!}
    </div>

    <div style="margin-top:48px;padding-top:24px;border-top:1px solid #eee;">
      <a href="{{ route('members.chapters.index') }}" style="font-size:14px;font-weight:600;color:var(--navy);text-decoration:none;">
        <i class="bi bi-arrow-left me-1"></i>Back to Members Library
      </a>
    </div>
  </article>
</div>

@endsection
