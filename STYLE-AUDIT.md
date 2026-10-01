# Style Consistency Audit — Unitey Website

_Generated: 2026-08-31_

---

## Summary

The Unitey site is a pure HTML/CSS/JS codebase with 6 live pages (index.html + 5 inner pages) using inline `<style>` blocks and CSS custom properties as design tokens. The token system is solid — the `:root` palette is well-defined and used correctly in most places — but drift has accumulated across six independently-written pages. The main problems are: a split in the `.eyebrow` class values between pages written at different times, a handful of hardcoded hex values that duplicate tokens, and minor nav/footer inconsistencies. Effort is low: all fixes are find-and-replace within `<style>` blocks.

Hero typography was already standardised in the previous session (canonical `.hero-eyebrow`, `.hero-h1`, `.hero-body` applied to all 5 inner pages) and is not a finding here.

---

## Styling systems in use

| System | Where | Files |
|---|---|---|
| CSS custom properties (`:root` tokens) | All pages | 6 |
| Inline `<style>` blocks | All pages | 6 |
| Inline `style=""` attributes | Scattered, mostly decorative | ~4 |
| No framework, no build tool | — | — |

No UI kit, no Tailwind, no CSS-in-JS. Variant files (`operating-companies-variants.html`, `team-variants.html`, `timeline-variants.html`) are excluded from this audit — they are sandbox files, not live pages.

---

## Findings

### F1. `.eyebrow` class split — severity: HIGH

**What's happening:** The `.eyebrow` class (used for section-level eyebrows throughout the body of each page — not the hero) has two different values across the six pages, created as pages were written at different times.

**Instances:** All 6 pages define `.eyebrow` in their own `<style>` block.

**Variants found:**

| Variant | font-size | letter-spacing | margin-bottom | Pages |
|---|---|---|---|---|
| A | `11px` | `.2em` | `18px` | company.html, portfolio.html, investments.html |
| B | `14px` | `.18em` | `16px` | index.html, news.html, contact.html |

**Proposed canonical:** Variant B — `14px / .18em / 16px` — chosen because: (1) it appears in 3 pages including index.html (the homepage, the most prominent page), (2) `14px` is more legible as a section label than `11px` (which is closer to a legal footnote), (3) news.html and contact.html were the most recently rewritten pages.

**Left alone:** `.hero-eyebrow` is intentionally separate from `.eyebrow` — it uses `11px / .25em` which is appropriate for the larger, high-contrast hero context.

---

### F2. Hardcoded `#e8912b` instead of `var(--orange)` — severity: MEDIUM

**What's happening:** `--orange: #e8912b` is defined in `:root`, but several rules use the raw hex instead of the token. This means if the brand orange ever changes, these will be missed.

**Instances:** ~8 occurrences across 2 files.

**Variants found:**

| Location | Count |
|---|---|
| company.html (`.jny-yr-tag`, `.jny-yr-btn.active .nd`, `.jny-yr-btn.active .yr-lbl`, `.jny-bar`) | 4 |
| index.html (journey section, similar rules) | ~4 |

**Proposed canonical:** Replace all `#e8912b` with `var(--orange)`.

---

### F3. Hardcoded `#0e1330` instead of `var(--ink)` — severity: LOW

**What's happening:** `--ink: #0e1330` is defined in `:root`, but dark-section backgrounds use the raw hex in several places.

**Instances:** ~10 occurrences across company.html, portfolio.html, investments.html, news.html, contact.html.

**Variants found:** All are `background: #0e1330` or `background-color: #0e1330` on dark sections (newsletter, CTA, connect, form sections).

**Proposed canonical:** Replace with `var(--ink)`.

---

### F4. Nav header minor inconsistency — severity: MEDIUM

**What's happening:** The sticky nav header (`header`) has slightly different values across pages — created when news.html and contact.html were written fresh rather than copied from the other pages.

**Instances:** All 6 pages.

**Variants found:**

| Variant | padding | backdrop-filter blur | background opacity | Pages |
|---|---|---|---|---|
| A | `20px 0` | `blur(16px)` | `rgba(20,31,71,.95)` | company, portfolio, investments |
| B | `18px 0` | `blur(14px)` | `rgba(20,31,71,.94)` | news, contact |
| C | `20px 0` | `blur(18px)` | `rgba(14,19,48,.96)` | index.html |

