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
    <section class="header{{ isset($headerClass) ? ' '.$headerClass : '' }}">
      <header>
        <div class="header-container">
          <div class="header-wrapper">
            <div class="header-logo">
              <a class="logo-image" href="{{ route('ClientHome') }}">
                <img class="logo" src="{{ $info->logo }}" alt="{{ $info->slogan }}" />
              </a>
              <div class="ending">
                <div class="select-lang">
                  @foreach(LaravelLocalization::getSupportedLocales() as $localeCode => $properties)
                    <a rel="alternate" hreflang="{{ $localeCode }}" href="{{ LaravelLocalization::getLocalizedURL($localeCode, null, [], true) }}">
                      <div class="lang-container-{{ $localeCode }}{{ locale() == $localeCode ? ' change-lang' : '' }}">
                        <span class="lang">{{ strtoupper($localeCode) }}</span>
                      </div>
                    </a>
                  @endforeach
                  <div>
                    <img src="{{ asset('assets/images/icons/langSwitch.svg') }}" alt="Switch Language" />
                  </div>
                </div>
                <div class="burger-menu">
                  <div class="top-line"></div>
                  <div class="middle-line"></div>
                  <div class="bottom-line"></div>
                </div>
              </div>
            </div>

            <div class="header-navigation-wrapper">
              <div class="header-navigation-container">
                <nav class="desktop-nav">
                  <ul class="desktop-ul">
                    <li>
                      <a class="nav-link" href="{{ route('ClientHome') }}">{{ trans('Home') }}</a>
                      @if(request()->routeIs('ClientHome'))<div class="active-nav-line"></div>@endif
                    </li>
                    <li>
                      <a class="nav-link" href="{{ route('ClientTours') }}">{{ trans('Tours') }}</a>
                      @if(request()->routeIs('ClientTours') || request()->routeIs('ClientTourInner'))<div class="active-nav-line tours"></div>@endif
                    </li>
                    <li>
                      <a class="nav-link" href="{{ route('ClientAbout') }}">{{ trans('About Us') }}</a>
                      @if(request()->routeIs('ClientAbout'))<div class="active-nav-line"></div>@endif
                    </li>
                    <li>
                      <a class="nav-link" href="{{ route('ClientContact') }}">{{ trans('Contact') }}</a>
                      @if(request()->routeIs('ClientContact'))<div class="active-nav-line"></div>@endif
                    </li>
                  </ul>
                </nav>
              </div>
            </div>
          </div>
        </div>

        <div class="mobile-navigation-wrapper">
          <div class="mobile-navigation">
            <nav class="mobile-nav">
              <ul class="mobile-ul">
                <li><a class="mobile-nav-link" href="{{ route('ClientHome') }}">{{ trans('Home') }}</a></li>
                <li><a class="mobile-nav-link" href="{{ route('ClientTours') }}">{{ trans('Tours') }}</a></li>
                <li><a class="mobile-nav-link" href="{{ route('ClientAbout') }}">{{ trans('About Us') }}</a></li>
                <li><a class="mobile-nav-link" href="{{ route('ClientContact') }}">{{ trans('Contact') }}</a></li>
              </ul>
            </nav>
          </div>
        </div>
      </header>

        @yield('hero')
      </section>

      @yield('content')

      <footer class="footer">
        <div class="footer-wrapper">
          <div class="footer-logo">
            <a href="{{ route('ClientHome') }}">
              <img src="{{ $info->logo }}" alt="{{ $info->slogan }}" />
            </a>
          </div>
          <div class="footer-navigation">
            <nav class="footer-nav">
              <ul class="footer-ul">
                <a class="footer-nav-link" href="{{ route('ClientHome') }}"><li>{{ trans('Home') }}</li></a>
                <a class="footer-nav-link" href="{{ route('ClientTours') }}"><li>{{ trans('Tours') }}</li></a>
                <a class="footer-nav-link" href="{{ route('ClientAbout') }}"><li>{{ trans('About Us') }}</li></a>
                <a class="footer-nav-link" href="{{ route('ClientContact') }}"><li>{{ trans('Contact') }}</li></a>
              </ul>
            </nav>
          </div>

          <div class="select-lang">
            @foreach(LaravelLocalization::getSupportedLocales() as $localeCode => $properties)
              <a rel="alternate" hreflang="{{ $localeCode }}" href="{{ LaravelLocalization::getLocalizedURL($localeCode, null, [], true) }}">
                <div class="lang-container-{{ $localeCode }}{{ locale() == $localeCode ? ' change-lang' : '' }}">
                  <span class="lang">{{ strtoupper($localeCode) }}</span>
                </div>
              </a>
            @endforeach
          </div>

          <div class="footer-soc-icons-wrapper">
            @if($info->facebook)
            <div class="soc-wrapper"><a href="{{ $info->facebook }}" target="_blank">Facebook</a></div>
            <div class="soc-wrapper"><div class="red-dot"></div></div>
            @endif
            @if($info->instagram)
            <div class="soc-wrapper"><a href="{{ $info->instagram }}" target="_blank">Instagram</a></div>
            <div class="soc-wrapper"><div class="red-dot"></div></div>
            @endif
            @if($info->tiktok)
            <div class="soc-wrapper"><a href="{{ $info->tiktok }}" target="_blank">TikTok</a></div>
            <div class="soc-wrapper"><div class="red-dot"></div></div>
            @endif
            @if($info->linkedin)
            <div class="soc-wrapper"><a href="{{ $info->linkedin }}" target="_blank">Linkedin</a></div>
            @endif
          </div>

          <div class="footer-contacts">
            <a href="tel:{{ $contact_info->phone }}">{{ $contact_info->phone }}</a>
          </div>
        </div>

        <div class="smart-academy">
          <p>Website Created by</p>
          <p><a href="https://smartweb.ge" target="_blank">Ready Web</a></p>
        </div>
      </footer>

{!! $info->pixel !!}
{!! $info->analytics !!}

@stack('scripts')
<script src="{{ asset('assets/scripts/main.js') }}"></script>

</body>
</html>
