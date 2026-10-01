<!-- HERO -->
<section class="hero">
  <div class="hero__panel hero__panel--l" aria-hidden="true"></div>
  <div class="hero__panel hero__panel--r" aria-hidden="true"></div>
  <div class="hero__filament" aria-hidden="true"></div>
  <div class="wrap hero-inner">
    <h1 class="rise d2">{!! $cms['hero']['headline'] !!}</h1>
    <div class="hero-ctas rise d3">
      <a href="{{ \App\Services\CmsStore::href($cms['hero']['button_url']) }}" class="btn btn-orange">{{ $cms['hero']['button_label'] }} <span class="arw">→</span></a>
    </div>
  </div>
</section>

<!-- COMPANY STATS -->
<section class="stats" id="about">
  <div class="wrap">
    <div class="stats-grid rv">
      <div class="stats-quote">
        <p>{{ $cms['intro']['lead'] }}</p>
        <p class="stats-mission">{{ $cms['intro']['mission'] }}</p>
      </div>
      <div class="stat-cols">
        @foreach ($cms['intro']['stats'] as $stat)
          <div class="stat">
            <div class="n" data-count="{{ $stat['value'] }}" @if ($stat['suffix'] !== '') data-suffix="{{ $stat['suffix'] }}" @endif>0</div>
            <div class="l">{{ $stat['label'] }}</div>
          </div>
        @endforeach
      </div>
    </div>
  </div>
</section>

<!-- STRATEGIC PILLARS -->
<section class="sp-section" id="pillars">
  <div class="wrap">
    <div class="sp-inner">
      <div class="sp-header rv">
        <p class="eyebrow">{{ $cms['pillars']['eyebrow'] }}</p>
        <h2>{{ $cms['pillars']['headline'] }}</h2>
      </div>
      <div class="v4-steps">
        @foreach ($cms['pillars']['items'] as $pillar)
          <div class="v4-step rv">
            <div class="v4-step__dot"><span>{{ str_pad($loop->iteration, 2, '0', STR_PAD_LEFT) }}</span></div>
            <div class="v4-step__img">
              <img src="{{ \App\Services\CmsStore::media($pillar['image']) }}" alt="{{ $pillar['alt'] }}" loading="lazy">
            </div>
            <h3>{{ $pillar['title'] }}</h3>
            <p>{{ $pillar['text'] }}</p>
          </div>
        @endforeach
      </div>
    </div>
  </div>
</section>

<!-- OPERATING COMPANIES -->
<section class="oc-section" id="companies">
  <div class="wrap">
    <div class="oc-inner">
      <div class="oc-header rv">
        <div class="oc-header-text">
          <p class="eyebrow">{{ $cms['network']['eyebrow'] }}</p>
          <h2 class="oc-headline">{!! $cms['network']['headline'] !!}</h2>
          <p class="oc-stmt">{!! $cms['network']['statement'] !!}</p>
        </div>
        <a href="{{ \App\Services\CmsStore::href($cms['network']['button_url']) }}" class="btn btn-navy">{{ $cms['network']['button_label'] }} <span class="arw">→</span></a>
      </div>
      <div class="v12-grid">
        @foreach ($companies as $company)
          <div class="v12-card rv">
            <div class="v12-card-inner">
              <div class="v12-front">
                <img class="co-logo" src="{{ \App\Services\CmsStore::media($company['home_logo']) }}" alt="{{ $company['name'] }}" loading="lazy">
              </div>
              <div class="v12-back">
                <div class="v12-name">{{ $company['name'] }}</div>
                <p class="v12-desc">{{ $company['home_summary'] }}</p>
              </div>
            </div>
          </div>
        @endforeach
      </div>
    </div>
  </div>
</section>

<!-- PARTNERS -->
<section class="partners" id="partners">
  <div class="wrap">
    <p class="eyebrow partners-label">{{ $cms['partners']['label'] }}</p>
    <div class="partners-track">
      <div class="partners-grid rv">
        @foreach ([false, true] as $duplicate)
          @foreach ($cms['partners']['items'] as $partner)
            <div class="partner-logo {{ $duplicate ? 'partner-logo-dup' : '' }}" @if ($duplicate) aria-hidden="true" @endif>
              <img src="{{ \App\Services\CmsStore::media($partner['image']) }}" style="--h:{{ $partner['height'] }}px" alt="{{ $duplicate ? '' : $partner['name'] }}">
            </div>
          @endforeach
        @endforeach
      </div>
    </div>
  </div>
