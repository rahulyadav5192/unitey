@extends('admin.layout')

@section('title', 'Overview')
@section('kicker', 'Overview')
@section('heading', 'What do you want to edit?')

@section('body')
  <p class="lede">Each card is a page on the site. Open it, change the words or pictures, and save. The current site content is already filled in.</p>
  <div class="cards">
    @foreach ($pages as $item)
      <a class="card" href="{{ route('admin.edit', $item['slug']) }}">
        <span class="card-count">{{ count($item['sections']) }} sections</span>
        <strong>{{ $item['name'] }}</strong>
        <p>{{ $item['summary'] }}</p>
        <span class="card-go">Edit</span>
      </a>
    @endforeach
    <a class="card" href="{{ route('admin.messages') }}">
      <span class="card-count">{{ $messages }} received</span>
      <strong>Messages</strong>
      <p>Inquiries sent from the contact page and the partners page.</p>
      <span class="card-go">Open</span>
    </a>
  </div>
@endsection
