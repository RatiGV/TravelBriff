@php
    $title = !request()->segment(3) ? trans('menu.' . $metaTitle) : $metaTitle;
@endphp

<!DOCTYPE html>
<html lang="{{ locale() }}">
<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="csrf-token" content="{{ csrf_token() }}" />

    <title>@include('layouts.title') - {{ $info->translate->title }}</title>
    <link rel="icon" type="image/x-icon" href="{{ $info->favicon }}">
    <link rel="stylesheet" href="{{ asset('assets/styles/main.css') }}" />

    @stack('css')

    <meta name="author" content="Smart Web" />
    <meta property="og:url" content="{{ url()->current() }}" />
    <meta property="og:type" content="website" />
    <meta property="og:title" content="@include('layouts.meta-title') - {{ $info->translate->title }}" />
    <meta property="og:description" content="@include('layouts.meta-description') - {{ $info->translate->title }}" />
    <meta property="og:image" content="{{ url('/') }}{{ $info->login_bg }}" />
</head>

<body>

    <header class="header">
        <div class="header-container">
          <div class="header-wrapper">
            <div class="header-logo">
              <a href="{{  route('ClientHome') }}">
                <img src="{{ $info->logo }}" alt="{{ $info->slogan }}" />
              </a>
            </div>
            <div class="burger-menu">
              <div class="top-line"></div>
              <div class="middle-line"></div>
              <div class="bottom-line"></div>
            </div>
            <div class="header-navigation-wrapper">
              <nav class="desktop-nav">
                <ul class="desktop-ul">
                  <li>
                    <a class="nav-link" href="{{  route('ClientHome') }}">{{ trans('Home') }}</a>
                  </li>
                  <li>
                    <a class="nav-link" href="{{ route('ClientRooms') }}">{{ trans('Rooms') }}</a>
                  </li>
                  <li><a class="nav-link" href="{{ route('ClientServices') }}">{{ trans('Services') }}</a></li>
                  <li><a class="nav-link" href="{{ route('ClientAbout') }}">{{ trans('About Us') }}</a></li>
                  <li><a class="nav-link" href="{{ route('ClientContact') }}">{{ trans('Contact') }}</a></li>
                </ul>
              </nav>
            </div>
            <div class="lang-number-container">
              <div class="footer-contacts-container phone">
                <a href="tel:{{ $contact_info->phone }}" target="_blank">{{ $contact_info->phone }}</a>
              </div>

              <div class="select-lang">
                @foreach(LaravelLocalization::getSupportedLocales() as $localeCode => $properties)
                  @if(locale() != $localeCode)
                  <a rel="alternate" hreflang="{{ $localeCode }}"  href="{{ LaravelLocalization::getLocalizedURL($localeCode, null, [], true) }}">
                          <div class="lang-container-{{ $localeCode }}">
                              <div class="lang-container-{{ $localeCode }}">
                                  <span class="lang">{{ $properties['native'] }}</span>
                          </div>
                       </div>
                      </a>
                  @endif
              @endforeach
          </div>
            </div>
          </div>
          <span class="header-black-line"></span>
        </div>

        <div class="mobile-navigation-wrapper">
          <div class="mobile-navigation">
            <nav class="mobile-nav">
              <ul class="mobile-ul">
                <li>
                  <a class="mobile-nav-link" href="{{  route('ClientHome') }}">{{ trans('Home') }}</a>
                </li>
                <li>
                  <a class="mobile-nav-link" href="{{ route('ClientRooms') }}">{{ trans('Rooms') }}</a>
                </li>
                <li>
                  <a class="mobile-nav-link" href="{{ route('ClientServices') }}">{{ trans('Services') }}</a>
                </li>
                <li>
                  <a class="mobile-nav-link" href="{{ route('ClientAbout') }}">{{ trans('About Us') }}</a>
                </li>
                <li>
                  <a class="mobile-nav-link" href="{{ route('ClientContact') }}">{{ trans('Contact') }}</a>
                </li>
              </ul>
            </nav>
          </div>

          <div class="mobile-select-lang">
            <a href="#">
              <div class="mobile-lang-container-eng change-lang">
                <span class="lang">ENG</span>
              </div>
            </a>
            <a href="#">
              <div class="mobile-lang-container-geo">
                <span class="lang">GEO</span>
              </div>
            </a>
          </div>
          <a class="mobile-number" href="tel:{{ $contact_info->phone }}" target="_blank">
            {{ $contact_info->phone }}
          </a>
        </div>
      </header>

      @yield('content')

      <footer class="footer">
        <div class="footer-wrapper">
          <span class="footer-black-line"></span>
          <div class="footer-logo">
            <a href="{{  route('ClientHome') }}">
              <img src="{{ $info->logo }}" alt="{{ $info->slogan }}" />
            </a>
          </div>
          <div class="footer-navigation">
            <nav class="footer-nav">
              <ul class="footer-ul">
                <li>
                  <a class="footer-nav-link" href="{{  route('ClientHome') }}">{{ trans('Home') }}</a>
                </li>
                <li>
                  <a class="footer-nav-link" href="{{ route('ClientRooms') }}">{{ trans('Rooms') }}</a>
                </li>
                <li>
                  <a class="footer-nav-link" href="{{ route('ClientServices') }}">{{ trans('Services') }}</a>
                </li>
                <li>
                  <a class="footer-nav-link" href="{{ route('ClientAbout') }}">{{ trans('About Us') }}</a>
                </li>
                <li>
                  <a class="footer-nav-link" href="{{ route('ClientContact') }}">{{ trans('Contact') }}</a>
                </li>
              </ul>
            </nav>
          </div>

          <div class="select-lang footer">
          @foreach(LaravelLocalization::getSupportedLocales() as $localeCode => $properties)
            @if(locale() != $localeCode)
            <a rel="alternate" hreflang="{{ $localeCode }}"  href="{{ LaravelLocalization::getLocalizedURL($localeCode, null, [], true) }}">
                    <div class="lang-container-{{ $localeCode }}">
                        <div class="lang-container-{{ $localeCode }}">
                            <span class="lang">{{ $properties['native'] }}</span>
                    </div>
                 </div>
                </a>
            @endif
        @endforeach
    </div>

          <div class="footer-contacts">
            <div class="footer-contacts-container phone">
              <a href="tel:{{ $contact_info->phone }}" target="_blank"> {{ $contact_info->phone }} </a>
            </div>
            <div class="footer-contacts-container">
              <a href="{{ route('ClientContact') }}"> {{ $contact_info->address }}</a>
            </div>
          </div>
        </div>

        <div class="footer-socials">
        @if($info->facebook)
          <div>
            <a href="{{ $info->facebook }}" target="_blank"> Facebook</a>
          </div>
          @endif
          @if($info->instagram)
          <div>
            <a href="{{ $info->instagram }}" target="_blank"> Instagram </a>
          </div>
          @endif
          @if($info->linkedin)
          <div>
            <a href="{{ $info->linkedin }}" target="_blank"> Linkedin </a>
          </div>
          @endif
          @if($info->tiktok)
          <div>
            <a href="{{ $info->tiktok }}" target="_blank"> Tiktok </a>
          </div>
          @endif
        </div>

        <div class="footer-bottom">
          <div class="grey-line"></div>

          <p>Website Created by<span>Ready Web</span></p>
        </div>
      </footer>


{!! $info->pixel !!}
{!! $info->analytics !!}



@stack('scripts')
<script src="{{ asset('assets/scripts/main.js') }}"></script>

</body>
</html>
