<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>{{ $cms['seo']['title'] }}</title>
  <link rel="icon" href="{{ asset('favicon1.png') }}">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;0,800;1,400;1,500&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="{{ asset('styles.css') }}">
  <style>
    /* HERO OVERRIDES */
    .hero-bg { opacity:.3 }
    .hero::after { background:linear-gradient(150deg,rgba(8,11,28,.96) 0%,rgba(8,11,28,.62) 52%,rgba(20,31,71,.5) 100%) }
    .hero-in { padding-top:140px; padding-bottom:100px; max-width:680px }
    .hero-quick { display:flex; gap:32px; flex-wrap:wrap; justify-content:center }
    .hero-quick-item { display:flex; align-items:center; gap:10px }
    .hero-quick-item svg { width:18px; height:18px; stroke:var(--orange); fill:none; stroke-width:2; stroke-linecap:round; stroke-linejoin:round; flex-shrink:0 }
    .hero-quick-item span { font-size:14px; color:rgba(255,255,255,.7); font-weight:500 }

    /* CONTACT SECTION */
    .contact-section { background:var(--ink); position:relative; overflow:hidden; min-height:100vh; display:flex; flex-direction:column; justify-content:center; padding:80px 0 }
    .contact-section::after { content:''; position:absolute; inset:0; background:radial-gradient(ellipse 55% 65% at 80% 50%,rgba(28,42,94,.5) 0%,transparent 65%),radial-gradient(ellipse 40% 55% at 10% 70%,rgba(232,145,43,.05) 0%,transparent 60%) }
    .contact-section > .wrap { width:100% }
    .contact-grid { position:relative; z-index:2; display:grid; grid-template-columns:1fr 1.45fr; gap:80px; align-items:center }
    .contact-left h2 { font-size:clamp(28px,3vw,42px); font-weight:800; letter-spacing:-.04em; line-height:1.08; color:#fff; margin-bottom:20px }
    .contact-left p { font-size:15px; line-height:1.8; color:rgba(255,255,255,.55); margin-bottom:32px }
    .inquiry-types { display:flex; flex-direction:column; gap:0; border:1px solid rgba(255,255,255,.1) }
    .inquiry-type { padding:20px 24px; border-bottom:1px solid rgba(255,255,255,.08); cursor:pointer; transition:background .3s var(--ease); display:flex; align-items:center; gap:16px }
    .inquiry-type:last-child { border-bottom:none }
    .inquiry-type:hover { background:rgba(255,255,255,.04) }
    .inquiry-type.active { background:rgba(232,145,43,.08); border-left:2px solid var(--orange); padding-left:22px }
    .inquiry-dot { width:8px; height:8px; border-radius:50%; background:rgba(255,255,255,.2); flex-shrink:0; transition:background .3s var(--ease) }
    .inquiry-type.active .inquiry-dot { background:var(--orange) }
    .inquiry-type-title { font-size:13px; font-weight:700; color:rgba(255,255,255,.8); margin-bottom:3px; transition:color .3s var(--ease) }
    .inquiry-type.active .inquiry-type-title { color:#fff }
    .inquiry-type-sub { font-size:12px; color:rgba(255,255,255,.38) }
    .contact-detail-row { display:flex; flex-direction:column; gap:20px }
    .contact-detail { display:flex; gap:14px; align-items:center }
    .contact-detail svg { width:16px; height:16px; stroke:var(--orange); fill:none; stroke-width:2; stroke-linecap:round; stroke-linejoin:round; flex-shrink:0 }
    .contact-detail-label { font-size:10px; letter-spacing:.15em; text-transform:uppercase; font-weight:700; color:rgba(255,255,255,.35); margin-bottom:3px }
    .contact-detail-value { font-size:14px; color:rgba(255,255,255,.75); font-weight:600 }

    /* FORM WRAPPER */
    .contact-form-wrap { background:var(--paper); border:1px solid var(--line); padding:44px }
    .form-submit-row { display:flex; align-items:center; justify-content:space-between; gap:24px; flex-wrap:wrap; margin-top:8px }
    .form-note { font-size:12px; color:rgba(255,255,255,.28); line-height:1.65; max-width:240px }

    /* LOCATION */
    .location-section { padding:0; background:var(--paper-2); display:grid; grid-template-columns:1fr 1fr; min-height:100vh }
    .location-map { overflow:hidden; position:relative }
    .location-map iframe { width:100%; height:100%; min-height:440px; border:0; display:block }
    .location-content { padding:80px 72px; display:flex; flex-direction:column; justify-content:center }
    .location-content h2 { font-size:clamp(22px,2.4vw,34px); font-weight:800; letter-spacing:-.035em; margin-bottom:18px; line-height:1.1; color:var(--ink) }
    .location-content > p { font-size:15px; line-height:1.8; color:var(--muted); margin-bottom:36px }
    .location-items { display:flex; flex-direction:column; gap:22px }
    .loc-item { display:flex; gap:14px; align-items:flex-start }
    .loc-icon { width:36px; height:36px; background:var(--paper); border:1px solid var(--line); display:flex; align-items:center; justify-content:center; flex-shrink:0 }
    .loc-icon svg { width:15px; height:15px; stroke:var(--orange); fill:none; stroke-width:2; stroke-linecap:round; stroke-linejoin:round }
    .loc-label { font-size:10px; letter-spacing:.14em; text-transform:uppercase; font-weight:700; color:var(--muted-2); margin-bottom:4px }
    .loc-val { font-size:14px; color:var(--navy); font-weight:600; line-height:1.6 }

    /* SPECIALIZED CONTACTS */
    .spec-section { background:var(--paper); position:relative; z-index:1; border-top:1px solid var(--line); padding:80px 28px }
    .spec-split { display:grid; grid-template-columns:1fr 1fr; min-height:480px; max-width:var(--max); margin:0 auto }
    .spec-content { padding:96px 72px; display:flex; flex-direction:column; justify-content:center; border-right:1px solid var(--line) }
    .spec-content h3 { font-size:clamp(20px,2vw,28px); font-weight:700; letter-spacing:-.03em; color:var(--navy); margin-bottom:20px; line-height:1.2 }
    .spec-content p { font-size:15px; line-height:1.85; color:var(--muted); margin-bottom:36px; max-width:480px }
    .spec-link { font-size:10px; letter-spacing:.18em; text-transform:uppercase; font-weight:700; color:var(--navy); display:inline-flex; align-items:center; gap:10px; border-bottom:1px solid var(--line); padding-bottom:4px; transition:border-color .35s var(--ease) }
    .spec-link:hover { border-color:var(--orange) }
    .spec-img { overflow:hidden; position:relative }
    .spec-img img { width:100%; height:100%; object-fit:cover; display:block }

    @@supports(height:100dvh) { .contact-section,.location-section { min-height:100dvh } }

    @@media(max-width:1000px) {
      .contact-grid { grid-template-columns:1fr; gap:56px }
      .inquiry-types { flex-direction:row; flex-wrap:wrap; border:none; gap:10px }
      .inquiry-type { border:1px solid rgba(255,255,255,.1); flex:1 1 calc(50% - 5px); min-width:160px }
      .inquiry-type.active { border-left-width:1px; border-color:var(--orange) }
      .location-section { grid-template-columns:1fr; min-height:auto }
      .location-content { padding:60px 28px }
    }
    @@media(max-width:900px) {
      .spec-split { grid-template-columns:1fr }
      .spec-img { min-height:340px }
      .spec-content { border-right:none; padding:0 0 48px }
      .spec-img { min-height:280px }
    }
    @@media(max-width:640px) {
      .hero-h1 { font-size:clamp(32px,9vw,52px) }
      .hero-in { padding-top:120px; padding-bottom:80px }
      .spec-section { padding:64px 20px }
      .contact-section { padding:64px 0; min-height:auto }
      .contact-form-wrap { padding:28px 20px }
      .hero-quick { gap:18px }

      /* mobile rhythm */
      .spec-content h3 { margin-bottom:12px }
      .spec-content p { margin-bottom:24px }
      .contact-grid { gap:36px }
      .contact-left h2 { margin-bottom:12px }
      .contact-left p { margin-bottom:24px }
      .inquiry-type { flex:1 1 100%; padding:16px 18px }
      .location-map iframe { min-height:300px }
      .location-content { padding:48px 20px }
      .location-content h2 { margin-bottom:12px }
      .location-content > p { margin-bottom:24px }
      .location-items { gap:16px }
    }
  </style>
</head>
<body>

  @include('partials.nav')

  @include('partials.contact-main')

  <!-- FOOTER -->
  @include('partials.footer')

  <script src="{{ asset('reveal.js') }}"></script>

  <script>
    const hdr = document.getElementById('hdr');
    let lastY = window.scrollY;
    addEventListener('scroll', () => {
      const y = window.scrollY;
      hdr.classList.toggle('solid', y > 60);
      if (y > lastY && y > 80) hdr.classList.add('nav-hidden');
      else if (y < lastY || y <= 80) hdr.classList.remove('nav-hidden');
      lastY = y;
    }, { passive: true });
    const burger = document.getElementById('burger');
    const navLinks = document.getElementById('navLinks');
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

    document.querySelectorAll('.inquiry-type').forEach(tab => {
      tab.addEventListener('click', () => {
        document.querySelectorAll('.inquiry-type').forEach(t => t.classList.remove('active'));
        tab.classList.add('active');
        const field = document.getElementById('inquiryField');
        const title = tab.querySelector('.inquiry-type-title');
        if (field && title) field.value = title.textContent.trim();
      });
    });

  </script>
</body>
</html>
