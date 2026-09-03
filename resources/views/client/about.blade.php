@php($headerClass = 'about-us')
@extends('layouts.client')

@section('hero')
<div class="details-container">
  <div class="details-wrapper">
    <div class="tour-details">
      <h1>{{ trans('About') }}</h1>
      <div class="about-us-paragraph-wrapper">
        {!! $about->description !!}
      </div>
    </div>
  </div>
</div>
<div class="image">
  <h2 class="responsive-title">{{ trans('About') }}</h2>
  <div class="color-overlay"></div>
  <img class="main-placeholder-image about-us" src="{{ $about->image }}" alt="{{ $about->title }}" />
</div>
@endsection

@section('content')
@endsection
