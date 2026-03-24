<style>
/* ─── NIS2 Kit Promo Banner ─────────────────────────────────── */
.nis2-promo-banner {
  background: linear-gradient(135deg, #001f4d 0%, #003b82 60%, #001f4d 100%);
  border-radius: var(--radius-md);
  padding: 16px 24px;
  position: relative;
  overflow: hidden;
  opacity: 0;
  transform: translateY(12px);
  transition: opacity 0.45s ease, transform 0.45s ease;
}
.nis2-promo-banner.visible { opacity: 1; transform: translateY(0); }
.nis2-promo-banner::before {
  content: '';
  position: absolute;
  top: -40px; right: -40px;
  width: 140px; height: 140px;
  border-radius: 50%;
  background: rgba(200,168,75,0.07);
  pointer-events: none;
}
.nis2-promo-title {
  font-family: var(--font-display);
  font-size: 1rem;
  color: #fff;
  font-weight: 800;
  margin: 0;
  line-height: 1.3;
}
.nis2-promo-title span { color: var(--accent); }
.nis2-promo-desc {
  font-size: 12.5px;
  color: rgba(255,255,255,0.68);
  margin: 0;
  line-height: 1.5;
}
.btn-nis2-buy {
  display: inline-flex;
  align-items: center;
  gap: 6px;
  background: var(--accent);
  color: var(--navy);
  font-weight: 700;
  font-size: 12.5px;
  padding: 7px 18px;
  border-radius: 5px;
  text-decoration: none;
  white-space: nowrap;
  transition: background 0.2s ease, transform 0.18s ease, box-shadow 0.2s ease;
}
.btn-nis2-buy:hover {
  background: #d4a820;
  color: var(--navy);
  transform: translateY(-1px);
  box-shadow: 0 4px 14px rgba(200,168,75,0.35);
}
</style>

<div class="container">
  <div class="nis2-promo-banner nis2-promo-reveal my-3">
    <div class="d-flex align-items-center justify-content-between flex-wrap gap-3">
      <div class="d-flex align-items-center gap-3">
        <i class="bi bi-shield-check" style="font-size:1.5rem;color:var(--accent);flex-shrink:0;"></i>
        <div>
          <h2 class="nis2-promo-title">Buy the <span>NIS2 Implementation KIT</span> Now</h2>
          <p class="nis2-promo-desc">Policies, gap analysis templates &amp; expert guidance — everything to achieve compliance.</p>
        </div>
      </div>
      <div class="d-flex align-items-center gap-2 flex-shrink-0">
        <a href="{{ route('nis2') }}" class="btn-nis2-buy">Learn More <i class="bi bi-arrow-right"></i></a>
      </div>
    </div>
  </div>
</div>

@once
@push('scripts')
<script>
(function () {
  var el = document.querySelector('.nis2-promo-reveal');
  if (!el) { return; }
  var obs = new IntersectionObserver(function (entries) {
    entries.forEach(function (entry) {
      if (entry.isIntersecting) { entry.target.classList.add('visible'); obs.unobserve(entry.target); }
    });
  }, { threshold: 0.1 });
  obs.observe(el);
})();
</script>
@endpush
@endonce