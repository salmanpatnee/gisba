# Memory — /pmp page redesign + /contact-us dropdown cleanup

Last updated: 2026-09-04

## What was built

**1. `/pmp` page changes** (planned via `/architect`, several pieces refined via `/frontend-design`)
- `resources/views/partials/pmp-banner.blade.php` — added a gold dashed-border "promo code" chip (tag icon, pulsing glow, links to `route('members.paywall')#coupon_code`) under the "Get PMP Training" button; removed the "6-Month Access" trust-row item and the "6-month access" CTA note; removed `/person` from the price.
- `resources/views/pages/pmp.blade.php` — removed the "Learning Innovation" (rhyme-based learning) section entirely, incl. its CSS. Removed unused CSS as sections were stripped.
- `resources/views/pages/_chapter-outline-card.blade.php` — removed the "Members" lock badge, the "Unlock with membership" link/text, and the wrapping `<a>` — cards are now plain non-clickable display cards (image, title, description).
- `resources/views/pages/members.blade.php` — removed the "Members Only" badge above the heading; removed all "6 months" wording (intro copy, both price `<sub>` tags, the "6 months of full access" feature bullet).
- New "Author Showcase" section added to `pmp.blade.php`, sitting between "Special Offer" and "Inside the Training". Went through several design iterations (see Decisions) and landed on: centered eyebrow "Learn From the Author" + heading "Live Online Course Conducted by the Author of the Popular Best-Selling Book, *Encyclopedia of Project Management: Beyond PMP*" (book title in gold) + the book cover image (`public/assets/images/pmp-book.png`, 483×517px) displayed at full natural size below the heading, no card background, no shadow, no ribbon — plain and minimal on the page background.
- New "Topics to be Covered During Live Online Course" divider added right before the Part 1 "PMBOK 8th Edition Review Training" section-header — styled as a centered flanking-gold-line + diamond-flourish + list-icon divider (classes `.topics-divider*`), sized up once from its first pass (label 12px→15px, icon 13px→16px, diamonds 7px→9px, lines 1px→2px thick).
- Commits (all on `main`, pushed): `fcf1037` (promo chip + 6-month/rhyme/outline-card removal), `6e0a2d8` (Members Only badge + /person removal), `7f4bd79` (author showcase add), `e9be6d7` (topics divider add). Pushed range `8041235..e9be6d7`.

**2. `/contact-us` heard-from dropdown cleanup**
- `resources/views/pages/contact-us.blade.php` — removed the "DAIC (Partner's Website)" and "Visionary Alpha (Partner's Website)" `<option>`s from the `#contact-heard-from` select; only LinkedIn / Google Search / Others remain.
- `app/Http/Requests/EnquiryRequest.php` — tightened `heard_from` validation from `in:linkedin,google,diac,visionary-alpha,other` to `in:linkedin,google,other`.
- Left `app/Mail/ContactMail.php`'s `$heardFromLabels` map untouched (still has `diac`/`visionary-alpha` entries) — intentional, so any already-stored historical `Enquiry` rows with those old values still render a friendly label instead of a raw slug.
- Commit: `52fe626`, pushed (`e9be6d7..52fe626`).

## Decisions made

- **Promo code chip**: text/link hint only, not a new functional coupon input — the real coupon field already lives on `members.paywall`; the chip just deep-links there.
- **"6-month access" removal scope**: explicitly extended to the `/members` paywall/checkout page too, not just `/pmp` — user confirmed via AskUserQuestion. Backend membership duration itself (still 6 months) was not touched, only the displayed copy.
- **Outline card link removal**: fully removed the click-through (no `stretched-link`), not just the visible badge/text — user confirmed via AskUserQuestion.
- **Author showcase — iterative simplification**: started as a side-by-side card (image left, text right, like the Special Offer card) → user asked for `/frontend-design` polish → became an elaborate navy "stage" (gradient bg, stripe texture, glow orbs, tilted book, Best-Seller ribbon) → user then asked, in sequence: "remove the bg and make the image full size" (→ plain page background, heading switched to navy text, image at true 483px width) → "remove the image card" (→ dropped the box-shadow/hover-lift, image is now flat) → "remove best seller ribbon" (→ dropped the ribbon markup/CSS entirely). **Signal for future work on this page: this user prefers restrained/minimal treatments over ornate ones for this section — don't re-add decorative chrome (shadows, ribbons, gradients) without being asked.**
- **Topics divider**: kept centered per explicit request; redesigned from a plain bold heading into a flanking-line divider motif (reusing the domain-eyebrow diamond flourish already used elsewhere on the page) rather than inventing a new visual language.
- **ContactMail label map**: kept the now-orphaned `diac`/`visionary-alpha` labels rather than deleting them, favoring backward-compatible display of historical data over strict dead-code removal — this was a judgment call, not explicitly asked.
- No Pest tests written this session — matches `feedback_no_tdd_default` (standing default: don't write tests unless explicitly asked). Confirmed no existing test references the removed `diac`/`daic`/`visionary-alpha` values, so nothing went stale.

## Problems solved

- **Browser screenshot/scroll desync**: the claude-in-chrome screenshot tool repeatedly returned frames at a stale/different scroll position than the actual page (especially right after lazy-loaded images caused a layout reflow), producing blank or wrong-section screenshots. Worked around by cross-checking with `javascript_tool` (`getBoundingClientRect`, `getComputedStyle`, `document.elementsFromPoint`, `innerText` checks) whenever a screenshot looked wrong, and by re-scrolling/re-screenshotting until stable.
- **Stale `style.css` in an already-open tab**: CSS edits to `public/assets/css/style.css` didn't show up in a tab that loaded the page before the edit. Fixed by forcing a cache-busted reload of just the stylesheet link via JS (`link.href = link.href.split('?')[0] + '?v=' + Date.now()`) rather than a full page reload.
- **Pre-existing spelling bug found (not fixed, now moot)**: `contact-us.blade.php` used option value `daic`, but `EnquiryRequest`'s old validation rule and `ContactMail`'s label map both used `diac` — a mismatch that meant selecting "DAIC" would have failed the `in:` validation. Both options are now removed entirely so this no longer matters, but worth knowing if partner-referral options are ever reintroduced.

## Current state

All 6 commits pushed to `origin/main`, latest is `52fe626`. Pint passes clean on every change. Verified in-browser (via DOM/computed-style checks and screenshots) that: the promo chip renders correctly, all "6-month"/"/person" text is gone from `/pmp` and `/members`, the author showcase section renders plain with a full-size image and no ribbon/shadow, the topics divider renders centered at its increased size, and the `/contact-us` heard-from `<select>` only has 3 options left (`linkedin`, `google`, `other`).

**Not yet done / not asked for:** no browser click-through submission test of the `/contact-us` form after the validation change; `resources/views/pages/home.blade.php` still shows DAIC and Visionary Alpha **partner logos** in a separate "partners" section (unrelated select field, explicitly out of scope — user only asked about `/contact-us`); `resources/views/pages/nis2-pricing.blade.php` also had a DIAC/Visionary text match that was never investigated (unknown if it's a similar dropdown needing the same fix).

## Next session starts with

Nothing queued. If DAIC/Visionary Alpha come up again, check whether the user wants:
1. The partner logos removed from `home.blade.php`'s partners section too.
2. `nis2-pricing.blade.php` checked for a similar select field.

## Open questions

- None blocking. The home.blade.php partner logos and nis2-pricing.blade.php mention are flagged above only in case they're relevant later — not confirmed as needing any action.
