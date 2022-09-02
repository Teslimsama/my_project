<h1>Notifications</h1>

<?php
    
    include("config/database.php");

    $id = $_GET['id'];

    $query ="UPDATE `notifications` SET `status` = 'read' WHERE `id` = $id;";
    performQuery($query);

    $query = "SELECT * from `notifications` where `id` = '$id';";
    if(count(fetchAll($query))>0){
        foreach(fetchAll($query) as $i){
            if($i['type']=='comment'){
                echo $i['message'];
            }
        }
    }
    
?><br/>
// <a href="notifications">Back</a>