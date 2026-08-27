# Memory — CRISC Online Course Feature

Last updated: 2026-08-27

## What was built

Full "CRISC Online Course" feature end to end, mirroring the existing NIS2/PMP patterns. Committed across 3 commits on `main` (`679cedc`, `d429a9d`, `15cdc33`), all pushed to `origin/main` — nothing pending push.

**Database:** `crisc_categories`, `crisc_posts`, `crisc_post_attachments`, `course_enrollments` tables; `crisc_price`/`crisc_currency`/`crisc_date`/`crisc_time_start`/`crisc_time_end`/`crisc_timezone`/`crisc_capacity` columns added to `site_settings`.

**Models:** `App\Models\CriscCategory`, `CriscPost`, `CriscPostAttachment` (direct clones of the PMP blog stack), `CourseEnrollment` (new, generic — has a `course` column so future paid courses can reuse it), `SiteSettings` extended with `crisc_*` fillable/casts + `getCriscSeatsRemainingAttribute()`.

**Public routes/controllers:**
- `/crisc-course` → `PageController::crisc()` — landing page (hero, course info, pricing teaser, **and** the article "Knowledge Base" section — see Decisions)
- `/crisc-course/pricing` → `PageController::criscPricing()` — PayPal enrollment card
- `/crisc-course/checkout`, `/crisc-course/paypal/return`, `/crisc-course/paypal/cancel`, `/crisc-course/enrolled` → `CriscCheckoutController` (new)
- `/crisc/{slug}` → `CriscController@show` (public) — individual article page only, **no `/crisc` index route** (removed, see Decisions)

**Admin:** `Admin\CriscController`, `CriscCategoryController`, `CriscAttachmentController` (clones of `Admin\Pmp*`) at `/admin/crisc*`; `Admin\CourseEnrollmentController@index` at `/admin/crisc-enrollments`; extended `Admin\SiteSettingsController`/`UpdateSiteSettingsRequest`/`admin/site-settings/edit.blade.php` with a CRISC fieldset (price/currency/date/times/timezone/capacity, Alpine.js live preview matching the existing membership-pricing pattern).

**Mail:** `App\Mail\CourseEnrollmentConfirmationMail` + `resources/views/emails/crisc-enrollment-confirmation.blade.php`.

**Nav:** CRISC links added to `layouts/site.blade.php` (public nav + footer) and `layouts/navigation.blade.php` (admin dropdown, desktop + mobile).

**Tests:** `tests/Feature/CriscBlogTest.php`, `CriscCoursePagesTest.php`, `CriscCheckoutTest.php` (16 tests) + one test added to `SiteSettingsTest.php` for the new `crisc_*` fields. Factories: `CriscCategoryFactory`, `CriscPostFactory`, `CourseEnrollmentFactory`.

**New file this session:** `ui-registry.md` (untracked, not yet committed) — created via `/imprint`, documents the `.kb-*` Knowledge Base card pattern and the `.page-layout` bottom-padding-stacking gotcha.

## Decisions made

