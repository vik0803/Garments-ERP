@extends('layouts.masterApp')

@section('title','Garments ERP')

@section('content')

  <section class="faq-area section-gap relative" style="padding-top: 200px;">
    <div class="overlay overlay-bg"></div>
    <div class="container">
      <div class="row justify-content-center align-items-center">
        <div class="col-lg-3 col-md-6">
          <div class="single-faq">
            <div class="circle">
              <div class="inner"></div>
            </div>
            <h5><span class="counter">2</span>K+</h5>
            <p>
              Projects Completed
            </p>
          </div>
        </div>
        <div class="col-lg-3 col-md-6">
          <div class="single-faq">
            <div class="circle">
              <div class="inner"></div>
            </div>
            <h5><span class="counter">5.5</span>K</h5>
            <p>
              Total Employees
            </p>
          </div>
        </div>
        <div class="col-lg-3 col-md-6">
          <div class="single-faq">
            <div class="circle">
              <div class="inner"></div>
            </div>
            <h5 class="counter">959</h5>
            <p>
              Happy Clients
            </p>
          </div>
        </div>
        <div class="col-lg-3 col-md-6">
          <div class="single-faq">
            <div class="circle">
              <div class="inner"></div>
            </div>
            <h5 class="counter">367</h5>
            <p>
              Tickets Submited
            </p>
          </div>
        </div>
      </div>
    </div>
  </section>

  <section class="service-area section-gap" id="service">
    <div class="container">
      <div class="row justify-content-center">
        <div class="col-md-12 pb-30 header-text text-center">
          <h1 class="mb-10">Our Capturing Market Sectors</h1>
          <p>
            Who are in extremely love with eco friendly system..
          </p>
        </div>
      </div>
      <div class="row">
        <div class="col-lg-4">
          <div class="single-service">
            <div class="thumb">
              <img src="{{ asset('img/s1.jpg') }}">
            </div>
            <h4>Automotive Engineering</h4>
            <p>
              inappropriate behavior is often laughed off as “boys will be boys,” women face higher conduct women face higher conduct.
            </p>
          </div>
        </div>
        <div class="col-lg-4">
          <div class="single-service">
            <div class="thumb">
              <img src="{{ asset('img/s2.jpg') }}">
            </div>
            <h4>Construction & Engineering</h4>
            <p>
              inappropriate behavior is often laughed off as “boys will be boys,” women face higher conduct women face higher conduct.
            </p>
          </div>
        </div>
        <div class="col-lg-4">
          <div class="single-service">
            <div class="thumb">
              <img src="{{ asset('img/s3.jpg') }}">
            </div>
            <h4>Industrial Engineering</h4>
            <p>
              inappropriate behavior is often laughed off as “boys will be boys,” women face higher conduct women face higher conduct.
            </p>
          </div>
        </div>
      </div>
    </div>
  </section>



    <section class="cat-area" id="feature">
      <div class="container">
        <div class="row">
          <div class="col-lg-4">
            <div class="single-cat d-flex flex-column">
              <a href="#" class="hb-sm-margin mx-auto d-block"><span class="hb hb-sm inv hb-facebook-inv"><span class="fas fa-magic"></span></span></a>
              <h4 class="mb-20" style="margin-top: 23px;">Maintenance</h4>
              <p>
                inappropriate behavior is often laughed off as “boys will be boys,” women face higher conduct standards especially in the workplace. That’s why.
              </p>
            </div>
          </div>
          <div class="col-lg-4">
            <div class="single-cat">
              <a href="#" class="hb-sm-margin mx-auto d-block"><span class="hb hb-sm inv hb-facebook-inv"><span class="fas fa-rocket"></span></span></a>
              <h4 class="mt-40 mb-20">Residental Service</h4>
              <p>
                inappropriate behavior is often laughed off as “boys will be boys,” women face higher conduct standards especially in the workplace. That’s why.
              </p>
            </div>
          </div>
          <div class="col-lg-4">
            <div class="single-cat">
              <a href="#" class="hb-sm-margin mx-auto d-block"><span class="hb hb-sm inv hb-facebook-inv"><span class="fas fa-bug"></span></span></a>
              <h4 class="mt-40 mb-20">Commercial Service</h4>
              <p>
                inappropriate behavior is often laughed off as “boys will be boys,” women face higher conduct standards especially in the workplace. That’s why.
              </p>
            </div>
          </div>
        </div>
      </div>
    </section>

    <section class="project-area section-gap" id="project">
      <div class="container">
        <div class="row justify-content-center">
          <div class="col-md-8 pb-30 header-text text-center">
            <h1 class="mb-10">Latest Finished Projects</h1>
            <p>
              Who are in extremely love with eco friendly system..
            </p>
          </div>
        </div>
        <div class="row">
          <div class="col-lg-8 col-md-8">
              <img class="img-fluid single-project" src="{{ asset('img/p1.jpg') }}">
          </div>
          <div class="col-lg-4 col-md-4">
              <img class="img-fluid single-project" src="{{ asset('img/p2.jpg') }}">
          </div>
          <div class="col-lg-6 col-md-6">
              <img class="img-fluid single-project" src="{{ asset('img/p3.jpg') }}">
          </div>
          <div class="col-lg-6 col-md-6">
              <img class="img-fluid single-project" src="{{ asset('img/p4.jpg') }}">
          </div>
        </div>
      </div>
    </section>

    <section class="feedback-area section-gap relative" id="feedback">
      <div class="overlay overlay-bg"></div>
      <div class="container">
        <div class="row justify-content-center">
          <div class="col-md-12 pb-30 header-text text-center">
            <h1 class="mb-10 text-white">Enjoy our Client’s Feedback</h1>
            <p class="text-white">
              Who are in extremely love with eco friendly system..
            </p>
          </div>
        </div>
        <div class="row feedback-contents justify-content-center align-items-center">
          <div class="col-lg-6 feedback-left relative d-flex justify-content-center align-items-center">
            <div class="overlay overlay-bg"></div>
            <a class="play-btn"><img class="img-fluid" src="{{ asset('img/play-btn.png') }}" alt=""></a>
          </div>
          <div class="col-lg-6 feedback-right">
            <div class="active-review-carusel">
              <div class="single-feedback-carusel">
                <div class="title d-flex flex-row">
                  <h4 class="text-white pb-10">Fannie Rowe</h4>
                  <div class="star">
                    <span class="fa fa-star checked"></span>
                    <span class="fa fa-star checked"></span>
                    <span class="fa fa-star checked"></span>
                    <span class="fa fa-star"></span>
                    <span class="fa fa-star"></span>
                  </div>
                </div>
                <p class="text-white">
                  Accessories Here you can find the best computer accessory for your laptop, monitor, printer, scanner, speaker. Here you can find the best computer accessory for your laptop, monitor, printer, scanner, speaker.
                </p>
              </div>
              <div class="single-feedback-carusel">
                <div class="title d-flex flex-row">
                  <h4 class="text-white pb-10">Fannie Rowe</h4>
                  <div class="star">
                    <span class="fa fa-star checked"></span>
                    <span class="fa fa-star checked"></span>
                    <span class="fa fa-star checked"></span>
                    <span class="fa fa-star checked"></span>
                    <span class="fa fa-star"></span>
                  </div>
                </div>
                <p class="text-white">
                  Accessories Here you can find the best computer accessory for your laptop, monitor, printer, scanner, speaker. Here you can find the best computer accessory for your laptop, monitor, printer, scanner, speaker.
                </p>
              </div>
              <div class="single-feedback-carusel">
                <div class="title d-flex flex-row">
                  <h4 class="text-white pb-10">Fannie Rowe</h4>
                  <div class="star">
                    <span class="fa fa-star checked"></span>
                    <span class="fa fa-star checked"></span>
                    <span class="fa fa-star checked"></span>
                    <span class="fa fa-star checked"></span>
                    <span class="fa fa-star checked	"></span>
                  </div>
                </div>
                <p class="text-white">
                  Accessories Here you can find the best computer accessory for your laptop, monitor, printer, scanner, speaker. Here you can find the best computer accessory for your laptop, monitor, printer, scanner, speaker.
                </p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>

@endsection
