<?php
$sql = "SELECT * FROM producttb LIMIT $startfrom,$num_pages ";

$result = mysqli_query($db_connect, $sql);

if (mysqli_num_rows($result) > 0) {
    return $result;
}
