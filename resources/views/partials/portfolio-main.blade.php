<!-- HERO -->
<section class="hero">
  <img class="hero-bg" src="{{ \App\Services\CmsStore::media($cms['hero']['image']) }}" alt="">
  <div class="wrap hero-in">
    <h1 class="hero-h1 rise">{!! $cms['hero']['headline'] !!}</h1>
    <p class="hero-body rise d1">{{ $cms['hero']['text'] }}</p>
  </div>
</section>

<div class="co-selector" role="navigation" aria-label="Portfolio companies">
  <div class="co-tabs" role="tablist">
    @foreach ($cms['companies']['items'] as $company)
      <button class="co-tab {{ $loop->first ? 'active' : '' }}" role="tab" aria-selected="{{ $loop->first ? 'true' : 'false' }}" aria-controls="panel-{{ $company['anchor'] }}" data-panel="{{ $company['anchor'] }}">
        <img style="--tab-h:{{ $company['tab_height'] }}px" src="{{ \App\Services\CmsStore::media($company['tab_logo']) }}" alt="{{ $company['name'] }}">
      </button>
    @endforeach
  </div>
</div>

@foreach ($cms['companies']['items'] as $company)
  @include('partials.portfolio-company', ['company' => $company])
@endforeach

<!-- CTA -->
<section class="cta">
  <img class="cta-bg" referrerpolicy="no-referrer" src="{{ \App\Services\CmsStore::media($cms['cta']['image']) }}" alt="">
  <div class="wrap cta-in">
    <h2 class="rv">{!! $cms['cta']['headline'] !!}</h2>
    <p class="cta-body rv">{{ $cms['cta']['text'] }}</p>
    <a href="{{ \App\Services\CmsStore::href($cms['cta']['button_url']) }}" class="btn btn-orange rv">{{ $cms['cta']['button_label'] }} <span class="arw">→</span></a>
  </div>
</section>