1. **Blog architecture — cloned the PMP pattern** (dedicated `CriscPost`/`CriscCategory`/`CriscPostAttachment` tables + admin CRUD), not a shared/generalized blog. User's explicit choice via AskUserQuestion, overriding my initial recommendation to generalize the existing `blog_posts` table.
2. **Course settings — extended the `SiteSettings` singleton** with `crisc_*` columns, following the same convention as NIS2/membership pricing, rather than a new dedicated `Course` model. User's explicit choice.
3. **Enrollment/payment — in-app PayPal checkout + new `CourseEnrollment` model**, reusing `PayPalService::createOrder()` (it already accepted custom amount/currency) via a new `CriscCheckoutController`, rather than a static Stripe Payment Link like NIS2 uses. User's explicit choice; enforces the 12-seat cap for real (`crisc_seats_remaining`), unlike NIS2's purely cosmetic "Limited Time Offer".
4. **`BusinessEmail` validation rule applied to `CriscCheckoutRequest`** — this rule existed in the codebase (`app/Rules/BusinessEmail.php`) but was completely unused everywhere else (dead code) before this session.
5. **Article listing folded into the landing page, not a separate route** — I initially built `/crisc` as a standalone listing page (cloning `/nis2`'s split of toolkit-page vs. blog-index-page). User corrected this twice: (a) "should not be a separate page rather a section on the /crisc-course page", then (b) "it should be the same as the nis2 knowledge base section" (i.e. reuse the exact `.kb-*` full-width stacked-card CSS/markup from `blog.blade.php`, not a custom single-big-card design I tried first). Removed the `/crisc` index route and public `CriscController::index()` entirely; `PageController::crisc()` now fetches `$categorizedPosts` itself and the landing view renders the Knowledge Base section inline. `/crisc/{slug}` (article detail) is untouched, just repoints its "back to articles" links at `crisc-course#articles`.
6. **PayPal locale pinned to `en-US`** in `PayPalService::createOrder()`'s `application_context` — fixes checkout rendering in the buyer's browser/IP-detected language (reported as "showing in German"). This is a shared service, so the fix also applies to the existing membership checkout, not just CRISC.

## Problems solved

- **`SiteSettings::current()`'s `firstOrCreate` defaults never applied** to `crisc_date`/`crisc_time_start`/`crisc_time_end` because the `site_settings` row already existed before the migration ran (defaults only apply on row creation). Had to backfill manually via `php artisan tinker` after migrating. **Anyone running these migrations on another environment (staging/prod) needs to check `/admin/settings` afterward and fill in the CRISC date/time/capacity if blank** — this will NOT be silently fixed by the migration alone.
- **New required `crisc_*` fields in `UpdateSiteSettingsRequest` broke existing `SiteSettingsTest.php` tests** that didn't submit them — fixed by updating those tests to include the new fields (not by loosening validation).
- Confirmed via `git stash` A/B comparison that `PmpOutlineTest` (3 tests), `BusinessEmailTest` (1 test), `GisbaPageTest` (1 test), and one `PayPalCheckoutTest` test are **pre-existing failures on `main`**, unrelated to this session's work — do not try to fix these as part of CRISC work, they were already broken.
- PayPal sandbox checkout was actually tested live end-to-end during this session (real order `9LY59104X6736591M` exists in the dev DB's `course_enrollments` table) — the full flow (checkout → PayPal → capture → enrollment record → confirmation email) is confirmed working, not just unit-tested.

## Current state

- Feature is complete, Pint-clean, all 16 CRISC tests + the extended `SiteSettingsTest` pass. Fully committed and pushed to `origin/main` (confirmed `git rev-list --left-right --count origin/main...main` → `0 0`).
- `ui-registry.md` exists locally but is **untracked/uncommitted** — created this session via `/imprint`, documents the Knowledge Base card pattern (now shared verbatim between `/nis2` and `/crisc-course`) and the page-layout padding-stacking gotcha.
- Live dev DB (`gisba_app.test`) currently has: 1 real CRISC article ("CRISC 1" in category "CRISC C1", created by the user via `/admin/crisc` at some point), 1 real `course_enrollments` row from the live PayPal test, and `site_settings.crisc_*` backfilled to $9.99 / Sep 21 2026 / 7:00 AM–1:00 PM / GMT+3 / capacity 12.
- `/imprint audit` has **not** been run — `ui-registry.md` only has 2 entries (Knowledge Base card, page-layout spacing), captured from this session's work only. Older UI (NIS2 pricing cards, admin CRUD tables, member pages, etc.) has not been inspected for consistency yet.

## Next session starts with

Nothing queued/blocking for the CRISC feature itself — it's complete and live. If picking this up again:
- Decide whether to commit `ui-registry.md` (currently untracked).
- Consider running `/imprint audit` to establish a full baseline across the older, untracked UI, since only 2 patterns are documented so far.
- No other CRISC follow-up work is pending.

## Open questions

- None outstanding for this feature. (Carried-over item from an even older session about resending welcome emails during a past SMTP outage was not touched this session and remains wherever it was left — not re-verified here.)
