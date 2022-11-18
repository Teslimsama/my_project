<?php

$sql_pro = "SELECT * FROM project LIMIT $startfrom,$num_pages";

$pro = mysqli_query($db_connect, $sql_pro);

if (mysqli_num_rows($pro) > 0) {
    return $pro;
}