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
       <style>
           #rcorners1 {
    border-radius: 25px;
    background: #FF4500;
    padding: 20px; 
    width: 500px;
        
}
       </style>
    </head>
    <body>
        <section id="page-header" class="visual color7">
            <div class="container">
                <div class="text-block">
                    <div class="heading-holder">
                        <h1><i>Registered Student Report</i></h1>
                    </div>
                    </div>
            </div>
        </section>

        <section class="section">
            <div class="container">
            <form  class="row form-horizontal" method="post" action="{{URL('/groupEventDetails')}}">
                                    {{ csrf_field() }}
               
                    <div class="well">
                    <br>
                        <div class="contact_form">
                            <div id="message"></div>
                                <div id="form_div1"> 
                                 <div class="row">
                                        <div class="col-md-3"></div>
                                            <div class="col-md-3">
                                                <label class="control-label " style="color: black;">Event Name</label>
                                            </div>
                                            <div class="col-md-4">
                                                <select class="form-control" name="event" required>
                                                    <option value="">Choose One</option>
                                                    @foreach($events as $event)
                                                    <option value="{{$event->Sub_Event_Id}}">{{$event->Name}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        
                                        

                                        
                                </div>
                           
                        </div>
                    
                </div>
                <br>
                <br>
                <div class="row">
                

                <center><button type="submit" class="btn btn-primary rounded">Submit</button></center>
                </div>
                </div>
                                    </form>
            </div><!-- end container -->  
        </section>
@include('footer')
    </body>
        
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
