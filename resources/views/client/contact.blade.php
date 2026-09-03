@extends('layouts.client')
@section('content')
@push('css')

@endpush
<main class="rooms-internal-main">
    <section class="products-internal-wrapper">
      <div class="products-internal-container services internal">
        <h1>{{ trans('Contact') }}</h1>

        <div class="about-us-internal-wrapper">
          <div class="products-internal-left-column contact">
            <div class="contact-details">
              <p class="contact-heading">{{ trans('Address') }}</p>
              <p class="contact-subheading">
                <a
                  href="https://www.google.com/maps/search/?api=1&query=Tbilisi,+Georgia,+Chavchavadze+street+N2"
                  target="_blank"
                >
                {{ $contact_info->address }}
                </a>
              </p>
            </div>
            <div class="contact-details">
              <p class="contact-heading">{{ trans('Phone') }}</p>
              <p class="contact-subheading phone">
                <a href="tel:{{ $contact_info->phone }}">{{ $contact_info->phone }}</a>
              </p>
            </div>
            <div class="contact-details">
              <p class="contact-heading">{{ trans('Email') }}</p>
              <p class="contact-subheading">
                <a href="mailto:{{ $contact_info->email }}">{{ $contact_info->email }}</a>
              </p>
            </div>
            <div class="contact-details">
              <p class="contact-heading">{{ trans('Social networks') }}</p>
              <div class="contact-social-media">
                @if($info->facebook)
                <a href="{{ $info->facebook }}" target="_blank">
                  <img
                    src="{{ asset('assets/images/icons/facebook.svg') }}"
                    alt="facebook icon"
                  />
                </a>
                @endif
                @if($info->instagram)
                <a href="{{ $info->instagram }}" target="_blank">
                  <img
                    src="{{ asset('assets/images/icons/instagram.svg') }}"
                    alt="instagram icon"
                  />
                </a>
                @endif
                @if($info->linkedin)
                <a href="{{ $info->linkedin }}" target="_blank">
                  <img
                    src="{{ asset('assets/images/icons/linkedin.svg') }}"
                    alt="linkedin icon"
                  />
                </a>
                @endif
                @if($info->tiktok)
                <a href="{{ $info->tiktok }}" target="_blank">
                  <img
                    src="{{ asset('assets/images/icons/tiktok.svg') }}"
                    alt="tiktok icon"
                  />
                </a>
                @endif
              </div>
            </div>
          </div>

          <div class="products-internal-right-column services internal">
            <iframe
              src="https://maps.google.com/maps?q={{ $info->latitude }},{{ $info->longitude }}&hl=ge&z=14&amp;output=embed"
              width="600"
              height="450"
              style="border: 0"
              allowfullscreen=""
              loading="lazy"
            ></iframe>
          </div>
        </div>
      </div>
    </section>
  </main>
@endsection
