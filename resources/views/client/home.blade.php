@php
$prodsCat = \App\Models\Product::groupBy('category_id')->pluck('category_id')->toArray();
@endphp
@extends('layouts.client')
@section('content')
<main class="index-main">
    <section class="index-title">
      <h1>
        {{ $slider->translate->title }}
      </h1>
      <p>
      {!! $slider->translate->short_description !!}
      @if(!is_null($slider->url))
       </p>
        <a href="{{ $slider->url }}"><button>{{ !is_null($slider->translate->button_title) ? $slider->translate->button_title : trans('See more') }}</button></a>
      @endif
    </section>
    <section class="index-image">
      <img src="{{ $slider->image }}" alt="Hotel View" />
    </section>
  </main>
  <section class="internal-similar-templates-wrapper">
    <div class="internal-similar-templates-container">
      <div class="internal-similar-templates-header">
        <div class="internal-similar-templates-title">{{ trans('Rooms') }}</div>
        <button
          class="internal-templates-see-all"
          onclick="window.location.href='{{ route('ClientRooms') }}'"
        >
          {{ trans('See all') }}
        </button>
      </div>
      <div class="filter-buttons">
        <button data-category="All" class="active">All</button>
        @forelse($rooms as $room)
        @if(in_array($room->id,$prodsCat))
            <button data-category="{{ \Illuminate\Support\Str::slug($room->translate->title,'-',false) }}">{{ $room->translate->title }}</button>
        @endif
        @empty
        @endforelse
      </div>
      <div class="internal-similar-templates">
        @forelse($rooms as $room)
            @forelse($room->products as $product)
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
        @empty
        @endforelse
      </div>
    </div>
  </section>
  <div class="grey-line"></div>
  <section class="internal-similar-templates-wrapper service">
    <div class="internal-similar-templates-container">
      <div class="internal-similar-templates-header">
        <div class="internal-similar-templates-title">{{ trans('Services') }}</div>
        <button
          class="internal-templates-see-all"
          onclick="window.location.href='{{ route('ClientServices') }}'"
        >
          See all
        </button>
      </div>
      <div class="internal-similar-templates service">
      @forelse($services as $service)
      @php
            $slug  = createSlug($service->translate->title);
    @endphp

        <div
          class="internal-similar-template service"
          onclick="window.location.href='{{ route('ClientServiceInner', $service->id) }}-{{ $slug }}'"
        >
          <div class="image-container">
            <img
              src="{{ $service->image }}"
              alt="Services"
              class="main-section-carousel-image"
            />
          </div>
          <div class="template-price">
            <div class="template-description">
              <p>{{ $service->translate->title }}</p>
                {!! $service->translate->short_description !!}
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
      </div>
    </div>
  </section>
  <div class="grey-line"></div>

  <section class="index-about-us">
    <div class="about-us-wrapper">
      <h2>{{ trans('About') }}</h2>
      <div class="about-us-container">
        <div class="about-us-paragraphs">
            {!! $about->short_description !!}

          <button
            class="internal-templates-see-all"
            onclick="window.location.href='{{ route('ClientAbout') }}'"
          >
            {{ trans('See more') }}
          </button>
        </div>
        <div class="about-us-image-container">
          <img src="{{ $about->image }}" alt="{{ $about->title }}" />
        </div>
      </div>
    </div>
  </section>
@endsection