**Proposed canonical:** Variant A — `20px 0 / blur(16px) / .95` — chosen because it appears in 3 inner pages, and `20px` gives a slightly more generous hit target than `18px`.

**Needs your call:** index.html uses a slightly different background colour (`rgba(14,19,48,...)` vs `rgba(20,31,71,...)`). These are close but not identical. Do you want index.html brought in line with the inner pages, or left as-is?

---

### F5. Footer top padding drift — severity: LOW

**What's happening:** Footer padding has a 2px difference between page groups.

**Instances:** All 5 inner pages (index.html footer not checked separately).

**Variants found:**

| Variant | padding | Pages |
|---|---|---|
| A | `72px 0 32px` | company, portfolio, investments |
| B | `70px 0 32px` | news, contact |

**Proposed canonical:** `72px 0 32px` (Variant A, majority of inner pages).

---

### F6. Section h2 scale drift — severity: LOW

**What's happening:** Most section headings use `clamp(28px,3vw,42px)`, but a few pages deviate slightly.

**Instances:** ~6 rules across 3 files.

**Variants found:**

| Value | Pages / sections |
|---|---|
| `clamp(28px,3vw,42px)` | portfolio, investments, index — standard |
| `clamp(26px,2.6vw,38px)` | company about section |
| `clamp(26px,2.8vw,38px)` | company team section |
| `clamp(28px,3.2vw,46px)` | news newsletter, contact specialized |

**Proposed canonical:** `clamp(28px,3vw,42px)` for all standard section h2s. The `clamp(28px,3.2vw,46px)` variants in newsletter/specialized sections are borderline — slightly larger headings in those sections could be intentional for visual impact. Flagged for your call below.

---

## Needs your call

1. **Nav background colour on index.html** (F4): index.html nav uses `rgba(14,19,48,...)` while all inner pages use `rgba(20,31,71,...)`. Align index to match inner pages, or keep separate? (The difference is subtle — barely visible.)

2. **Newsletter/specialized h2 at `clamp(28px,3.2vw,46px)`** (F6): news.html newsletter section and contact.html specialized contacts use a slightly larger h2. Is this intentional for visual hierarchy in those sections, or should it be normalised to `clamp(28px,3vw,42px)`?

---

## Proposed token set

No new tokens are needed. All changes use the existing `:root` variables. The canonical values to apply:

```css
/* Canonical .eyebrow (section-level, all pages) */
.eyebrow {
  font-size: 14px;
  letter-spacing: .18em;
  text-transform: uppercase;
  font-weight: 700;
  color: var(--orange);
  margin-bottom: 16px;
  display: block;
}

/* Canonical nav header */
header {
  padding: 20px 0;
  backdrop-filter: blur(16px);
  background: rgba(20,31,71,.95); /* --navy-deep base */
}

/* Canonical footer */
footer {
  padding: 72px 0 32px;
}

/* Canonical section h2 */
.section-h2 { /* or whatever selector applies */
  font-size: clamp(28px,3vw,42px);
}

/* Token replacements */
/* #e8912b → var(--orange) */
/* #0e1330 → var(--ink) */
```

---

## Refactor plan

All changes are confined to `<style>` blocks — no HTML changes needed. Ordered by impact:

| Phase | Change | Files | Risk |
|---|---|---|---|
| 1 | `.eyebrow` font-size `11px→14px`, letter-spacing `.2em→.18em`, margin `18px→16px` | company.html, portfolio.html, investments.html | Low — visual size change, worth a quick eyeball |
| 2 | Replace `#e8912b` with `var(--orange)` | company.html, index.html | Very low — identical values |
| 3 | Replace `#0e1330` with `var(--ink)` | company, portfolio, investments, news, contact | Very low — identical values |
| 4 | Nav header: `18px→20px`, `blur(14px)→blur(16px)`, `.94→.95` | news.html, contact.html | Low — subtle visual change |
| 5 | Footer padding `70px→72px` | news.html, contact.html | Very low |
| 6 | Section h2 `clamp(26px,2.6-2.8vw,38px)→clamp(28px,3vw,42px)` | company.html | Low — slight size increase |

---

## Out of scope

- `operating-companies-variants.html`, `team-variants.html`, `timeline-variants.html` — sandbox/variant files, not live
- `node_modules`, `dist`, any vendor CSS
- Hero typography — already standardised in the previous session
- Scroll-reveal (`.rv`/`.rise`) animations — consistent across all pages, no drift found
- JS behaviour — not styling
