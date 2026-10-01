# Website Revamp — Build Brief & Agent Instructions

> Paste this file into your project root (e.g. `docs/WEBSITE-REVAMP-BRIEF.md`) and point your IDE agent at it:
> **"Read `docs/WEBSITE-REVAMP-BRIEF.md` and follow it exactly. Start with Phase 1."**

---

## 0. Before you start (human, not the agent)

### 0.1 Rotate your API key
The 21st.dev Magic key was pasted into a chat window. Treat it as compromised:
1. Go to https://21st.dev/magic/console
2. Revoke the old key, generate a new one.
3. Store it in `.env.local` / your MCP config only. Never commit it. Add `.env*` to `.gitignore`.

### 0.2 Provide the old site
The brief references "the old website in a folder" — it was **not** attached. Put it at:
```
/legacy/                 # old site: HTML, CSS, assets, copy
/legacy/screenshots/     # full-page captures of every page, desktop + mobile
```
Without this, the agent will invent content instead of migrating yours.

### 0.3 Correct the tool setup
The install steps you pasted are for **21st.dev Magic MCP** — a different project from the **ui-ux-pro-max skill**. You need both, installed differently. See §1.

---

## 1. Environment setup

### 1.1 Prerequisites
- Node.js LTS
- **Python 3.x** — required by ui-ux-pro-max's search engine (`python3 --version`)
- IDE: Cursor, Windsurf, VS Code (Cline), or Claude Code

### 1.2 Install ui-ux-pro-max skill (design intelligence)

**Claude Code:**
```
/plugin marketplace add nextlevelbuilder/ui-ux-pro-max-skill
/plugin install ui-ux-pro-max@ui-ux-pro-max-skill
```

**Everyone else (CLI):**
```bash
npm install -g ui-ux-pro-max-cli
cd /path/to/project

uipro init --ai cursor      # or: windsurf | claude | copilot | codex | universal
```

Verify:
```bash
python3 .claude/skills/ui-ux-pro-max/scripts/search.py "glassmorphism" --domain style
```
(swap `.claude/` for `.cursor/` or `.windsurf/` depending on your install)

### 1.3 Install 21st.dev Magic MCP (component generation)
```bash
npx @21st-dev/cli@latest install cursor --api-key <YOUR_NEW_KEY>
```
Supported clients: `cursor`, `windsurf`, `cline`, `claude`

Manual config (`~/.cursor/mcp.json`, `~/.codeium/windsurf/mcp_config.json`, `~/.cline/mcp_config.json`, `~/.claude/mcp_config.json`):
```json
{
  "mcpServers": {
    "@21st-dev/magic": {
      "command": "npx",
      "args": ["-y", "@21st-dev/magic@latest", "API_KEY=\"YOUR_NEW_KEY\""]
    }
  }
}
```

VS Code — `.vscode/mcp.json` (keeps the key out of the file):
```json
{
  "inputs": [
    { "type": "promptString", "id": "apiKey", "description": "21st.dev Magic API Key", "password": true }
  ],
  "servers": {
    "@21st-dev/magic": {
      "command": "npx",
      "args": ["-y", "@21st-dev/magic@latest"],
      "env": { "API_KEY": "${input:apiKey}" }
    }
  }
}
```

### 1.4 Project stack
```bash
npm i motion lenis
```
- **Next.js (App Router) + TypeScript + Tailwind**
- **`motion`** — the current package name for Framer Motion (v11+). Import from `motion/react`, not `framer-motion`. Don't install both.
- **Lenis** for smooth scroll (only if §4 says so — see the caveat there)

---

## 2. Phase plan (agent follows in order, stops for review after each)

| Phase | Output | Gate |
|---|---|---|
| 1 | Audit `/legacy/` — inventory pages, copy, assets, what's worth keeping | Human review |
| 2 | Design system via ui-ux-pro-max, persisted to `design-system/MASTER.md` | Human approves palette + type |
| 3 | Hero section only — fully built, deployed to a preview URL | Human approves the hero |
| 4 | Remaining sections | Human review |
| 5 | Performance, a11y, cross-browser pass | Ships |

