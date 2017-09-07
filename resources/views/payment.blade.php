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


   <section id="page-header" class="visual color3">
      <div class="container">
        <div class="text-block">
          <div class="heading-holder">
            <h1>Payment</h1>
          </div>
        </div>
      </div>
    </section>

    <section class="section lb">
      <div class="container">
          <div class="well">
            <br>
           
            @foreach($participant as $pt)
               <div class="row">
                
                <div class="col-md-3"></div>
           <div class="col-md-2">
            <label for="Captain" class="control-label"><span style="color: black;">Member Details</span></label>
            </div>
                <div class="col-md-4">
                 <input type="text" class="form-control" name="participant[]" style="color: green;" value="<?php echo $pt['Name'] .'( '.$pt['lib'].' )';?> " disabled>
                </div>
                </div>
                <br>
            @endforeach

                <br>
                <div class="row">
                 <div class="col-md-3"></div>
                 <div class="col-md-2">
                <label for="Captain" class="control-label"><span style="color: black;">Total amount</span></label>
                </div>
                <div class="col-md-4">
                  <span style="color: red;"><i class="fa fa-inr"></i> {!! $amount !!}</span>
                </div>
                </div>
                <br><br>
                <div class="row">
                <div class="col-md-4"></div>
                <div class="col-md-4">
                   <center><button type="button" class="btn btn-success rounded" data-toggle="collapse" data-target="#payment_div">Proceed To pay</button></center>
                </div>
                
                </div>
                <br>
                <div class="row">
                 
                  <div id="payment_div" class="collapse">
                  <div class="col-md-10">
                    <div class="row">
                      <span style="color: red;">
                        For Payment Through Card : <i class="fa fa-inr"></i> 18.0 + GST as applicable.
                      </span>
                    </div>
                    <br>
                    <div class="row">
                      <span style="color: red;">
                        For Payment Through PayTm : 2% Of Total Amount
                      </span>
                    </div>
                  </div>
                 <form action="{{ action('StudentController@pay_amount') }}" method="post">
                   {{ csrf_field() }}
                   <button type="submit" id="sub_id" class="btn btn rounded" name="sub_id" value="{!! $event_details[0]->Sub_Event_Id !!}"><img src="images/card.png" height="50px" width="50px"></button>
                  <button type="submit" id="sub_id" class="btn btn rounded" name="sub_id" value="{!! $event_details[0]->Sub_Event_Id !!}"><img src="images/high-resolution-original.png" height="50px" width="50px"></button>
                </form>
                </div>
                </div>
               
              
         
         
          <!-- end content -->
        </div>
        <!-- end row -->
     
      <!-- end container -->
    </section>
  <script src="{!!  URL::to('js/jquery.min.js') !!}"></script>
  <script src="{!!  URL::to('js/bootstrap.js') !!}"></script>
  <script src="{!!  URL::to('js/login.js') !!}"></script>
  @endsection
@include('footer')



</html>