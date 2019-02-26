<?php
function getDatabase() {
    
       
        $config = array(
            'DB_DNS' => 'mysql:host=ict.neit.edu;port=5500;dbname=se266_jamila;',
            'DB_USER' => 'se266_jamila',
            'DB_PASSWORD' => '8001513'
        );
       
     try {
            $db = new PDO($config['DB_DNS'], $config['DB_USER'], $config['DB_PASSWORD']);
            $db->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
        } catch (Exception $ex) {
            echo $ex->getMessage();
            $db = null;
        }
        

    return $db;
}


function isPostRequest() {
    return ( filter_input(INPUT_SERVER, 'REQUEST_METHOD') === 'POST' );
}
function getSearch(){
            $db = getDatabase();
            $column1 =  filter_input(INPUT_GET, 'category');
            $searchWord = filter_input(INPUT_GET, 'search1');
            $stmt = $db->prepare("SELECT * FROM cc37panels WHERE $column1 LIKE :search");
            $search = '%'.$searchWord.'%';
            $binds = array(
                ":search" => $search
                    );
            if ($stmt->execute($binds) && $stmt->rowCount() > 0) {
                $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
            }
            return $results;
}
function getDay(){
            $db = getDatabase();
//            $date = filter_input(INPUT_GET, 'date');
//            $column2 = filter_input(INPUT_GET, 'columnSort');
            $stmt = $db->prepare("SELECT * FROM cc37panels Where Date = :date order by TimeStart");
            $binds = array(
                ":date" => $date
            );
            if ($stmt->execute($binds) && $stmt->rowCount() > 0) {
                $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
            }
            return $results;
}
function getRoom($room){
            $results = array();
            $db = getDatabase();
            $stmt = $db->prepare("SELECT * FROM cc37panels WHERE Room = :room order by Date");
            $binds = array(
                ":room" => $room
            );
            if ($stmt->execute($binds) && $stmt->rowCount() > 0) {
                $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
            }
            return $results;
}
function getAll(){
    
            $db = getDatabase();
            $stmt = $db->prepare("SELECT * FROM cc37panels order by Date");
        if ($stmt->execute() && $stmt->rowCount() > 0) {
             $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
        }
              return $results;
}
