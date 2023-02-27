<?php include "session.php" ?>
<?php

include("database.php");

$id = $_GET['id'];

$query = "UPDATE `notifications` SET `status` = 'read' WHERE `id` = $id;";
performQuery($query);



?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="apple-touch-icon" sizes="76x76" href="Images/apple-touch-icon.png">
  <link rel="shortcut icon" type="image/png" href="Images/android-chrome-512x512.png">
  <title>
    Notifications || Unibooks
  </title>
  <!--     Fonts and icons     -->
  <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700,900|Roboto+Slab:400,700" />
  <!-- Nucleo Icons -->
  <link href="assets/css/nucleo-icons.css" rel="stylesheet" />
  <link href="assets/css/nucleo-svg.css" rel="stylesheet" />
  <!-- Font Awesome Icons -->
  <script src="https://kit.fontawesome.com/e9de02addb.js" crossorigin="anonymous"></script>
  <!-- Material Icons -->
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Round" rel="stylesheet">
  <!-- CSS Files -->
  <link id="pagestyle" href="assets/css/material-dashboard.css?v=3.0.4" rel="stylesheet">
  <link id="pagestyle" href="assets/css/profile.css" rel="stylesheet">
  <script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js?client=ca-pub-9952650109664010" crossorigin="anonymous"></script>
</head>

<body>
  <div class="card w-70 text-center">
    <?php

    $query = "SELECT * from `notifications` where `id` = '$id';";
    if (count(fetchAll($query)) > 0) {
      foreach (fetchAll($query) as $i) {
        if ($i['type'] == 'comment') {
          echo '<p class="pt-2 ">' . $i['message'] . '</p>';
        }
      }
    }
    ?> <a href="notifications">Back<i class="material-icons opacity-10">arrow</i></a>
  </div>
  <style>
    .card {
      justify-content: center;
      margin-top: 250px;
      margin-left: 55px;
    }
  </style>

  <?php include "footer.php" ?>

</body>

</html>