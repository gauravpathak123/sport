@include('header')
@section('bodyContent')
<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Sports Fest</title>

        <!-- Fonts -->
      
        <!-- Styles -->
       
    </head>
    <body>
        <section class="visual">
            <div class="container">
                <div class="text-block">
                    <div class="heading-holder">
                        <h1>SPORTS FEST</h1>
                    </div>
                    <p class="tagline"></p>
                    <div class="tagline">&nbsp; <p class="element">Come, Lets Play</p> &nbsp;</div>
                    <div class="infos">
                    <span class="info"><i class="fa fa-star"></i> RUN</span>
                    <span class="info"><i class="fa fa-star"></i> PLAY</span>
                    <span class="info"><i class="fa fa-star"></i> LEARN</span>
                    <span class="info"><i class="fa fa-star"></i> WIN</span>
                    </div>
                </div>
            </div>
            <img src="{!!  URL::to('upload/img-decor-01.jpg') !!}" alt="" class="bg-stretch">
        </section>

        <section class="section">
            <div class="container">
              <?php //if(!isset($_SESSION['Hash3'])){ ?>
                <div id="cta">
                    <a data-toggle="modal" data-target="#login" class="btn btn-primary rounded">
                      LOGIN
                      </a>
                </div>
                <?php// } ?>
                <div class="section-title text-center">
                    <h5>Just play.</h5>
                    <h3>Have fun. Enjoy the game.</h3>
                    <hr>
                </div><!-- end title -->

                <div class="row-fluid service-list">
                    <div class="col-md-4 col-sm-6" onclick="getdata(4)" data-toggle="modal" data-target="#rules">
                        <div class="serviceBox">
                            <div class="service-icon withborder color1 hovicon effect-1 sub-a">
                                <img src="{!!  URL::to('images/icons/icon_01.png') !!}" alt="">
                            </div>
                            <div class="service-content">
                                <h3>Football</h3>
                                <p>
                                  In football, you won’t go far, unless you know where the goalposts are.
                                </p>
                            </div>
                        </div>
                    </div><!-- end col -->

                    <div class="col-md-4 col-sm-6" onclick="getdata()" data-toggle="modal" data-target="#rules">
                        <div class="serviceBox">
                            <div class="service-icon withborder color2 hovicon effect-1 sub-a">
                                <img src="{!!  URL::to('images/icons/icon_02.png') !!}" alt="">
                            </div>
                            <div class="service-content">
                                <h3>Cricket</h3>
                                <p>
                                    You can cut the tension with a cricket stump.
                                </p>
                            </div>
                        </div>
                    </div><!-- end col -->

                    <div class="col-md-4 col-sm-6" onclick="getdata(7)" data-toggle="modal" data-target="#rules">
                        <div class="serviceBox">
                            <div class="service-icon withborder color3 hovicon effect-1 sub-a">
                                <img src="images/icons/icon_03.png" alt="">
                            </div>
                            <div class="service-content">
                                <h3>Volleyball</h3>
                                <p>
                                    Volleyball is 20 percent athleticness and 80 percent mental.
                                </p>
                            </div>
                        </div>
                    </div><!-- end col -->

                    <div class="col-md-4 col-sm-6" onclick="getdata(2)" data-toggle="modal" data-target="#rules">
                        <div class="serviceBox">
                            <div class="service-icon withborder color4 hovicon effect-1 sub-a">
                                <img src="images/icons/icon_04.png" alt="">
                            </div>
                            <div class="service-content">
                                <h3>Basketball</h3>
                                <p>
                                    Basketball is a beautiful game when the five players on the court play with one heartbeat.
                                </p>
                            </div>
                        </div>
                    </div><!-- end col -->

                    <div class="col-md-4 col-sm-6" onclick="getdata(5)" data-toggle="modal" data-target="#rules">
                        <div class="serviceBox">
                            <div class="service-icon withborder color5 hovicon effect-1 sub-a">
                                <img src="images/icons/icon_05.png" alt="">
                            </div>
                            <div class="service-content">
                                <h3>Badminton</h3>
                                <p>
                                    Talk with your racquet, play with your heart.
                                </p>
                            </div>
                        </div>
                    </div><!-- end col -->

                    <div class="col-md-4 col-sm-6" onclick="getdata(3)" data-toggle="modal" data-target="#rules">
                        <div class="serviceBox">
                            <div class="service-icon withborder color6 hovicon effect-1 sub-a">
                                <img src="images/icons/icon_06.png" alt="">
                            </div>
                            <div class="service-content">
                                <h3>Lawn Tennis</h3>
                                <p>
                                    Dreams do come true if you keep believing in yourself. Anything is possible.
                                </p>
                            </div>
                        </div>
                    </div><!-- end col -->
                  <div class="col-md-4 col-sm-6">
                        <div class="serviceBox">
                            <div class="service-icon withborder color7 hovicon effect-1 sub-a">
                                <img src="images/icons/icon_07.png" alt="">
                            </div>
                            <div class="service-content">
                                <h3>Table Tennis</h3>
                                <p>
                                   The more u hit the more u win.
                                </p>
                            </div>
                        </div>
                    </div>
                  <div class="col-md-4 col-sm-6" onclick="getdata(1)" data-toggle="modal" data-target="#rules">
                        <div class="serviceBox">
                            <div class="service-icon withborder color8 hovicon effect-1 sub-a">
                                <img src="images/icons/icon_08.png" alt="">
                            </div>
                            <div class="service-content">
                                <h3>Pool</h3>
                                <p>
                                   There's nothing worse than good position if you miss the shot.
                                </p>
                            </div>
                        </div>
                    </div>
                  <div class="col-md-4 col-sm-6" onclick="getdata(6)" data-toggle="modal" data-target="#rules">
                        <div class="serviceBox">
                            <div class="service-icon withborder color9 hovicon effect-1 sub-a">
                                <img src="images/icons/icon_10.png" alt="">
                            </div>
                            <div class="service-content">
                                <h3>Chess</h3>
                                <p>
                                   When you see a good move, look for a better one.
                                </p>
                            </div>
                        </div>
                    </div>
                  <div class="col-md-4 col-sm-6" >
                        <div class="serviceBox">
                            <div class="service-icon withborder color10 hovicon effect-1 sub-a">
                                <img src="images/icons/icon_11.png" alt="">
                            </div>
                            <div class="service-content">
                                <h3>Atheletics</h3>
                                <p>
                                   Some Peolpe want it to happen, Some wish it would happen,<br>And others... make it happen.
                                </p>
                            </div>
                        </div>
                    </div>
                </div><!-- end row -->
            </div><!-- end container -->      
        </section>

        <section class="section c1">
            <img class="rocket hidden-xs" src="upload/rocket.png" alt="">
            <svg id="clouds" class="hidden-xs" xmlns="http://www.w3.org/2000/svg" version="1.1" width="100%" height="100" viewBox="0 0 85 100" preserveAspectRatio="none">
                <path d="M-5 100 Q 0 20 5 100 Z
                    M0 100 Q 5 0 10 100
                    M5 100 Q 10 30 15 100
                    M10 100 Q 15 10 20 100
                    M15 100 Q 20 30 25 100
                    M20 100 Q 25 -10 30 100
                    M25 100 Q 30 10 35 100
                    M30 100 Q 35 30 40 100
                    M35 100 Q 40 10 45 100
                    M40 100 Q 45 50 50 100
                    M45 100 Q 50 20 55 100
                    M50 100 Q 55 40 60 100
                    M55 100 Q 60 60 65 100
                    M60 100 Q 65 50 70 100
                    M65 100 Q 70 20 75 100
                    M70 100 Q 75 45 80 100
                    M75 100 Q 80 30 85 100
                    M80 100 Q 85 20 90 100
                    M85 100 Q 90 50 95 100
                    M90 100 Q 95 25 100 100
                    M95 100 Q 100 15 105 100 Z">
                </path>
            </svg>

            <div class="container">
                <div class="section-title text-center">
                    <h3>Meet The Devlopers.</h3>
                    <hr>
                  <div class="row">
                           <a target="_blank" href="http://www.facebook.com/kieterp" ><button type="button" class="btn btn-primary rounded">Team ERP</button>
                  </a></div><!-- end row -->
                </div><!-- end title -->

                
            </div><!-- end container -->  
  </section>
  
    </body>
        @include('footer')

  <script src="js/jquery.min.js"></script>
  <script src="js/bootstrap.js"></script>
  <script src="js/login.js"></script>
</body>
<div id="rules" class="modal fade" role="dialog">
    <div class="modal-dialog">

      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h3 class="modal-title">RULES</h3>
        </div>
        <div class="modal-body" id="rule">
       
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>
  
</html>
