<?php
 include_once 'config/database.php';
 session_start();
    $download = $_POST['download'];
    $student_id = $_SESSION['id'];
    
$now = new DateTime();
$timestamp = $now->getTimestamp();
$sql = "INSERT INTO downloads (customerid,book,timestamp) VALUES(?,?,?);";

$stmt = mysqli_stmt_init($db_connect);
mysqli_stmt_prepare($stmt,$sql);
mysqli_stmt_bind_param($stmt,'isi',$student_id,$download,$timestamp);

if(mysqli_stmt_execute($stmt)){
    echo 'bad';
}else{
    $_SESSION['error'] = 'Error while registering';
    header('Location:../signup');
}
?>
<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">book</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <!-- <form action="../../pages/app/forgotten.app.php" method="POST"> -->
        <h4>Which would you like ? </h4>
        <hr>
        <form action="app/download_link.app.php?file=person.jpg" method="POST">
            <input type="hidden" name="download" value="hppay" id="download">

            <button id="download" name="download" vaule="itworked" class="btn btn-dark " >Download to your device <i class="material-icons ms-1 opacity-10">download</i></button>
        </form>


        <a id="download" class="btn btn-dark " href="#">Sent to Your email </a>
       
          
        <!-- </form> -->
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
       
      </div>
    </div>
  </div>
</div>