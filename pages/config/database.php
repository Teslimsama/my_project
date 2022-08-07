<?php

$db_connect = mysqli_connect('localhost', 'root', '', 'unibooks');

if(!$db_connect){
   die('error connecting to database'. mysqli_connect_error()); 
}