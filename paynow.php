

<?php
    
 
    include_once 'config/database.php';
    include 'config/alert.message.php';
    
    
    
    
    $student_id = $_SESSION['id'];
    
    $sql = "SELECT * FROM unibooker WHERE id='$student_id';";
    $sql_result = mysqli_query($db_connect,$sql);
    $rows = mysqli_fetch_assoc($sql_result);
    
    
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="apple-touch-icon" sizes="76x76" href="Images/apple-touch-icon.png">
  <link rel="shortcut icon" type="image/png" href="Images/android-chrome-512x512.png">
  <title>
    PayNow || Unibooks
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
  <link id="pagestyle" href="assets/css/material-dashboard.css?v=3.0.4" rel="stylesheet" >
  <link id="pagestyle" href="assets/css/profile.css" rel="stylesheet" >
</head>
<body>
  <div class="container-fluid">
     <div class="contianer card" >
      <div class=" card-body ">

        <form id="paymentForm">
                    <div class="form-group form-control">
                        <label for="email">Email Address</label>
                        <input type="email" id="email-address" value="<?php echo $rows['email'] ;?>" required />
                    </div>
                    <div class="form-group">
                        
                        <input type="hidden" id="amount" value="<?php echo $_POST['amount'] ;?>" required />
                    </div>
                    <div class="form-group">
                        <label for="first-name">First Name</label>
                        <input type="text" value="<?php echo $rows['firstname'] ;?>" id="first-name" />
                    </div>
                    <div class="form-group">
                        <label for="last-name">Last Name</label>
                        <input type="text" value="<?php echo $rows['lastname'] ;?>" id="last-name" />
                    </div>
                    <div class="form-submit">
                        <button type="submit" class="btn btn-dark mt-2" onclick="payWithPaystack()"> Pay </button>
                    </div>
                </form>
    
                <script src="https://js.paystack.co/v1/inline.js"></script> 
                </div>
                </div>
              </div>
            </div>
          </div>
    
          <script>
            const paymentForm = document.getElementById('paymentForm');
        paymentForm.addEventListener("submit", payWithPaystack, false);
        function payWithPaystack(e) {
        e.preventDefault();
    
        let handler = PaystackPop.setup({
            key: 'pk_test_3d44964799de7e2a5abdbf2eef2fbe6852e60833', // Replace with your public key
            email: document.getElementById("email-address").value,
            amount: document.getElementById("amount").value * 100,
            ref: 'unibook'+Math.floor((Math.random() * 1000000000) + 1), // generates a pseudo-unique reference. Please replace with a reference you generated. Or remove the line entirely so our API will generate one for you
            // label: "Optional string that replaces customer email"
            onClose: function(){
              // window.location
            alert('Window closed.');
            },
            callback: function(response){
            let message = 'Payment complete! Reference: ' + response.reference;
            alert(message);
            
            window.location = "http://localhost/my_project/transact_verify?reference=" + response.reference;
    
            }
        });
    
        handler.openIframe();
        }
    </script>
      </div>
    </div>
  </div>
   
    <style>
    .card{
    justify-content: center;
    margin-top: 250px;
    margin-left: 55px;
    }
    </style>
    
    <div class="container-fluid py-4">
         <!-- footer  -->
         <div class="container-fluid bg- mt-5 ">
          <footer class="py-3 my-4 ">
            <ul class="nav justify-content-center border-bottom pb-3 mb-3">
            <li class="nav-item"><a href="about_us" class="nav-link px-2 text-light">Home</a></li>
              <li class="nav-item"><a href="#" class="nav-link px-2 text-light">More Website</a></li>
              <li class="nav-item"><a href="donate" class="nav-link px-2 text-light">Donate</a></li>
              <li class="nav-item"><a href="faq" class="nav-link px-2 text-light">FAQs</a></li>
              <li class="nav-item"><a href="about_us" class="nav-link px-2 text-light">About Us</a></li>
            </ul>
            <p class="text-center text-muted">&copy; 
              <script>
              document.write(new Date().getFullYear())
            </script> Testech, Ltd</p>
            
          </footer>
            </div>
      <!-- footer  -->
    </div>
		
</body>
</html>