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
    /* COMPANY — page-specific CSS */

    /* Hero overrides */
    .hero { padding: 140px 0 96px }
    .hero-bg { transition: transform 8s ease }
    .hero::after {
      content: '';
      position: absolute;
      inset: 0;
      background: linear-gradient(155deg, rgba(8,11,28,.92) 0%, rgba(8,11,28,.72) 55%, rgba(8,11,28,.85) 100%);
    }
    .hero-in { max-width: 1000px }

    /* About */
    .about { background: var(--paper); position: relative; z-index: 1 }
    .about-split { display: grid; grid-template-columns: 1fr 1fr; min-height: 100vh }
    .about-img-side { position: relative; overflow: hidden }
    .about-img-side img { width: 100%; height: 100%; object-fit: cover; display: block; transition: transform 12s ease }
    .about-img-side:hover img { transform: scale(1.04) }
    .about-img-side::after { display: none }
    .about-content { padding: 88px 72px 88px 60px; display: flex; flex-direction: column; justify-content: center }
    .about-content h2 { font-size: clamp(28px,3vw,42px); font-weight: 700; letter-spacing: -.035em; line-height: 1.15; margin-bottom: 20px }
    .about-content > p:not(.eyebrow) { font-size: 16px; line-height: 1.8; color: var(--muted); margin-bottom: 48px }
    .purpose-pair { display: flex; flex-direction: column; gap: 0 }
    .purpose-box { padding: 32px 36px }
    .purpose-box:last-child { border-bottom: none }
    .purpose-box .eyebrow { margin-bottom: 10px; font-size: 10px }
    .purpose-box h3 { font-size: 17px; font-weight: 700; letter-spacing: -.02em; color: var(--navy); margin-bottom: 10px; line-height: 1.3 }
    .purpose-box p { font-size: 13.5px; line-height: 1.8; color: var(--muted) }

    /* Approach */
    .approach { background: var(--ink); position: relative; overflow: hidden; z-index: 1; min-height: 100vh; display: flex; align-items: center }
    .approach::before { content: ''; position: absolute; inset: 0; background: radial-gradient(ellipse 55% 75% at 12% 50%, rgba(232,145,43,.09) 0%, transparent 65%), radial-gradient(ellipse 45% 55% at 90% 15%, rgba(28,42,94,.6) 0%, transparent 60%); pointer-events: none }
    .approach .wrap { position: relative; z-index: 1 }
    .approach-inner { padding: 120px 0 140px }
    .approach-head { margin-bottom: 80px }
    .approach-head h2 { font-size: clamp(32px,3.5vw,52px); font-weight: 800; letter-spacing: -.045em; color: #fff; line-height: 1.0; max-width: 640px }
    .approach-head h2 em { font-style: normal; color: var(--orange) }
    .approach-grid { display: grid; grid-template-columns: repeat(2,1fr); gap: 0 }
    .approach-card { padding: 56px 52px; transition: background .4s var(--ease) }
    .approach-card:hover { background: rgba(255,255,255,.025) }
    .approach-num { font-size: 11px; font-weight: 700; letter-spacing: .18em; color: var(--orange); margin-bottom: 24px; display: block }
    .approach-card h3 { font-size: clamp(18px,1.6vw,22px); font-weight: 700; letter-spacing: -.02em; color: #fff; line-height: 1.2; margin-bottom: 16px; text-transform: uppercase }
    .approach-card p { font-size: 14px; line-height: 1.9; color: rgba(255,255,255,.52) }

    /* Journey (company version — dark navy bg, different from homepage) */
    .journey-shell { position: relative; background: var(--navy-deep); padding: 96px 0; z-index: 1; overflow: hidden }
    .journey-top { margin-bottom: 52px; position: relative; z-index: 1 }
    .journey-top h2 { font-size: clamp(28px,3vw,42px); font-weight: 700; letter-spacing: -.04em; color: #fff; margin: 0 0 12px }
    .journey-top p { font-size: 14px; line-height: 1.85; color: rgba(255,255,255,.5); max-width: 480px }
    .tl-center { position: relative; padding: 0; margin-top: 56px }
    .tl-center::before { content: ''; position: absolute; left: 50%; transform: translateX(-50%); top: 0; bottom: 0; width: 1px; background: rgba(255,255,255,.1) }
    .tl-row { display: grid; grid-template-columns: 1fr 1fr; gap: 0 48px; margin-bottom: 52px; position: relative }
    .tl-row:last-child { margin-bottom: 0 }
    .tl-row::before { content: ''; position: absolute; left: 50%; top: 6px; transform: translateX(-50%); width: 10px; height: 10px; border-radius: 50%; background: var(--orange); z-index: 2 }
    .tl-left { text-align: right; padding-right: 36px }
    .tl-right { padding-left: 36px }
    .tl-row.odd .tl-left { opacity: 1 }
    .tl-row.odd .tl-right { opacity: 0; pointer-events: none }
    .tl-row.even .tl-left { opacity: 0; pointer-events: none }
    .tl-row.even .tl-right { opacity: 1 }
    .tl-year { font-size: 10px; font-weight: 700; letter-spacing: .18em; text-transform: uppercase; color: var(--orange); margin-bottom: 8px }
    .tl-title { font-size: 17px; font-weight: 700; letter-spacing: -.02em; color: #fff; margin-bottom: 8px; line-height: 1.25 }
    .tl-desc { font-size: 13px; line-height: 1.75; color: rgba(255,255,255,.5) }
    .tl-row--current::before { width: 14px; height: 14px; background: var(--orange); box-shadow: 0 0 0 4px rgba(232,145,43,.22), 0 0 12px rgba(232,145,43,.3) }
    .tl-row--current .tl-title { color: #fff; font-size: 19px }
    .tl-row--current .tl-desc { color: rgba(255,255,255,.72) }

    /* Leadership */
    .team { padding: 96px 0; background: var(--bg-warm); position: relative; z-index: 1 }
    .team-head { margin-bottom: 48px }
    .team-head h2 { font-size: clamp(28px,3vw,42px); font-weight: 700; letter-spacing: -.035em; line-height: 1.15 }
    .team-grid { display: grid; grid-template-columns: repeat(5,1fr); gap: 16px }
    .person-wrap { position: relative }
    .person { position: relative; overflow: hidden; clip-path: polygon(0 0, 100% 0, 100% calc(100% - 80px), calc(100% - 80px) 100%, 0 100%) }
    .person figure { margin: 0; overflow: hidden }
    .person img { aspect-ratio: 3/4; object-fit: cover; object-position: center 12%; width: 100%; display: block; transition: transform 1.1s var(--ease) }
    .person:hover img { transform: scale(1.05) }
    .person::after { content: ''; position: absolute; inset: 0; background: linear-gradient(to top, rgba(0,0,0,.78) 0%, rgba(0,0,0,.3) 42%, transparent 68%); pointer-events: none }
    .person-info { position: absolute; bottom: 0; left: 0; padding: 20px 18px 24px; z-index: 1 }
    .person .nm { font-size: 17px; font-weight: 700; letter-spacing: -.015em; color: #fff; line-height: 1.2 }
    .person .rl { font-size: 12.5px; color: rgba(255,255,255,.58); margin-top: 5px }
    .li-corner { position: absolute; bottom: 0; right: 0; width: 80px; height: 80px; background: var(--navy); clip-path: polygon(100% 0, 100% 100%, 0 100%); display: flex; align-items: flex-end; justify-content: flex-end; padding: 14px; z-index: 10; transition: background .2s }
    .li-corner:hover { background: var(--navy-deep) }
    .li-corner svg { width: 19px; height: 19px; fill: #fff }

    /* Founder */
    .founder { position: relative; overflow: hidden; background: var(--paper-2); z-index: 1; padding: 80px 0 }
    .founder-grid { display: grid; grid-template-columns: 1fr 1.3fr; gap: 60px; align-items: center }
    .founder-img-side { display: flex; align-items: center; justify-content: center }
    .founder-img-side img { width: 100%; max-width: 360px; height: auto; object-fit: contain; display: block; border-radius: 6px }
    .founder-quote-side { display: flex; flex-direction: column; justify-content: center; gap: 24px }
    .founder-label { font-size: 10px; letter-spacing: .24em; text-transform: uppercase; color: var(--orange); font-weight: 700; display: block; margin-bottom: 4px }
    .founder-pre { font-size: clamp(24px,2.6vw,38px); font-weight: 800; letter-spacing: -.04em; color: var(--ink); line-height: 1.1 }
    .founder-quote { font-size: clamp(15px,1.4vw,17px); line-height: 1.88; color: var(--muted); font-style: normal; padding-left: 20px; border-left: 2px solid var(--orange); margin: 8px 0 }
    .founder-attr { display: flex; flex-direction: column; gap: 4px; padding-top: 4px }
    .founder-attr .name { font-size: 15px; font-weight: 700; color: var(--ink) }
    .founder-attr .title { font-size: 13px; color: var(--muted-2); letter-spacing: .06em }

    /* CTA override */
    .cta { padding: 80px 0 }

    @@supports (height: 100dvh) {
      .about-split, .approach, .cta { min-height: 100dvh }
    }

    @@media (max-width: 1100px) {
      .about-content { padding: 72px 48px }
      .founder-quote-side { padding: 72px 52px }
    }
    @@media (max-width: 900px) {
      .about-split { grid-template-columns: 1fr; min-height: auto }
      .about-img-side { min-height: 340px }
      .about-img-side::after { display: none }
      .about-content { padding: 56px 28px }
      .approach-grid { grid-template-columns: 1fr }
      .approach { min-height: auto }
      .approach-inner { padding: 88px 0 }
      .approach-head { margin-bottom: 36px }
      .approach-card { padding: 28px 0 }
      .purpose-box { padding: 24px 0 }
      .team-grid { grid-template-columns: repeat(3,1fr) }
      .tl-center { margin-left: 20px }
      .tl-center::before { left: 0; transform: none }
      .tl-row { grid-template-columns: 1fr; padding-left: 28px; gap: 0 }
      .tl-row::before { left: -5px; transform: none; top: 8px }
      .tl-left { text-align: left; padding-right: 0 }
      .tl-right { padding-left: 0 }
      .tl-row.odd .tl-right { display: none }
      .tl-row.even .tl-left { display: none }
      .tl-row.even .tl-right { opacity: 1 }
      .founder-grid { grid-template-columns: 1fr; gap: 0; min-height: auto }
      .founder-img-side { padding: 0 0 40px }
      .founder-quote-side { padding: 0 }
    }
    @@media (max-width: 600px) {
      .hero { padding: 120px 0 72px }
      .hero-h1 { font-size: clamp(32px,9vw,52px) }
      .hero-body { font-size: 15px }
      .hero-ctas { flex-direction: column; align-items: center }
      .about-content { padding: 48px 28px }
      .approach-inner { padding: 80px 0 100px }
      .approach-head { margin-bottom: 52px }
      .journey-shell { padding: 72px 0 }
      .team-grid { grid-template-columns: 1fr 1fr; gap: 10px }
      .person .nm { font-size: 14px }
      .approach-card { padding: 40px 28px }
      .founder { padding: 60px 0 }
      .founder-grid { gap: 32px }

      /* mobile rhythm */
      .about-img-side { min-height: 260px }
      .about-content h2 { margin-bottom: 14px }
      .about-content > p:not(.eyebrow) { margin-bottom: 24px }
      .purpose-box { padding: 20px 0 }
      .purpose-box h3 { margin-bottom: 8px }
      .approach { min-height: auto }
      .approach-inner { padding: 72px 0 }
      .approach-head { margin-bottom: 28px }
      .approach-card { padding: 22px 0 }
      .approach-num { margin-bottom: 10px }
      .approach-card h3 { margin-bottom: 8px }
      .journey-top { margin-bottom: 28px }
      .tl-center { margin-top: 28px }
      .tl-row { margin-bottom: 32px }
      .team { padding: 72px 0 }
      .team-head { margin-bottom: 28px }
      .founder-img-side { padding-bottom: 28px }
      .founder-quote-side { gap: 14px }
    }
    @@media (max-width: 480px) {
      .about-content { padding: 48px 20px }
    }
  </style>
</head>
<body>

  <!-- NAV -->
  @include('partials.nav')

  @include('partials.company-main')

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


  </script>
</body>
</html>
