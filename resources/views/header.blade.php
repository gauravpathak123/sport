<!doctype html>
<html lang="en">
<head>

       <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

    <!-- SITE META -->
    <title>Sports Fest</title>
    <meta name="description" content="">
    <meta name="author" content="">
    <meta name="keywords" content="">

    <!-- FAVICONS -->
    <link rel="shortcut icon" href="{!!  URL::to('images/favicon.ico') !!}" type="image/x-icon">
    <link rel="apple-touch-icon" href="{!!  URL::to('images/apple-touch-icon.png') !!}">
    <link rel="apple-touch-icon" sizes="57x57" href="{!!  URL::to('images/apple-touch-icon-57x57.png') !!}">
    <link rel="apple-touch-icon" sizes="72x72" href="{!!  URL::to('images/apple-touch-icon-72x72.png') !!}">
    <link rel="apple-touch-icon" sizes="76x76" href="{!!  URL::to('images/apple-touch-icon-76x76.png') !!}">
    <link rel="apple-touch-icon" sizes="114x114" href="{!!  URL::to('images/apple-touch-icon-114x114.png') !!}">
    <link rel="apple-touch-icon" sizes="120x120" href="{!!  URL::to('images/apple-touch-icon-120x120.png') !!}">
    <link rel="apple-touch-icon" sizes="144x144" href="{!!  URL::to('images/apple-touch-icon-144x144.png') !!}">
    <link rel="apple-touch-icon" sizes="152x152" href="{!!  URL::to('images/apple-touch-icon.png') !!}">

    <!-- TEMPLATE STYLES -->
    <link rel="stylesheet" type="text/css" href="{!!  URL::to('css/bootstrap.css') !!}">
    <link rel="stylesheet" type="text/css" href="{!!  URL::to('css/style.css') !!}">
    
    <link rel="stylesheet" type="text/css" href="{!!  URL::to('css/colors.css') !!}">
    <script type="text/javascript" src="{!!  URL::to('js/jquery.min.js') !!}"></script>

    <!--[if IE]>
    <script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->
  
  <script>
  function getdata(reg)
  {
        //alert(reg);

    try{
   
   ajaxRequest = new XMLHttpRequest();
  
 }catch (e){
  
   try{
      ajaxRequest = new ActiveXObject("Msxml2.XMLHTTP");
      
   }catch (e) {
      try{
         ajaxRequest = new ActiveXObject("Microsoft.XMLHTTP");
         
      }catch (e){
        
         alert("Your browser broke!");
         return false;
      }
   }
 }

 ajaxRequest.onreadystatechange = function(){
   if(ajaxRequest.readyState == 4){
      var ajaxDisplay = document.getElementById('rule');
      
      ajaxDisplay.innerHTML = ajaxRequest.responseText;
      //alert(ajaxDisplay.length);
   }
 }
 ajaxRequest.open("GET", "get_rules.php?e="+reg, true);
 ajaxRequest.send(); 
  }
</script>

</head>

