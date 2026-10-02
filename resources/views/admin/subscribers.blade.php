@extends('admin.layout')

@section('title', 'Subscribers')
@section('kicker', 'Stay Informed')
@section('heading', 'Subscribers')
@section('actions')
  <a class="save" href="{{ route('admin.subscribers.export') }}">Export CSV</a>
@endsection

@section('body')
  @if ($subscribers->isEmpty())
    <p class="lede">No subscribers yet. When someone joins Stay Informed, their email will appear here.</p>
  @else
    <div class="inbox">
      @foreach ($subscribers as $subscriber)
        <article class="letter">
          <header>
            <strong>{{ $subscriber->email }}</strong>
            <div class="letter-tools">
              <time>{{ $subscriber->created_at->timezone(config('app.timezone'))->format('j M Y, H:i') }}</time>
              <form method="POST" action="{{ route('admin.subscribers.destroy', $subscriber) }}">
                @csrf
                @method('DELETE')
                <button class="text-btn danger" type="submit" data-confirm="Delete this subscriber?">Delete</button>
              </form>
            </div>
          </header>
          <p class="letter-meta">Signed up from {{ ucfirst($subscriber->source) }}</p>
        </article>
      @endforeach
    </div>
  @endif
@endsection
