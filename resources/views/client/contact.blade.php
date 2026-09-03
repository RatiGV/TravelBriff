@php($headerClass = 'contact-us')
@extends('layouts.client')

@section('hero')
<div class="details-container contact">
  <div class="details-wrapper">
    <div class="tour-details contact-us">
      <h1>{{ trans('Contact') }}</h1>
      <div class="about-us-paragraph-wrapper contact">
        <div>
          <p class="address-text">{{ trans('Address') }}</p>
          <a
            href="https://www.google.com/maps?q={{ $info->latitude }},{{ $info->longitude }}"
            target="_blank"
            class="address-link"
          >{{ $contact_info->address }}</a>
        </div>
        <div>
          <p class="phone-text">{{ trans('Phone') }}</p>
          <a href="tel:{{ $contact_info->phone }}" target="_blank" class="phone-link">{{ $contact_info->phone }}</a>
        </div>
        @if(isset($contact_info->email) && $contact_info->email)
        <div>
          <p class="email-text">{{ trans('Email') }}</p>
          <a href="mailto:{{ $contact_info->email }}" target="_blank" class="email-link">{{ $contact_info->email }}</a>
        </div>
        @endif
        <div>
          <p class="social-text">{{ trans('Social networks') }}</p>
          <div class="social-media-contact">
            @if($info->facebook)
            <div>
              <a href="{{ $info->facebook }}" target="_blank" class="social-link facebook">Facebook</a>
              <div class="grey-contact-ball"></div>
            </div>
            @endif
            @if($info->instagram)
            <div>
              <a href="{{ $info->instagram }}" target="_blank" class="social-link instagram">Instagram</a>
              <div class="grey-contact-ball"></div>
            </div>
            @endif
            @if($info->tiktok)
            <div>
              <a href="{{ $info->tiktok }}" target="_blank" class="social-link tiktok">TikTok</a>
              <div class="grey-contact-ball"></div>
            </div>
            @endif
            @if($info->linkedin)
            <div>
              <a href="{{ $info->linkedin }}" target="_blank" class="social-link linkedin">LinkedIn</a>
            </div>
            @endif
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<div class="image">
  <h2 class="responsive-title">{{ trans('Contact') }}</h2>
  <div class="color-overlay"></div>
  <iframe
    class="main-placeholder-image contact"
    src="https://maps.google.com/maps?q={{ $info->latitude }},{{ $info->longitude }}&hl=ge&z=14&amp;output=embed"
    width="600"
    height="450"
    style="border: 0"
    allowfullscreen=""
    loading="lazy"
    referrerpolicy="no-referrer-when-downgrade"
  ></iframe>
</div>
@endsection

@section('content')
@endsection
