# UI Registry

Tracks the visual patterns already in use across the app so new components stay consistent. Append-only — update an entry in place if the pattern changes, don't duplicate.

---

### Knowledge Base Card (category card)

File: resources/views/pages/crisc-course.blade.php (also used identically in resources/views/pages/blog.blade.php on /nis2)
Last updated: 2026-08-27

| Property         | Class / Value                                                                                          |
| ---------------- | ------------------------------------------------------------------------------------------------------- |
| Background       | `.kb-card` → `var(--bg-white)`                                                                          |
| Border            | `.kb-card` → `1px solid var(--border-light)`                                                            |
| Border radius     | `.kb-card` → `var(--radius-lg)`                                                                          |
| Header background | `.kb-card-header` → `linear-gradient(135deg, var(--navy) 0%, rgba(0,33,80,0.92) 100%)`                  |
| Text — primary    | `.kb-card-category-name` → `#ffffff` (on navy header); `.kb-article-link` → `var(--navy)` (on white body) |
| Text — secondary  | `.kb-section-label` → `var(--accent)`; `.kb-count-badge` → `var(--text-muted)`                          |
| Spacing           | Header `12px 16px 10px`; body `10px 16px 14px`; section wrapper `padding: 60px 0 80px`                   |
| Hover state       | `.kb-card:hover` → `box-shadow: var(--shadow-hover); transform: translateY(-3px)`. `.kb-article-link:hover` → `color: var(--accent)`, gap widens 7px→10px |
| Shadow            | Default `var(--shadow-card)`; hover `var(--shadow-hover)`                                                |
| Accent usage      | `var(--accent)` for the icon chip, the section's underline bar (`.kb-accent-bar`), and article-link bullet dot |

**Pattern notes:**
This is the "one category = one full-width card, stacked vertically" layout (`col-12` per card, not a multi-column grid) — each card lists every article in that category as a bulleted link list. Cards fade/slide in via a shared `.kb-reveal` + `IntersectionObserver` script (`opacity:0 → 1`, `translateY(18px) → 0`, 0.48s ease). When adding this section to a new page, reuse the exact `.kb-*` class block verbatim rather than rewriting it — it was copy-pasted intentionally between `/nis2` and `/crisc-course` per an explicit instruction ("should be the same as the nis2 knowledge base section") so any visual change should be applied to both.

---

### Page-layout spacing (hero → next full-width section)

File: resources/views/pages/crisc-course.blade.php, resources/views/pages/blog.blade.php
Last updated: 2026-08-27

| Property | Value |
| -------- | ----- |
| `.page-layout` default padding | `28px 0 48px` (global, `public/assets/css/style.css`) |
| Override when a full-width section follows | `style="padding-bottom:0;"` on the `.page-layout` wrapper |

**Pattern notes:**
`.page-layout`'s default 48px bottom padding stacks with a following section's own top padding (e.g. `.kb-section`'s 60px), producing an oversized gap (~108px). Whenever a `.page-layout` block is immediately followed by another full-width section on the same page, zero out its bottom padding inline rather than editing the shared `.page-layout` class (which is used everywhere). This is the fix applied after the CRISC course landing page's Knowledge Base section looked too far detached from the content above it.