**Do not skip to Phase 3.** The hero is the whole bet; it gets built against an approved design system, not vibes.

### Phase 2 command
```bash
python3 .claude/skills/ui-ux-pro-max/scripts/search.py "<your industry, e.g. luxury real estate Dubai>" \
  --design-system --persist -p "<Brand Name>"

python3 .claude/skills/ui-ux-pro-max/scripts/search.py "<same>" \
  --design-system --persist -p "<Brand Name>" --page "home"
```
This writes `design-system/MASTER.md` + `design-system/pages/home.md`. Every subsequent phase reads MASTER first, then the page override.

---

## 3. THE HARD RULES — non-negotiable

The agent must re-read this section before writing any component.

### 3.1 NO BOXY DESIGN
Banned outright:
- ❌ Uniform 3-across card grids with equal-height rectangles
- ❌ `rounded-2xl border shadow-lg` on every container (the shadcn default look)
- ❌ Bento grids — this is now the most templated layout on the web
- ❌ Sections that are all the same full-width, same vertical padding, stacked like bricks
- ❌ Visible borders as the primary way of separating content
- ❌ Centered heading + centered subheading + centered button, repeated down the page

Required instead:
- ✅ **Asymmetry.** Content sits at 30/70 or 62/38 splits, not 50/50. Offset baselines.
- ✅ **Overlap.** Elements break out of their section — an image bleeds over the fold line, type overlaps media, a card crosses a background boundary.
- ✅ **Edge-to-edge bleeds.** Media touches the viewport edge; it isn't inset in a padded container.
- ✅ **Separation by contrast, mask, or motion** — not by a 1px border.
- ✅ **Organic/architectural shapes** — SVG clip-paths, diagonal cuts, arcs. Dubai's skyline is a shape language: use it (tapering verticals, angled crowns, the Museum of the Future torus).
- ✅ **Varied section rhythm.** Tall / short / tall. Some sections breathe, some are dense.

### 3.2 NO AI-DEFAULT AESTHETICS
Banned: purple→pink gradients, cream `#F4F1EA` + terracotta `#D97757`, black + acid-green, generic glow-blobs behind text, emoji used as icons.
Use **Lucide** or **Phosphor** SVG icons only.

### 3.3 Typography carries the brand
- One characterful **display** face, used large and with restraint.
- One clean **body** face.
- Optional **mono/utility** face for labels and data.
- Display type should be genuinely large — clamp from ~3rem to ~9rem. Tight tracking on display (`-0.03em`), never on body.
- Take the ui-ux-pro-max font-pairing recommendation, then check it isn't Inter + Playfair. If it is, ask for another.

### 3.4 Quality floor (never announce it, just do it)
- Responsive at 375 / 768 / 1024 / 1440
- Text contrast ≥ 4.5:1 over video (use a scrim — see §4.4)
- Visible keyboard focus states everywhere
- `cursor-pointer` on all clickables
- `prefers-reduced-motion` fully respected (§5.4)
- No layout shift on load (CLS < 0.1)

---

## 4. The hero — Dubai skyline video

### 4.1 Concept direction
The hero is a thesis statement, not a banner. The video is not wallpaper behind a centered H1.

Pick **one** signature moment and execute it precisely:

**Option A — Masked reveal.** The skyline video plays *inside* the display type. Headline set in a heavy display face, `background-clip: text`, video behind it. On scroll, the mask scales up and the video fills the viewport.

**Option B — Split-column parallax.** Video occupies an off-center column (e.g. right 62%) with a hard diagonal or arc edge. Type sits in the narrow left column, anchored to the bottom baseline. The two columns scroll at different rates.

**Option C — Scrubbed skyline.** The video timeline is bound to scroll position — the camera pushes through the skyline as the user scrolls the first viewport. Type elements fade in and out at fixed scroll offsets.

Option C is the most impressive and the most expensive; only choose it if the video is short (≤ 6s) and you've done the seeking work in §4.3.

**Agent: propose all three with ASCII wireframes and a one-line rationale each. Wait for the human to pick. Do not build all three.**

