<?php
$sql = "SELECT * FROM producttb";

$result = mysqli_query($db_connect, $sql);

if (mysqli_num_rows($result) > 0) {
    return $result;
}
