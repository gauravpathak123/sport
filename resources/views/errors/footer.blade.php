@yield('bodyContent')

<footer>
    <!-- Footer Top: Begin -->
          <div class="copyrights">
            <div class="container">
                <div class="row">
                    <div class="col-md-5 text-left">
                        <a target="_blank" class="footer-brand" href="http://www.facebook.com/kieterp">&copy;&nbsp; All Rights Reserved. Powered By: Team ERP
                    </div>
                    <div class="col-md-7 text-right">
                        <ul class="list-inline">
                            <li><a href="{!!  URL::to('/') !!}"><i class="fa fa-home"></i> Home</a></li>
                            <li><a href="{!!  URL::to('/#event') !!}">Events</a></li>
                            <li><a href="{!!  URL::to('contact_us') !!}">Contact</a></li>
                        </ul>
                    </div>
                </div><!-- end row -->
            </div><!-- end container -->  
        </div><!-- end copy -->
    </div><!-- end wrapper -->  <!-- Footer bottom: End -->
</footer>
