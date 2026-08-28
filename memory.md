# Memory — Home Page: Available Courses & Training Schedule

Last updated: 2026-08-28

## What was built

Added two new sections to the home page (`resources/views/pages/home.blade.php`) and their styles (`public/assets/css/style.css`), and reworked the home page layout. Committed on `main` as `1105263` ("feat(home): add Available Courses and Training Schedule sections") — not yet pushed to `origin`.

**Layout change:** Removed the home page's left sidebar (`Quick Links` nav + Contact GISBA box) entirely. Main content column changed from `col-12 col-md-9` to `col-12` — the whole home page content area is now full width. Also fixed `.requirement-grid` (used by "Our Expertise" and reused on several other pages: CRISC/CISSP/PRINCE2 course pages, training-course-development, nis2-implementation-toolkit, awareness) from `grid-template-columns: repeat(auto-fill, minmax(200px,1fr))` to `repeat(auto-fit, ...)` — `auto-fill` was reserving invisible empty columns and leaving a gap on the right once the container got wider (after the sidebar was removed); `auto-fit` collapses those and stretches the real items to fill the row. This is a global CSS change, not home-page-scoped.

**"Available Courses" section** (`#courses`, placed right after the top hero, before "Our Expertise"): a 4-column grid (`col-6 col-md-3`) of `.course-card` cards — one per course (CRISC, CISSP, PMP, PRINCE2), in that order (matches header/footer nav order). Each card: full-width **uncropped** banner image on top (no `object-fit`/forced height — went through two redesign iterations; first version cropped the image which the user rejected as "not looking professional" / "image is cropping", so the final version just lets the image render at natural aspect ratio), a gold divider, then an eyebrow label, serif course title, a one-line description pulled from each course's own real hero copy, two feature tags (Expert-Led / Live Sessions), and a "View Course Details" CTA linking to the course's real route (`crisc-course`, `cissp`, `pmp`, `prince2`). Grid width went 4-col → 2-col (editorial split-card layout) → back to 4-col (image-top layout) across the session per user feedback — final state is 4-col, image-top.

**"Training Schedule 2026" section** (`#schedule`, placed after "Available Courses", before "Our Expertise"): content extracted directly from `content/Training Schedule 2026 (1).docx` (a table + bullet lists — read via a one-off Python `zipfile`/`ElementTree` script since the docx tool can't read binary files directly). Renders as a `.schedule-table` (Course / Recent Cohort / Upcoming Cohort) with gold "Enrolling" pills for the open cohort (linking to the course page) and grey struck-through "Closed" pills for the past cohort, using the exact dates from the doc. A "Salient Features" 2×2 card grid (one per course, bullet list of course-specific selling points also from the doc) was added, then **removed entirely** per explicit user request ("Remove all Salient Features cards") — both the Blade markup and the now-dead `.schedule-feature-*` CSS were deleted. Final section is just the schedule table.

## Decisions made

- Course promo images are shown **uncropped** (top, natural aspect ratio) rather than cropped/cover-fit — user explicitly rejected two different cropped treatments (a short `object-fit:cover` strip, then a left-split card crop) before landing on "just show the full image."
- Sidebar/"Quick Links" removed from the home page entirely (not just hidden) per explicit request — full-width layout is now the home page's standing design, not a one-off for this section.
- Training Schedule content is static/hardcoded from the docx, not wired to `SiteSettings` DB fields — the docx has data (a "Closed" cohort + salient features) that doesn't exist in the `site_settings` schema at all, and this was treated as a one-time marketing-content add, consistent with how the course cards above it are also hardcoded rather than DB-driven.
- Salient Features cards were cut entirely rather than trimmed/restyled — user wanted them gone, not adjusted.

## Problems solved

- A PowerShell `-replace` / `Set-Content -Encoding utf8` one-liner used to bulk-swap grid column classes **corrupted the file's encoding** (em dashes became `â€"` mojibake, a stray BOM was added). Caught it via `git diff`, reverted the file with `git checkout --`, and rebuilt the lost edits (which included that session's earlier "Available Courses" section work) using the Edit tool instead of shell text substitution. **Lesson: never use PowerShell/shell find-replace on this Blade file (or likely any UTF-8 file with em dashes/smart quotes) — always use the Edit tool.**
- Reading `.docx` content: the `Read` tool errors on binary files. Worked around it by treating the `.docx` as a zip and parsing `word/document.xml` directly with Python (`zipfile` + `xml.etree.ElementTree`), which also correctly separated the schedule `<w:tbl>` table rows from the "Salient Features" paragraphs.
- CSS Grid `auto-fill` vs `auto-fit` gap bug (see Layout change above) — general fix applicable anywhere `.requirement-grid` is used with a container wider than the items need.

## Current state

Home page (`/`) now has, top to bottom: hero, Available Courses (4-col, uncropped images), Training Schedule 2026 (table only, no feature cards), Our Expertise (now full-width, no gap), Our Flagship Services, and the rest of the pre-existing sections — all full width, no sidebar. Committed as `1105263` on `main`, working tree clean for this feature (only this `memory.md` file itself is left modified, intentionally excluded from that commit as unrelated). Not pushed to `origin`. `vendor/bin/pint --dirty` passes. Not manually re-tested in-browser after the very last "remove Salient Features" edit's CSS cleanup pass beyond confirming pint — worth a quick visual check next session if picking this back up.

## Next session starts with

Nothing queued. If continuing: confirm whether `1105263` should be pushed to `origin/main`, and do a final visual pass on `/` (desktop + mobile) now that Salient Features are gone, to make sure the Training Schedule section's spacing/divider still looks right without them.

## Open questions

- Push policy unconfirmed again this session (same open question as last time) — does the user push manually, or should Claude push after committing?
- No test coverage was added for any of this session's home-page changes (static content/CSS only, consistent with skip-tests-on-static-content pattern established last session) — confirm that's still fine if this work expands to anything dynamic later.
