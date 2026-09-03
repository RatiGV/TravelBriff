@extends('layouts.client')

@section('hero')
<div class="details-container main-details">
  <div class="details-wrapper">
    <div class="tour-details">
      <h1>{{ $slider->translate->title }}</h1>
      <p>{!! $slider->translate->short_description !!}</p>
      <button onclick="window.location.href='{{ !is_null($slider->url) ? $slider->url : route('ClientTours') }}'">
        {{ !is_null($slider->translate->button_title) ? $slider->translate->button_title : trans('Tours') }}
      </button>
    </div>
    <div class="scroll">
      <p>{{ trans('See more') }}</p>
      <img src="{{ asset('assets/images/icons/scroll.svg') }}" alt="Scroll" />
    </div>
  </div>
</div>
<div class="image">
  <div class="color-overlay"></div>
  <img class="main-placeholder-image" src="{{ $slider->image }}" alt="{{ $slider->translate->title }}" />
</div>
@endsection

@section('content')
<section class="internal-similar-templates-wrapper">
  <div class="internal-similar-templates-container">
    <div class="internal-similar-templates-header">
      <div class="internal-similar-templates-title">{{ trans('Tours') }}</div>
      <button class="internal-templates-see-all" onclick="window.location.href='{{ route('ClientTours') }}'">
        {{ trans('See all') }}
      </button>
    </div>
    <div class="filter-buttons">
      <button data-category="All" class="active">All</button>
      @forelse($tourCategories as $category)
        @if($category->products->count())
          <button data-category="{{ \Illuminate\Support\Str::slug($category->translate->title,'-',false) }}">{{ $category->translate->title }}</button>
        @endif
      @empty
      @endforelse
    </div>
    <div class="internal-similar-templates">
      @forelse($tourCategories as $category)
        @forelse($category->products as $product)
        <div
          class="internal-similar-template rooms"
          data-category="{{ \Illuminate\Support\Str::slug($category->translate->title,'-',false) }}"
          onclick="window.location.href='{{ route('ClientTourInner',$product->id.'-'.\Illuminate\Support\Str::slug($product->translate->title,'-',false)) }}'"
        >
          <div class="image-container">
            <img src="{{ $product->image }}" alt="{{ $product->translate->title }}" class="main-section-carousel-image" />
            @if($product->days || $product->nights)
            <div class="top-right-divs">
              @if($product->days)
              <div class="day">
                <img src="{{ asset('assets/images/icons/day.svg') }}" alt="{{ trans('days') }}" />
                <p>{{ $product->days }} {{ trans('days') }}</p>
              </div>
              @endif
              @if($product->nights)
              <div class="night">
                <img src="{{ asset('assets/images/icons/night.svg') }}" alt="{{ trans('nights') }}" />
                <p>{{ $product->nights }} {{ trans('nights') }}</p>
              </div>
              @endif
            </div>
            @endif
          </div>
          <div class="template-price">
            <div class="template-description">
              <p class="type-of-room">{{ $category->translate->title }}</p>
              <p class="price-of-room">{{ $product->price }} <span>₾</span></p>
            </div>
            <div>
              <img class="arrow-icon" src="{{ asset('assets/images/icons/rightArrow.svg') }}" alt="Right arrow icon" />
            </div>
          </div>
        </div>
        @empty
        @endforelse
      @empty
      @endforelse
    </div>
  </div>
</section>

<div class="grey-line"></div>

<section class="index-about-us-wrapper">
  <div class="index-about-us-container">
    <h2>{{ trans('About') }}</h2>
    <div class="index-about-us-content">
      <div>
        {!! $about->short_description !!}
        <button onclick="window.location.href='{{ route('ClientAbout') }}'">{{ trans('See more') }}</button>
      </div>
      <div>
        <img src="{{ $about->image }}" alt="{{ $about->title }}" />
      </div>
    </div>
  </div>
</section>
@endsection
