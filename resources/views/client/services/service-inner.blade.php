@extends('layouts.client')
@section('content')
<main class="rooms-internal-main">
    <section class="products-internal-wrapper">
      <div class="products-internal-container services">
        <div class="products-internal-left-column services">
          <h1>{{ $service->translate->title }}</h1>
          {!! $service->translate->description !!}
        </div>
        <div class="products-internal-right-column">
          <img
            src="{{ $service->image }}"
            alt="{{ $service->translate->title }}"
            class="products-internal-large"
          />
          @if($service->images->isNotEmpty())
            @forelse($service->images as $img)
            <div class="products-internal-small-images">
                <img
                src="{{ $img->image }}"
                alt="Hotel Image 2"
                class="products-internal-small"
                />
            </div>
            @empty
            @endforelse
          @endif
        </div>
      </div>
    </section>
  </main>


@endsection
