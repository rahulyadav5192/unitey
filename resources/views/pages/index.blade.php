<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>{{ $cms['seo']['title'] }}</title>
  <link rel="icon" href="{{ asset('favicon1.png') }}">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link
    href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;0,800;1,400;1,500&family=Quicksand:wght@700&family=Archivo:wght@700;800&family=Noto+Sans+Arabic:wght@500&display=swap"
    rel="stylesheet">
  <link rel="stylesheet" href="{{ asset('styles.css') }}">
  <style>
    /* INDEX — page-specific CSS (shared styles in styles.css) */

    #bgVid {
      position: fixed;
      inset: 0;
      width: 100%;
      height: 100%;
      object-fit: cover;
      z-index: 0;
      pointer-events: none;
    }

    /* Hero overrides — centered fullscreen + video bg */
    .hero {
      justify-content: center;
      text-align: center;
      width: 100%;
      z-index: 1;
      background: transparent;
    }

    .hero::after {
      content: "";
      position: absolute;
      inset: 0;
      z-index: 1;
      background: linear-gradient(160deg, rgba(6, 9, 30, .84) 0%, rgba(6, 9, 30, .6) 55%, rgba(6, 9, 30, .46) 100%);
      pointer-events: none;
    }

    .hero-inner {
      position: relative;
      z-index: 3;
      width: 100%;
      padding-top: 60px;
      display: flex;
      flex-direction: column;
      align-items: center;
    }

    .hero-eyebrow {
      font-size: 10px;
      letter-spacing: .3em;
      margin-bottom: 32px;
    }

    .hero h1 {
      font-size: clamp(44px, 6vw, 88px);
      line-height: 1.1;
      font-weight: 800;
      letter-spacing: -.045em;
      color: #fff;
      max-width: 1200px;
    }

    .hero-body {
      margin-top: 28px;
      max-width: 500px;
      font-size: 18px;
      line-height: 1.65;
      letter-spacing: -.01em;
      color: rgba(255, 255, 255, .74);
      font-weight: 400;
    }

    .hero-ctas {
      align-items: center;
      margin-top: 44px;
    }

    /* Hero text waits for the shutter, then rises as the panels part */
    .hero .rise {
      animation-play-state: paused
    }

    .is-typeset .hero .rise {
      animation-play-state: running
    }

    .hero h1.rise {
      animation-delay: .55s
    }

    .hero .hero-ctas.rise {
      animation-delay: .69s
    }

    /* STATS */
    .stats {
      position: relative;
      min-height: 100vh;
      width: 100%;
      display: flex;
      align-items: center;
      overflow: hidden;
      color: #fff;
      z-index: 1;
    }

    .stats::after {
      content: "";
      position: absolute;
      inset: 0;
      background: linear-gradient(90deg, rgba(6, 9, 20, .93), rgba(6, 9, 20, .72) 55%, rgba(6, 9, 20, .86));
    }

    .stats-grid {
      position: relative;
      z-index: 2;
      display: grid;
      grid-template-columns: 1fr 1fr;
      gap: 60px;
      align-items: center;
      width: 100%;
    }

    .stats-quote {
      font-size: clamp(17px, 1.8vw, 22px);
      font-weight: 400;
      line-height: 1.85;
      color: rgba(255, 255, 255, .78);
    }

    .stat-cols {
      display: grid;
      grid-template-columns: 1fr 1fr;
      gap: 0;
    }

    .stat {
      padding: 36px 40px
    }

    @@keyframes numShimmer {
      0% {
        background-position: 200% center
      }

      100% {
        background-position: -100% center
      }
    }

    .stat .n {
      font-size: clamp(40px, 5vw, 72px);
      font-weight: 700;
      line-height: 1;
      letter-spacing: -.04em;
      font-variant-numeric: tabular-nums;
      display: block;
      background: linear-gradient(110deg,
          rgba(255, 255, 255, .45) 0%,
          rgba(255, 255, 255, 1) 30%,
          rgba(255, 255, 255, .60) 50%,
          rgba(255, 255, 255, 1) 72%,
          rgba(255, 255, 255, .45) 100%);
      background-size: 250% auto;
      -webkit-background-clip: text;
      background-clip: text;
      color: transparent;
      animation: numShimmer 4s linear infinite;
    }

    .stat .l {
      margin-top: 12px;
      font-size: 15px;
      font-weight: 600;
      color: rgba(255, 255, 255, .6);
      letter-spacing: .08em;
      text-transform: uppercase;
    }

    .stat.wide {
      grid-column: 1/-1
    }

    .stats-mission {
      margin-top: 22px;
    }

    /* STRATEGIC PILLARS V4 */
    .sp-section {
      background: var(--ink);
      position: relative;
      z-index: 1;
      overflow: hidden;
    }

    .sp-section::before {
      content: '';
      position: absolute;
      inset: 0;
      background: radial-gradient(ellipse 50% 70% at 50% 100%, rgba(232, 145, 43, .06) 0%, transparent 60%);
      pointer-events: none;
    }

    .sp-section .wrap {
      position: relative;
      z-index: 1
    }

    .sp-inner {
      padding: 100px 0 110px
    }

    .sp-header {
      text-align: center;
      margin-bottom: 72px
    }

    .sp-header h2 {
      font-size: clamp(26px, 3vw, 40px);
      font-weight: 700;
      letter-spacing: -.035em;
      color: #fff;
      line-height: 1.12;
      max-width: 880px;
      margin: 0 auto;
    }

    .v4-steps {
      position: relative;
      display: grid;
      grid-template-columns: repeat(3, 1fr);
      gap: 0;
    }

    .v4-steps::before {
      content: '';
      position: absolute;
      top: 24px;
      left: 10%;
      right: 10%;
      height: 1px;
      background: linear-gradient(90deg, transparent, rgba(232, 145, 43, .35), transparent);
    }

    .v4-step {
      text-align: center;
      padding: 0 32px
    }

    .v4-step__dot {
      width: 48px;
      height: 48px;
      border-radius: 50%;
      background: rgba(232, 145, 43, .1);
      border: 2px solid rgba(232, 145, 43, .4);
      display: flex;
      align-items: center;
      justify-content: center;
      margin: 0 auto 36px;
      position: relative;
    }

    .v4-step__dot span {
      font-size: 14px;
      font-weight: 800;
      color: var(--orange)
    }

    .v4-step__img {
      width: 100%;
      aspect-ratio: 16/10;
      overflow: hidden;
      border-radius: 12px;
      margin-bottom: 32px;
    }

    .v4-step__img img {
      width: 100%;
      height: 100%;
      object-fit: cover;
      display: block
    }

    .v4-step h3 {
      font-size: clamp(17px, 1.6vw, 20px);
      font-weight: 700;
      letter-spacing: -.02em;
      color: #fff;
      line-height: 1.2;
      margin-bottom: 14px;
    }

    .v4-step p {
      font-size: 13.5px;
      line-height: 1.82;
      color: rgba(255, 255, 255, .5);
      max-width: 300px;
      margin: 0 auto;
    }

    /* OPERATING COMPANIES V12 */
    .oc-section {
      background: var(--bg-warm);
      position: relative;
      z-index: 1;
    }

    .oc-section .wrap {
      position: relative;
      z-index: 1
    }

    .oc-inner {
      padding: 80px 0 100px
    }

    .oc-header {
      margin-bottom: 56px;
      display: flex;
      align-items: flex-end;
      justify-content: space-between;
      gap: 32px;
    }

    .oc-header .btn {
      flex-shrink: 0;
      margin-bottom: 4px
    }

    .oc-header .eyebrow {
      color: var(--orange);
      margin-bottom: 16px
    }

    .oc-headline {
      font-size: clamp(28px, 3vw, 42px);
      font-weight: 800;
      letter-spacing: -.04em;
      line-height: 1.08;
      color: var(--ink);
      margin-bottom: 14px;
    }

    .oc-stmt {
      font-size: 15px;
      line-height: 1.8;
      color: var(--muted);
      max-width: 520px;
    }

    .v12-grid {
      display: grid;
      grid-template-columns: repeat(4, 1fr);
      gap: 16px;
    }

    .v12-card {
      perspective: 1200px;
      height: 400px
    }

    .v12-card-inner {
      position: relative;
      width: 100%;
      height: 100%;
      text-align: center;
      transition: transform .7s cubic-bezier(.4, .2, .2, 1);
      transform-style: preserve-3d;
    }

    .v12-card:hover .v12-card-inner {
      transform: rotateY(180deg)
    }

    .v12-front,
    .v12-back {
      position: absolute;
      width: 100%;
      height: 100%;
      -webkit-backface-visibility: hidden;
      backface-visibility: hidden;
      border-radius: 14px;
      display: flex;
      flex-direction: column;
      align-items: center;
      justify-content: center;
      padding: 36px 28px;
    }

    .v12-front {
      background: var(--paper);
      border: 1px solid var(--line);
      box-shadow: 0 4px 20px rgba(14, 19, 48, .04);
      gap: 0;
    }

    .v12-front .co-logo {
      height: 56px;
      max-height: 56px;
      max-width: 140px;
      width: auto;
      object-fit: contain;
      display: block
    }

    .v12-back {
      background: var(--navy-deep);
      color: #fff;
      transform: rotateY(180deg);
      gap: 14px;
    }

    .v12-name {
      font-size: 17px;
      font-weight: 700;
      letter-spacing: -.02em;
      color: var(--orange-2);
      line-height: 1.2;
    }

    .v12-desc {
      color: rgba(255, 255, 255, .75);
      font-size: 13.5px;
      line-height: 1.78;
    }

    /* Mobile / touch: no flip — logo + paragraph on one card */
    @@media (max-width: 900px),
    (hover: none) {
      .v12-card {
        perspective: none;
        height: auto
      }

      .v12-card-inner,
      .v12-card:hover .v12-card-inner {
        transform: none;
        transform-style: flat;
        height: auto;
        text-align: left;
        background: var(--paper);
        border: 1px solid var(--line);
        border-radius: 14px;
        box-shadow: 0 4px 20px rgba(14, 19, 48, .04);
        padding: 32px 28px;
        display: flex;
        flex-direction: column;
        gap: 20px;
      }

      .v12-front,
      .v12-back {
        position: static;
        height: auto;
        padding: 0;
        border: 0;
        border-radius: 0;
        box-shadow: none;
        background: none;
        transform: none;
        align-items: flex-start;
        -webkit-backface-visibility: visible;
        backface-visibility: visible;
      }

      .v12-front .co-logo {
        height: 48px
      }

      .v12-name {
        display: none
      }

      .v12-desc {
        color: var(--muted);
        font-size: 14px
      }
    }

    /* PARTNERS */
    .partners {
      background: var(--paper);
      overflow: hidden;
      padding: 80px 0;
      position: relative;
      z-index: 1;
    }

    .partners-label {
      text-align: center;
      margin-bottom: 52px;
      color: var(--orange)
    }

    .partners-track {
      overflow: hidden;
      -webkit-mask-image: linear-gradient(90deg, transparent, #000 7%, #000 93%, transparent);
      mask-image: linear-gradient(90deg, transparent, #000 7%, #000 93%, transparent);
    }

    .partners-grid {
      display: flex;
      flex-wrap: nowrap;
      align-items: center;
      justify-content: flex-start;
      width: max-content;
      gap: 0;
      animation: partners-marquee 46s linear infinite;
    }

    .partners-grid:hover {
      animation-play-state: paused
    }

    /* each logo gets its own --h so wide and square marks carry the same visual weight */
    .partner-logo {
      flex-shrink: 0;
      display: flex;
      align-items: center;
      justify-content: center;
      height: 64px;
      margin-right: 64px
    }

    .partner-logo img {
      height: var(--h, 44px);
      width: auto;
      max-width: none;
      object-fit: contain;
      display: block
    }

    .partner-logo-dup {
      display: flex
    }

    @@keyframes partners-marquee {
      from {
        transform: translateX(0)
      }

      to {
        transform: translateX(-50%)
      }
    }

    /* JOURNEY SHELL */
    .journey-shell {
      position: relative;
      background: var(--ink);
      z-index: 1;
      overflow: hidden;
      padding: 100px 0;
    }

    .jny-header {
      padding-bottom: 56px
    }

    .jny-header .eyebrow {
      margin-bottom: 16px;
      color: var(--orange)
    }

    .jny-header h2 {
      font-size: clamp(28px, 3vw, 42px);
      font-weight: 700;
      letter-spacing: -.035em;
      color: #fff;
      margin: 0 0 12px;
    }

    .jny-header>p {
      font-size: 14px;
      line-height: 1.85;
      color: rgba(255, 255, 255, .55);
      margin: 0;
    }

    .jny-split {
      display: grid;
      grid-template-columns: 1fr 1fr;
      align-items: stretch;
      gap: 0;
    }

    .jny-split-right {
      padding: 48px 0 0 64px;
      display: flex;
      flex-direction: column;
      justify-content: center;
      gap: 16px;
    }

    .jny-yr-tag {
      font-size: 10px;
      font-weight: 700;
      letter-spacing: .22em;
      text-transform: uppercase;
      color: var(--orange);
      margin-bottom: 20px;
      display: block;
    }

    .jny-chap-title {
      font-size: clamp(28px, 3vw, 44px);
      font-weight: 700;
      letter-spacing: -.035em;
      color: #fff;
      margin: 0 0 16px;
      line-height: 1.1;
    }

    .jny-chap-desc {
      font-size: 15px;
      line-height: 1.82;
      color: rgba(255, 255, 255, .58);
    }

    .jny-milestone-img {
      overflow: hidden;
      border-radius: 6px
    }

    .jny-milestone-img img {
      width: 100%;
      height: 100%;
      object-fit: cover;
      display: block;
      aspect-ratio: 4/3;
      transition: transform 1.2s var(--ease);
    }

    .jny-split:hover .jny-milestone-img img {
      transform: scale(1.04)
    }

    /* SOVEREIGN MAP */
    .journey-hero {
      position: relative;
      min-height: 100vh;
      width: 100%;
      display: flex;
      align-items: center;
      justify-content: center;
      text-align: center;
      overflow: hidden;
      background: var(--navy-deep);
      z-index: 1;
      padding: 80px 52px;
    }

    .journey-hero::before {
      content: "";
      position: absolute;
      inset: 0;
      z-index: 1;
      background: radial-gradient(ellipse 38% 34% at 50% 50%, rgba(6, 9, 20, .72) 0%, rgba(6, 9, 20, .3) 60%, transparent 100%);
    }

    @@keyframes mapDrift {
      0% {
        background-position: 0 0;
        transform: scale(1) translate(0, 0)
      }

      25% {
        background-position: 22px 10px;
        transform: scale(1.045) translate(3px, -4px)
      }

      50% {
        background-position: -10px 20px;
        transform: scale(1.06) translate(-5px, 3px)
      }

      75% {
        background-position: 16px -8px;
        transform: scale(1.03) translate(4px, 5px)
      }

      100% {
        background-position: 0 0;
        transform: scale(1) translate(0, 0)
      }
    }

    @@keyframes mapPulse {

      0%,
      100% {
        opacity: .48
      }

      50% {
        opacity: .68
      }
    }

    .map {
      position: absolute;
      inset: 0;
      background-image: radial-gradient(rgba(255, 255, 255, .9) 1px, transparent 1px);
      background-size: 9px 9px;
      -webkit-mask-image: url('https://upload.wikimedia.org/wikipedia/commons/8/80/World_map_-_low_resolution.svg');
      mask-image: url('https://upload.wikimedia.org/wikipedia/commons/8/80/World_map_-_low_resolution.svg');
      -webkit-mask-size: cover;
      mask-size: cover;
      -webkit-mask-position: center;
      mask-position: center;
      -webkit-mask-repeat: no-repeat;
      mask-repeat: no-repeat;
      animation: mapDrift 26s ease-in-out infinite, mapPulse 9s ease-in-out infinite;
      transform-origin: center;
    }

    .journey-hero-in {
      position: relative;
      z-index: 2
    }

    .journey-hero h3 {
      font-size: clamp(44px, 5.5vw, 72px);
      font-weight: 700;
      line-height: 1.04;
      letter-spacing: -.04em;
      color: #fff;
      margin: 0;
    }

    .journey-hero h3 span {
      color: var(--orange);
      display: block
    }

    .journey-hero p {
      margin: 16px auto 32px;
      max-width: 560px;
      font-size: clamp(15px, 1.4vw, 18px);
      line-height: 1.75;
      color: rgba(255, 255, 255, .75);
    }

    /* INSIGHTS */
    .insights {
      padding: 80px 0;
      width: 100%;
      overflow: visible;
      background: var(--paper);
      position: relative;
      z-index: 1;
      min-height: 100vh;
      display: flex;
      align-items: center;

    }

    .ins-header {
      display: flex;
      justify-content: space-between;
      align-items: flex-end;
      margin-bottom: 44px;
    }

    .ins-header h2 {
      font-size: clamp(28px, 3vw, 42px);
      font-weight: 700;
      letter-spacing: -.035em;
      line-height: 1.15;
      margin-top: 8px;
    }

    .ins-header .readlink {
      flex-shrink: 0;
      margin-bottom: 4px
    }

    .ins-header .eyebrow {
      margin-bottom: 8px
    }

    .ins-layout {
      display: grid;
      grid-template-columns: 1.1fr 1fr;
      align-items: stretch;
      gap: 40px;

    }

    /* main story: image top, text bottom — left column, no card chrome */
    .ins-feature {
      display: flex;
      flex-direction: column;
    }

    .ins-feature-img {
      overflow: hidden;
    }

    .ins-feature-img img {
      width: 100%;
      aspect-ratio: 3/2;
      object-fit: cover;
      display: block;
      transition: transform 1.2s var(--ease);
    }

    .ins-feature:hover .ins-feature-img img {
      transform: scale(1.04)
    }

    .ins-feature-body {
      padding: 20px 0 0;
      display: flex;
      flex-direction: column;
      justify-content: flex-start;
    }

    .ins-feature-body .eyebrow {
      color: var(--orange);
      font-weight: 700;
      font-size: 10px;
      margin-bottom: 14px;
    }

    .ins-feature-body h3 {
      font-size: clamp(15px, 1.2vw, 18px);
      font-weight: 700;
      line-height: 1.35;
      letter-spacing: -.02em;
      margin-bottom: 10px;
    }

    .ins-feature-body p {
      font-size: 13px;
      line-height: 1.65;
      color: var(--muted);
      margin-bottom: 14px;
    }

    .ins-feature-body .ins-date {
      margin-bottom: 14px;
    }

    .ins-feature-body .readlink {
      margin-top: auto;
      align-self: flex-start;
    }

    /* secondary stories: right column, stacked — top item is text-only, bottom keeps its image */
    .ins-row {
      display: flex;
      flex-direction: column;
      justify-content: space-between;
      height: 100%;
      gap: 32px;
    }

    .ins-item {
      display: flex;
      flex-direction: column;
    }

    .ins-row .ins-item + .ins-item {
      border-top: 1px solid var(--line);
      padding-top: 24px;
    }

    .ins-item .eyebrow {
      margin-bottom: 10px;
      font-size: 10px;
      font-weight: 600;
      color: var(--muted-2)
    }

    .ins-item h4 {
      font-size: 16px;
      font-weight: 700;
      line-height: 1.35;
      margin: 0 0 10px;
      letter-spacing: -.02em;
      display: -webkit-box;
      -webkit-line-clamp: 2;
      -webkit-box-orient: vertical;
      overflow: hidden;
    }

    .ins-date {
      display: block;
      font-size: 11px;
      letter-spacing: .06em;
      color: var(--muted-2);
      margin-bottom: 12px;
    }

    .ins-item-foot {
      margin-top: auto;
      padding-top: 14px;
      border-top: 1px solid var(--line);
      display: flex;
      flex-direction: column;
      align-items: flex-start;
    }

    .ins-item-foot .ins-date {
      margin-bottom: 10px;
    }

    .ins-item-foot .readlink {
      flex-shrink: 0;
    }

    .ins-thumb {
      overflow: hidden;
      margin-top: 16px;
      margin-bottom: 14px;
    }

    .ins-thumb img {
      width: 100%;
      aspect-ratio: 16/9;
      object-fit: cover;
      display: block;
      transition: transform 1.1s var(--ease);
    }

    .ins-item:hover .ins-thumb img {
      transform: scale(1.04)
    }

    /* CTA overrides — index uses inline <img>, different gradient + sizing */
    .cta {
      width: 100%
    }

    .cta img {
      position: absolute;
      inset: 0;
      width: 100%;
      height: 100%;
      object-fit: cover;
    }

    .cta::after {
      content: "";
      position: absolute;
      inset: 0;
      background: linear-gradient(180deg, rgba(8, 11, 22, .72), rgba(8, 11, 22, .86));
    }

    .cta h2 {
      font-weight: 700;
      line-height: 1.12;
      letter-spacing: -.04em;
      margin: 0 auto 36px;
    }

    .cta-body {
      margin: 0 auto 36px;
      max-width: 540px;
      font-size: clamp(15px, 1.4vw, 18px);
      line-height: 1.75;
      color: rgba(255, 255, 255, .75);
    }

    /* HERO SHUTTER */
    .hero__panel {
      position: absolute;
      top: 0;
      bottom: 0;
      width: 52%;
      z-index: 10;
      background: var(--ink);
      transition: transform 1.7s cubic-bezier(.83, 0, .17, 1) .25s;
      will-change: transform;
    }

    .hero__panel--l {
      left: 0;
      clip-path: polygon(0 0, 100% 0, 100% 34%, 93% 41%, 93% 62%, 86% 69%, 86% 100%, 0 100%);
    }

    .hero__panel--r {
      right: 0;
      clip-path: polygon(0 0, 100% 0, 100% 100%, 14% 100%, 14% 58%, 7% 51%, 7% 29%, 0 22%);
    }

    .is-typeset .hero__panel--l {
      transform: translate3d(-101%, 0, 0)
    }

    .is-typeset .hero__panel--r {
      transform: translate3d(101%, 0, 0)
    }

    .hero__filament {
      position: absolute;
      top: 0;
      bottom: 0;
      left: 50%;
      width: 1px;
      z-index: 11;
      background: linear-gradient(180deg, transparent, var(--orange), transparent);
      transition: opacity .9s ease .9s, transform 1.7s cubic-bezier(.83, 0, .17, 1) .25s;
      pointer-events: none;
    }

    .is-typeset .hero__filament {
      opacity: 0;
      transform: scaleY(1.4)
    }

    /* RESPONSIVE — index-specific sections */

    @@supports (height: 100dvh) {

      .stats,
      .journey-hero,
      .insights,
      .cta {
        min-height: 100dvh
      }
    }

    @@media (max-width: 900px) {
      .oc-header {
        flex-direction: column;
        align-items: flex-start;
        gap: 22px
      }

      .oc-header .btn {
        margin-bottom: 0
      }

      .hero-inner {
        padding-top: 80px;
        padding-bottom: 60px
      }

      .stats-grid {
        grid-template-columns: 1fr;
        gap: 40px
      }

      .stat-cols {
        grid-template-columns: 1fr 1fr
      }

      .stat {
        padding: 28px 20px
      }

      .stats {
        padding: 60px 0
      }

      .jny-split {
        grid-template-columns: 1fr
      }

      .jny-split-right {
        padding: 40px 0 0
      }

      .jny-milestone-img {
        min-height: 320px
      }

      .v12-grid {
        grid-template-columns: 1fr 1fr
      }

      .v4-step {
        max-width: 520px;
        margin: 0 auto
      }

      .stats {
        min-height: auto;
        padding: 96px 0
      }

      .v4-steps {
        grid-template-columns: 1fr
      }

      .v4-steps::before {
        display: none
      }

      .v4-step {
        padding: 0 0 48px
      }

      .journey-hero {
        padding: 60px 26px;
        min-height: 100vh
      }

      .ins-layout {
        grid-template-columns: 1fr;
        gap: 28px;
      }

      .ins-row {
        height: auto;
        gap: 28px;
      }

      .partners {
        overflow: hidden
      }

      .partners-grid {
        animation-duration: 30s;
      }

      .partner-logo {
        margin-right: 56px
      }

      .partner-logo img {
        height: calc(var(--h, 44px) * .85)
      }

      .partner-logo-dup {
        display: flex
      }
    }

    @@media (max-width: 768px) {
      .oc-headline br {
        display: none
      }

      .hero h1 {
        font-size: clamp(38px, 8vw, 64px)
      }

      .hero-body {
        font-size: 16px;
        max-width: 100%
      }

      .stats-quote {
        font-size: clamp(17px, 4vw, 22px)
      }

      .stat .n {
        font-size: clamp(32px, 8vw, 52px)
      }

      .stat .l {
        font-size: 13px
      }

      .journey-hero h3 {
        font-size: clamp(34px, 8vw, 52px)
      }

      .cta h2 {
        font-size: clamp(22px, 5vw, 32px)
      }
    }

    @@media (max-width: 600px) {
      .v12-grid {
        grid-template-columns: 1fr
      }

      .v12-card-inner,
      .v12-card:hover .v12-card-inner {
        padding: 28px 24px;
        gap: 18px
      }

      .hero h1 {
        font-size: clamp(32px, 9.5vw, 50px)
      }

      .hero-body {
        font-size: 15px;
        margin-top: 20px
      }

      .hero-ctas {
        flex-direction: column;
        align-items: flex-start
      }

      .hero-inner {
        padding-top: 72px
      }

      .stat .n {
        font-size: clamp(48px, 14vw, 72px)
      }

      .stat .l {
        font-size: 12px;
        letter-spacing: .06em
      }

      .journey-hero {
        padding: 60px 20px
      }

      .journey-hero h3 {
        font-size: clamp(28px, 9vw, 40px)
      }

      .journey-hero p {
        font-size: 14px
      }

      .ins-header {
        flex-direction: column;
        align-items: flex-start;
        gap: 16px
      }

      .sp-inner {
        padding: 72px 0 80px
      }

      .oc-inner {
        padding: 64px 0 72px
      }

      .journey-shell {
        padding: 72px 0
      }

      .jny-split-right {
        padding: 32px 0 0
      }

      /* mobile rhythm */
      .stats {
        min-height: auto;
        padding: 80px 0
      }

      .stats-grid {
        gap: 28px
      }

      .stat {
        padding: 20px 0
      }

      .stats-mission {
        margin-top: 14px
      }

      .sp-inner {
        padding: 64px 0 72px
      }

      .sp-header {
        margin-bottom: 40px
      }

      .v4-step {
        padding: 0 0 44px
      }

      .v4-step:last-child {
        padding-bottom: 0
      }

      .v4-step__dot {
        margin-bottom: 20px
      }

      .v4-step__img {
        margin-bottom: 20px
      }

      .v4-step h3 {
        margin-bottom: 8px
      }

      .oc-header {
        margin-bottom: 32px
      }

      .oc-headline {
        margin-bottom: 10px
      }

      .v12-grid {
        gap: 12px
      }

      .partners {
        padding: 56px 0
      }

      .partners-label {
        margin-bottom: 28px
      }

      .journey-hero p {
        margin: 14px auto 28px
      }

      .insights {
        min-height: auto;
        padding: 64px 0
      }

      .ins-header {
        margin-bottom: 28px
      }

      .ins-layout {
        gap: 20px;
      }

      .ins-row {
        gap: 20px;
      }

      .ins-feature-body {
        padding: 28px 24px;
      }
    }

    @@media (max-width: 480px) {
      .stat-cols {
        grid-template-columns: 1fr 1fr
      }

      .hero h1 {
        font-size: 30px
      }

      .hero-body {
        font-size: 14px
      }

      .stat .n {
        font-size: 44px
      }

      .stats-quote {
        font-size: 15px
      }

      .journey-hero h3 {
        font-size: 26px
      }

      .cta h2 {
        font-size: clamp(20px, 7vw, 26px)
      }
    }

    @@media (prefers-reduced-motion: reduce) {
      .partners-grid {
        animation: none;
        flex-wrap: wrap;
        width: auto;
        justify-content: center
      }

      .partner-logo-dup {
        display: none
      }

      .hero__panel--l {
        transform: translate3d(-101%, 0, 0) !important
      }

      .hero__panel--r {
        transform: translate3d(101%, 0, 0) !important
      }

      .hero__filament {
        opacity: 0 !important
      }
    }
  </style>
</head>

<body>

  <!-- GLOBAL VIDEO BACKGROUND (shared by hero + stats) -->
  <video id="bgVid" autoplay muted loop playsinline>
    <source src="{{ \App\Services\CmsStore::media($cms['hero']['video']) }}" type="video/mp4">
  </video>

  <!-- NAV -->
  @include('partials.nav')

  @include('partials.home-main')

  <!-- FOOTER -->
  @include('partials.footer')
  <script src="{{ asset('reveal.js') }}"></script>
  <script>
    /* ---- sticky nav + hide on scroll down ---- */
    const hdr = document.getElementById('hdr');
    let lastScrollY = window.scrollY;

    addEventListener('scroll', () => {
      const y = window.scrollY;
      hdr.classList.toggle('solid', y > 60);
      if (y > lastScrollY && y > 80) {
        hdr.classList.add('nav-hidden');
      } else if (y < lastScrollY || y <= 80) {
        hdr.classList.remove('nav-hidden');
      }
      lastScrollY = y;
    }, { passive: true });

    /* ---- shared video parallax (hero + stats) ---- */
    const bgVid = document.getElementById('bgVid');
    function rafBgParallax() {
      /* subtle scale: video breathes slightly as you scroll through the first two sections */
      const progress = Math.min(window.scrollY / (window.innerHeight * 2), 1);
      const scale = 1 + progress * 0.08;
      if (bgVid) bgVid.style.transform = `scale(${scale})`;
    }
    window.addEventListener('scroll', () => requestAnimationFrame(rafBgParallax), { passive: true });

    /* ---- animated stat counters (start as the stats block finishes revealing) ---- */
    const nums = document.querySelectorAll('.n[data-count]');
    const nio = new IntersectionObserver((es) => {
      es.forEach(e => {
        if (!e.isIntersecting) return;
        nio.unobserve(e.target);
        const el = e.target, target = +el.dataset.count, suf = el.dataset.suffix || '';
        const dur = 1500;
        setTimeout(() => {
          const t0 = performance.now();
          (function step(t) {
            const p = Math.min((t - t0) / dur, 1);
            const eased = 1 - Math.pow(1 - p, 3);
            el.textContent = Math.round(target * eased) + suf;
            if (p < 1) requestAnimationFrame(step);
          })(t0);
        }, 350);
      });
    }, { threshold: 0, rootMargin: '0px 0px -12% 0px' });
    nums.forEach(n => nio.observe(n));

    /* ---- Hero shutter: typeset gate ---- */
    (function () {
      var opened = false;
      function openShutter() {
        if (opened) return;
        opened = true;
        document.documentElement.classList.add('is-typeset');
      }
      if (document.fonts && document.fonts.ready) {
        document.fonts.ready.then(openShutter);
        setTimeout(openShutter, 1800);
      } else {
        setTimeout(openShutter, 200);
      }
    })();

    /* ---- Navbar: transparent over hero only ---- */
    (function () {
      const hero = document.querySelector('.hero');
      if (!hero) return;
      new IntersectionObserver(([e]) => {
        if (!e.isIntersecting) {
          hdr.classList.add('solid');
        } else {
          if (window.scrollY <= 60) hdr.classList.remove('solid');
        }
      }, { threshold: 0.05 }).observe(hero);
    })();

    /* ---- Burger nav ---- */
    (function () {
      const burger = document.querySelector('.burger');
      const nav = document.querySelector('.nav-links');
      if (!burger || !nav) return;
      burger.addEventListener('click', () => {
        nav.classList.toggle('open');
        burger.classList.toggle('open');
      });
      // close on link tap
      nav.querySelectorAll('a').forEach(a => a.addEventListener('click', () => {
        nav.classList.remove('open');
        burger.classList.remove('open');
      }));
      // close on outside tap
      document.addEventListener('click', e => {
        if (!burger.contains(e.target) && !nav.contains(e.target)) {
          nav.classList.remove('open');
          burger.classList.remove('open');
        }
      });
    })();

  </script>
</body>

</html>