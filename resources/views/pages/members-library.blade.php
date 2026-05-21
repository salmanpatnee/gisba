@extends('layouts.site')

@section('title', 'Members Library — GISBA Exclusive Resources')
@section('meta_description', 'Access exclusive cybersecurity and project management resources in the GISBA members library.')

@section('banner')
  <div class="d-flex justify-content-between align-items-center flex-wrap gap-2">
    <span><i class="bi bi-star-fill me-2"></i>Members Library</span>
    <div class="d-flex gap-3 align-items-center">
      <a href="{{ route('home') }}"><i class="bi bi-house me-1"></i>Home</a>
      <a href="{{ route('contact-us') }}"><i class="bi bi-envelope me-1"></i>Contact</a>
      <form method="POST" action="{{ route('members.logout') }}" style="margin:0;">
        @csrf
        <button type="submit" style="background:none;border:none;padding:0;color:inherit;cursor:pointer;font-size:inherit;"><i class="bi bi-box-arrow-right me-1"></i>Log Out</button>
      </form>
    </div>
  </div>
@endsection

@section('footer_tagline')
  GISBA Members — Exclusive Resources<br />
  Expert content for cybersecurity and project management professionals.
@endsection

@section('content')

<style>
.library-hero { padding: 40px 36px 44px; border-radius: var(--radius-lg); }
.member-card { background: var(--bg-white); border: 1px solid var(--border-light); border-radius: var(--radius-lg); overflow: hidden; box-shadow: var(--shadow-card); transition: box-shadow 0.25s, transform 0.25s; height: 100%; display: flex; flex-direction: column; }
.member-card:hover { box-shadow: var(--shadow-hover); transform: translateY(-3px); }
.member-card-img { width: 100%; height: 180px; object-fit: cover; }
.member-card-body { padding: 18px 20px; flex: 1; display: flex; flex-direction: column; }
.member-card-title { font-family: var(--font-display); font-size: 1rem; font-weight: 700; color: var(--navy); margin-bottom: 8px; line-height: 1.35; }
.member-card-excerpt { font-size: 13px; color: #555; line-height: 1.6; flex: 1; margin-bottom: 16px; }
.member-card-footer { display: flex; align-items: center; justify-content: space-between; font-size: 12px; color: #999; }
.btn-read { font-size: 12.5px; font-weight: 600; color: var(--navy); text-decoration: none; display: flex; align-items: center; gap: 4px; }
.btn-read:hover { color: var(--accent); }
</style>

<div class="page-layout" style="padding-bottom:0;">
  <div class="container">
    <div class="hero-section library-hero">
      <div class="row align-items-center g-4">
        <div class="col-12">
          <span style="font-size:11px;font-weight:700;letter-spacing:1.4px;text-transform:uppercase;color:var(--accent);background:rgba(200,168,75,0.12);border:1px solid rgba(200,168,75,0.3);padding:4px 14px;border-radius:20px;display:inline-block;margin-bottom:16px;">
            <i class="bi bi-star-fill me-1"></i> Members Only
          </span>
          <h1 style="font-family:var(--font-display);font-size:clamp(1.6rem,3.5vw,2.4rem);color:#fff;font-weight:900;line-height:1.2;margin-bottom:14px;">
            Members <span style="color:var(--accent);">Library</span>
          </h1>
          <p style="color:rgba(255,255,255,0.78);font-size:15.5px;line-height:1.7;max-width:520px;margin:0;">
            Exclusive resources curated by the GISBA team. New content added regularly.
          </p>
        </div>
      </div>
    </div>
  </div>
</div>

<section style="padding:60px 0 80px;background:var(--bg-page);">
  <div class="container">

    @if($posts->isEmpty())
      <div style="text-align:center;padding:60px 0;color:#888;">
        <i class="bi bi-journal-x" style="font-size:3rem;display:block;margin-bottom:16px;color:#ccc;"></i>
        <p>No content yet. Check back soon.</p>
      </div>
    @else
      <div class="row g-4">
        @foreach($posts as $post)
          <div class="col-12 col-md-6 col-lg-4">
            <div class="member-card">
              <img src="{{ $post->image_url }}" alt="{{ $post->title }}" class="member-card-img">
              <div class="member-card-body">
                <h2 class="member-card-title">{{ $post->title }}</h2>
                <p class="member-card-excerpt">{{ $post->excerpt }}</p>
                <div class="member-card-footer">
                  <span><i class="bi bi-calendar3 me-1"></i>{{ $post->formatted_date }}</span>
                  <a href="{{ route('members.show', $post->slug) }}" class="btn-read">
                    Read more <i class="bi bi-arrow-right"></i>
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
