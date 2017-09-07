@include('header')
@section('bodyContent')

<section id="page-header" class="visual color4">
            <div class="container">
                <div class="text-block">
                    <div class="heading-holder">
                        <h1>CONTACT US</h1>
                    </div>
                    <p class="tagline"></p>
                </div>
            </div>
        </section>

        <section class="section">
            <div class="container">
                <div class="row service-list noborder">
									<div class="col-md-2 "></div>
                    <div class="col-md-4 col-sm-6">
                        <div class="serviceBox">
                            <div class="service-icon withborder color1 hovicon effect-1 sub-a">
                                <i class="fa fa-envelope-o"></i>
                            </div>
                            <div class="service-content">
                                <h3>Have Questions?</h3>
                                <hr>
                                <p>
                                    amit.goyal@kiet.edu
                                </p>
                            </div>
                        </div>
                    </div><!-- end col -->
										<div class="col-md-1 "></div>
                    <div class="col-md-4 col-sm-6">
                        <div class="serviceBox">
                            <div class="service-icon withborder color2 hovicon effect-1 sub-a">
                                <i class="fa fa-phone"></i>
                            </div>
                            <div class="service-content">
                                <h3>Call us</h3>
                                <hr>
                                <p>
                                     9899979748
                                </p>
                            </div>
                        </div>
                    </div><!-- end col -->

                   <!-- end col -->
                </div><!-- end row -->
            </div><!-- end container -->  
        </section>
  @endsection
@include('footer')