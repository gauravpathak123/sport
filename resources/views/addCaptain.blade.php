@include('header')

@section('bodyContent')
<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" type="text/css" href="css/sweetalert.css">
        <script type="text/javascript" src="js/jquery.min.js"></script>
        <script type="text/javascript" src="js/sweetalert.min.js"></script>
        <title>Sports Fest</title>

        <!-- Fonts -->
      
        <!-- Styles -->
         <script>
  function getName(model)
  {
    var d;
            $.ajax({
                type: 'GET',
                url: '../getCaptainName',
                data: {
                   
                    'lib': model
                  
                    
                },

                success: function (data) {
                   d=JSON.parse(data);

                   if(d.error==false)
                   {
                    
                    document.getElementById("sub").disabled = false;
                    document.getElementById("captainid").style.color='green';
                  }
                    else
                    {
                      document.getElementById("sub").disabled = true;
                      document.getElementById("captainid").style.color='red';
                    }
                    $("#captainid").html(d.msg);
                }
    });
          }
          /*function getResponse()
  {
    var d;
            $.ajax({
                type: 'POST',
                url: '../submit',
                data: 
                   $('form[name="shrey"]').serializeArray(),
                    'Event': document.getElementById("Event"),
                    'Dept':document.getElementById("Dept"),
                    'LibId':document.getElementById("LibId"),
                  
                    
                

                success: function (data) {
                   d=JSON.parse(data);

                   if(d.error==false)
                   {
                    swal('Success',data,'success');  
                    document.getElementById("sub").disabled = false;
                    document.getElementById("captainid").style.color='green';
                  }
                    else
                    {
                      document.getElementById("sub").disabled = true;
                      document.getElementById("captainid").style.color='red';
                    }
                    $("#captainid").html(d.msg);
                }
    });
          }*/

  </script>
       
    </head>
    <body>
        <section class="visual color7"  style="height:100px;width:100%;">
            <div class="container">
                <div class="text-block">
                    <div class="heading-holder">
                        <h1>Team Captain</h1>
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
         
        </section>

        <section class="section">
        <div class="container">
<div class="panel panel-default">

    <div class="panel-body">
    <center><h2><span><b>Add Captain</b></span></h2></center>
    <hr>
@if (session('alert'))
  @if(session('error')==true)
    <div class="alert alert-danger" style="text-align: center;font-size: 20px;">
        {{ session('alert') }}
    </div>
    @else
    <div class="alert alert-success" style="text-align: center;font-size: 20px;">
        {{ session('alert') }}
    </div>
    @endif
@endif
        <div class="well">
        <form method="POST" action="{{ url('/submit') }}">
        {{ csrf_field() }}
                <br>
                <div class="row">
              <div class="col-md-1"></div>
              <div class="col-md-3">
                <label for="Department" class="control-label">Select Department</label>
              </div>
                <div class="col-md-6">
                    <select class="form-control" id="Dept" name="Dept" required>
                      <option value="">Chooose One</option>
                        @foreach ($dept as $d) 
                              <option  value="{!! $d->Did !!}">{!! $d->Branch !!}</option>
                        @endforeach
                    </select>

                </div>
         

          </div>
           <br>
                <div class="row">
              <div class="col-md-1"></div>
              <div class="col-md-3">
                <label for="Event" class="control-label">Select Event</label>
              </div>
                <div class="col-md-6">
                    <select class="form-control" id="Event" name="Event" required="">
                        <option value="">Chooose One</option>
                        @foreach ($event_name_arr as $e)
                        <option  value="{!! $e !!}">{!! $e !!}</option>
                          @endforeach
                    </select>

                </div>
         

          </div>
          <br>
           <div class="row">
            <div class="col-md-1"></div>
             <div class="col-md-3">
                    <label for="password" class="control-label">Enter Captain's Library Id</label>
                    </div>
                    <div class="col-md-6">
                        <input id="LibId" type="text" class="form-control" name="LibId" onkeyup ="getName(this.value)" required>
                        <span id="captainid" style="color: red;font-size: 80%;">Kindly Enter LibraryId Of Your Team Member</span>
                
                </div>
          </div>
                <br>
                <br>
                <div class="row">
                <div class="class-md-3"></div>
                <div class="class-md-3">
                    <center><button type="submit" id="sub" class="btn btn-success" >Submit</button></center>
                 </div>
                 
            </div>
            </form>
           

            </div>
             </div>
  </div>
</div>
        </section>

        <section class="section c1">
            <img class="rocket hidden-xs" src="upload/rocket.png" alt="">
           

            <div class="container">
                <div class="section-title text-center">
                    <h3>Meet The Devlopers.</h3>
                    <hr>
                  <div class="row">
                           <a target="_blank" href="http://www.facebook.com/kieterp" ><button type="button" class="btn btn-primary rounded">Team ERP
                            </button>
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

