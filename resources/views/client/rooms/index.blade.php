@php
$prodsCat = \App\Models\Product::groupBy('category_id')->pluck('category_id')->toArray();
@endphp
@extends('layouts.client')
@section('content')
<main class="rooms-main">
    <section class="rooms-wrapper">
      <div class="room-buttons">
        <h1>{{ trans('Rooms') }}</h1>
        <div class="filter-buttons">
          <button data-category="All" class="active">All</button>
          @forelse($rooms as $room)
            @if(in_array($room->id,$prodsCat))
                <button data-category="{{ \Illuminate\Support\Str::slug($room->translate->title,'-',false) }}">{{ $room->translate->title }}</button>
            @endif
            @empty
        @endforelse
        </div>
      </div>
      <div class="room-selection-wrapper">
        <div class="room-selection-container">
          <div class="internal-similar-templates rooms">
            @forelse($rooms as $room)
                @forelse($room->paginatedProducts as $product)
            <div
              class="internal-similar-template rooms"
              data-category="{{ \Illuminate\Support\Str::slug($room->translate->title,'-',false) }}"
              onclick="window.location.href='{{ route('ClientRoomInner',$product->id.'-'.\Illuminate\Support\Str::slug($product->translate->title,'-',false)) }}'"
            >
              <div class="image-container">
                <img
                  src="{{ $product->image }}"
                  alt="{{ $product->translate->title }}"
                  class="main-section-carousel-image"
                />
              </div>
              <div class="template-price">
                <div class="template-description">
                  <p class="type-of-room">{{ $room->translate->title }}</p>
                  {!! $product->translate->short_description !!}
                  <p class="price-of-room">{{ $product->price }} <span>Gel</span></p>
                </div>
                <div>
                  <img
                    class="arrow-icon"
                    src="{{ asset('assets/images/icons/rightArrow.svg') }}"
                    alt="Right arrow icon"
                  />
                </div>
              </div>
            </div>

                    @empty
                    @endforelse
                    {{ $room->paginatedProducts->links('vendor.pagination.default') }}
                @empty
                @endforelse

          </div>
        </div>
      </div>
      <div class="room-navigation">
        <div class="left-arrow">
          <img src="{{ asset('assets/images/icons/leftArrow.svg') }}" alt="Move Left" />
        </div>
        <button class="room-button active">1</button>
        <button class="room-button">2</button>
        <button class="room-button">3</button>
        <div class="right-arrow">
          <img src="{{ asset('assets/images/icons/rightArrow.svg') }}" alt="Move Right" />
        </div>
      </div> 
    </section>
  </main>
@endsection