### 4.2 Video sourcing & encoding
Source: Pexels / Artgrid / Filmsupply — **licensed footage only**, no scraped drone clips. Prefer a slow push or a static long-lens shot at blue hour; avoid fast cuts.

Encode three variants:
```bash
# Desktop — H.264 MP4, widest compatibility
ffmpeg -i source.mov -vf "scale=1920:-2" -c:v libx264 -crf 24 -preset slow \
  -pix_fmt yuv420p -movflags +faststart -an hero-1920.mp4

# Desktop — WebM/VP9, ~30% smaller where supported
ffmpeg -i source.mov -vf "scale=1920:-2" -c:v libvpx-vp9 -crf 33 -b:v 0 -an hero-1920.webm

# Mobile — smaller, cheaper
ffmpeg -i source.mov -vf "scale=828:-2" -c:v libx264 -crf 26 -preset slow \
  -pix_fmt yuv420p -movflags +faststart -an hero-828.mp4

# Poster frame
ffmpeg -i source.mov -ss 00:00:01 -vframes 1 -q:v 2 hero-poster.jpg
```
Targets: **desktop < 3 MB, mobile < 1.2 MB, loop 6–10s**. `-an` strips audio — the hero video is silent, always.
`-movflags +faststart` is mandatory or the video won't start until fully buffered.

### 4.3 Implementation rules
```tsx
<video
  autoPlay
  muted
  loop
  playsInline            // iOS refuses to inline-play without this
  preload="metadata"
  poster="/hero-poster.jpg"
  className="absolute inset-0 h-full w-full object-cover"
  aria-hidden="true"     // decorative — keep it out of the a11y tree
>
  <source src="/hero-1920.webm" type="video/webm" media="(min-width: 768px)" />
  <source src="/hero-1920.mp4"  type="video/mp4"  media="(min-width: 768px)" />
  <source src="/hero-828.mp4"   type="video/mp4" />
</video>
```
- Poster image must be visible **instantly** — it's the LCP element. Preload it: `<link rel="preload" as="image" href="/hero-poster.jpg" />`
- Fade the video in over the poster on `onCanPlay` so there's no pop.
- Pause the video when the hero scrolls out of view (IntersectionObserver) — saves battery and main-thread time.
- On `prefers-reduced-motion: reduce`, don't load the video at all. Render the poster still.
- If `navigator.connection.saveData` is true, poster only.
- **Never** use a video as a CSS `background` — no control, no fallback.

### 4.4 Text legibility over video
A flat `bg-black/50` overlay is the boxy answer and it kills the footage. Use instead:
- A directional gradient scrim anchored to where the type sits: `bg-gradient-to-t from-black/80 via-black/20 to-transparent`
- Or a subtle backdrop blur limited to the type's bounding area
- Or grade the video darker at encode time in the region behind the type, so no overlay is needed at all

Verify 4.5:1 against the **brightest frame** of the loop, not the poster.

---

## 5. Motion system (`motion` / Framer Motion)

### 5.1 Import surface
```ts
import { motion, useScroll, useTransform, useSpring, useInView, AnimatePresence } from "motion/react";
```

### 5.2 Easing & duration tokens
Define once in `lib/motion.ts` and import everywhere. No inline magic numbers.
```ts
export const ease = {
  out:  [0.16, 1, 0.3, 1],      // expo-out — the workhorse for reveals
  inOut:[0.83, 0, 0.17, 1],     // for transitions between states
  soft: [0.33, 1, 0.68, 1],
} as const;

export const dur = { fast: 0.3, base: 0.6, slow: 0.9, hero: 1.4 } as const;

export const spring = { type: "spring", stiffness: 120, damping: 20, mass: 0.6 } as const;
```
Never use `ease: "linear"` for anything a human looks at. Never use the default `easeInOut` — it's the tell.

### 5.3 The four motion patterns to use

**1. Orchestrated hero entrance** — the page-load sequence. Stagger, don't dump.
```tsx
const container = { animate: { transition: { staggerChildren: 0.08, delayChildren: 0.2 } } };
const line = {
  initial: { y: "110%" },
  animate: { y: 0, transition: { duration: dur.hero, ease: ease.out } },
};
// Wrap each headline line in an overflow-hidden span so the mask reads as a curtain.
```

