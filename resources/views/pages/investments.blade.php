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
    /* HERO OVERRIDES */
    .hero { padding:140px 0 96px }
    .hero-bg { opacity:.35 }
    .hero::after { background:linear-gradient(155deg,rgba(8,11,28,.94) 0%,rgba(8,11,28,.72) 55%,rgba(8,11,28,.88) 100%) }
    .hero-in { max-width:1080px }
    .hero-h1 { font-size:clamp(32px,3.9vw,54px) }

    /* STATS BAR */
    .stats-bar { position:relative; background:var(--ink); border-bottom:1px solid rgba(255,255,255,.06); padding:72px 0 }
    .stats-bar-inner { display:grid; grid-template-columns:repeat(4,1fr) }
    .stat-item { padding:44px 40px; border-right:1px solid rgba(255,255,255,.07); text-align:center }
    .stat-item:last-child { border-right:none }
    .stat-n { font-size:clamp(40px,4.5vw,64px); font-weight:700; letter-spacing:-.04em; line-height:1; display:block;
      background:linear-gradient(110deg,rgba(255,255,255,.45) 0%,rgba(255,255,255,1) 30%,rgba(255,255,255,.6) 50%,rgba(255,255,255,1) 72%,rgba(255,255,255,.45) 100%);
      background-size:250% auto; -webkit-background-clip:text; background-clip:text; color:transparent;
      animation:shimmer 4s linear infinite }
    @@keyframes shimmer { 0%{background-position:200% center} 100%{background-position:-100% center} }
    .stat-l { margin-top:10px; font-size:13px; font-weight:600; color:rgba(255,255,255,.5); letter-spacing:.08em; text-transform:uppercase }

    /* PORTFOLIO OVERVIEW */
    .po-section { padding:100px 0; background:var(--bg-warm); border-bottom:1px solid var(--line); min-height:100vh }
    .po-head { margin-bottom:64px }
    .po-head h2 { font-size:clamp(28px,3vw,42px); font-weight:700; letter-spacing:-.04em; line-height:1.12; max-width:640px; margin-bottom:18px }
    .po-head p { font-size:16px; line-height:1.8; color:var(--muted); max-width:560px }
    .po-grid { display:grid; grid-template-columns:repeat(2,1fr); gap:0; border:1px solid var(--line) }
    .po-card { padding:44px 48px; border-right:1px solid var(--line); border-bottom:1px solid var(--line); background:var(--paper); transition:background .35s var(--ease) }
    .po-card:hover { background:var(--paper-2) }
    .po-card:nth-child(2n) { border-right:none }
    .po-card:nth-child(3),.po-card:nth-child(4) { border-bottom:none }
    .po-card-logo { height:36px; width:auto; max-width:140px; object-fit:contain; margin-bottom:20px }
    .po-card p { font-size:14px; line-height:1.82; color:var(--muted) }

    /* PARTNERS */
    .partners-section { padding:100px 0; background:var(--paper); border-bottom:1px solid var(--line); min-height:100vh }
    .partners-head { margin-bottom:64px; text-align:center }
    .partners-head h2 { font-size:clamp(28px,3vw,42px); font-weight:700; letter-spacing:-.04em; line-height:1.12; margin-bottom:18px }
    .partners-head p { font-size:16px; line-height:1.8; color:var(--muted); max-width:580px; margin:0 auto }
    .partner-item { display:grid; grid-template-columns:1fr 1fr; align-items:center; border-bottom:1px solid var(--line) }
    .partner-item:last-child { border-bottom:none }
    .partner-item--alt { background:var(--paper-2) }
    .partner-logo-side { display:flex; align-items:center; justify-content:center; padding:80px 60px; border-right:1px solid var(--line) }
    .partner-item--alt .partner-logo-side { grid-column:2; grid-row:1; border-right:none; border-left:1px solid var(--line) }
    .partner-item--alt .partner-desc-side { grid-column:1; grid-row:1 }
    .partner-logo-side img { height:56px; width:auto; max-width:200px; object-fit:contain }
    .partner-logo-pair { display:flex; gap:32px; align-items:center }
    .partner-logo-pair img { height:56px; width:auto; max-width:140px; object-fit:contain }
    .partner-desc-side { padding:80px 60px }
    .partner-item-tag { font-size:10px; letter-spacing:.15em; text-transform:uppercase; font-weight:700; color:var(--orange); margin-bottom:14px; display:block }
    .partner-item-name { font-size:clamp(22px,2.2vw,32px); font-weight:700; letter-spacing:-.04em; margin-bottom:16px; color:var(--ink) }
    .partner-item-desc { font-size:15px; line-height:1.82; color:var(--muted) }

    /* PORTFOLIO CTA */
    .pf-cta { position:relative; background:var(--ink); border-bottom:1px solid var(--line); padding:88px 0; overflow:hidden; color:#fff }
    .pf-cta-bg { position:absolute; inset:0; width:100%; height:100%; object-fit:cover; opacity:.45 }
    .pf-cta::after { content:""; position:absolute; inset:0; background:linear-gradient(180deg, rgba(8,11,22,.75), rgba(8,11,22,.85)) }
    .pf-cta-in { position:relative; z-index:2; display:flex; align-items:center; justify-content:space-between; gap:48px }
    .pf-cta h2 { font-size:clamp(26px,2.8vw,40px); font-weight:800; letter-spacing:-.04em; line-height:1.1; margin-bottom:14px; color:#fff }
    .pf-cta p { font-size:16px; line-height:1.8; color:rgba(255,255,255,.72); max-width:620px }
    .pf-cta .btn { flex-shrink:0 }

    /* CONNECT */
    .connect { background:var(--ink); position:relative; overflow:hidden; min-height:100vh; display:flex; align-items:center }
    .connect::before { content:''; position:absolute; inset:0; background:radial-gradient(ellipse 55% 75% at 90% 50%,rgba(232,145,43,.08) 0%,transparent 65%),radial-gradient(ellipse 45% 55% at 10% 15%,rgba(28,42,94,.6) 0%,transparent 60%); pointer-events:none }
    .connect .wrap { position:relative; z-index:1 }
    .connect-inner { padding:100px 0; display:grid; grid-template-columns:1fr 1.15fr; gap:88px; align-items:start }
    .connect-left .eyebrow { color:var(--orange) }
    .connect-left h2 { font-size:clamp(28px,3vw,42px); font-weight:700; letter-spacing:-.04em; color:#fff; line-height:1.1; margin-bottom:20px }
    .connect-left p { font-size:15px; line-height:1.82; color:rgba(255,255,255,.58); margin-bottom:36px }
    .connect-detail { display:flex; flex-direction:column; gap:16px }
    .c-detail { font-size:14px; color:rgba(255,255,255,.52); line-height:1.6 }
    .c-detail strong { color:rgba(255,255,255,.82); font-weight:600; display:block; margin-bottom:2px }
    .connect-form { background:var(--paper); border:1px solid var(--line); padding:48px }
    .form-submit { width:100%; justify-content:center }

    @@supports(height:100dvh) { .po-section,.partners-section,.connect { min-height:100dvh } }

    @@media(max-width:900px) {
      .pf-cta { padding:64px 0 }
      .pf-cta-in { flex-direction:column; align-items:flex-start; gap:28px }
      .stats-bar-inner { grid-template-columns:repeat(2,1fr) }
      .stat-item:nth-child(2) { border-right:none }
      .stat-item:nth-child(3),.stat-item:nth-child(4) { border-top:1px solid rgba(255,255,255,.07) }
      .po-grid { grid-template-columns:1fr }
      .po-card { border-right:none }
      .po-card:nth-child(3),.po-card:nth-child(4) { border-bottom:1px solid var(--line) }
      .po-card:last-child { border-bottom:none }
      .hero { padding:120px 0 72px }
      .partner-item { grid-template-columns:1fr }
      .partner-item--alt .partner-logo-side { grid-column:1; grid-row:1; border-left:none; border-right:none; border-bottom:1px solid var(--line) }
      .partner-item--alt .partner-desc-side { grid-column:1; grid-row:2 }
      .partner-logo-side { border-right:none; border-bottom:1px solid var(--line); padding:48px 40px }
      .partner-desc-side { padding:48px 40px }
      .partners-section { min-height:auto }
      .po-section { min-height:auto }
      .connect-inner { grid-template-columns:1fr; gap:48px; padding:80px 0 }
    }
    @@media(max-width:600px) {
      .stats-bar-inner { grid-template-columns:1fr 1fr }
      .connect-form { padding:28px 20px }
      .partner-logo-side { padding:28px 20px }
      .partner-desc-side { padding:24px 20px 32px }

      /* mobile rhythm */
      .partners-section { padding:64px 0 }
      .partners-head { margin-bottom:36px }
      .partners-head h2 { margin-bottom:12px }
      .connect { min-height:auto }
      .connect-inner { padding:64px 0; gap:36px }
      .connect-left h2 { margin-bottom:12px }
      .connect-left p { margin-bottom:24px }
    }
  </style>
</head>
<body>

  <!-- NAV -->
  @include('partials.nav')

  @include('partials.partners-main')

  <!-- FOOTER -->
  @include('partials.footer')

  <script src="{{ asset('reveal.js') }}"></script>

  <script>
    const hdr = document.getElementById('hdr');
    const burger = document.getElementById('burger');
    const navLinks = document.getElementById('navLinks');
    let lastY = window.scrollY;

    burger.addEventListener('click', () => { burger.classList.toggle('open'); navLinks.classList.toggle('open') });

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

    // stat counters
    const nio = new IntersectionObserver(es => {
      es.forEach(e => {
        if (!e.isIntersecting) return;
        const el = e.target, target = +el.dataset.count, suf = el.dataset.suffix || '', plain = el.dataset.plain;
        const dur = 1400, t0 = performance.now();
        (function step(t) {
          const p = Math.min((t - t0) / dur, 1), eased = 1 - Math.pow(1 - p, 3);
          el.textContent = plain ? target : (Math.round(target * eased) + suf);
          if (p < 1) requestAnimationFrame(step);
          else if (plain) el.textContent = target;
        })(t0);
        nio.unobserve(el);
      });
    }, { threshold: .5 });
    document.querySelectorAll('.stat-n[data-count]').forEach(n => nio.observe(n));

  </script>
</body>
</html>
