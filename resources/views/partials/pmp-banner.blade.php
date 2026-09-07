<div class="container">
  <div class="nis2-promo-banner my-3">
    <div class="nis2-promo-orb"></div>
    <div class="nis2-promo-inner">

      <div class="nis2-promo-left">
        <div class="nis2-promo-badge-icon" aria-hidden="true">
          <span class="nis2-promo-badge-icon-ring"></span>
          <i class="bi bi-patch-check-fill"></i>
        </div>
        <div class="nis2-promo-text">
          <div class="nis2-promo-badge"><i class="bi bi-star-fill"></i> Certification Prep</div>
          <h2 class="nis2-promo-title">
            @if (($variant ?? 'primary') === 'reinforcing')
              Ready to Enroll? Get <span>PMP Comprehensive Training</span>
            @else
              Pass the PMP Exam with <span>Confidence</span>
            @endif
          </h2>
          <p class="nis2-promo-subhead">Aligned with PMBOK&reg; 8th Edition &amp; the PMP July 2026 Exam Content Outline.</p>
          <p class="nis2-promo-desc">Exam-ready content, practice questions &amp; expert guidance — everything you need to pass the PMP exam.</p>
          @if($showBlogLink ?? false)
            <p class="nis2-promo-desc nis2-promo-blog-link">Or access the free resources <a href="{{ route('pmp') }}#knowledge-base">blog</a>.</p>
          @endif

          @if(($outlineChapterCount ?? 0) > 0)
          <div class="nis2-promo-trust-row">
            <span class="nis2-promo-trust-item"><i class="bi bi-journals"></i> {{ $outlineChapterCount }} Chapters</span>
            <span class="nis2-promo-trust-sep">&bull;</span>
            <span class="nis2-promo-trust-item"><i class="bi bi-award-fill"></i> 35 PDU Hours Certificate of Completion</span>
          </div>
          @endif

          <div class="nis2-promo-pills">
            <span class="nis2-promo-pill"><i class="bi bi-check-circle-fill"></i> Exam-Ready Content</span>
            <span class="nis2-promo-pill"><i class="bi bi-check-circle-fill"></i> Practice Questions</span>
            <span class="nis2-promo-pill"><i class="bi bi-check-circle-fill"></i> Expert Guidance</span>
          </div>
        </div>
      </div>

      <div class="nis2-promo-cta">
        <div class="nis2-promo-price-line">
          <span class="nis2-promo-new-price">{{ $pmpPrice }}</span>
        </div>
        @if($pmpSchedule)
          <div class="nis2-promo-schedule"><i class="bi bi-calendar3"></i> {{ $pmpSchedule }}</div>
        @endif
        <a href="{{ route('pmp.pricing') }}" class="btn-nis2-buy">
          Get PMP Training <i class="bi bi-arrow-right"></i>
        </a>
        <a href="{{ route('pmp.pricing') }}#coupon_code" class="nis2-promo-coupon-chip">
          <span class="nis2-promo-coupon-chip-icon"><i class="bi bi-tag-fill"></i></span>
          <span class="nis2-promo-coupon-chip-copy">
            <strong>Have a promo code?</strong>
            Apply it at checkout for an extra discount
          </span>
        </a>
      </div>

    </div>
  </div>
</div>
