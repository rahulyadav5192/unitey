<!-- HERO -->
<section class="hero">
  <img class="hero-bg" src="{{ \App\Services\CmsStore::media($cms['hero']['image']) }}" alt="">
  <div class="wrap hero-in">
    <h1 class="hero-h1 rise">{{ $cms['hero']['headline'] }}</h1>
  </div>
</section>

<!-- STRATEGIC PARTNERS -->
<section class="partners-section" id="partners">
  <div class="wrap">
    <div class="partners-head rv">
      <h2>{{ $cms['list']['headline'] }}</h2>
      <p>{{ $cms['list']['intro'] }}</p>
    </div>
    <div class="partner-strip">
      @foreach ($cms['list']['items'] as $partner)
        <div class="partner-item {{ $loop->even ? 'partner-item--alt' : '' }} rv">
          <div class="partner-logo-side">
            @if ($partner['image_2'] !== '')
              <div class="partner-logo-pair">
                <img src="{{ \App\Services\CmsStore::media($partner['image']) }}" alt="{{ $partner['name'] }}">
                <img src="{{ \App\Services\CmsStore::media($partner['image_2']) }}" alt="{{ $partner['alt_2'] }}">
              </div>
            @else
              <img src="{{ \App\Services\CmsStore::media($partner['image']) }}" alt="{{ $partner['name'] }}">
            @endif
          </div>
          <div class="partner-desc-side">
            <p class="partner-item-desc">{{ $partner['text'] }}</p>
          </div>
        </div>
      @endforeach
    </div>
  </div>
</section>

<!-- PORTFOLIO CTA -->
<section class="pf-cta">
  <img class="pf-cta-bg" referrerpolicy="no-referrer" src="{{ \App\Services\CmsStore::media($cms['cta']['image']) }}" alt="">
  <div class="wrap pf-cta-in rv">
    <div>
      <span class="eyebrow">{{ $cms['cta']['eyebrow'] }}</span>
      <h2>{{ $cms['cta']['headline'] }}</h2>
      <p>{{ $cms['cta']['text'] }}</p>
    </div>
    <a href="{{ \App\Services\CmsStore::href($cms['cta']['button_url']) }}" class="btn btn-orange">{{ $cms['cta']['button_label'] }} <span class="arw">→</span></a>
  </div>
</section>

<!-- STRATEGIC CONNECT FORM -->
<section class="connect" id="connect">
  <div class="wrap">
    <div class="connect-inner">
      <div class="connect-left rv">
        <p class="eyebrow">{{ $cms['connect']['eyebrow'] }}</p>
        <h2>{{ $cms['connect']['headline'] }}</h2>
        <p>{{ $cms['connect']['text'] }}</p>
        <div class="connect-detail">
          <div class="c-detail"><strong>{{ $cms['connect']['email_label'] }}</strong>{{ $cms['connect']['email'] }}</div>
          <div class="c-detail"><strong>{{ $cms['connect']['address_label'] }}</strong>{!! $cms['connect']['address'] !!}</div>
          <div class="c-detail"><strong>{{ $cms['connect']['phone_label'] }}</strong>{{ $cms['connect']['phone'] }}</div>
        </div>
      </div>
      <form class="connect-form rv" method="POST" action="{{ route('inquiries.store') }}">
        @csrf
        <input type="hidden" name="source" value="partners">
        @if (session('sent') === 'partners')
          <p style="margin:0 0 16px;font-weight:600">Thank you. Your message has been received.</p>
        @endif
        <div class="form-row">
          <div class="form-field">
            <label>{{ $cms['connect']['name_label'] }}</label>
            <input type="text" name="name" placeholder="{{ $cms['connect']['name_placeholder'] }}">
          </div>
          <div class="form-field">
            <label>{{ $cms['connect']['email_field'] }}</label>
            <input type="email" name="email" placeholder="{{ $cms['connect']['email_placeholder'] }}">
          </div>
        </div>
        <div class="form-row">
          <div class="form-field">
            <label>{{ $cms['connect']['business_label'] }}</label>
            <input type="text" name="business" placeholder="{{ $cms['connect']['business_placeholder'] }}">
          </div>
          <div class="form-field">
            <label>{{ $cms['connect']['phone_field'] }}</label>
            <input type="tel" name="phone" placeholder="{{ $cms['connect']['phone_placeholder'] }}">
          </div>
        </div>
        <div class="form-row">
          <div class="form-field">
            <label>{{ $cms['connect']['country_label'] }}</label>
            <input type="text" name="country" placeholder="{{ $cms['connect']['country_placeholder'] }}">
          </div>
          <div class="form-field">
            <label>{{ $cms['connect']['inquiry_label'] }}</label>
            <select name="inquiry">
              <option value="" disabled selected>{{ $cms['connect']['inquiry_placeholder'] }}</option>
              @foreach ($cms['connect']['types'] as $type)
                <option>{{ $type['label'] }}</option>
              @endforeach
            </select>
          </div>
        </div>
        <div class="form-field">
          <label>{{ $cms['connect']['message_label'] }}</label>
          <textarea name="message" placeholder="{{ $cms['connect']['message_placeholder'] }}"></textarea>
        </div>
        <button class="btn btn-orange form-submit" type="submit">{{ $cms['connect']['button_label'] }} <span class="arw">→</span></button>
      </form>
    </div>
  </div>
</section>
