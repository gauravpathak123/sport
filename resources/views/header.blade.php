
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
    <link rel="shortcut icon" href="images/favicon.ico" type="image/x-icon">
    <link rel="apple-touch-icon" href="images/apple-touch-icon.png">
    <link rel="apple-touch-icon" sizes="57x57" href="images/apple-touch-icon-57x57.png">
    <link rel="apple-touch-icon" sizes="72x72" href="images/apple-touch-icon-72x72.png">
    <link rel="apple-touch-icon" sizes="76x76" href="images/apple-touch-icon-76x76.png">
    <link rel="apple-touch-icon" sizes="114x114" href="images/apple-touch-icon-114x114.png">
    <link rel="apple-touch-icon" sizes="120x120" href="images/apple-touch-icon-120x120.png">
    <link rel="apple-touch-icon" sizes="144x144" href="images/apple-touch-icon-144x144.png">
    <link rel="apple-touch-icon" sizes="152x152" href="images/apple-touch-icon-152x152.png">

    <!-- TEMPLATE STYLES -->
    <link rel="stylesheet" type="text/css" href="css/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="style.css">
    <link rel="stylesheet" type="text/css" href="css/colors.css">
 

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
                                <li ><a href="index.php">Home</a></li>
                                <li><a href="events.php">Events</a></li>
                              <li><a href="show_details.php">Co-ordinators</a></li>
                              <li><a href="contact.php">Contact</a></li>
                              <?php
                              
                                //if(isset($_SESSION['Hash3'])){
                                  //if($_SESSION['Hash3']=='Student'){
                              ?>
                                <li class="dropdown hasmenu">
                                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Athlete's Corner <span class="fa fa-angle-down"></span></a>
                                    <ul class="dropdown-menu">
                                        <li><a href="student_view_schedule.php">Events Schedule</a></li>
                                        <li><a href="student_dash.php">Registration For Events</a></li>
                                        <li><a href="edit_team.php">Enrolled Events</a></li>
                                       
                                    </ul>
                                </li>
                              <?php //}
                                  //else if($_SESSION['Hash3']=='APEX'){
                                    ?>
                             <!-- <li class="dropdown hasmenu">
                                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Apex Corner <span class="fa fa-angle-down"></span></a>
                                    <ul class="dropdown-menu">
                                        <li><a href="apex.php">Add Co-ordinators</a></li>
                                        <li><a href="add_events_details.php">Define Event Details</a></li>
                                        <li><a href="pool_matching.php">Pool Details</a></li>
                                        <li><a href="schedule_set.php">Schedule Add/Update</a></li>
                                        <li><a href="registed_student.php">Enrolled Students</a></li>
                                       
                                    </ul>
                                </li>-->
                              <?php// }
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
                              <li class="active"><a href="logOut.php" >LogOut</a></li>
                              <?php //}
                              //else{
                                ?>
                                <li class="active"><a data-toggle="modal" data-target="#login">Login</a></li>
                              <?php
                              //} ?>
                                
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
        <form action="authentication.php" method="Post">
          
          </form>
          <div class="row">
        <div class="col-md-2"></div>
        <div class="col-md-4"><h4>
          UserName:
          </h4></div>
        <div class="col-md-4">
         <input type="text" class="form-control" id="loginId" name='username'>
          </div>
          </div>
           <div class="row">
        <div class="col-md-2"></div>
        <div class="col-md-4"><h4>
          Password
          </h4></div>
        <div class="col-md-4">
         <input type="password" class="form-control" id="loginPass" name='password'>
          </div>
          </div>
          <div class='row'>
            <center> <div id="loginResult" style='color:red;'>
            </div></center>
          </div>
        </div>
        <div class="modal-footer">
          <button type="submit" id="loginSubmit" class="btn btn-primary">Submit</button>
        </div>
       
        </div>
        </form>
      </div>

  </div>
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