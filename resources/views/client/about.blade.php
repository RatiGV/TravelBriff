@extends('layouts.client')
@section('content')
<main class="rooms-internal-main">
    <section class="products-internal-wrapper">
      <div class="products-internal-container services internal">
        <h1>{{ trans('About') }}</h1>

        <div class="about-us-internal-wrapper">
          <div class="products-internal-left-column services">
            {!! $about->description !!}
          </div>
          <div class="products-internal-right-column services internal">
            <img
              src="{{ $about->image }}"
              alt="{{ $about->title }}"
              class="products-internal-large"
            />
          </div>
        </div>
      </div>
    </section>
  </main>
@endsection
