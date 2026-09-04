{{-- Guest-facing course outline card. --}}
<div class="col-12 col-md-6 col-lg-4">
  <div class="chapter-card">
    <div class="chapter-card-media">
      <img src="{{ $chapter->image_url }}" alt="{{ $chapter->title }}" class="chapter-card-img" loading="lazy">
    </div>
    <div class="chapter-card-body">
      <h3 class="chapter-card-title">{{ $chapter->title }}</h3>
      @if($chapter->description)
        <p class="chapter-card-desc">{{ Str::limit($chapter->description, 120) }}</p>
      @endif
    </div>
  </div>
</div>
