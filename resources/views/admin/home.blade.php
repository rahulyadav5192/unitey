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
    @if ($messages !== null)
      <a class="card" href="{{ route('admin.messages') }}">
        <span class="card-count">{{ $messages }} received</span>
        <strong>Messages</strong>
        <p>Inquiries sent from the contact page and the partners page.</p>
        <span class="card-go">Open</span>
      </a>
    @endif
    @if ($subscribers !== null)
      <a class="card" href="{{ route('admin.subscribers') }}">
        <span class="card-count">{{ $subscribers }} signed up</span>
        <strong>Subscribers</strong>
        <p>Email addresses from the Stay Informed form on News.</p>
        <span class="card-go">Open</span>
      </a>
    @endif
    @if ($users !== null)
      <a class="card" href="{{ route('admin.users.index') }}">
        <span class="card-count">{{ $users }} people</span>
        <strong>Users</strong>
        <p>Who can sign in, and which role each person has.</p>
        <span class="card-go">Manage</span>
      </a>
    @endif
    @if ($roles !== null)
      <a class="card" href="{{ route('admin.roles.index') }}">
        <span class="card-count">{{ $roles }} roles</span>
        <strong>Roles</strong>
        <p>Choose which sidebar items each role can open.</p>
        <span class="card-go">Manage</span>
      </a>
    @endif
  </div>
@endsection
