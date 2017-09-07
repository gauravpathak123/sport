
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


   <section id="page-header" class="visual color1">
      <div class="container">
        <div class="text-block">
          <div class="heading-holder">
            <h1>404 NOT FOUND</h1>
          </div>
        </div>
      </div>
    </section>

  <script src="{!!  URL::to('js/jquery.min.js') !!}"></script>
  <script src="{!!  URL::to('js/bootstrap.js') !!}"></script>
  <script src="{!!  URL::to('js/login.js') !!}"></script>




</html>