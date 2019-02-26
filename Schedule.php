<!DOCTYPE html>
<html>
    <head>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css" 
              integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous">
        <link href="https://gitcdn.github.io/bootstrap-toggle/2.2.2/css/bootstrap2-toggle.min.css" rel="stylesheet">
<script src="https://gitcdn.github.io/bootstrap-toggle/2.2.2/js/bootstrap2-toggle.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <?php 
          include_once './functions.php';
        
          
       $action = filter_input(INPUT_GET, 'action');
       
        
        ?>
         
        <div class="row">
            <form action="#" method="get">
  <div class="col-md-3"><label class="checkbox">
            <input type="checkbox" data-toggle="toggle" data-width="100" data-style="quick" data-on="Friday" data-off="Friday" name ="fridayButton"> 
        </label></div>
  <div class="col-md-3"><label class="checkbox">
            <input type="checkbox" data-toggle="toggle" data-width="100" data-style="quick" data-on="Saturday" data-off="Saturday" name ="saturdayButton"> 
        </label></div>
  <div class="col-md-3"><label class="checkbox">
            <input type="checkbox" data-toggle="toggle" data-width="100" data-style="quick" data-on="Sunday" data-off="Sunday"name ="sundayButton"> 
        </label></div>
  <div class="col-md-3"><label class="checkbox">
            <input type="checkbox" data-toggle="toggle" data-width="100" data-style="quick" data-on="Monday" data-off="Monday" name ="mondayButton"> 
        </label></div>
                 </div>
            <br><br>
  <div class="form-group col-md-6">
        <select id="room" class="form-control">
            <option value="" selected>Select a Room:</option>
            <option value="Newburyport">Newburyport</option>
            <option value="Gloucester_A">Gloucester A</option>
            <option value="Gloucester_B">Gloucester B</option>
            <option value="Marblehead_A">Marblehead A</option>
            <option value="Marblehead_B">Marblehead B</option>
            <option value="Georgetown">Georgetown</option>
            <option value="Ipswich">Ipswich</option>
        </select>
  </div>
                <script> 
                $('select').on('change', function() {
                window.location.href="programming.php?room="+this.value;
                    });
                
                </script>
                
<!--        <input type="hidden" name="action" value="Submit2" />
        <input type="submit" value="Submit"  />-->
            </form> <?php 
        $room = filter_input(INPUT_GET, 'room');
       $searchWord = '';
       $results = array();
       if (isset($room)){
          
           $results = getRoom($room);
           
       }
       
//        if ( $action === 'Submit1' ) {
//            echo 'Searching Data...';
//           $results = getSearch();
//        }
//        else if ( $action === 'Submit2' ) {
//            echo 'Sorting Data...';
//           $results = getSort();
//        } 
        else {
            $results = getAll();
       }

        ?>
           
   
          <table class="table" >
            <thead class="PanelHeader">
                <tr>
                    <th></th>
                    <th>Day:</th>
                    <th>Title:</th>
                    <th>Start:</th>
                    <th>End:</th>
                    <th>Room:</th>
            </thead>
            <?php foreach ($results as $row): ?>
                <tr>
                    <td><a class="btn btn-info" href="./read.php?id=<?php echo $row['id']; ?>">Select</a></td>  
                    <td><?php echo date('l',strtotime ($row['Date'])); ?></td>     
                    <td><?php echo $row['Title']; ?></td>
                    <td><?php echo date('h:i A',strtotime ($row['TimeStart'])); ?></td>
                    <td><?php echo date('h:i A',strtotime ($row['TimeEnd'])); ?></td> 
                    <td><?php echo str_replace("_", " ", $row['Room']); ?></td>
                             
                </tr>
            <?php endforeach; ?> 
        </table>
    </body>
</html>
