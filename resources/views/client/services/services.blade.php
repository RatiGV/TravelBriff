@extends('layouts.client')
@section('content')
<main class="rooms-main services">
    <section class="internal-similar-templates-wrapper service page">
      <div class="internal-similar-templates-container">
        <div class="internal-similar-templates-header">
          <div class="room-buttons">
            <h1>{{ trans('Services') }}</h1>
          </div>
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
                alt="{{ $service->translate->title }}"
                class="main-section-carousel-image"
              />
            </div>
            <div class="template-price">
                <div class="template-description services">
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
  </main>
@endsection
