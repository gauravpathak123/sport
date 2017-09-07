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
            <h1>Individual Registraion</h1>
          </div>
        </div>
      </div>
    </section>

    <section class="section lb">
      <div class="container">
        <div class="row">
          <div class="well">
            <br>
           

           
            <br>

            <form action="{{ action('StudentController@addIndMembers') }}" method="post">
              {{ csrf_field() }}
               <input type="hidden" name="sub_event_id" id="sub_event_id" value="{!! $event_details[0]->Sub_Event_Id !!}">
                <div class="row">
                   <div class="col-md-1"></div>
                  <div class="col-md-3">
            <label for="Captain" class="control-label">Team Name<span style="color: red;">*</span></label>
            </div>
            <div class="col-md-6">
                   <input type="text" class="form-control" name="team_name" id="team_name" onkeyup ="getTeam(this.value)" required="">
              <span id="id_team" name="text" style="color: red;font-size: 80%;"></span> 
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
            <?php 
            $j=0;
            for($i=0;$i<$event_details[0]->TeamSizeMin-1;$i++){?>
            <div class="row">
            <div class="col-md-1"></div>
            <div class="col-md-3">
            <label for="Captain" class="control-label">Team Member<span style="color: red;">*</span></label>
            </div>
            <div class="col-md-6">
              <input type="hidden" id="num" name="num" value="<?php echo $i;?>"> 
              <input type="text" class="form-control" name="lib[]" id="lib[]" onkeyup ="getName(this.value,<?php echo $i; ?>)" required="">
              <span id="id<?php echo $j; ?>" name="text" style="color: red;font-size: 80%;">Kindly Enter LibraryId Of Your Team Member</span>
            </div>
          </div>
          <?php $j++; }?>

           
          <div class="row"><br><center><button type="submit" id="team_id" name="team_id" value="{!! $team_details[0]->Reg_Id !!}" class="btn btn-primary rounded">Register</button></center></div>

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
  function getName(model,id)
  {
    var d;
    var sub_event_id=document.getElementById('sub_event_id').value;
   // alert(sub_event_id);
          var e={
                   
                    'lib': model,
                     'sub_event_id':sub_event_id
                  
                    
                };
               // console.log(e);
            var r=$.ajax({
                type: 'GET',
                url: '../getName',
                data: e,
                success: function (data) {
                   d=JSON.parse(data);
                   if(d.error==false){
                    document.getElementById("id"+id).style.color='green';
                    document.getElementById('team_id').disabled=false;
                  }
                    else{
                      document.getElementById("id"+id).style.color='red';
                      document.getElementById('team_id').disabled=true;
                    }
                    $("#id"+id).html(d.msg);
                }
    });
          }

  </script>


   <script>
  function getTeam(team)
  {
    //var d;
    //var sub_event_id=document.getElementById('sub_event_id').value;
   // alert(sub_event_id);
          var e={
                   
                    'team': team
                    
                };
                
            var r=$.ajax({
                type: 'GET',
                url: '../getTeam',
                data: e,
                success: function (data) {
                 // console.log(data);
                   d=JSON.parse(data);
                   if(d.error==false){
                    document.getElementById("id_team").style.color='green';
                    document.getElementById('team_id').disabled=false;
                  }
                    else{
                      document.getElementById("id_team").style.color='red';
                      document.getElementById('team_id').disabled=true;
                    }
                    $("#id_team").html(d.msg);
                }
    });
          }

  </script>

  @endsection
@include('footer')



</html>