</section>

<!-- SOVEREIGN MAP (standalone fold) -->
<section class="journey-hero" id="sovereign">
  <div class="map"></div>
  <div class="journey-hero-in">
    <h3>{!! $cms['sovereign']['headline'] !!}</h3>
    <p>{{ $cms['sovereign']['text'] }}</p>
    <a href="{{ \App\Services\CmsStore::href($cms['sovereign']['button_url']) }}" class="btn btn-orange">{{ $cms['sovereign']['button_label'] }} <span class="arw">→</span></a>
  </div>
</section>

<!-- INSIGHTS (UNITEY UPDATES) -->
<section class="insights" id="insights">
  <div class="wrap">
    <div class="ins-header rv">
      <div>
        <p class="eyebrow">{{ $cms['insights']['eyebrow'] }}</p>
        <h2>{{ $cms['insights']['headline'] }}</h2>
      </div>
      <a href="{{ \App\Services\CmsStore::href($cms['insights']['button_url']) }}" class="btn btn-navy">{{ $cms['insights']['button_label'] }} <span class="arw">→</span></a>
    </div>
    @php
      $feature = collect($cms['insights']['stories'])->first(fn ($story) => ($story['layout'] ?? '') === 'feature');
      $sideStories = collect($cms['insights']['stories'])->filter(fn ($story) => ($story['layout'] ?? '') !== 'feature')->values();
    @endphp
    <div class="ins-layout">
      @if ($feature)
        <article class="ins-feature rv">
          <figure class="ins-feature-img"><img src="{{ \App\Services\CmsStore::media($feature['image']) }}" alt="{{ $feature['alt'] }}"></figure>
          <div class="ins-feature-body">
            <div class="eyebrow">{{ $feature['eyebrow'] }}</div>
            <h3>{{ $feature['title'] }}</h3>
            @if ($feature['excerpt'] !== '')<p>{{ $feature['excerpt'] }}</p>@endif
            <span class="ins-date">{{ $feature['date'] }}</span>
            <a href="{{ \App\Services\CmsStore::href($feature['url']) }}" @if (str_starts_with($feature['url'], 'http')) target="_blank" rel="noopener" @endif class="readlink">Read</a>
          </div>
        </article>
      @endif
      <div class="ins-row">
        @foreach ($sideStories as $story)
          @if (($story['layout'] ?? '') === 'thumb')
            <article class="ins-item rv">
              <div class="eyebrow">{{ $story['eyebrow'] }}</div>
              <h4>{{ $story['title'] }}</h4>
              <div class="ins-item-foot">
                <span class="ins-date">{{ $story['date'] }}</span>
                <a href="{{ \App\Services\CmsStore::href($story['url']) }}" @if (str_starts_with($story['url'], 'http')) target="_blank" rel="noopener" @endif class="readlink">Read</a>
              </div>
              @if ($story['image'] !== '')
                <figure class="ins-thumb"><img src="{{ \App\Services\CmsStore::media($story['image']) }}" alt="{{ $story['alt'] }}"></figure>
              @endif
            </article>
          @else
            <article class="ins-item ins-item-noimg rv">
              <div class="eyebrow">{{ $story['eyebrow'] }}</div>
              <h4>{{ $story['title'] }}</h4>
              <div class="ins-item-foot">
                <span class="ins-date">{{ $story['date'] }}</span>
                <a href="{{ \App\Services\CmsStore::href($story['url']) }}" @if (str_starts_with($story['url'], 'http')) target="_blank" rel="noopener" @endif class="readlink">Read</a>
              </div>
            </article>
          @endif
        @endforeach
      </div>
    </div>
  </div>
</section>

<!-- CTA -->
<section class="cta" id="contact">
  <img referrerpolicy="no-referrer" src="{{ \App\Services\CmsStore::media($cms['cta']['image']) }}" alt="">
  <div class="wrap cta-in">
    <h2 class="rv">{!! $cms['cta']['headline'] !!}</h2>
    <p class="cta-body rv">{{ $cms['cta']['text'] }}</p>
    <a href="{{ \App\Services\CmsStore::href($cms['cta']['button_url']) }}" class="btn btn-orange rv">{{ $cms['cta']['button_label'] }} <span class="arw">→</span></a>
  </div>
</section>
