---
name: style-consistency-audit
description: Audit a website or web app codebase for visual inconsistency — the same button, card, input, or heading styled four different ways across different files — then unify it. Maps the project's styling systems (Tailwind, plain CSS/SCSS, CSS-in-JS, inline styles), inventories every color, spacing, radius, shadow and font value in use, groups repeated components by role, picks a canonical style for each, writes an audit report, and refactors the codebase to match once approved. Use this skill whenever the user mentions inconsistent styling, messy CSS, design consistency, a design system or design tokens, duplicate or conflicting styles, "make the site look consistent", "clean up the CSS", "standardize the components", or wants a UI/CSS audit — even if they don't use the word "audit".
---

# Style Consistency Audit

Codebases drift. A button gets copy-pasted, someone tweaks the padding, a new page uses `#3B82F6` instead of `#3b82f5`, and six months later the site has nine button styles and no one knows which one is correct. This skill finds that drift and removes it.

The work splits into two halves separated by a hard stop:

**Audit** (read-only) → **report** → **wait for the user's approval** → **refactor**

Never merge these. The audit is worthless if the user can't inspect the proposed changes before files move, and unifying styles is a destructive operation on someone's design. Even when the user seems eager, produce the report first. The one exception is a user who explicitly says "just fix it, don't ask" — then still write the report, show it, and proceed without pausing.

## Phase 1 — Map the project

Do not start reading component files. Build a map first, because the map determines which of the later steps even apply.

Establish:

1. **Framework and file types** — check `package.json`, then the file extensions actually present (`.jsx/.tsx`, `.vue`, `.svelte`, `.astro`, `.html`, `.php`, `.erb`).
2. **Which styling systems are in play.** Most real codebases have more than one, and the interesting bugs live where they overlap. Look for:
   - `tailwind.config.*` or `@import "tailwindcss"` / `@tailwind` directives → Tailwind
   - `.css`, `.scss`, `.sass`, `.less`, `.module.css` files
   - `styled-components`, `@emotion`, `stitches`, `vanilla-extract` in dependencies
   - `style={{...}}` or `style="..."` attributes in markup
   - A UI kit (shadcn/ui, MUI, Chakra, Bootstrap, Ant) — these bring their own canonical styles and change the recommendation completely
3. **Where the truth is supposed to live** — a `tokens` file, `theme.ts`, CSS custom properties in `:root`, a `tailwind.config` `theme.extend` block, or a `components/ui/` directory. If a design system already exists, the job is usually "make the codebase obey the system that's already here", which is a much better outcome than inventing a new one.
4. **What to ignore** — `node_modules`, `dist`, `build`, `.next`, `vendor`, minified files, and any third-party CSS the team doesn't own. Editing vendor CSS is almost always wrong.

Read `references/stack-detection.md` for the specific signals and what each one implies for the refactor.

Summarize the map for the user in a few lines before continuing. If the project turns out to be huge (say, 500+ component files), say so and propose scoping the audit to a directory or a component category rather than boiling the ocean.

## Phase 2 — Inventory the raw values

Run the bundled scanner to get frequency tables of every literal style value in the codebase:

```bash
python scripts/scan_styles.py <project-root> --output /tmp/style-inventory.json
```

It reports colors, spacing values, font sizes, font families, border radii, shadows, z-indexes, and Tailwind class strings, each with occurrence counts and `file:line` locations. It prints a human-readable summary and writes full JSON.

This is deliberately mechanical. It is much faster and more accurate than reading files and eyeballing, and the counts are what Phase 4 uses to pick winners. Read the JSON for detail, but do not paste the whole thing into the conversation.

The signal to look for in the output:

- **Near-duplicate colors** — `#3b82f6`, `#3B82F6`, `rgb(59,130,246)`, and `#3b83f7` are one color wearing four hats. Cluster colors that are within a small perceptual distance of each other; the scanner flags these.
- **Off-scale spacing** — a codebase using 4/8/12/16/24 with three stray `13px` and `17px` values.
- **Arbitrary Tailwind values** — `p-[13px]`, `text-[#3b82f6]`, `w-[437px]`. These bypass the design system by definition and are always worth flagging.
- **Values that duplicate a token** — a raw `#3b82f6` sitting next to a `--color-primary` that resolves to the same thing.

## Phase 3 — Group repeated components by role

Now read code. Find every place the codebase renders the same *kind of thing* — the role, not the implementation. Typical roles: buttons, links, inputs, selects, textareas, cards, modals, badges/pills, tables, headings, nav items, form labels, error messages, avatars, tooltips, section wrappers.

Find them by looking for the markup signature, not the name: an `<button>`, an `<a>` styled to look like a button, a `<div onClick>` acting as one, and a `<Button>` component are all the button role. The ad-hoc ones are usually where the inconsistency lives — a proper `<Button>` component is rarely the problem.

For each role, build a variant table: the distinct style signatures, how many times each appears, and where. `references/component-roles.md` has the detection patterns and the property set that matters for each role.

### Distinguishing drift from intent

This is the single most important judgment in the skill, and getting it wrong makes things worse rather than better. Not every difference is a defect. Before calling two variants inconsistent, rule out:

