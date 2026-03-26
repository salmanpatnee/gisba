<style>
/* ─── NIS2 Kit Promo Banner ─────────────────────────────────── */
.nis2-promo-banner {
  background: linear-gradient(160deg, #001f4d 0%, #003b82 55%, #004a99 100%);
  border-radius: var(--radius-lg);
  padding: 22px 28px;
  position: relative;
  overflow: hidden;
  opacity: 0;
  transform: translateY(10px);
  transition: opacity 0.45s ease, transform 0.45s ease;
}
.nis2-promo-banner.visible { opacity: 1; transform: translateY(0); }

/* Subtle stripe texture — matches .hero-img-banner */
.nis2-promo-banner::before {
  content: '';
  position: absolute;
  bottom: 0; left: 0; right: 0;
  height: 100%;
  background: repeating-linear-gradient(
    90deg,
    rgba(255,255,255,0.035) 0px,
    rgba(255,255,255,0.035) 14px,
    transparent 14px,
    transparent 30px
  );
  pointer-events: none;
}

/* Gold bottom border accent */
.nis2-promo-banner::after {
  content: '';
  position: absolute;
  bottom: 0; left: 0; right: 0;
  height: 3px;
  background: var(--accent);
}

.nis2-promo-badge {
  display: inline-flex;
  align-items: center;
  gap: 6px;
  background: rgba(200, 168, 75, 0.18);
  border: 1px solid var(--accent);
  color: var(--accent);
  font-family: var(--font-body);
  font-size: 11px;
  font-weight: 700;
  letter-spacing: 0.8px;
  text-transform: uppercase;
  padding: 4px 12px;
  border-radius: 20px;
  margin-bottom: 10px;
}

.nis2-promo-title {
  font-family: var(--font-display);
  font-size: clamp(0.95rem, 2vw, 1.1rem);
  font-weight: 900;
  color: #fff;
  margin: 0 0 6px;
  line-height: 1.3;
}
.nis2-promo-title span { color: var(--accent); }

.nis2-promo-desc {
  font-family: var(--font-body);
  font-size: 13.5px;
  color: rgba(255, 255, 255, 0.75);
  margin: 0;
  line-height: 1.55;
}

.btn-nis2-buy {
  display: inline-flex;
  align-items: center;
  justify-content: center;
  gap: 7px;
  background: var(--accent);
  color: var(--navy) !important;
  font-family: var(--font-body);
  font-weight: 700;
  font-size: 13.5px;
  padding: 10px 22px;
  border-radius: var(--radius-md);
  border: 2px solid var(--accent);
  text-decoration: none !important;
  white-space: nowrap;
  transition: background 0.2s ease, box-shadow 0.2s ease, transform 0.15s ease;
  flex-shrink: 0;
}
.btn-nis2-buy:hover {
  background: #b8942f;
  border-color: #b8942f;
  box-shadow: 0 4px 16px rgba(200, 168, 75, 0.4);
  transform: translateY(-1px);
}

@media (max-width: 575px) {
  .nis2-promo-banner { padding: 18px 18px 20px; }
  .btn-nis2-buy { width: 100%; }
}
</style>

<div class="container">
  <div class="nis2-promo-banner nis2-promo-reveal my-3">
    <div class="d-flex align-items-center justify-content-between flex-wrap gap-3" style="position:relative;z-index:1;">

      <div>
        <div class="nis2-promo-badge">
          <i class="bi bi-shield-check"></i>
          Compliance Toolkit
        </div>
        <h2 class="nis2-promo-title">Get the <span>NIS2 Implementation KIT</span></h2>
        <p class="nis2-promo-desc">Policies, gap analysis templates &amp; expert guidance — everything to achieve compliance.</p>
      </div>

      <a href="{{ route('nis2-toolkit') }}" class="btn-nis2-buy">
        Learn More <i class="bi bi-arrow-right"></i>
      </a>

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
