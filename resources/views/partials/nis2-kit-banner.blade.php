<style>
/* ─── NIS2 Kit Promo Banner ─────────────────────────────────── */
.nis2-promo-banner {
  background: linear-gradient(160deg, #001430 0%, #002b6e 45%, #003b82 100%);
  border-radius: var(--radius-lg);
  padding: 32px 36px;
  position: relative;
  overflow: hidden;
  border: 1px solid rgba(200,168,75,0.25);
  box-shadow: 0 8px 32px rgba(0,20,60,0.28);
  opacity: 0;
  transform: translateY(10px);
  transition: opacity 0.45s ease, transform 0.45s ease;
}
.nis2-promo-banner.visible { opacity: 1; transform: translateY(0); }

/* Stripe texture */
.nis2-promo-banner::before {
  content: '';
  position: absolute;
  inset: 0;
  background: repeating-linear-gradient(
    90deg,
    rgba(255,255,255,0.03) 0px,
    rgba(255,255,255,0.03) 14px,
    transparent 14px,
    transparent 30px
  );
  pointer-events: none;
}

/* Gold top + bottom border */
.nis2-promo-banner::after {
  content: '';
  position: absolute;
  bottom: 0; left: 0; right: 0;
  height: 4px;
  background: linear-gradient(90deg, var(--accent), #e8c96a, var(--accent));
}

/* Decorative glow orb */
.nis2-promo-orb {
  position: absolute;
  top: -60px; right: -60px;
  width: 220px; height: 220px;
  border-radius: 50%;
  background: radial-gradient(circle, rgba(200,168,75,0.12) 0%, transparent 70%);
  pointer-events: none;
}

.nis2-promo-inner {
  position: relative;
  z-index: 1;
  display: flex;
  align-items: center;
  justify-content: space-between;
  gap: 28px;
  flex-wrap: wrap;
}

.nis2-promo-left {
  display: flex;
  align-items: center;
  gap: 20px;
  flex: 1;
  min-width: 0;
}

/* Icon box */
.nis2-promo-icon {
  width: 56px;
  height: 56px;
  background: rgba(200,168,75,0.15);
  border: 1.5px solid rgba(200,168,75,0.4);
  border-radius: var(--radius-md);
  display: flex;
  align-items: center;
  justify-content: center;
  flex-shrink: 0;
  font-size: 1.6rem;
  color: var(--accent);
}

.nis2-promo-text { min-width: 0; }

.nis2-promo-badge {
  display: inline-flex;
  align-items: center;
  gap: 5px;
  background: rgba(200,168,75,0.15);
  border: 1px solid rgba(200,168,75,0.45);
  color: var(--accent);
  font-family: var(--font-body);
  font-size: 10.5px;
  font-weight: 700;
  letter-spacing: 1px;
  text-transform: uppercase;
  padding: 3px 10px;
  border-radius: 20px;
  margin-bottom: 8px;
}

.nis2-promo-title {
  font-family: var(--font-display);
  font-size: clamp(1.05rem, 2.2vw, 1.3rem);
  font-weight: 900;
  color: #fff;
  margin: 0 0 7px;
  line-height: 1.25;
}
.nis2-promo-title span { color: var(--accent); }

.nis2-promo-desc {
  font-family: var(--font-body);
  font-size: 13.5px;
  color: rgba(255,255,255,0.72);
  margin: 0;
  line-height: 1.55;
}

/* Feature pills */
.nis2-promo-pills {
  display: flex;
  flex-wrap: wrap;
  gap: 6px;
  margin-top: 10px;
}
.nis2-promo-pill {
  display: inline-flex;
  align-items: center;
  gap: 5px;
  background: rgba(255,255,255,0.07);
  border: 1px solid rgba(255,255,255,0.14);
  color: rgba(255,255,255,0.82);
  font-family: var(--font-body);
  font-size: 11.5px;
  font-weight: 500;
  padding: 3px 10px;
  border-radius: 20px;
}
.nis2-promo-pill i { color: #6fcf8a; font-size: 11px; }

/* CTA group */
.nis2-promo-cta {
  display: flex;
  flex-direction: column;
  align-items: center;
  gap: 8px;
  flex-shrink: 0;
  text-align: center;
}

.btn-nis2-buy {
  display: inline-flex;
  align-items: center;
  justify-content: center;
  gap: 8px;
  background: var(--accent);
  color: var(--navy) !important;
  font-family: var(--font-body);
  font-weight: 700;
  font-size: 14px;
  padding: 12px 28px;
  border-radius: var(--radius-md);
  border: 2px solid var(--accent);
  text-decoration: none !important;
  white-space: nowrap;
  transition: background 0.2s ease, box-shadow 0.2s ease, transform 0.15s ease;
  box-shadow: 0 4px 16px rgba(200,168,75,0.3);
}
.btn-nis2-buy:hover {
  background: #b8942f;
  border-color: #b8942f;
  box-shadow: 0 6px 22px rgba(200,168,75,0.45);
  transform: translateY(-2px);
}

.nis2-promo-note {
  font-family: var(--font-body);
  font-size: 11px;
  color: rgba(255,255,255,0.45);
  white-space: nowrap;
}

@media (max-width: 767px) {
  .nis2-promo-banner { padding: 22px 20px 26px; }
  .nis2-promo-inner { flex-direction: column; align-items: flex-start; gap: 20px; }
  .nis2-promo-cta { align-items: flex-start; width: 100%; }
  .btn-nis2-buy { width: 100%; justify-content: center; }
  .nis2-promo-note { display: none; }
}
</style>

<div class="container">
  <div class="nis2-promo-banner nis2-promo-reveal my-3">
    <div class="nis2-promo-orb"></div>
    <div class="nis2-promo-inner">

      <div class="nis2-promo-left">
        <div class="nis2-promo-icon">
          <i class="bi bi-shield-check"></i>
        </div>
        <div class="nis2-promo-text">
          <div class="nis2-promo-badge"><i class="bi bi-star-fill"></i> Compliance Toolkit</div>
          <h2 class="nis2-promo-title">Get the <span>NIS2 Implementation KIT</span></h2>
          <p class="nis2-promo-desc">Policies, gap analysis templates &amp; expert guidance — everything to achieve compliance.</p>
          <div class="nis2-promo-pills">
            <span class="nis2-promo-pill"><i class="bi bi-check-circle-fill"></i> Gap Analysis Templates</span>
            <span class="nis2-promo-pill"><i class="bi bi-check-circle-fill"></i> Ready-Made Policies</span>
            <span class="nis2-promo-pill"><i class="bi bi-check-circle-fill"></i> Expert Guidance</span>
          </div>
        </div>
      </div>

      <div class="nis2-promo-cta">
        <a href="{{ route('nis2-toolkit') }}" class="btn-nis2-buy">
          Learn More <i class="bi bi-arrow-right"></i>
        </a>
        
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