- **Semantic variants** — primary vs secondary vs destructive vs ghost. Different by design.
- **States** — hover, focus, active, disabled, loading, error.
- **Responsive and container variation** — a card in a sidebar legitimately differs from the same card in a hero.
- **Theming** — light/dark, or a marketing site with a different palette from the app.
- **Deliberate one-offs** — a landing page hero, a pricing table, a 404 page.

The tell for real drift is *unexplained* difference: two instances doing the same job in the same context with different padding, or a color that is 2% off another color, or a shadow that's `0 1px 3px` here and `0 1px 2px` there. When a difference could plausibly be intentional, classify it as "needs a human call" rather than silently normalizing it. Flattening a real design decision is a worse failure than leaving one inconsistency in place, because the user can always ask for a second pass but can't easily recover a design intent you erased.

## Phase 4 — Choose the canonical variant

For each role, the winner is **the most frequently used variant**. Frequency is a good default because it minimizes the diff and it usually reflects whatever the team drifted toward most recently and most often.

Apply the tie-breaks in order when frequency doesn't settle it:

1. If a design token, theme config, or UI-kit component already defines the value, that wins regardless of frequency — the codebase is supposed to obey it.
2. If a shared component exists (`components/ui/Button.tsx`), its style wins over ad-hoc copies.
3. Prefer the variant using token/scale values over the one using arbitrary literals.
4. Prefer the variant in the most recently modified files (`git log -1 --format=%ci -- <file>`), as it's the likeliest current intent.
5. Prefer the accessible option — if two variants differ only in contrast, take the one that passes WCAG AA.

Record *why* each winner won. The report needs it, and a user who disagrees with one pick needs to see the reasoning to override it.

Where frequency is close (say, 8 instances vs 7), don't silently pick. Surface it as a genuine choice in the report and let the user decide.

## Phase 5 — Write the audit report

Write it to a file (`STYLE-AUDIT.md` at the project root, unless the user says otherwise) and summarize the highlights in chat. Use this structure:

```markdown
# Style Consistency Audit

## Summary
[3–5 sentences: what the project uses, how bad the drift is, the top 3 problems, rough effort]

## Styling systems in use
[Table: system, where it's used, file count — plus a note on any overlap that causes conflicts]

## Findings
[One section per finding, ordered by impact]

### F1. [Title] — severity: high | medium | low
- **What's happening:** [description]
- **Instances:** [count] across [n] files
- **Variants found:** [table: style signature, count, example locations]
- **Proposed canonical:** [the value/spec] — chosen because [reason]
- **Left alone:** [any variants classed as intentional, and why]

## Needs your call
[Every close-frequency tie or ambiguous intent/drift case, as a numbered list of concrete questions]

## Proposed token set
[The consolidated values, ready to drop into tailwind.config / :root / theme.ts]

## Refactor plan
[Ordered phases, each with a one-line risk note]

## Out of scope
[Vendor CSS, dead code, and anything else deliberately not touched]
```

Then stop and ask for approval. Explicitly point at the "Needs your call" section — those answers change the refactor.

## Phase 6 — Refactor

Only after approval.

**Set up safety first.** Confirm the working tree is clean (`git status`), then create a branch. If the project isn't under version control, say so plainly and get explicit confirmation before editing anything — an un-undoable mass edit of someone's styles is not a risk to take quietly.

Work in this order, committing after each phase so any single step can be reverted independently:

1. **Define tokens** — add the canonical values to the config/`:root`/theme file. Nothing visual changes yet.
2. **Replace raw values with tokens** — mechanical, low risk, big diff. Colors first, then spacing, then radii/shadows/typography.
3. **Unify each component role**, highest-impact first. This is the risky part; do one role per commit.
4. **Extract shared components** where the same markup is duplicated many times — but only if the user asked for it or the report proposed it. Consolidating styles is a smaller ask than restructuring the component tree, and it's easy to overstep here.
5. **Remove what's now dead** — superseded CSS rules and unused classes. Verify each is genuinely unreferenced before deleting; a dynamically-constructed class name (`` `btn-${variant}` ``) will not show up in a naive grep.

While editing, keep these in mind:

- **The cascade bites.** Removing a class can expose a lower-specificity rule that was being overridden. In plain CSS, check what else targets an element before deleting its rules.
- **Tailwind class order matters** for conflicting utilities, and `!important` / `!` prefixes in the codebase signal a specificity fight that unifying may resolve — or may break.
- **Don't touch behavior.** Class names sometimes double as JS hooks or test selectors. Grep for a class in `.test.`/`.spec.`/`.cy.` files and in `querySelector` calls before renaming it.
- **Dynamic class names** must be checked by hand; string interpolation defeats find-and-replace.

**Verify** after each phase: the build or typecheck passes, tests pass, and nothing that was styled is now unstyled. If a dev server and a browser tool are available, spot-check the highest-traffic pages before and after — a screenshot comparison catches what grep cannot. Report honestly if you couldn't verify visually.

Finish with a summary: files changed, instances normalized, tokens introduced, anything deliberately skipped, and what the user should eyeball manually.

## Bundled resources

- `scripts/scan_styles.py` — the value inventory scanner (Phase 2)
- `references/stack-detection.md` — signals for identifying styling systems and what each implies
- `references/component-roles.md` — detection patterns and the properties that matter per role
