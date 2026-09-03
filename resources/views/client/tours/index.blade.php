@php($headerClass = 'internal')
@extends('layouts.client')

@section('hero')
<div class="details-container">
  <div class="details-wrapper">
    <div class="tour-details">
      <h1>{{ trans('Tours') }}</h1>
    </div>
  </div>
</div>
<div class="image">
  <div class="color-overlay"></div>
  <img class="main-placeholder-image tours" style="object-position: top;" src="{{ asset('assets/images/carTourMain.jpg') }}" alt="{{ trans('Tours') }}" />
</div>
@endsection

@section('content')
<section class="tour-list-wrapper">
  <div class="tour-list-container">
    <div class="filter-buttons tours">
      <button data-category="All" class="active">All</button>
      @forelse($categories as $category)
        @if($category->paginatedTours->total())
          <button data-category="{{ \Illuminate\Support\Str::slug($category->translate->title,'-',false) }}">{{ $category->translate->title }}</button>
        @endif
      @empty
      @endforelse
    </div>
    <main class="rooms-main">
      <section class="rooms-wrapper">
        <div class="room-selection-wrapper">
          <div class="room-selection-container">
            <div class="internal-similar-templates rooms">
              @forelse($categories as $category)
                @forelse($category->paginatedTours as $tour)
                <div
                  class="internal-similar-template rooms"
                  data-category="{{ \Illuminate\Support\Str::slug($category->translate->title,'-',false) }}"
                  onclick="window.location.href='{{ route('ClientTourInner',$tour->id.'-'.\Illuminate\Support\Str::slug($tour->translate->title,'-',false)) }}'"
                >
                  <div class="image-container">
                    <img src="{{ $tour->image }}" alt="{{ $tour->translate->title }}" class="main-section-carousel-image" />
                    @if($tour->days || $tour->nights)
                    <div class="top-right-divs">
                      @if($tour->days)
                      <div class="day">
                        <img src="{{ asset('assets/images/icons/day.svg') }}" alt="{{ trans('days') }}" />
                        <p>{{ $tour->days }} {{ trans('days') }}</p>
                      </div>
                      @endif
                      @if($tour->nights)
                      <div class="night">
                        <img src="{{ asset('assets/images/icons/night.svg') }}" alt="{{ trans('nights') }}" />
                        <p>{{ $tour->nights }} {{ trans('nights') }}</p>
                      </div>
                      @endif
                    </div>
                    @endif
                  </div>
                  <div class="template-price">
                    <div class="template-description">
                      <p class="type-of-room">{{ $category->translate->title }}</p>
                      {!! $tour->translate->short_description !!}
                      <p class="price-of-room">{{ $tour->price }} <span>₾</span></p>
                    </div>
                    <div>
                      <img class="arrow-icon" src="{{ asset('assets/images/icons/rightArrow.svg') }}" alt="Right arrow icon" />
                    </div>
                  </div>
                </div>
                @empty
                @endforelse
                {{ $category->paginatedTours->links('vendor.pagination.default') }}
              @empty
              @endforelse
            </div>
          </div>
        </div>
      </section>
    </main>
  </div>
</section>
@endsection
