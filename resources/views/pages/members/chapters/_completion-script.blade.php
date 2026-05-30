@push('scripts')
<script>
  document.querySelectorAll('video[data-complete-url]').forEach(function (v) {
    v.addEventListener('ended', function () {
      fetch(v.dataset.completeUrl, {
        method: 'POST',
        headers: { 'X-CSRF-TOKEN': v.dataset.csrf, 'Accept': 'application/json' },
      }).then(function (r) {
        if (! r.ok) { return; }
        var card = v.closest('.video-card');
        if (! card) { return; }
        card.classList.add('is-watched');
        var tick = card.querySelector('.completion-tick');
        if (tick) { tick.className = 'completion-tick bi bi-check-circle-fill'; }
      });
    });
  });
</script>
@endpush
