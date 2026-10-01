@php
  $wide = in_array($field['type'], ['textarea', 'html', 'image', 'video', 'note'], true);
@endphp

@if ($field['type'] === 'note')
  <h3 class="field-note">{{ $field['label'] }}</h3>
@elseif ($field['type'] === 'check')
  <label class="check {{ $wide ? 'wide' : '' }}">
    <input type="hidden" name="{{ $name }}" value="0">
    <input type="checkbox" name="{{ $name }}" value="1" @checked(filter_var($value, FILTER_VALIDATE_BOOLEAN))>
    <span>
      {{ $field['label'] }}
      @if ($field['hint'])<small>{{ $field['hint'] }}</small>@endif
    </span>
  </label>
@elseif ($field['type'] === 'select')
  <label class="{{ $wide ? 'wide' : '' }}">
    {{ $field['label'] }}
    <select name="{{ $name }}">
      @foreach ($field['options'] as $optionValue => $optionLabel)
        <option value="{{ $optionValue }}" @selected((string) $value === (string) $optionValue)>{{ $optionLabel }}</option>
      @endforeach
    </select>
    @if ($field['hint'])<small>{{ $field['hint'] }}</small>@endif
  </label>
@elseif (in_array($field['type'], ['image', 'video'], true))
  <div class="media wide">
    <span class="media-label">{{ $field['label'] }}</span>
    @if ($value)
      @if ($field['type'] === 'video')
        <video src="{{ \App\Services\CmsStore::media($value) }}" muted playsinline></video>
      @else
        <img src="{{ \App\Services\CmsStore::media($value) }}" alt="">
      @endif
    @endif
    <input type="hidden" name="{{ $name }}" value="{{ $value }}">
    <input type="file" name="{{ $file }}" accept="{{ $field['type'] === 'video' ? 'video/mp4,video/webm' : 'image/*' }}">
    @if ($value)
      <label class="check slim">
        <input type="checkbox" name="{{ $remove }}" value="1">
        <span>Remove this {{ $field['type'] === 'video' ? 'video' : 'image' }}</span>
      </label>
    @endif
    @if ($field['hint'])<small>{{ $field['hint'] }}</small>@endif
  </div>
@else
  <label class="{{ $wide ? 'wide' : '' }}">
    {{ $field['label'] }}
    @if ($field['type'] === 'textarea' || $field['type'] === 'html')
      <textarea name="{{ $name }}" rows="{{ $field['type'] === 'html' ? 16 : 4 }}">{{ $value }}</textarea>
    @else
      <input type="text" name="{{ $name }}" value="{{ $value }}">
    @endif
    @if ($field['hint'])<small>{{ $field['hint'] }}</small>@endif
  </label>
@endif
