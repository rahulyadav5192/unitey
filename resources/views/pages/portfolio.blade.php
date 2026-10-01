<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>{{ $cms['seo']['title'] }}</title>
  <link rel="icon" href="{{ asset('favicon1.png') }}">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;0,800;1,400;1,500&family=Archivo:wght@700;800&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="{{ asset('styles.css') }}">
  <style>
    /* PORTFOLIO — page-specific CSS */

    /* Hero */
    .hero { padding: 140px 0 96px }
    .hero::after {
      content: '';
      position: absolute; inset: 0;
      background: linear-gradient(155deg, rgba(8,11,28,.92) 0%, rgba(8,11,28,.68) 55%, rgba(8,11,28,.85) 100%);
    }
    .hero-in { max-width: 1120px }
    .hero-body { max-width: 760px }
    .hero-h1 { line-height: 1.12; font-size: clamp(34px, 4.4vw, 64px) }

    /* ════════════════════════
       COMPANY SELECTOR
    ════════════════════════ */
    .co-selector {
      background: var(--paper);
      border-bottom: 1px solid var(--line);
    }
    .co-tabs {
      display: grid;
      grid-template-columns: repeat(4, 1fr);
      max-width: var(--max);
      margin: 0 auto;
    }
    .co-tab {
      display: flex;
      flex-direction: column;
      align-items: center;
      justify-content: center;
      gap: 11px;
      padding: 26px 20px;
      border: none;
      border-bottom: 3px solid transparent;
      background: transparent;
      cursor: pointer;
      transition: background .2s var(--ease), border-color .2s var(--ease);
      position: relative;
    }
    .co-tab:not(:last-child) { border-right: 1px solid var(--line) }
    .co-tab:hover { background: var(--paper-2) }
    .co-tab.active { border-bottom-color: var(--orange); background: #fff }
    .co-tab img {
      height: var(--tab-h, 34px); width: auto; max-width: 150px;
      object-fit: contain; display: block;
      opacity: .55;
      transition: opacity .2s;
    }
    .co-tab.active img { opacity: 1 }
    .co-tab-name {
      font-size: 10px; font-weight: 700;
      letter-spacing: .1em; text-transform: uppercase;
      color: var(--muted-2);
      transition: color .2s;
      line-height: 1.4;
      text-align: center;
    }
    .co-tab.active .co-tab-name { color: var(--navy) }

    /* ════════════════════════
       PANELS
    ════════════════════════ */
    .co-panel { display: none }
    .co-panel.active { display: block }

    /* ── Company banner ── */
    .panel-banner {
      position: relative;
      min-height: 520px;
      display: flex;
      align-items: center;
      overflow: hidden;
    }
    .panel-banner-bg {
      position: absolute; inset: 0;
      width: 100%; height: 100%;
      object-fit: cover;
      display: block;
      transition: transform 10s ease;
    }
    .panel-banner:hover .panel-banner-bg { transform: scale(1.03) }
    .panel-banner::after {
      content: '';
      position: absolute; inset: 0;
      background: linear-gradient(108deg,
        rgba(8,11,28,.95) 0%,
        rgba(8,11,28,.78) 50%,
        rgba(8,11,28,.24) 100%);
      pointer-events: none;
    }
    .panel-banner-in {
      position: relative; z-index: 1;
      padding: 96px 0;
      width: 100%;
    }
    /* each mark gets its own height so all four read at the same visual size */
    .panel-banner-logo {
      height: var(--logo-h, 52px); width: auto; max-width: none;
      object-fit: contain; display: block;
      margin-bottom: 32px;
      filter: brightness(0) invert(1);
    }
    .panel-banner-logo-link { display: inline-block }
    .panel-banner-logo--asis { filter: none }
    .btn.is-disabled { opacity: .45; cursor: not-allowed; pointer-events: none }
    .btn-note {
      display: block; margin-top: 14px;
      font-size: 10px; letter-spacing: .18em; text-transform: uppercase;
      font-weight: 700; color: rgba(255,255,255,.5);
    }
    .panel-banner-cat {
      font-size: 10px; letter-spacing: .22em;
      text-transform: uppercase; font-weight: 700;
      color: var(--orange); margin-bottom: 14px;
      display: block;
    }
    .panel-banner h2 {
      font-size: clamp(28px, 3vw, 44px);
      font-weight: 800; letter-spacing: -.04em;
      line-height: 1.1; color: #fff;
      margin-bottom: 18px; max-width: 620px;
    }
    .panel-banner p {
      font-size: 15px; line-height: 1.88;
      color: rgba(255,255,255,.84);
      margin-bottom: 40px;
      max-width: 560px;
    }

    /* ── Capabilities — vertical list + image ── */
    .panel-caps {
      padding: 72px 0 64px;
      background: var(--bg-warm);
    }
    .panel-caps-head {
      margin-bottom: 40px;
      display: flex; align-items: center; justify-content: space-between;
      gap: 28px; flex-wrap: wrap;
    }
    .panel-caps-head .eyebrow { margin-bottom: 0 }
    .caps-idents { display: flex; align-items: center; gap: 24px; flex-wrap: wrap }
    .caps-idents .cred-mark-img { flex-shrink: 0 }
    .caps-ident {
      display: inline-flex; align-items: center; gap: 10px;
      font-size: 10.5px; letter-spacing: .14em; text-transform: uppercase;
      font-weight: 700; color: var(--navy);
    }
    .caps-ident svg { width: 20px; height: 20px; fill: var(--orange); flex-shrink: 0 }
    .caps-idents > img:not(.cred-mark-img) { height: 52px; width: auto; display: block; margin: -14px 0 }

    /* proprietary products sit in their own cards, apart from the service list */
    .prod-grid { display: grid; grid-template-columns: 1fr 1fr; gap: 18px; margin-bottom: 44px }
    .prod-card {
      background: var(--paper);
      border: 1px solid var(--line);
      border-top: 3px solid var(--orange);
      border-radius: 12px;
      padding: 30px 32px;
    }
    .prod-card img { height: var(--ph, 66px); width: auto; object-fit: contain; display: block; margin: -10px 0 8px -6px }
    .prod-card .prod-lbl {
      font-size: 9.5px; letter-spacing: .18em; text-transform: uppercase;
      font-weight: 700; color: var(--muted-2); display: block; margin-bottom: 14px;
    }
    .prod-card p { font-size: 13px; line-height: 1.75; color: var(--muted) }
    .caps-split {
      display: grid;
      grid-template-columns: 1fr 360px;
      gap: 72px;
      align-items: start;
    }
    .caps-list { display: flex; flex-direction: column }
    .caps-item {
      padding: 22px 0;
      border-bottom: 1px solid var(--line);
    }
    .caps-item:first-child { border-top: 1px solid var(--line) }
    .caps-item-body h4 {
      font-size: 15px; font-weight: 700;
      letter-spacing: -.022em; color: var(--ink);
      margin-bottom: 7px; line-height: 1.28;
    }
    .caps-item-body p { font-size: 13px; line-height: 1.75; color: var(--muted) }
    .caps-img-col { position: sticky; top: 90px }
    .caps-split--match { align-items: stretch }
    .caps-split--match .caps-img-col { position: static; display: flex }
    .caps-split--match .caps-img-col img { height: 100%; aspect-ratio: auto }
    .caps-img-col img {
      width: 100%; aspect-ratio: 3/4;
      object-fit: cover; border-radius: 14px;
      display: block;
    }

    /* ── Credential — open editorial layout ── */
    .panel-cred {
      padding: 0 0 72px;
      background: var(--bg-warm);
    }
    .cred-feature {
      display: block;
      padding: 52px 0;
      border-top: 1px solid var(--line);
    }
    .cred-feature h3 {
      font-size: clamp(17px, 1.7vw, 22px);
      font-weight: 800; letter-spacing: -.035em;
      color: var(--ink); margin-bottom: 14px;
      line-height: 1.2; margin-top: 10px;
    }
    .cred-left > p {
      font-size: 14px; line-height: 1.82;
      color: var(--muted); max-width: 600px;
    }
    .cred-tags {
      display: flex; flex-direction: column;
      gap: 10px; align-items: flex-start;
    }
    .cred-tags-lbl {
      font-size: 9.5px; letter-spacing: .14em;
      text-transform: uppercase; font-weight: 700;
      color: var(--muted-2); margin-bottom: 4px; display: block;
    }
    .cred-mark { display: block; margin-bottom: 12px }
    .cred-mark img,
    .cred-mark-img { height: var(--cm-h, 34px); width: auto; object-fit: contain; display: block }
    .cred-mark-pair { display: flex; align-items: center; gap: 26px; flex-wrap: wrap }

    .cred-pill {
      display: inline-block;
      max-width: 100%;
      background: var(--navy); color: #fff;
      font-size: 11px; font-weight: 700;
      letter-spacing: .08em; text-transform: uppercase;
      padding: 9px 18px; border-radius: 6px;
      line-height: 1.5;
    }
    .cred-pill.light {
      background: rgba(232,145,43,.1);
      border: 1px solid rgba(232,145,43,.28);
      color: var(--orange);
    }

    /* CTA */
    .cta { padding: 80px 0 }
    .cta-bg { opacity: .42 }
    @@supports (height: 100dvh) { .cta { min-height: 100dvh } }

    /* ════════════════════════
       RESPONSIVE
    ════════════════════════ */
    @@media (max-width: 1100px) {
      .caps-split { grid-template-columns: 1fr 300px; gap: 52px }
    }
    @@media (max-width: 900px) {
      .caps-split { grid-template-columns: 1fr; gap: 0 }
      .caps-img-col { display: none }
      .cred-feature { grid-template-columns: 1fr; gap: 28px }
      .cred-tags { flex-direction: row; flex-wrap: wrap }
      .co-tabs { grid-template-columns: repeat(4, 1fr) }
    }
    @@media (max-width: 640px) {
      .hero { padding: 120px 0 72px }
      .hero-h1 { font-size: clamp(32px,9vw,52px) }
      .co-tabs {
        display: flex; overflow-x: auto;
        scrollbar-width: none;
      }
      .co-tabs::-webkit-scrollbar { display: none }
      .co-tab { flex-shrink: 0; min-width: 130px; padding: 18px 14px }
      .co-tab img { height: calc(var(--tab-h, 34px) * .78); max-width: 118px }
      .co-tab-name { font-size: 8.5px }
      .panel-banner { min-height: 400px }
      .panel-banner-in { padding: 72px 0 }
      .panel-banner-logo { height: 44px }
      .panel-caps { padding: 52px 0 48px }
      .panel-cred { padding: 0 0 56px }
      .caps-item { padding: 18px 0 }
      .prod-grid { grid-template-columns: 1fr; gap: 14px; margin-bottom: 32px }
      .panel-caps-head { gap: 16px }

      /* mobile rhythm */
      .panel-banner-logo { margin-bottom: 20px }
      .panel-banner h2 { margin-bottom: 12px }
      .panel-banner p { margin-bottom: 28px }
      .panel-caps { padding: 48px 0 32px }
      .panel-caps-head { margin-bottom: 20px }
      .panel-cred { padding-bottom: 48px }
      .cred-feature { padding: 32px 0 0; gap: 20px }
    }
  </style>
</head>
<body>

  <!-- NAV -->
  @include('partials.nav')

  @include('partials.portfolio-main')

  <!-- FOOTER -->
  @include('partials.footer')

  <script src="{{ asset('reveal.js') }}"></script>

  <script>
    /* NAV */
    const hdr = document.getElementById('hdr');
    const burger = document.getElementById('burger');
    const navLinks = document.getElementById('navLinks');
    let lastY = window.scrollY;

    burger.addEventListener('click', () => {
      burger.classList.toggle('open');
      navLinks.classList.toggle('open');
    });

    // close on link tap
    navLinks.querySelectorAll('a').forEach(a => a.addEventListener('click', () => {
      navLinks.classList.remove('open');
      burger.classList.remove('open');
    }));
    // close on outside tap
    document.addEventListener('click', e => {
      if (!burger.contains(e.target) && !navLinks.contains(e.target)) {
        navLinks.classList.remove('open');
        burger.classList.remove('open');
      }
    });

    addEventListener('scroll', () => {
      const y = window.scrollY;
      hdr.classList.toggle('solid', y > 60);
      if (y > lastY && y > 80) hdr.classList.add('nav-hidden');
      else if (y < lastY || y <= 80) hdr.classList.remove('nav-hidden');
      lastY = y;
    }, { passive: true });

    /* TAB SWITCHER */
    function switchTab(id) {
      document.querySelectorAll('.co-tab').forEach(t => {
        t.classList.remove('active');
        t.setAttribute('aria-selected', 'false');
      });
      document.querySelectorAll('.co-panel').forEach(p => p.classList.remove('active'));

      const tab   = document.querySelector(`.co-tab[data-panel="${id}"]`);
      const panel = document.getElementById(`panel-${id}`);
      if (tab)   { tab.classList.add('active'); tab.setAttribute('aria-selected', 'true') }
      if (panel) { panel.classList.add('active'); Reveal.replay(panel) }

      if (window.innerWidth < 900) {
        document.querySelector('.co-selector').scrollIntoView({ behavior: 'smooth', block: 'nearest' });
      }
    }

    document.querySelectorAll('.co-tab').forEach(tab => {
      tab.addEventListener('click', () => {
        switchTab(tab.dataset.panel);
        history.replaceState(null, '', '#' + tab.dataset.panel);
      });
    });

    /* open the company named in the URL (nav dropdown links here) */
    function openFromHash(scroll) {
      const id = location.hash.replace('#', '');
      if (!document.getElementById('panel-' + id)) return;
      switchTab(id);
      if (scroll) document.querySelector('.co-selector').scrollIntoView({ behavior: 'smooth', block: 'start' });
    }
    openFromHash(true);
    addEventListener('hashchange', () => openFromHash(true));

  </script>
</body>
</html>
