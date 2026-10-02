@extends('admin.layout')

@section('title', 'No access')
@section('kicker', 'Access')
@section('heading', 'You do not have access to that')

@section('body')
  <p class="lede">Your role does not include this part of the admin. Ask an administrator if you need it.</p>
@endsection
