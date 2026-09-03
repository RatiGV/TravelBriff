@extends('layouts.client')
@section('content')
<main class="rooms-internal-main">
    <section class="products-internal-wrapper">
      <div class="products-internal-container">
        <div class="products-internal-right-column">
          <img
            src="{{ $room->image }}"
            alt="Hotel Image 1"
            class="products-internal-large"
          />
          @if(!empty($room->images))
          <div class="products-internal-small-images">
            @forelse($room->images as $img)
            <img
              src="{{ $img->image }}"
              alt="Hotel-Image-{{ $loop->iteration }}"
              class="products-internal-small"
            />
            @empty
            @endforelse
          </div>
          @endif
        </div>
        <div class="products-internal-left-column">
          <h1>{{ $room->category->translate->title }}</h1>
          <p class="internal-description">
            {!! $room->translate->description !!}
          </p>
          <div class="internal-price-button">
            <p>{{ $room->price }} <span>Gel</span> <span>{{ trans('Per night') }}</span></p>
            <button id="bookRoomBtn">Book a room</button>
          </div>
        </div>
      </div>
    </section>

    <div id="popup" class="popup">
      <div class="popup-wrapper">
        <div class="popup-content">
          <div id="closePopup" class="close">
            <p>Close</p>
            <img src="{{ asset('assets/images/icons/closeIcon.svg') }}" alt="Exit" />
          </div>
        </div>
        <div class="popup-details">
          <div class="popup-subdetails details">
            <div class="popup-header check-in">
              <img src="{{ asset('assets/images/icons/calendar.svg') }}" alt="Calendar" />
              <p>Check in</p>
              <p>01/01/2024</p>
            </div>
            <div class="calendar check-in">
              <div class="calendar-month-year">
                <img
                  src="{{ asset('assets/images/icons/leftArrow.svg') }}"
                  alt="left arrow"
                />
                <p>April 2024</p>
                <img
                  src="{{ asset('assets/images/icons/rightArrow.svg') }}"
                  alt="right arrow"
                />
              </div>
              <div class="calendar-dates">
                <div class="calendar-weekdays">
                  <p>Mo</p>
                  <p>Tu</p>
                  <p>We</p>
                  <p>Th</p>
                  <p>Fr</p>
                  <p>Sa</p>
                  <p>Su</p>
                </div>
                <div class="calendar-days">
                  <p>1</p>
                  <p>2</p>
                  <p>3</p>
                  <p>4</p>
                  <p>5</p>
                  <p>6</p>
                  <p>7</p>
                </div>
                <div class="calendar-days">
                  <p>8</p>
                  <p>9</p>
                  <p>10</p>
                  <p>11</p>
                  <p>12</p>
                  <p>13</p>
                  <p>14</p>
                </div>
                <div class="calendar-days">
                  <p>15</p>
                  <p>16</p>
                  <p>17</p>
                  <p>18</p>
                  <p>19</p>
                  <p>20</p>
                  <p>21</p>
                </div>
                <div class="calendar-days">
                  <p>22</p>
                  <p>23</p>
                  <p>24</p>
                  <p>25</p>
                  <p>26</p>
                  <p>27</p>
                  <p>28</p>
                </div>
                <div class="calendar-days end">
                  <p>29</p>
                  <p>30</p>
                  <p></p>
                </div>
              </div>
            </div>
          </div>
          <div class="popup-subdetails details">
            <div class="popup-header check-out">
              <img src="{{ asset('assets/images/icons/calendar.svg') }}" alt="Calendar" />
              <p>Check out</p>
              <p>01/01/2024</p>
            </div>
            <div class="calendar check-out">
              <div class="calendar-month-year">
                <img
                  src="{{ asset('assets/images/icons/leftArrow.svg') }}"
                  alt="left arrow"
                />
                <p>April 2024</p>
                <img
                  src="{{ asset('assets/images/icons/rightArrow.svg') }}"
                  alt="right arrow"
                />
              </div>
              <div class="calendar-dates">
                <div class="calendar-weekdays">
                  <p>Mo</p>
                  <p>Tu</p>
                  <p>We</p>
                  <p>Th</p>
                  <p>Fr</p>
                  <p>Sa</p>
                  <p>Su</p>
                </div>
                <div class="calendar-days">
                  <p>1</p>
                  <p>2</p>
                  <p>3</p>
                  <p>4</p>
                  <p>5</p>
                  <p>6</p>
                  <p>7</p>
                </div>
                <div class="calendar-days">
                  <p>8</p>
                  <p>9</p>
                  <p>10</p>
                  <p>11</p>
                  <p>12</p>
                  <p>13</p>
                  <p>14</p>
                </div>
                <div class="calendar-days">
                  <p>15</p>
                  <p>16</p>
                  <p>17</p>
                  <p>18</p>
                  <p>19</p>
                  <p>20</p>
                  <p>21</p>
                </div>
                <div class="calendar-days">
                  <p>22</p>
                  <p>23</p>
                  <p>24</p>
                  <p>25</p>
                  <p>26</p>
                  <p>27</p>
                  <p>28</p>
                </div>
                <div class="calendar-days end">
                  <p>29</p>
                  <p>30</p>
                  <p>31</p>
                </div>
              </div>
            </div>
          </div>
          <div class="popup-subdetails details">
            <div class="popup-header adults">
              <div class="popup-header-persons">
                <img
                  src="{{ asset('assets/images/icons/adultIcon.svg') }}"
                  alt="Person Icon"
                />
                <p>Adults</p>
              </div>
              <div class="popup-header-amount">
                <img
                  class="minus"
                  src="{{ asset('assets/images/icons/minus.svg') }}"
                  alt="minus Icon"
                />
                <p class="count">0</p>
                <img
                  class="plus"
                  src="{{ asset('assets/images/icons/plus.svg') }}"
                  alt="plus Icon"
                />
              </div>
            </div>
          </div>
          <div class="popup-subdetails details">
            <div class="popup-header adults">
              <div class="popup-header-persons">
                <img
                  src="{{ asset('assets/images/icons/childIcon.svg') }}"
                  alt="Child Icon"
                />
                <p>Children</p>
              </div>
              <div class="popup-header-amount">
                <img
                  class="minus"
                  src="{{ asset('assets/images/icons/minus.svg') }}"
                  alt="minus Icon"
                />
                <p class="count">0</p>
                <img
                  class="plus"
                  src="{{ asset('assets/images/icons/plus.svg') }}"
                  alt="plus Icon"
                />
              </div>
            </div>
          </div>
          <div class="popup-subdetails button">
            <div class="popup-header button">
              <button>Check Availability</button>
            </div>
          </div>
        </div>
      </div>
    </div>

    <div id="dimOverlay" class="dim-overlay"></div>
    <div class="grey-line"></div>

    <section class="internal-similar-templates-wrapper">
      <div class="internal-similar-templates-container">
        <div class="internal-similar-templates-header">
          <div class="internal-similar-templates-title">{{ trans('Same Rooms') }}</div>
          <button
            class="internal-templates-see-all"
            onclick="window.location.href='{{ route('ClientRooms') }}'"
          >
            {{ trans('See all') }}
          </button>
        </div>

        <div class="internal-similar-templates">
            @forelse($sameRooms as $sameRoom)
          <div
            class="internal-similar-template rooms"
            data-category="{{ \Illuminate\Support\Str::slug($sameRoom->category->translate->title,'-',false) }}"
            onclick="window.location.href='{{ route('ClientRoomInner',$sameRoom->id.'-'.\Illuminate\Support\Str::slug($sameRoom->category->translate->title,'-',false)) }}'"
          >
            <div class="image-container">
              <img
                src="{{ $sameRoom->image }}"
                alt="Hotel Room"
                class="main-section-carousel-image"
              />
            </div>
            <div class="template-price">
              <div class="template-description">
                <p class="type-of-room">{{ $sameRoom->category->translate->title }}</p>
                <p class="price-of-room">{{ $sameRoom->price }} <span>Gel</span></p>
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