**2. Scroll-linked (not scroll-triggered) hero transform**
```tsx
const { scrollYProgress } = useScroll({ target: heroRef, offset: ["start start", "end start"] });
const scale   = useTransform(scrollYProgress, [0, 1], [1, 1.15]);
const y       = useTransform(scrollYProgress, [0, 1], [0, 120]);
const opacity = useTransform(scrollYProgress, [0, 0.7], [1, 0]);
// Smooth it: const smoothY = useSpring(y, { stiffness: 100, damping: 30 });
```

**3. Section reveals** — `useInView` with `once: true, margin: "-15%"`. Vary the reveal per section: one masks up, one scales in from 0.94, one wipes via `clipPath`. **Never the same fade-up on every section** — that's the AI-generated tell.

**4. Micro-interactions** — magnetic cursor on the primary CTA, link underlines that wipe on hover, an image that scales 1.04 inside a fixed mask on hover. Keep them under 300ms.

### 5.4 Reduced motion — required
```tsx
const reduce = useReducedMotion();
// Then: transition={reduce ? { duration: 0 } : { duration: dur.base, ease: ease.out }}
// And skip the video entirely (§4.3).
```

### 5.5 Performance rules
- Animate **only** `transform` and `opacity`. Animating `width`, `height`, `top`, `left`, or `filter` on scroll is banned.
- `will-change: transform` on scroll-driven elements only, removed when idle.
- Lenis smooth scroll is **optional and risky** — it breaks scroll anchoring, native find-in-page, and some assistive tech. If used: `lerp: 0.1`, and disable it when `prefers-reduced-motion` is set.
- Every scroll handler passive. No `useState` updates inside scroll callbacks — use MotionValues.
- Target 60fps on a mid-range Android. Profile it, don't assume it.

---

## 6. Component sourcing (21st.dev Magic MCP)

Use Magic MCP for the scaffolding of: nav, marquee, testimonial rail, footer, form inputs.
**Do not** use it for the hero — that's bespoke.

After every Magic MCP generation, the agent must:
1. Strip the default `rounded-lg border shadow` treatment (§3.1).
2. Replace generated colors/fonts with tokens from `design-system/MASTER.md`.
3. Re-check it against §3.1 before committing.

Generated components arrive boxy by default. They must be re-skinned, not pasted.

---

## 7. Acceptance criteria

The revamp ships only when all of these pass:

- [ ] Lighthouse: Performance ≥ 90 mobile, Accessibility 100, Best Practices ≥ 95
- [ ] LCP < 2.5s on Fast 3G throttling (poster image is LCP, not the video)
- [ ] CLS < 0.1 — hero reserves its space before the video loads
- [ ] Total hero payload < 3 MB desktop / < 1.2 MB mobile
- [ ] 60fps scroll on a mid-range Android, verified in DevTools Performance
- [ ] Video inline-plays on iOS Safari (test on a real device, not the simulator)
- [ ] `prefers-reduced-motion` produces a static, fully usable page with no video
- [ ] Full keyboard traversal with visible focus at every stop
- [ ] No `<video>` in the a11y tree; all decorative SVG `aria-hidden`
- [ ] Zero uniform 3-card grids, zero bento layouts, zero universal `rounded-2xl border`
- [ ] Every color and font traces back to `design-system/MASTER.md`
- [ ] All copy migrated from `/legacy/` — no placeholder lorem, no invented claims

---

## 8. Kickoff prompt

```
Read docs/WEBSITE-REVAMP-BRIEF.md in full.

Phase 1: audit /legacy/ and give me an inventory — pages, sections, copy blocks,
assets, and what's worth keeping vs killing. Table format.

Then stop. Do not start Phase 2 until I approve.

Constraints that override everything: §3 HARD RULES. If any output of yours
contains a uniform card grid, a bento layout, or a universally rounded bordered
container, you have failed the brief — redo it.
```
