@extends('admin.layout')

@section('title', 'Messages')
@section('kicker', 'Inbox')
@section('heading', 'Messages')

@section('body')
  @if ($messages->isEmpty())
    <p class="lede">No messages yet. When someone uses a form on the site, it will appear here.</p>
  @else
    <div class="inbox">
      @foreach ($messages as $message)
        <article class="letter">
          <header>
            <strong>{{ $message->name ?: 'No name' }}</strong>
            <time>{{ $message->created_at->timezone(config('app.timezone'))->format('j M Y, H:i') }}</time>
          </header>
          <p class="letter-meta">
            {{ ucfirst($message->source) }}
            @if ($message->inquiry) · {{ $message->inquiry }} @endif
            @if ($message->email) · {{ $message->email }} @endif
            @if ($message->phone) · {{ $message->phone }} @endif
          </p>
          @if ($message->business || $message->country)
            <p class="letter-meta">{{ $message->business }} {{ $message->country }}</p>
          @endif
          @if ($message->message)
            <p>{{ $message->message }}</p>
          @endif
        </article>
      @endforeach
    </div>
  @endif
@endsection
