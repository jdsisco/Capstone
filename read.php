<html>  
    <head>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css" 
              integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous">
        <link href="https://gitcdn.github.io/bootstrap-toggle/2.2.2/css/bootstrap2-toggle.min.css" rel="stylesheet">
<script src="https://gitcdn.github.io/bootstrap-toggle/2.2.2/js/bootstrap2-toggle.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
        <meta charset="UTF-8">
        <title></title>
    </head> <body>
        <?php 
          include_once './functions.php';
          $id = filter_input(INPUT_GET, 'id'); 
            $stmt = $db->prepare("SELECT Title, Description, Date, TimeStart, TimeEnd, Room, Panelists FROM cc37panels WHERE id = :id");
            $binds = array(
                ":id" => $id
            );
           $results = ''; $title =''; $desc=''; $day = ''; $start = ''; $end = ''; $panelists = ''; $location = '';
            if ($stmt->execute($binds) && $stmt->rowCount() > 0) {
                $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
                   $title = $results[0]['Title']; 
                   $desc = $results[0]['Description'];
                   $location = $results[0]['Room'];
                   $day = $results[0]['Date']; 
                   $start = $results[0]['TimeStart']; 
                   $end = $results[0]['TimeEnd']; 
                   $panelists =  $results[0]['Panelists'];
                  
            }  
        ?>
        <form name="formView" method="GET">
            <input type="text" class="form-control" name="title" value="<?php echo $title;?>" readonly="readonly"><br>
            <input type="text" class="form-control"  name="desc" value="<?php echo $desc;?>" readonly="readonly"><br>
            <input type="text" class="form-control"  name="date" value="<?echo date('l',strtotime ($row['Date'])); ?>" readonly="readonly"><br>
            <input type="text" class="form-control"  name="room" value="<?echo str_replace("_", " ", $row['Room']);?>" readonly="readonly"><br>
            <input type="text" class="form-control" name="start" value="<?php date('h:i A',strtotime ($row['TimeStart']));?>" readonly="readonly"><br>
            <input type="text" class="form-control" name="end" value="<?php date('h:i A',strtotime ($row['TimeEnd']));?>" readonly="readonly"><br>
            <input type="text" class="form-control" name="panelists" value="<?php echo $row['Panelists']; ?>" readonly="readonly"><br>
            <input type="hidden" value="<?php echo $id?>" name="id"/>
        </form>
        <p> <a class="col-sm-offset-2 btn btn-default" href="programming.php">Go Back</a></p>
    </body>
</html>