@extends('layouts.site')

@section('title', 'NIS2 Video Resources | GISBA Consultants — Cybersecurity Training Videos')
@section('meta_description', 'Watch GISBA NIS2 cybersecurity training and compliance videos. Expert insights on NIS2, ISO standards, and cyber resilience delivered through video.')

@section('banner')
  <div class="d-flex justify-content-between align-items-center flex-wrap gap-2">
    <span><i class="bi bi-play-circle me-2"></i>GISBA NIS2 Video Resources — Cybersecurity Training &amp; Compliance</span>
    <div class="d-flex gap-3">
      <a href="{{ route('home') }}"><i class="bi bi-house me-1"></i>Home</a>
      <a href="{{ route('contact-us') }}"><i class="bi bi-envelope me-1"></i>Contact</a>
    </div>
  </div>
@endsection

@section('footer_tagline')
  Expert Cybersecurity &amp; Compliance Training<br />
  Video Resources from the GISBA Consulting Team.
@endsection

@section('content')

<style>
/* ─── Video Hero ─────────────────────────────────────────────── */
.video-hero { padding: 40px 36px 44px; border-radius: var(--radius-lg); }
.video-hero-label { display: inline-block; font-size: 11px; font-weight: 700; letter-spacing: 1.4px; text-transform: uppercase; color: var(--accent); background: rgba(200,168,75,0.12); border: 1px solid rgba(200,168,75,0.3); padding: 4px 14px; border-radius: 20px; margin-bottom: 16px; }
.video-hero-title { font-family: var(--font-display); font-size: clamp(1.6rem, 3.5vw, 2.4rem); color: var(--text-white); font-weight: 900; line-height: 1.2; margin-bottom: 14px; }
.video-hero-title span { color: var(--accent); }
.video-hero-desc { color: rgba(255,255,255,0.78); font-size: 15.5px; line-height: 1.7; max-width: 520px; margin-bottom: 0; }

/* ─── Videos Section ─────────────────────────────────────────── */
.videos-section { padding: 60px 0 80px; background: var(--bg-page); }
.videos-section-header { margin-bottom: 48px; }
.videos-section-label { font-size: 11px; font-weight: 700; letter-spacing: 1.2px; text-transform: uppercase; color: var(--accent); display: block; margin-bottom: 6px; }
.videos-section-title { font-family: var(--font-display); font-size: 1.25rem; color: var(--navy); font-weight: 700; margin-bottom: 4px; }
.videos-accent-bar { width: 40px; height: 3px; background: var(--accent); border-radius: 2px; }
.videos-count-badge { display: inline-flex; align-items: center; gap: 6px; font-size: 12px; font-weight: 600; color: var(--text-muted); background: var(--bg-section-alt); border: 1px solid var(--border-light); padding: 4px 12px; border-radius: 20px; }

/* ─── Video Card ─────────────────────────────────────────────── */
.video-card {
  background: var(--bg-white);
  border: 1px solid var(--border-light);
  border-radius: var(--radius-lg);
  overflow: hidden;
  box-shadow: var(--shadow-card);
  transition: box-shadow 0.28s ease, transform 0.28s ease;
  height: 100%;
  display: flex;
  flex-direction: column;
}
.video-card:hover { box-shadow: var(--shadow-hover); transform: translateY(-4px); }