<div id="wrapper">
        <header class="header">
            <div class="container">
                <nav class="navbar navbar-default navbar-static-top">
                    <div class="container-fluid">
                        <div class="navbar-header">
                            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                                <span class="sr-only">Toggle navigation</span>
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                            </button>
                            <a class="navbar-brand" href="index.php"><img src="images/logo.png" id="logo" width="100%" alt=""></a>
                        </div>
                        <div id="navbar" class="navbar-collapse collapse">
                            <ul class="nav navbar-nav navbar-right">
                                <li ><a href="{!!  URL::to('/') !!}">Home</a></li>
                                <li id="events"><a href="{!!  URL::to('/#event') !!}">Events</a></li>
                                
                              <li class="dropdown hasmenu"><a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Co-ordinators<span class="fa fa-angle-down"></span></a>
                                <ul class="dropdown-menu">
                                  <li><a href="{!!  URL::to('core_comittee') !!}">Core commitee</a></li>
                                  <li><a href="{!!  URL::to('/') !!}">Student commitee</a></li>
                                </ul></li>

                                <li><a href="{!!  URL::to('contact_us') !!}">Contact us</a></li>

                              <?php
                              
                                if(Auth::check()){
                                  if(Auth::user()->Hash3=="Student"){
                              ?>
                                <li class="dropdown hasmenu">
                                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Athlete's Corner <span class="fa fa-angle-down"></span></a>
                                    <ul class="dropdown-menu">
                                        <li><a href="{!!  URL::to('coming_soon') !!}">Events Schedule</a></li>
                                        <li><a href="{!!  URL::to('student_dash') !!}">Registration For Events</a></li>
                                        <li><a href="{!!  URL::to('my_events') !!}">Enrolled Events</a></li>
                                       
                                    </ul>
                                </li>
                              <?php }else if(Auth::user()->Hash3=='core'){
                                    ?>


                             <li class="dropdown hasmenu">
                                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Reports <span class="fa fa-angle-down"></span></a>
                                    <ul class="dropdown-menu">
                                        <li><a href="{!!  URL::to('paidStudentReport') !!}">Paid Student Report</a></li>
                                        <li><a href="{!!  URL::to('registeredStudentReport') !!}">Registered Student Report</a></li>
                                       
                                    </ul>
                                </li>

                             <li class="dropdown hasmenu">
                                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Admin Corner <span class="fa fa-angle-down"></span></a>
                                    <ul class="dropdown-menu">
                                        <li><a href="{!!  URL::to('/addCaptain') !!}">Add Captain</a></li>
                                        <li><a href="{!!  URL::to('/') !!}">Add Apex</a></li>
                                       
                                    </ul>
                                </li>

                              <?php }
                             // else if($_SESSION['Hash3']=='ADMIN'){
                                    ?>
                              <!--<li class="dropdown hasmenu">
                                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Admin Corner <span class="fa fa-angle-down"></span></a>
                                    <ul class="dropdown-menu">
                                        <li><a href="add_apex.php">Add Apex</a></li>
                                        <li><a href="add_event.php">Add Events</a></li>
                                        <li><a href="approve_paid.php">Collect Registration Fees</a></li>
                                        <li><a href="registed_student.php">Enrolled Students</a></li>
                                        <li><a href="view_registered_students.php">Registered Students</a></li>
                                       
                                    </ul>
                                </li>-->
                              <?php// }
                              ?>
                               <li>
                                  <a href="{{ route('logout') }}"
                                      onclick="event.preventDefault();
                                               document.getElementById('logout-form').submit();">
                                      LogOut
                                  </a>

                                  <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                      {{ csrf_field() }}
                                  </form>
                              </li>
                              
                              <?php }
                              else{
                                ?>
                                <li class="active"><a href="#" data-toggle="modal" data-target="#login">Login</a></li>
                              <?php
                              } ?>
                                
                            </ul>
                        </div>
                    </div><!-- end container-fluid -->
                </nav><!-- end navbar -->
            </div><!-- end container -->
        </header><!-- end header -->
</div> 
 <div id="login" class="modal fade" role="dialog" style="width:100%;">
    <div class="modal-dialog">

      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Login<font size="-1">(Use Erp Student Portal Credential to Login)</font></h4>
        </div>
        <div class="modal-body">

        <form class="form-horizontal" method="POST" action="{{ route('login') }}">
          {{ csrf_field() }}
          
          <div class="row">
              <div class="col-md-1"></div>
              <div class="col-md-3">
                <label for="email" class="control-label">Username</label>
              </div>
                <div class="col-md-6">
                    <input class="form-control" name="email"  required autofocus>

                </div>
         

          </div>
          <br>
           <div class="row">
            <div class="col-md-1"></div>
             <div class="col-md-3">
                    <label for="password" class="control-label">Password</label>
                    </div>
                    <div class="col-md-6 {{ $errors->has('password') ? ' has-error' : '' }}">
                        <input id="password" type="password" class="form-control" name="password" required>
                        @if ($errors->has('password'))
                            <span class="help-block">
                                <strong>{{ $errors->first('password') }}</strong>
                            </span>
                        @endif
                
                </div>
          </div>

           <div class="form-group">
                <div class="col-md-6 col-md-offset-4">
                    <div class="checkbox">
                        <label>
                            <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}> Remember Me
                        </label>
                    </div>
                </div>
            </div>

          
          <div class='row'>
            <center> <div id="loginResult" style='color:red;'>
            </div></center>
          </div>
        </div>
        <div class="modal-footer">
          <center><button type="submit" id="loginSubmit" class="btn btn-primary">Submit</button></center>
        </div>
       
        </div>
        </form>
      </div>

  </div>

  <script>
$("#events").on('click',function() {
    $('html, body').animate({
        'scrollTop' : $("#event").position().top
    },700);
});
</script>>
<script>
   window.onload=function(){adjustStyle();}
     function adjustStyle() {
    width = parseInt(screen.width);
    if(width<701) 
    {
        document.getElementById('logo').setAttribute("width", "40%");
    } else if ((width>=701)&&(width<900)) {
        document.getElementById('logo').setAttribute("width", "70%");
    } else {
       document.getElementById('logo').setAttribute("width", "100%"); 
    }
}
  </script>     

@yield('bodyContent')
@yield('footerContent')