<!-- HERO -->
<section class="hero">
  <img class="hero-bg" referrerpolicy="no-referrer" src="{{ \App\Services\CmsStore::media($cms['hero']['image']) }}" alt="">
  <div class="wrap hero-in">
    <h1 class="hero-h1 rise">{{ $cms['hero']['headline'] }}</h1>
    <p class="hero-body rise d1">{{ $cms['hero']['text'] }}</p>
  </div>
</section>

<section class="spec-section">
  <div class="spec-split">
    <div class="spec-content rv">
      <h3>{{ $cms['partnership']['title'] }}</h3>
      <p>{{ $cms['partnership']['text'] }}</p>
      <a href="{{ \App\Services\CmsStore::href($cms['partnership']['button_url']) }}" class="btn btn-navy" style="align-self:flex-start">{{ $cms['partnership']['button_label'] }} <span class="arw">→</span></a>
    </div>
    <div class="spec-img rv">
      <img src="{{ \App\Services\CmsStore::media($cms['partnership']['image']) }}" alt="{{ $cms['partnership']['alt'] }}">
    </div>
  </div>
</section>

<div id="contact-form"></div>
<section class="contact-section">
  <div class="wrap">
    <div class="contact-grid">
      <div class="contact-left rv">
        <span class="eyebrow">{{ $cms['form']['eyebrow'] }}</span>
        <h2>{{ $cms['form']['headline'] }}</h2>
        <p>{{ $cms['form']['text'] }}</p>
        <div class="inquiry-types" id="inquiryTypes">
          @foreach ($cms['form']['types'] as $type)
            <div class="inquiry-type {{ $loop->first ? 'active' : '' }}" data-type="{{ $type['key'] }}">
              <div class="inquiry-dot"></div>
              <div>
                <div class="inquiry-type-title">{{ $type['title'] }}</div>
                <div class="inquiry-type-sub">{{ $type['subtitle'] }}</div>
              </div>
            </div>
          @endforeach
        </div>
        <div class="contact-detail-row" style="margin-top:36px">
          <div class="contact-detail">
            <svg viewBox="0 0 24 24"><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07A19.5 19.5 0 0 1 4.72 12a19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 3.63 1h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L7.91 8.6a16 16 0 0 0 6 6l.96-.96a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"/></svg>
            <div class="contact-detail-body">
              <div class="contact-detail-label">{{ $cms['form']['phone_label'] }}</div>
              <div class="contact-detail-value">{{ $cms['form']['phone'] }}</div>
            </div>
          </div>
          <div class="contact-detail">
            <svg viewBox="0 0 24 24"><path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"/><polyline points="22,6 12,13 2,6"/></svg>
            <div class="contact-detail-body">
              <div class="contact-detail-label">{{ $cms['form']['email_label'] }}</div>
              <div class="contact-detail-value">{{ $cms['form']['email'] }}</div>
            </div>
          </div>
        </div>
      </div>
      <form class="rv" method="POST" action="{{ route('inquiries.store') }}">
        @csrf
        <input type="hidden" name="source" value="contact">
        <input type="hidden" name="inquiry" id="inquiryField" value="{{ $cms['form']['types'][0]['title'] ?? 'General' }}">
        <div class="contact-form-wrap">
          @if (session('sent'))
            <p style="margin:0 0 16px;color:#d7ecda;font-weight:600">Thank you. Your message has been received.</p>
          @endif
          <div class="form-row">
            <div class="form-field">
              <label>{{ $cms['form']['name_label'] }}</label>
              <input type="text" name="name" placeholder="{{ $cms['form']['name_placeholder'] }}">
            </div>
            <div class="form-field">
              <label>{{ $cms['form']['email_field'] }}</label>
              <input type="email" name="email" placeholder="{{ $cms['form']['email_placeholder'] }}">
            </div>
          </div>
          <div class="form-row">
            <div class="form-field">
              <label>{{ $cms['form']['business_label'] }}</label>
              <input type="text" name="business" placeholder="{{ $cms['form']['business_placeholder'] }}">
            </div>
            <div class="form-field">
              <label>{{ $cms['form']['phone_field'] }}</label>
              <input type="tel" name="phone" placeholder="{{ $cms['form']['phone_placeholder'] }}">
            </div>
          </div>
          <div class="form-field">
            <label>{{ $cms['form']['message_label'] }}</label>
            <textarea name="message" placeholder="{{ $cms['form']['message_placeholder'] }}"></textarea>
          </div>
          <div class="form-submit-row">
            <button class="btn btn-orange" type="submit">{{ $cms['form']['button_label'] }} <span class="arw">→</span></button>
          </div>
        </div>
      </form>
    </div>
  </div>
</section>

<div class="location-section">
  <div class="location-map rv">
    <iframe src="{{ $cms['location']['map'] }}" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
  </div>
  <div class="location-content rv">
    <span class="eyebrow">{{ $cms['location']['eyebrow'] }}</span>
    <h2>{{ $cms['location']['headline'] }}</h2>
    <p>{{ $cms['location']['text'] }}</p>
    <div class="location-items">
      <div class="loc-item">
        <div class="loc-icon"><svg viewBox="0 0 24 24"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"/><circle cx="12" cy="10" r="3"/></svg></div>
        <div>
          <div class="loc-label">{{ $cms['location']['address_label'] }}</div>
          <div class="loc-val">{{ $cms['location']['address'] }}</div>
        </div>
      </div>
      <div class="loc-item">
        <div class="loc-icon"><svg viewBox="0 0 24 24"><path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"/><polyline points="22,6 12,13 2,6"/></svg></div>
        <div>
          <div class="loc-label">{{ $cms['location']['email_label'] }}</div>
          <div class="loc-val">{{ $cms['location']['email'] }}</div>
        </div>
      </div>
    </div>
  </div>
</div>
