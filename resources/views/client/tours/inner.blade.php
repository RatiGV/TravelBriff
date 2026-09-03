@php($headerClass = 'internal')
@extends('layouts.client')

@section('hero')
<div class="details-container">
  <div class="details-wrapper">
    <div class="tour-details">
      <h1>{{ $tour->category->translate->title }}</h1>
      <p class="tour-subtitle">{{ $tour->translate->title }}</p>
      <div class="about-us-paragraph-wrapper">
        @if($tour->days || $tour->nights)
        <p>{{ trans('site.duration') }}</p>
        <div>
          <div class="day-night-counter">
            @if($tour->days)
            <div>
              <img src="{{ asset('assets/images/icons/day.svg') }}" alt="{{ trans('days') }}" />
              <p>{{ $tour->days }} {{ trans('days') }}</p>
            </div>
            @endif
            @if($tour->nights)
            <div>
              <img src="{{ asset('assets/images/icons/night.svg') }}" alt="{{ trans('nights') }}" />
              <p>{{ $tour->nights }} {{ trans('nights') }}</p>
            </div>
            @endif
          </div>
        </div>
        @endif
        <div class="tour-description">
          {!! $tour->translate->description !!}
        </div>
        <div class="tour-price-info">
          <div class="tour-price">{{ $tour->price }} <span>₾</span></div>
        </div>
      </div>
    </div>
  </div>
</div>
<div class="image">
  <div class="color-overlay"></div>
  <img class="main-placeholder-image tours-internal" src="{{ $tour->image }}" alt="{{ $tour->translate->title }}" />
  @if(!empty($tour->images) && $tour->images->count())
  <div class="gallery-thumbnails">
    @foreach($tour->images as $img)
    <img src="{{ $img->image }}" alt="{{ $tour->translate->title }} {{ $loop->iteration }}" />
    @endforeach
  </div>
  @endif
</div>
@endsection

@section('content')
<div class="grey-line"></div>

<section class="similar-tours">
  <div class="internal-similar-templates-wrapper">
    <div class="internal-similar-templates-container">
      <div class="internal-similar-templates-header">
        <p class="internal-similar-templates-title">{{ trans('Same Tours') }}</p>
      </div>
      <div class="internal-similar-templates">
        @forelse($sameTours as $sameTour)
        <div
          class="internal-similar-template"
          onclick="window.location.href='{{ route('ClientTourInner',$sameTour->id.'-'.\Illuminate\Support\Str::slug($sameTour->translate->title,'-',false)) }}'"
        >
          <div class="image-container">
            <img src="{{ $sameTour->image }}" alt="{{ $sameTour->translate->title }}" />
            @if($sameTour->days || $sameTour->nights)
            <div class="top-right-divs">
              @if($sameTour->days)
              <div class="day">
                <img src="{{ asset('assets/images/icons/day.svg') }}" alt="{{ trans('days') }}" />
                <span>{{ $sameTour->days }} {{ trans('days') }}</span>
              </div>
              @endif
              @if($sameTour->nights)
              <div class="night">
                <img src="{{ asset('assets/images/icons/night.svg') }}" alt="{{ trans('nights') }}" />
                <span>{{ $sameTour->nights }} {{ trans('nights') }}</span>
              </div>
              @endif
            </div>
            @endif
          </div>
          <div class="template-description">
            <span class="type-of-room">{{ $sameTour->category->translate->title }}</span>
            <div class="template-price">
              <p class="price-of-room">{{ $sameTour->price }} <span>₾</span></p>
            </div>
          </div>
        </div>
        @empty
        @endforelse
      </div>
    </div>
  </div>
</section>
@endsection
