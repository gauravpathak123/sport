@include('header')

@section('bodyContent')
<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <script type="text/javascript" src="js/jquery.min.js"></script>
        <title>Sports Fest</title>

        <!-- Fonts -->
      
        <!-- Styles -->

      <script>
         function getDept(){
           // console.log('HII');
            jQuery.ajax({
               type:'GET',
               url:'/getDept',
               success:function(data){
                console.log(data);
                  $("#dept").html(data);
               }
            });
         }
         getDept();
      </script>
       
    </head>
    <body>
        <section id="page-header" class="visual color7">
            <div class="container">
                <div class="text-block">
                    <div class="heading-holder">
                        <h1>Enrolled Events</h1>
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
    <center><h2><span><b>Enrolled Events</b></span></h2></center>
    <hr>

       
                <br>
                <table class="table table-striped">
                <thead >
                  <th>S.No</th>
                  <th>Team Name</th>
                  <th>Events</th>
                  <th>Status</th>
                </thead>

                <tbody>
                <?php $i=1;
                foreach($response as $res) {?>
                <tr>
                  <td><?php echo $i++;?></td>
                  <td><?php echo $res['team_name'];?></td>
                  <td><?php echo $res['event_Name'];?></td>
                  <?php if($res['status']=='PAID'){?>
                  <td><?php echo $res['status'];?></td>
                  <?php }
                  else{?>
                   <td><form action="{{ action('StudentController@pay_amount') }}" method="post">
                   {{ csrf_field() }}
                   <button type="submit" class="btn btn-success rounded" data-toggle="collapse" data-target="#payment_div" name="sub_id" value="<?php echo $res['sub_event_id'];?>">Pay</button>
                 </form></td>
                  <?php }?>
                </tr>
               <?php }?>
                </tbody>
                </table>
                <br>
            
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

