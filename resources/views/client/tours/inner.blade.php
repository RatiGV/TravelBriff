@php($headerClass = 'internal')
@extends('layouts.client')

@section('hero')
<div class="details-container">
  <div class="details-wrapper">
    <div class="tour-details">
      <h1>{{ $tour->translate->title }}</h1>
      <p class="tour-subtitle">{{ $tour->category->translate->title }}</p>
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
          @if((float) $tour->price == 1)
          <div class="tour-price">{{ trans('Price negotiable') }}</div>
          @else
          <div class="tour-price">{{ $tour->price }} <span>₾</span></div>
          @endif
        </div>
        <div class="tour-request-form-wrapper" id="tour-request-form">
          <p class="tour-request-form-title">{{ trans('Request this tour') }}</p>

          <form class="tour-request-form" method="POST" action="{{ route('StoreTourOrder', $tour->id) }}#tour-request-form">
            @csrf
            <div class="tour-request-form-row">
              <div class="tour-request-form-field">
                <label for="first_name">{{ trans('Name') }} *</label>
                <input type="text" id="first_name" name="first_name" value="{{ old('first_name') }}" required>
                @error('first_name')<span class="tour-request-form-error">{{ $message }}</span>@enderror
              </div>
              <div class="tour-request-form-field">
                <label for="last_name">{{ trans('Surname') }} *</label>
                <input type="text" id="last_name" name="last_name" value="{{ old('last_name') }}" required>
                @error('last_name')<span class="tour-request-form-error">{{ $message }}</span>@enderror
              </div>
            </div>
            <div class="tour-request-form-row">
              <div class="tour-request-form-field">
                <label for="email">{{ trans('Email') }} *</label>
                <input type="email" id="email" name="email" value="{{ old('email') }}" required>
                @error('email')<span class="tour-request-form-error">{{ $message }}</span>@enderror
              </div>
              <div class="tour-request-form-field">
                <label for="phone">{{ trans('Phone') }} *</label>
                <input type="text" id="phone" name="phone" value="{{ old('phone') }}" required>
                @error('phone')<span class="tour-request-form-error">{{ $message }}</span>@enderror
              </div>
            </div>
            <div class="tour-request-form-row">
              <div class="tour-request-form-field">
                <label for="persons">{{ trans('Quantity of persons') }} *</label>
                <input type="number" id="persons" name="persons" min="1" value="{{ old('persons', 1) }}" required>
                @error('persons')<span class="tour-request-form-error">{{ $message }}</span>@enderror
              </div>
            </div>
            <div class="tour-request-form-row">
              <div class="tour-request-form-field">
                <label for="arrival_date">{{ trans('Arrival date') }}</label>
                <input type="date" id="arrival_date" name="arrival_date" value="{{ old('arrival_date') }}">
                @error('arrival_date')<span class="tour-request-form-error">{{ $message }}</span>@enderror
              </div>
              <div class="tour-request-form-field">
                <label for="return_date">{{ trans('Return date') }}</label>
                <input type="date" id="return_date" name="return_date" value="{{ old('return_date') }}">
                @error('return_date')<span class="tour-request-form-error">{{ $message }}</span>@enderror
              </div>
            </div>
            <div class="tour-request-form-row">
              <div class="tour-request-form-field">
                <label for="pickup_location">{{ trans('Pickup location') }}</label>
                <input type="text" id="pickup_location" name="pickup_location" value="{{ old('pickup_location') }}">
                @error('pickup_location')<span class="tour-request-form-error">{{ $message }}</span>@enderror
              </div>
              <div class="tour-request-form-field">
                <label for="return_location">{{ trans('Return location') }}</label>
                <input type="text" id="return_location" name="return_location" value="{{ old('return_location') }}">
                @error('return_location')<span class="tour-request-form-error">{{ $message }}</span>@enderror
              </div>
            </div>
            <div class="tour-request-form-row">
              <div class="tour-request-form-field">
                <label for="captcha">{{ $captcha['a'] }} + {{ $captcha['b'] }} = ? *</label>
                <input type="text" id="captcha" name="captcha" inputmode="numeric" autocomplete="off" required>
                @error('captcha')<span class="tour-request-form-error">{{ $message }}</span>@enderror
              </div>
            </div>
            <button type="submit" class="tour-request-form-submit">{{ trans('Send request') }}</button>

            @if(session('tour_order_success'))
            <div class="tour-request-message tour-request-message--success">
              {{ trans('Your request has been sent successfully. We will contact you soon.') }}
            </div>
            @elseif($errors->any())
            <div class="tour-request-message tour-request-message--error">
              {{ trans('Please correct the errors below and try again.') }}
            </div>
            @endif
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
<div class="image">
  <div class="color-overlay"></div>
  <img class="main-placeholder-image tours-internal" id="tour-gallery-main-image" src="{{ $tour->image }}" alt="{{ $tour->translate->title }}" />
  @if(!empty($tour->images) && $tour->images->count())
  <div class="gallery-thumbnails" id="tour-gallery-thumbnails">
    @foreach($tour->images as $img)
    <img class="gallery-thumb" src="{{ $img->image }}" alt="{{ $tour->translate->title }} {{ $loop->iteration }}" />
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
            <span class="type-of-room">{{ $sameTour->translate->title }}</span>
            <span class="tour-card-category">{{ $sameTour->category->translate->title }}</span>
            <div class="template-price">
              @if((float) $sameTour->price == 1)
              <p class="price-of-room">{{ trans('Price negotiable') }}</p>
              @else
              <p class="price-of-room">{{ $sameTour->price }} <span>₾</span></p>
              @endif
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