.video-card-player {
  position: relative;
  background: linear-gradient(160deg, #0a1628 0%, #002150 100%);
  aspect-ratio: 16 / 9;
}
.video-card-player::before {
  content: '';
  position: absolute;
  inset: 0;
  background:
    radial-gradient(ellipse at 20% 50%, rgba(200,168,75,0.08) 0%, transparent 60%),
    radial-gradient(ellipse at 80% 20%, rgba(200,168,75,0.05) 0%, transparent 50%);
  pointer-events: none;
  z-index: 0;
}
.video-card-player video {
  position: relative;
  z-index: 1;
  width: 100%;
  height: 100%;
  display: block;
  object-fit: contain;
}

.video-card-body {
  padding: 0;
  flex: 1;
  display: flex;
  flex-direction: column;
}
.video-card-footer {
  display: flex;
  align-items: center;
  justify-content: space-between;
  gap: 10px;
  padding: 12px 16px 14px;
  background: linear-gradient(135deg, var(--navy) 0%, rgba(0,33,80,0.93) 100%);
  position: relative;
  overflow: hidden;
}
.video-card-footer::after {
  content: '';
  position: absolute;
  bottom: -18px; right: -18px;
  width: 64px; height: 64px;
  background: rgba(200,168,75,0.08);
  border-radius: 50%;
}
.video-card-title {
  font-family: var(--font-display);
  font-size: 0.88rem;
  font-weight: 700;
  color: #ffffff;
  line-height: 1.35;
  margin: 0;
  position: relative; z-index: 1;
}
.video-card-meta {
  display: flex;
  align-items: center;
  gap: 10px;
  flex-wrap: wrap;
}
.video-card-badge {
  display: inline-flex;
  align-items: center;
  gap: 4px;
  font-size: 11px;
  font-weight: 600;
  letter-spacing: 0.5px;
  text-transform: uppercase;
  color: var(--accent);
  background: rgba(200,168,75,0.1);
  border: 1px solid rgba(200,168,75,0.25);
  padding: 2px 9px;
  border-radius: 20px;
}
.video-card-size {
  font-size: 11.5px;
  color: var(--text-muted);
}

/* ─── Empty State ────────────────────────────────────────────── */
.videos-empty {
  text-align: center;
  padding: 64px 24px;
  background: var(--bg-white);
  border: 1px solid var(--border-light);
  border-radius: var(--radius-lg);
}
.videos-empty-icon {
  width: 64px; height: 64px;
  background: rgba(200,168,75,0.1);
  border: 1px solid rgba(200,168,75,0.2);
  border-radius: 50%;
  display: inline-flex;
  align-items: center;
  justify-content: center;
  font-size: 26px;
  color: var(--accent);
  margin-bottom: 20px;
}
.videos-empty-title {
  font-family: var(--font-display);
  font-size: 1.15rem;
  font-weight: 700;
  color: var(--navy);
  margin-bottom: 8px;
}
.videos-empty-desc {
  font-size: 14px;
  color: var(--text-muted);
  max-width: 360px;
  margin: 0 auto;
  line-height: 1.6;
}

/* ─── Views ─────────────────────────────────────────────────── */
.video-card-views {
  display: inline-flex;
  align-items: center;
  gap: 4px;
  font-size: 11.5px;
  font-weight: 500;
  color: rgba(255,255,255,0.75);
  white-space: nowrap;
  position: relative; z-index: 1;
}
.video-card-views i { font-size: 12px; }

/* ─── Reveal animation ──────────────────────────────────────── */
.vid-reveal { opacity: 0; transform: translateY(18px); transition: opacity 0.48s ease, transform 0.48s ease; }
.vid-reveal.visible { opacity: 1; transform: translateY(0); }
</style>

{{-- ── Hero ─────────────────────────────────────────────────────── --}}
<div class="page-layout" style="padding-bottom:0;">
  <div class="container">
    <div class="hero-section video-hero">
      <div class="row align-items-center g-4">
        <div class="col-12">
          <span class="video-hero-label"><i class="bi bi-play-circle me-1"></i> NIS2 Video Resources</span>
          <h1 class="video-hero-title">NIS2 Cybersecurity &amp; Compliance<br /><span>Training Videos</span></h1>
          <p class="video-hero-desc">Watch expert-led videos on NIS2, ISO frameworks, cyber resilience, and compliance best practices — delivered directly from GISBA consultants in the field.</p>
        </div>
      </div>
    </div>
  </div>
</div>

{{-- ── NIS2 Kit Promo Banner ──────────────────────────────────────── --}}
@include('partials.nis2-kit-banner')

{{-- ── Videos Grid ────────────────────────────────────────────────── --}}
<section class="videos-section">
  <div class="container">

    <div class="videos-section-header vid-reveal">
      <div class="d-flex align-items-end justify-content-between flex-wrap gap-3">
        <div>
          <span class="videos-section-label">Resources Library</span>
          <h2 class="videos-section-title">Browse Training Videos</h2>
          <div class="videos-accent-bar mt-2"></div>
        </div>
        <span class="videos-count-badge">
          <i class="bi bi-play-circle" style="color:var(--accent);"></i>
          {{ $videos->count() }} {{ Str::plural('Video', $videos->count()) }}
        </span>
      </div>
    </div>

    @if($videos->isNotEmpty())
      <div class="row g-4">
        @foreach($videos as $video)
        <div class="col-12 col-md-6 vid-reveal" style="transition-delay: {{ $loop->index * 0.08 }}s;">
          <div class="video-card">
            <div class="video-card-player">
              <video
                controls
                controlsList="nodownload"
                oncontextmenu="return false;"
                preload="metadata"
                playsinline
                data-view-url="{{ route('videos.record-view', $video) }}"
                data-csrf="{{ csrf_token() }}"
              >
                <source src="{{ Storage::disk('public')->url($video->path) }}" type="{{ $video->mime_type }}">
                Your browser does not support the video tag.
              </video>
            </div>
            <div class="video-card-body">
              <div class="video-card-footer">
                <h3 class="video-card-title">{{ $video->title }}</h3>
                <div class="video-card-views flex-shrink-0">
                  <i class="bi bi-eye"></i>
                  <span>{{ number_format($video->views) }}</span>
                </div>
              </div>
            </div>
          </div>
        </div>
        @endforeach
      </div>
    @else
      <div class="vid-reveal">
        <div class="videos-empty">
          <div class="videos-empty-icon">
            <i class="bi bi-play-circle"></i>
          </div>
          <h3 class="videos-empty-title">No Videos Yet</h3>
          <p class="videos-empty-desc">Training videos will be available here soon. Check back later for expert cybersecurity content from GISBA.</p>
        </div>
      </div>
    @endif

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

  document.querySelectorAll('.vid-reveal').forEach(el => revealObserver.observe(el));
})();

// ── View tracking ─────────────────────────────────────────────
document.querySelectorAll('video[data-view-url]').forEach(function (video) {
  var tracked = false;
  video.addEventListener('play', function () {
    if (tracked) { return; }
    tracked = true;
    fetch(video.dataset.viewUrl, {
      method: 'POST',
      headers: {
        'X-CSRF-TOKEN': video.dataset.csrf,
        'Accept': 'application/json',
      },
    });
  });
});
</script>
@endpush
