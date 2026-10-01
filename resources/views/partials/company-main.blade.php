<!-- HERO -->
<section class="hero">
  <img class="hero-bg" src="{{ \App\Services\CmsStore::media($cms['hero']['image']) }}" alt="">
  <div class="wrap hero-in">
    <h1 class="hero-h1 rise">{!! $cms['hero']['headline'] !!}</h1>
    <p class="hero-body rise d1">{{ $cms['hero']['text'] }}</p>
  </div>
</section>

<!-- ABOUT -->
<section class="about" id="about">
  <div class="about-split">
    <div class="about-img-side">
      <img src="{{ \App\Services\CmsStore::media($cms['about']['image']) }}" alt="{{ $cms['about']['alt'] }}">
    </div>
    <div class="wrap" style="padding-top:0;padding-bottom:0;display:contents">
      <div class="about-content rv">
        <p class="eyebrow">{{ $cms['about']['eyebrow'] }}</p>
        <h2>{!! $cms['about']['headline'] !!}</h2>
        <p>{{ $cms['about']['intro'] }}</p>
        <div class="purpose-pair">
          <div class="purpose-box">
            <p class="eyebrow">{{ $cms['about']['purpose_label'] }}</p>
            <h3>{{ $cms['about']['purpose_title'] }}</h3>
            <p>{{ $cms['about']['purpose_text'] }}</p>
          </div>
          <div class="purpose-box">
            <p class="eyebrow">{{ $cms['about']['ambition_label'] }}</p>
            <h3>{{ $cms['about']['ambition_title'] }}</h3>
            <p>{{ $cms['about']['ambition_text'] }}</p>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- APPROACH -->
<section class="approach">
  <div class="wrap">
    <div class="approach-inner">
      <div class="approach-head rv">
        <p class="eyebrow">{{ $cms['approach']['eyebrow'] }}</p>
        <h2>{!! $cms['approach']['headline'] !!}</h2>
      </div>
      <div class="approach-grid">
        @foreach ($cms['approach']['items'] as $item)
          <div class="approach-card rv">
            <span class="approach-num">{{ $item['number'] }}</span>
            <h3>{{ $item['title'] }}</h3>
            <p>{{ $item['text'] }}</p>
          </div>
        @endforeach
      </div>
    </div>
  </div>
</section>

<!-- JOURNEY -->
<section class="journey-shell" id="journey">
  <div class="wrap" style="position:relative;z-index:1">
    <div class="journey-top rv">
      <p class="eyebrow">{{ $cms['journey']['eyebrow'] }}</p>
      <h2>{{ $cms['journey']['headline'] }}</h2>
      <p>{{ $cms['journey']['intro'] }}</p>
    </div>
    <div class="tl-center">
      @foreach ($cms['journey']['events'] as $event)
        <div class="tl-row {{ $loop->odd ? 'odd' : 'even' }} {{ $loop->last ? 'tl-row--current' : '' }} rv">
          @if ($loop->odd)
            <div class="tl-left">
              <div class="tl-year">{{ $event['year'] }}</div>
              <div class="tl-title">{{ $event['title'] }}</div>
              <div class="tl-desc">{{ $event['text'] }}</div>
            </div>
            <div class="tl-right"></div>
          @else
            <div class="tl-left"></div>
            <div class="tl-right">
              <div class="tl-year">{{ $event['year'] }}</div>
              <div class="tl-title">{{ $event['title'] }}</div>
              <div class="tl-desc">{{ $event['text'] }}</div>
            </div>
          @endif
        </div>
      @endforeach
    </div>
  </div>
</section>

<!-- LEADERSHIP -->
<section class="team">
  <div class="wrap">
    <div class="team-head rv">
      <p class="eyebrow">{{ $cms['team']['eyebrow'] }}</p>
      <h2>{{ $cms['team']['headline'] }}</h2>
    </div>
    <div class="team-grid">
      @foreach ($cms['team']['people'] as $person)
        <div class="person-wrap rv">
          <div class="person">
            <figure><img src="{{ \App\Services\CmsStore::media($person['image']) }}" alt="{{ $person['name'] }}"></figure>
            <div class="person-info"><div class="nm">{{ $person['name'] }}</div><div class="rl">{{ $person['role'] }}</div></div>
          </div>
          <a href="{{ $person['linkedin'] !== '' ? $person['linkedin'] : '#' }}" class="li-corner" @if ($person['linkedin'] !== '') target="_blank" rel="noopener" @endif>
            <svg viewBox="0 0 24 24"><path d="M20.447 20.452h-3.554v-5.569c0-1.328-.027-3.037-1.852-3.037-1.853 0-2.136 1.445-2.136 2.939v5.667H9.351V9h3.414v1.561h.046c.477-.9 1.637-1.85 3.37-1.85 3.601 0 4.267 2.37 4.267 5.455v6.286zM5.337 7.433c-1.144 0-2.063-.926-2.063-2.065 0-1.138.92-2.063 2.063-2.063 1.14 0 2.064.925 2.064 2.063 0 1.139-.925 2.065-2.064 2.065zm1.782 13.019H3.555V9h3.564v11.452zM22.225 0H1.771C.792 0 0 .774 0 1.729v20.542C0 23.227.792 24 1.771 24h20.451C23.2 24 24 23.227 24 22.271V1.729C24 .774 23.2 0 22.222 0h.003z"/></svg>
          </a>
        </div>
      @endforeach
    </div>
  </div>
</section>

<!-- FOUNDER'S PERSPECTIVE -->
<section class="founder">
  <div class="wrap">
    <div class="founder-grid">
      <div class="founder-img-side">
        <img src="{{ \App\Services\CmsStore::media($cms['founder']['image']) }}" alt="{{ $cms['founder']['alt'] }}">
      </div>
      <div class="founder-quote-side rv">
        <span class="founder-label">{{ $cms['founder']['label'] }}</span>
        <h2 class="founder-pre">{!! $cms['founder']['headline'] !!}</h2>
        <p class="founder-quote">{{ $cms['founder']['quote'] }}</p>
        <div class="founder-attr">
          <div class="name">{{ $cms['founder']['name'] }}</div>
          <div class="title">{{ $cms['founder']['role'] }}</div>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- CTA -->
<section class="cta">
  <img class="cta-bg" referrerpolicy="no-referrer" src="{{ \App\Services\CmsStore::media($cms['cta']['image']) }}" alt="">
  <div class="wrap cta-in">
    <h2 class="rv">{!! $cms['cta']['headline'] !!}</h2>
    <p class="cta-body rv">{{ $cms['cta']['text'] }}</p>
    <a href="{{ \App\Services\CmsStore::href($cms['cta']['button_url']) }}" class="btn btn-orange rv">{{ $cms['cta']['button_label'] }} <span class="arw">→</span></a>
  </div>
</section>
