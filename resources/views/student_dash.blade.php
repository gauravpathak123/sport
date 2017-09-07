  @include('header')
  @section('bodyContent')

  <html>
   <style>
    body {
      margin-top:0px;
  }
  .stepwizard-step p {
      margin-top: 10px;
  }
  .stepwizard-row {
      display: table-row;
  }
  .stepwizard {
      display: table;
      width: 50%;
      position: relative;
  }
  .stepwizard-step button[disabled] {
      opacity: 1 !important;
      filter: alpha(opacity=100) !important;
  }
  .stepwizard-row:before {
      top: 14px;
      bottom: 0;
      position: absolute;
      content: " ";
      width: 100%;
      height: 1px;
      background-color: #ccc;
      z-order: 0;
  }
  .stepwizard-step {
      display: table-cell;
      text-align: center;
      position: relative;
  }
  .btn-circle {
      width: 30px;
      height: 30px;
      text-align: center;
      padding: 6px 0;
      font-size: 12px;
      line-height: 1.428571429;
      border-radius: 15px;
  }
    </style>
    <link rel="stylesheet" type="text/css" href="{{ URL::to('css/bootstrap.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ URL::to('css/style.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ URL::to('css/colors.css') }}">
  <script src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.11.1/jquery.validate.min.js"></script>


     <section id="page-header" class="visual color5 ">
        <div class="container">
          <div class="text-block">
            <div class="heading-holder">
              <h1>Event Registration</h1>
            </div>
          </div>
        </div>
      </section>

      <section class="section lb">
        <div class="container">
          <div class="row">
            <div class="content col-md-12 col-sm-12">
              <div class="row">
                <div class="col-md-2"></div>
                <div class="col-md-4 col-sm-12 wow fadeIn" data-wow-duration="1s" data-wow-delay="0.2s" data-toggle="modal" data-target="#ind_events" >
                  <div class="pricing-box-06 color9 hovicon effect-1 sub-a">
                    <div class="pricing-box-06-head" >
                    <BR>
                    <BR>
                      <h3>Individual<BR>Events</h3>
                    </div>
                    <!-- end pricing-box-09-head -->
                    <div class="pricing-box-06-body">
                    </div>
                    <!-- end pricing-box-06-body -->
                    <div class="pricing-box-06-foot">
                    </div>
                    <!-- end pricing-box-06-foot -->
                  </div>
                  <!-- end pricing-box-06 -->
                </div>
                <!-- end col -->
                <div class="col-md-1"></div>
                <div class="col-md-4 col-sm-12 wow fadeIn" data-toggle="modal" data-target="#group_events" >
                  <div class="pricing-box-06 color7 hovicon effect-1 sub-a">
                    <div class="pricing-box-06-head">
                    <BR>
                    <BR>
                      <h3>Group<BR>Events</h3>
                    
                    </div>
                    <!-- end pricing-box-09-head -->
                    <div class="pricing-box-06-body">
                    </div>
                    <!-- end pricing-box-06-body -->
                    <div class="pricing-box-06-foot">
                    </div>
                    <!-- end pricing-box-06-foot -->
                  </div>
                  <!-- end pricing-box-06 -->
                </div>
                <!-- end col -->

              </div>

            </div>
            <!-- end content -->
          </div>
          <!-- end row -->
        </div>
        <!-- end container -->
      </section>
    <script src="{!!  URL::to('js/jquery.min.js') !!}"></script>
    <script src="{!!  URL::to('js/bootstrap.js') !!}"></script>
    <script src="{!!  URL::to('js/login.js') !!}"></script>
    @endsection
  @include('footer')

  <div id="ind_events" class="modal fade" role="dialog">
      <div class="modal-dialog">

        <form action="{{ action('StudentController@ind_reg') }}" method="post">
        {{ csrf_field() }}
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h3 class="modal-title">Indiviudal Events</h3>
          </div>          
              
              <div class="modal-body" id="rule">
              
                  <div class="row">
                <div class="col-md-1"></div>
                <div class="col-md-3">
                  <label for="event">Event<span style="color: red;">*</span></label>
                </div>
                  <div class="col-md-6">
                      <select class="form-control" name="sub_id">
                        <option value="">Choose One</option>
                        @foreach($ind_sub_events as $ind)
                        
                          <option value="{!! $ind->Sub_Event_Id !!}">{!! $ind->Name !!}</option>
                        @endforeach
                      </select>

                  </div>
              </div>
            
          </div>
          <div class="modal-footer">
            <center><button type="submit"  class="btn btn-primary rounded">Register</button></center>
          </div>
          
        </div>
      
      </form>
    </div></div>

    <div id="group_events" class="modal fade" role="dialog">
      <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
        <form action="{{ action('HomeController@grp_reg') }}" method="post">
        {{ csrf_field() }}
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h3 class="modal-title">Group Events</h3>
          </div>
          <div class="modal-body" id="rule">
            
             <div class="row">
                <div class="col-md-1"></div>
                <div class="col-md-3">
                  <label for="event">Event<span style="color: red;">*</span></label>
                </div>
                  <div class="col-md-6">
                      <select class="form-control" name="sub_id">
                        <option value="">Choose One</option>
                        @foreach($grp_sub_events as $grp)
                        
                          <option value="{!! $grp->Sub_Event_Id !!}">{!! $grp->Name !!}</option>
                        @endforeach
                      </select>

                  </div>
              </div>
              
            
          </div>

         

          <div class="modal-footer">
            <center><button type="submit"  class="btn btn-primary rounded">Register</button></center>
          </div>
          </form>
        </div>
      </div>
    </div>

  </html>