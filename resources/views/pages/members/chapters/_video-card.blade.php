@php($watched = $resource->isWatchedBy(auth()->user()))
<div class="video-card {{ $watched ? 'is-watched' : '' }}">
  <div class="video-card-player">
    <video
      controls
      controlsList="nodownload"
      preload="metadata"
      data-complete-url="{{ route('members.chapters.resource.complete', $resource->id) }}"
      data-csrf="{{ csrf_token() }}">
      <source src="{{ route('members.chapters.stream', $resource->id) }}" type="video/mp4">
      Your browser does not support video playback.
    </video>
  </div>
  <div class="video-card-footer">
    <span class="video-num">{{ str_pad($index + 1, 2, '0', STR_PAD_LEFT) }}</span>
    <span class="video-title">{{ $resource->file_name }}</span>
    <i class="completion-tick bi {{ $watched ? 'bi-check-circle-fill' : 'bi-circle' }}"
       title="{{ $watched ? 'Completed' : 'Not completed yet' }}"></i>
  </div>
</div>
