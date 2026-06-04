{{-- Guest-facing course outline card (no progress; whole card → paywall). --}}
<div class="col-12 col-md-6 col-lg-4">
  <div class="chapter-card">
    <div class="chapter-card-media">
      <img src="{{ $chapter->image_url }}" alt="{{ $chapter->title }}" class="chapter-card-img" loading="lazy">
      <span class="chapter-lock-badge"><i class="bi bi-lock-fill"></i> Members</span>
    </div>
    <div class="chapter-card-body">
      <h3 class="chapter-card-title">{{ $chapter->title }}</h3>
      @if($chapter->description)
        <p class="chapter-card-desc">{{ Str::limit($chapter->description, 120) }}</p>
      @endif
      <div class="chapter-card-foot">
        <a href="{{ route('members.paywall') }}" class="btn-unlock stretched-link">
          <i class="bi bi-unlock-fill"></i> Unlock with membership
        </a>
      </div>
    </div>
  </div>
</div>
