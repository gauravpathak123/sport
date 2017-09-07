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
            <h1>Group Registraion</h1>
          </div>
        </div>
      </div>
    </section>

    <section class="section lb">
      <div class="container">
        <div class="row">
          <div class="well">
            <br>
            <div class="row"> 

           <div >
           
              <div class="alert alert-warning" id="alert"> <center id="alertmsg" >Kindly enter library id for team members </center></div>
            </div>
            </div>
            <br>
            <div class="row">
            <div class="col-md-1"></div>
            <div class="col-md-3">
            <label for="Captain" class="control-label">Team Captain</label>
            </div>
            <div class="col-md-6">

             <input type="text" class="form-control" name="captain" value="{!! $captain_name !!} ( {!! $captain_lib !!} )" disabled>
            </div>
            </div>
            <br>

            <form name="reg" action="{{ url('/groupRegistrationSuccess') }}" method="post"  >
              {{ csrf_field() }}
             
             <div class="row">
            <div class="col-md-1"></div>
            <div class="col-md-3">
            <label for="Captain" class="control-label">Team Name<span style="color: red;">*</span></label>
            </div>
            <div class="col-md-6">
              <input type="text" class="form-control" name="team_name" id="team_name"  required="" onkeyup=" getName();">
                   
              </div>
            
              
          </div class="row" >
            <center>
          <div>
              <div class="col-md-4" >
             
                 <span id="span" name="text1" style="color: red;font-size: 80%;"></span>
              
              </div>
              </div>
            </center>
            <br>
              <br>
            <?php 
            $j=1;
            for($i=0;$i<$event_details[0]->TeamSizeMin-1;$i++){?>
            <div class="row">
            <div class="col-md-1"></div>
            <div class="col-md-3">
            <label for="Captain" class="control-label">Team Member<span style="color: red;">*</span></label>
            </div>
            <div class="col-md-6">
              <input type="hidden" id="num" name="num" value="<?php echo $i;?>"> 
              <input type="text" class="form-control" name="lib[]" id="lib[]"  required=""  onkeyup="getName(this.value,<?php echo $j; ?>); " >
                <span id="id<?php echo $j++; ?>" name="text" style="color: red;font-size: 80%;"></span>
               
            </div>
          </div>
          <br>
          <?php }?>

           <?php for($i=$event_details[0]->TeamSizeMin;$i<$event_details[0]->TeamSizeMax;$i++){?>
            <div class="row">
            <div class="col-md-1"></div>
            <div class="col-md-3">
            <label for="Captain" class="control-label">Team Member</label>
            </div>
            <div class="col-md-6">
              <input type="hidden" id="num" name="num" value="<?php echo $i;?>"> 
              <input type="text" class="form-control" name="lib[]" id="lib[]" onkeyup="getName(this.value,<?php echo $j; ?>);" >
               <span id="id<?php echo $j++; ?>" name="text" style="color: red;font-size: 80%;"></span>
               
            </div>
          </div>
          <br>
          <?php }?>
             <input type="hidden" id="captain_lib_id" name="captain_lib_id" value="{!! $captain_lib !!}">
              <input type="hidden" id="event_id" name="event_id" value="{!! $event_details[0]->Sub_Event_Id !!}">
               <input type="hidden" id="team_id" name="team_id" value="{{$team_details}}" >
               <div class="row">
               <div class="col-md-3"></div>
               <div class="col-md-6">
          <button center type="submit" id="team" name="team"  class="btn btn-primary rounded " disabled="">Register</button>
          </div></div>
          </div>
        </form>
         
          <!-- end content -->
        </div>
        <!-- end row -->
      </div>
      <!-- end container -->
    </section>
  <script src="{!!  URL::to('js/jquery.min.js') !!}"></script>
  <script src="{!!  URL::to('js/bootstrap.js') !!}"></script>
  <script src="{!!  URL::to('js/login.js') !!}"></script>
 
  <script>

function getName(model,id) {
         
                      //alert(model);
                      //console.log(document.getElementById("lib[]").value.length);
            $.ajax({
                type: 'GET',
                
                url: '../getName',
                data: {'lib': model
                },
                success: function (data){
                  
                   d=JSON.parse(data);
                  // console.log(d);
                   if(d.error==false)
                   {
                    //document.getElementById("lib").value=d.error;
                    document.getElementById("id"+id).style.color='green';
                   }
                    else
                    {
                     // document.getElementById("lib").value=d.error;
                      document.getElementById("id"+id).style.color='red';
                    }
                    $("#id"+id).html(d.msg);
                }
    });
              $.ajax({
        type : 'POST',
        url : '../groupRegistration',
        data : $('form[name="reg"]').serializeArray(),

        /* {
          'team_name': team_name,
          'captain_lib_id' : captain_lib_id,
          'event_id': event_id,
          'team_id' : team_id,
          'lib' :lib,
        },*/
        success: function(data){
          d=JSON.parse(data);
           console.log(d);
          if(d.error==true){
            document.getElementById("alert").className = "alert-warning";
            $("#alertmsg").html(d.msg);

          }
          else{
            document.getElementById("alert").className = "alert-success";
            $("#alertmsg").html(d.msg);

          }
          document.getElementById("team").disabled=d.error;
        }
      });

          }


  </script>
  @endsection
@include('footer')



</html>