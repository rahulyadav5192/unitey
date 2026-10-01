<!-- LEGAL HERO -->
<section class="legal-hero">
  <div class="legal-hero-in">
    <span class="legal-label">{{ $cms['hero']['label'] }}</span>
    <h1 class="legal-title">{{ $cms['hero']['title'] }}</h1>
    <div class="legal-meta">{{ $cms['hero']['date'] }}</div>
  </div>
</section>

<article class="legal-body">
  {!! $cms['document']['html'] !!}
</article>
