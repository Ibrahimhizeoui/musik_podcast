
<!DOCTYPE html>
<html>
<head>
   <title>Tuto</title>
   <!-- Fonts -->
   <link href="https://fonts.googleapis.com/css?family=PT+Sans:400,400i,700,700i" rel="stylesheet">
   <!-- css -->
   <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
   <link rel="stylesheet" type="text/css" href="css/style.css">
</head>
<body onload="initialize()">

<!-- End Header-->
<section class="container-fluid banner">
   <div class="ban">
      <img src="img/bg1.jpg">
   </div>
   <div class="inner-banner" style="top: 10%;">
      <h1>Matcha en podd med din resa</h1>
      <div class="col-md-6 ">
            <form class="form-horizontal maps" action="" method="post">
          
    
            
            <div class="form-group">
              
              <div class="col-md-6">
                <input id="from" name="from" type="text" placeholder="Från" class="form-control">
              </div>
            </div>
           <div class="form-group">
              
              <div class="col-md-6">
                <input id="to" name="to" type="text" placeholder="Till" class="form-control">
              </div>
            </div>
    
            <div class="form-group">
              <div class="col-md-6">
                <button type="submit" class="btn btn-primary ">Hitta</button>
              </div>
            </div>
          
          </form>


   </div>
   <?php
       if(isset($_POST["from"])&& isset($_POST["from"])){

        ?>
   <div class="col-md-6" style="background:#EEE;padding: 20px;">
     <div class="bs-example" data-example-id="striped-table">
     <?php
      
      $from=$_POST["from"];
       $to=$_POST["to"];
       $from=urlencode($from);
       $to=urlencode($to);
       
       $url="https://maps.googleapis.com/maps/api/distancematrix/json?origins=$from&destinations=$to";
       $json =  file_get_contents($url);    
         $array = json_decode($json, true);
         $duration=$array["rows"][0]["elements"][0]["duration"]["text"];
         $distance=$array["rows"][0]["elements"][0]["distance"]["text"];
         $pieces = explode(" ", $duration);
         
     ?>
      <h2><?php echo "Din resa ska ta $duration och distance är $distance";?></h2>
      <table class="table table-striped"> 
      <thead> 
      <tr> 
      <th>Rank</th> <th>NAMN</th> <th>Tid</th> </tr> </thead>
       <tbody> 
       
       <?php

         $json =  file_get_contents('https://itunes.apple.com/search?term=podcast&output=json&limit=10&offset=5');    
         $array = json_decode($json, true);

    foreach($array['results'] as $value)
    {?>
       <tr data-toggle="modal" data-target="#myModal">

        <th scope="row">1</th> <td><?php echo $value['artistName']?></td>
          <td><?php echo $duration?></td>  <div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        
        <div class="modal-body">
        <a href="https://itunes.apple.com/WebObjects/MZStore.woa/wa/viewAlbum?i=120954025&id=120954021&s=1" class="btn btn-primary">play me </a>
        <!-- Problem 2 -->
        </div>
        
      </div>
      
    </div>
  </div></tr> <?php  }}?> </tbody> 
       </table> </div>
   </div>
</section>
<!-- End Banner-->

<!-- End footer-->

<!--Js-->

<script type="text/javascript" src="js/jquery.js"></script>
<script type="text/javascript" src="js/bootstrap.min.js"></script>

<script src="https://maps.googleapis.com/maps/api/js?v=3.exp&sensor=false&libraries=places"></script>
        <script>
            var from;
            function initialize() {
              from = new google.maps.places.Autocomplete(
                  /** @type {HTMLInputElement} */(document.getElementById('from')),
                  { types: ['geocode'] });
              google.maps.event.addListener(from, 'place_changed', function() {
              });
              to = new google.maps.places.Autocomplete(
                  /** @type {HTMLInputElement} */(document.getElementById('to')),
                  { types: ['geocode'] });
              google.maps.event.addListener(to, 'place_changed', function() {
              });
            }

        </script>
        

</body>
</html>