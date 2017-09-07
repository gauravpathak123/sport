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
       <script type="text/javascript">

           function getCoordinator(id)
           {
                        $.ajax({
                type: 'GET',
                url: '../getApexCoordinator',
                data: {
                   
                    'eventId': id
                  
                    
                },

                success: function (data) {
                    console.log(JSON.parse(data));
                    var table = document.getElementById("showTable");
                    var row = table.insertRow(0);
                    var cell1 = row.insertCell(0);
                    var cell2 = row.insertCell(1);
                    cell1.innerHTML = "NEW CELL1";
                    cell2.innerHTML = "NEW CELL2";
                    document.getElementById("showTable").style.display='block';
                }
            });

           }
       </script>
    </head>
    <body>
        <section id="page-header" class="visual color7">
            <div class="container">
                <div class="text-block">
                    <div class="heading-holder">
                        <h1><i>Student Committe Members</i></h1>
                    </div>
                    </div>
            </div>
        </section>
        <br>
        <br>
        <section>
            <div class="container">
            <div  class="jumbotron">
            <div class="row">
            <div class="col-md-3"></div>
            <div class="col-md-2">
                <label for="EventName">Select Event</label>
            </div>
            <div class="col-md-3">
                <select class="form-control" id="event" name="event" onchange="getCoordinator(this.value);">
                    <option value="">Choose One</option>
                    <?php echo json_encode($Event_Name);?>
                    @foreach($Event_Name as $en)

                    <option value="{{ $en['id'] }}">{{ $en['name'] }}</option>
                    @endforeach
                </select>
            </div>
            </div>
            </div>
            </div>
        </section>

        <div id="showTable" style="display: none;">
            <section>
            <div class="container">
            <div  class="jumbotron">
            <div class="row">
                <table id="showTable" class="table table-responsive table-stripped table-bordered">
                    <thead>
                        <th>S.No.</th>
                        <th>Name</th>
                        <th>Contact No.</th>
                        <th>Branch</th>
                        <th>Year</th>
                    </thead>
                    <tbody>
                    
                    </tbody>
                </table>
            </div>
            </div>
            </div>
        </section>
        <br>
        <section>
            <div class="container">
            <div  class="jumbotron">
            <div class="row">
                <table id="showTable2" class="table table-stripped table-bordered">
                    <thead>
                        <th>S.No.</th>
                        <th>Name</th>
                        <th>Contact No.</th>
                        <th>Branch</th>
                        <th>Year</th>
                    </thead>
                    <tbody>
                             
                    </tbody>
                </table>
            </div>
            </div>
            </div>
        </section>
        </div>
    </body>
        

  <script src="js/jquery.min.js"></script>
  <script src="js/bootstrap.js"></script>
  <script src="js/login.js"></script>
</body>
  @include('footer')
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

