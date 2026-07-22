<div class="container">
  <div class="nis2-promo-banner my-3">
    <div class="nis2-promo-orb"></div>
    <div class="nis2-promo-inner">

      <div class="nis2-promo-left">
        <div class="nis2-promo-icon">
          <i class="bi bi-award"></i>
        </div>
        <div class="nis2-promo-text">
          <div class="nis2-promo-badge"><i class="bi bi-star-fill"></i> Certification Prep</div>
          <h2 class="nis2-promo-title">Get the <span>PMP Comprehensive Training Aligned with PMBOK 8th Edition and PMP July 2026 Exam Outline</span></h2>
          <p class="nis2-promo-desc">Exam-ready content, practice questions &amp; expert guidance — everything you need to pass the PMP exam.</p>
          @if($showBlogLink ?? false)
            <p class="nis2-promo-desc" style="margin-top:10px;font-weight:600;">Or access the free resources <a href="{{ route('pmp') }}#knowledge-base" style="color:var(--accent);font-weight:800;text-decoration:underline;text-underline-offset:3px;">blog</a>.</p>
          @endif
          <div class="nis2-promo-pills">
            <span class="nis2-promo-pill"><i class="bi bi-check-circle-fill"></i> Exam-Ready Content</span>
            <span class="nis2-promo-pill"><i class="bi bi-check-circle-fill"></i> Practice Questions</span>
            <span class="nis2-promo-pill"><i class="bi bi-check-circle-fill"></i> Expert Guidance</span>
          </div>
        </div>
      </div>

      <div class="nis2-promo-cta">
        <a href="{{ route('members.paywall') }}" class="btn-nis2-buy">
          $30 / 6 months — Get PMP Training <i class="bi bi-arrow-right"></i>
        </a>
      </div>

    </div>
  </div>
</div>
