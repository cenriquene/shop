@extends('layouts.template')

@section('title', 'Product details')

@section('content')
    <section class="page-section bg-light" id="portfolio">

        @if( $product )
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-8">
                        <div class="modal-body">
                            <!-- Project Details Go Here-->
                            <h2 class="text-uppercase">{{ $product->name }}</h2>
                            <p class="item-intro text-muted">{{ $product->category->name }}</p>
                            <img class="img-fluid d-block mx-auto" src="https://store.hp.com/SpainStore/Html/Merch/Images/c05447684_500x367.jpg" alt="" />
                            <p>{{ $product->description }}</p>
                            <button class="btn btn-primary" data-dismiss="modal" type="button"> ADD TO CART</button>

                            <a class="btn btn-primary nav-link js-scroll-trigger" href="/checkout">CHECK OUT</a>
                        </div>
                    </div>
                </div>
            </div>
        @endif
    </section>

    <!-- Reviews-->
    <section class="page-section" id="about">
        <div class="container">
            <div class="text-center">
                <h2 class="section-heading text-uppercase">Reviews</h2>
            </div>
            <ul class="timeline">
                <li>
                    <div class="timeline-image"><img class="rounded-circle img-fluid" src="img/avatar-default.png" alt="" /></div>
                    <div class="timeline-panel">
                        <div class="timeline-heading">
                            <span class="fa fa-star" style="color: #fed136"></span>
                            <span class="fa fa-star" style="color: #fed136"></span>
                            <span class="fa fa-star" style="color: #fed136"></span>
                            <span class="fa fa-star" style="color: #fed136"></span>
                            <span class="fa fa-star" style="color: #fed136"></span>
                            <h4 class="subheading">Larry Parker</h4>
                        </div>
                        <div class="timeline-body"><p class="text-justify">I've went through 4 different monitors before. Quality construction and solid stand, awesome lighting (kind of a gimmick, but whatever - looks neat).</p></div>
                    </div>
                </li>
                <li class="timeline-inverted">
                    <div class="timeline-image"><img class="rounded-circle img-fluid" src="img/avatar-default.png" alt="" /></div>
                    <div class="timeline-panel">
                        <div class="timeline-heading">
                            <span class="fa fa-star" style="color: #fed136"></span>
                            <span class="fa fa-star" style="color: #fed136"></span>
                            <span class="fa fa-star" style="color: #fed136"></span>
                            <span class="fa fa-star" style="color: #fed136"></span>
                            <span class="fa fa-star" style="color: #fed136"></span>
                            <h4 class="subheading">Kay Garland</h4>
                        </div>
                        <div class="timeline-body"><p class="text-justify">Love the design, love the build quality, love the refresh rate, resolution, and price.</p></div>
                    </div>
                </li>
                <li>
                    <div class="timeline-image"><img class="rounded-circle img-fluid" src="img/avatar-default.png" alt="" /></div>
                    <div class="timeline-panel">
                        <div class="timeline-heading">
                            <span class="fa fa-star" style="color: #fed136"></span>
                            <span class="fa fa-star" style="color: #fed136"></span>
                            <span class="fa fa-star" style="color: #fed136"></span>
                            <span class="fa fa-star" style="color: #fed136"></span>
                            <span class="fa fa-star" style="color: #fed136"></span>
                            <h4 class="subheading">Diana Petersen</h4>
                        </div>
                        <div class="timeline-body"><p class="text-justify">10/10 Will purchase again for a multi monitor setup. I'm a long time away from looking at throwing money at 2k or 4k monitors, especially when the build quality and picture on this are just amazing.</p></div>
                    </div>
                </li>
                <li class="timeline-inverted">
                    <div class="timeline-image">
                        <h4>
                            Be Part
                            <br />
                            Of Our
                            <br />
                            Story!
                        </h4>
                    </div>
                </li>
            </ul>
        </div>
    </section>
@stop
