# Memory — Coupon System: ISACA90/MEPAK90 (90% off) + Mailtrap SDK

Last updated: 2026-09-01

## What was built

**Coupon feature — new 90%-off tier**, added alongside the existing ISACA50/MEPAK50 flat-$499.99 coupon across all four checkout flows. Committed as `996eaf0` ("feat(coupons): add ISACA90/MEPAK90 for 90% off dynamic pricing") on `main`.

Files touched:
- `app/Http/Controllers/CriscCheckoutController.php`
- `app/Http/Controllers/CourseCheckoutController.php` (shared by CISSP + PRINCE2 via `$course` route param)
- `app/Http/Controllers/PayPalCheckoutController.php` (PMP / `/members` paywall flow)
- `resources/views/pages/crisc-course-pricing.blade.php`
- `resources/views/pages/cissp-course-pricing.blade.php`
- `resources/views/pages/prince2-course-pricing.blade.php`
- `resources/views/pages/members.blade.php`

Each controller now has `PERCENT_COUPON_CODES = ['ISACA90', 'MEPAK90']` and `PERCENT_COUPON_DISCOUNT = 0.10`, with a 3-way `match(true)` branch (flat coupon > percent coupon > normal price) computing the discounted amount as `floor($basePrice * self::PERCENT_COUPON_DISCOUNT * 100) / 100`. Each blade view's Alpine `checkCoupon()` mirrors this client-side for the price preview using `Math.floor(this.fullPrice * 0.10 * 100) / 100`.

`members.blade.php` needed one extra change the course pages didn't: it had no raw numeric base price in its Alpine `x-data` block (only pre-formatted currency strings), so added `fullPrice: {{ (float) $settings->membership_price }}` — `$settings` was already being passed into the view from `MembersController::paywall()`.

**Second, unrelated commit**: `1a2ccc2` ("feat(mail): send contact form enquiries via Mailtrap SDK") — added `railsware/mailtrap-php` + `symfony/mailer` + `symfony/http-client` to `composer.json`, registered a `mailtrap-sdk` mail transport in `config/mail.php`, and switched `ContactController::send()` to use `Mail::mailer('mailtrap-sdk')`. Also added empty `MAILTRAP_HOST`/`MAILTRAP_API_KEY`/`MAILTRAP_INBOX_ID` placeholders to `.env.example`. This was pre-existing uncommitted work from a different task (not part of the coupon session) — committed separately at the user's request, no secrets included.

## Decisions made

- **90%-off coupon computes dynamically from the live `SiteSettings` price** (e.g. `crisc_price`, `cissp_price`, `prince2_price`, `membership_price`) at checkout time, not a hardcoded flat price like the existing 50% coupon — user explicitly said "Prices are dynamic, it should change accordingly." This means CRISC's 90%-off amount ($9.99 base) is very different in scale from CISSP/PRINCE2's ($999.99 base) — that's intentional per-flow behavior, not a bug.
- **Truncate (floor), don't round**, to 2 decimals: `999.99 * 0.10 = 99.999` — `round()`/`toFixed()` bumped this to `100.00`, but the user wanted exactly `99.99`. Fixed by switching both server (`floor($x*100)/100`) and client (`Math.floor(x*100)/100`) from round-based to floor-based truncation. This must be kept in sync — any future coupon math needs both sides updated identically or the client preview will drift from the actual server-charged amount.
- **Kept the existing duplication pattern** (3 controllers + 4 views, no shared coupon config/class) rather than centralizing — explicit user choice for scope reasons, even though this is the second time the same 7 files needed touching for a new coupon tier. If a third tier is ever requested, worth revisiting centralization at that point.
- Coupon codes are case-insensitive via `strtoupper(trim(...))` server-side and `.toUpperCase()` client-side — consistent with the existing ISACA50/MEPAK50 pattern.

## Problems solved

- **Rounding bug**: initial implementation used `round($basePrice * 0.10, 2)` (and `.toFixed(2)` client-side), which turned $999.99 into $100.00 instead of the desired $99.99, because `999.99 * 0.10 = 99.999` rounds up at 2dp. Fixed by switching to floor-based truncation (`floor($x * 100) / 100`) on both server and client — verified this also applies correctly to CRISC ($9.99 → $0.99) and membership ($30.00 → $3.00) bases.

## Current state

All four checkout flows (CRISC, CISSP, PRINCE2, PMP/members) now accept both coupon tiers:
- `ISACA50`/`MEPAK50` → flat $499.99 (unchanged, pre-existing)
- `ISACA90`/`MEPAK90` → 90% off current live price, truncated to cents (new this session)

Both are enforced server-side (PayPal charge always matches) and previewed client-side via Alpine. `vendor/bin/pint --dirty` passes. Both commits (`996eaf0`, `1a2ccc2`) are local on `main`, 2 commits ahead of `origin/main` — **not pushed**. No automated tests were added (project's standing default is no-TDD unless explicitly asked — see global memory `feedback_no_tdd_default`).

Not yet manually verified in-browser this session — the fix was applied and Pint-checked, but no live page reload / PayPal sandbox test was run to confirm $999.99 → $99.99 actually renders and charges correctly end-to-end.

## Next session starts with

Nothing queued. If continuing:
1. Confirm whether `996eaf0` and `1a2ccc2` should be pushed to `origin/main` (2 commits currently ahead, unpushed).
2. Do a manual browser check on all 4 pricing pages (`/crisc-course`, `/cissp-course`, `/prince2-course`, `/members`) with `ISACA90`/`MEPAK90` to confirm the displayed price is correct (e.g. CISSP $999.99 → $99.99, not $100.00) and that `ISACA50`/`MEPAK50` still show flat $499.99 (regression check).
3. If practical, submit a real checkout with a sandbox PayPal account to confirm the persisted `CourseEnrollment.amount` / `MemberAccessToken.amount_paid` matches the truncated discount.

## Open questions

- Push policy still unconfirmed (same recurring open question across sessions) — does the user push manually, or should Claude push after committing?
- Mailtrap SDK commit (`1a2ccc2`) was committed as-is without deep review of the Mailtrap integration itself (it was pre-existing work from outside this session's task) — worth a sanity check that `MAILTRAP_API_KEY` etc. are actually set in the real `.env` (not just `.env.example`) before this reaches production, since a missing key would silently break contact form emails.
