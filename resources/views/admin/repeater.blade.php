@php
  $token = str_contains($name, '__') ? '__CHILD__' : '__ROW__';
@endphp
<div class="repeater" data-repeater>
  <div class="rep-head">
    <h3>{{ $group['name'] }}</h3>
    @if (! empty($group['hint']))<p>{{ $group['hint'] }}</p>@endif
  </div>
  <div class="rep-rows">
    @foreach ($items as $index => $item)
      @include('admin.row', [
        'group' => $group,
        'item' => $item,
        'index' => $index,
        'name' => $name,
        'file' => $file,
        'remove' => $remove,
      ])
    @endforeach
  </div>
  <template data-token="{{ $token }}">
    @include('admin.row', [
      'group' => $group,
      'item' => [],
      'index' => $token,
      'name' => $name,
      'file' => $file,
      'remove' => $remove,
    ])
  </template>
  <button class="add" type="button" data-add>Add {{ strtolower($group['item']) }}</button>
</div>
