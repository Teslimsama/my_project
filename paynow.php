<?php include "session.php";
include 'alert.message.php';

if (isset($_GET['id'])) {
  $id = $conn->quote($_GET['id']);
  $sql = "SELECT * FROM producttb WHERE id=$id";
  $result = $conn->query($sql) or die('bad query');
  $row = $result->fetch(PDO::FETCH_ASSOC);
} else {
  header("location:project");
}
if (!isset($user['id'])) {
  $_SESSION['error'] = 'Signin First !!!';
  header("location:Signin");
}
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
  <link id="pagestyle" href="assets/css/material-dashboard.css?v=3.0.4" rel="stylesheet">
  <link id="pagestyle" href="assets/css/profile.css" rel="stylesheet">
</head>

<body>
  <div class="container">
    <div class="row">
      <div class="col-12 vw-80">
        <div class="card">
          <div class=" card-body ">

            <form id="payForm">
              <div class="input-group input-group-outline my-3">
                <label for="email">Email Address</label>
                <input type="email" class="form-control w-100" id="email-address" value="<?php echo $user['email']; ?>" required />
              </div>
              <div class="input-group input-group-outline my-3">

                <input type="hidden" id="amount" value="<?php echo $row['product_price']; ?>" />
                <input type="hidden" name="phone" id="phone" value="<?php echo $user['phone'] ?>" required />
              </div>
              <div class="input-group input-group-outline my-3">
                <label for="first-name">First Name</label>
                <input type="text" class="form-control w-100" value="<?php echo $user['firstname']; ?>" id="first-name" />
              </div>
              <div class="input-group input-group-outline my-3">
                <label for="last-name">Last Name</label>
                <input type="text" class="form-control w-100" value="<?php echo $user['lastname']; ?>" id="last-name" />
              </div>
              <div class="my-3">
                <label for="payment">Form of Payment</label>
                <div class="form-check">
                  <input id="credit" name="paymentMethod" type="radio" class="form-check-input" checked required>
                  <label class="form-check-label" onclick="paystack()" for="credit">Paystack</label>
                </div>
                <div class="form-check">
                  <input id="debit" name="paymentMethod" type="radio" class="form-check-input" required>
                  <label class="form-check-label" onclick="flutterwave()" for="debit">Flutterwave</label>
                </div>
                <div class="form-check">
                  <input id="paypal" name="paymentMethod" type="radio" class="form-check-input" required>
                  <label class="form-check-label" onclick="bank_transfer()" for="paypal">Bank Transfer</label>
                </div>
              </div>

              <div class="form-submit">
                <div id="paystack">
                  <button type="submit" class="btn  btn-dark btn-large  mt-4" onclick="payWithPaystack()"> Pay </button>
                  <a href="#" class="btn  btn-dark btn-large  mt-4" onclick="history.back()">Cancel</a>

                </div>
                <div style="display: none;" id="flutterwave">
                  <button type="submit" class="btn  btn-dark btn-large  mt-4" onclick="payNow()"> Pay</button>
                  <a href="#" class="btn  btn-dark btn-large  mt-4" onclick="history.back()">Cancel</a>

                </div>
                <div style="display: none;" id="bank_transfer">
                  <button type="button" class="btn  btn-dark btn-large  mt-4" data-bs-toggle="modal" data-bs-target="#staticBackdrop"> mPay</button>

                  <a href="#" class="btn  btn-dark btn-large  mt-4" onclick="history.back()">Cancel</a>

                </div>
              </div>
            </form>

            <script src="https://checkout.flutterwave.com/v3.js"></script>
            <script src="https://js.paystack.co/v1/inline.js"></script>
            <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-u1OknCvxWvY5kfmNBILK2hRnQC3Pr17a+RTT6rIHI7NnikvbZlHgTPOOmMi466C8" crossorigin="anonymous"></script>


          </div>
        </div>
      </div>
    </div>
  </div> <?php
          include "pay_modal.php"
          ?>
  <script>
    let div = document.getElementById('paystack');
    let display = 0;
    let div2 = document.getElementById('flutterwave');
    let div3 = document.getElementById('bank_transfer');

    function paystack() {

      div.style.display = 'block';
      div2.style.display = 'none';
      div3.style.display = 'none';


    }

    function flutterwave() {

      div.style.display = 'none';
      div2.style.display = 'block';
      div3.style.display = 'none';

    }

    function bank_transfer() {

      div3.style.display = 'block';
      div2.style.display = 'none';
      div.style.display = 'none';

    }
  </script>
  <script src="assets/js/checkout.js"></script>

  </div>
  </div>
  </div>

  </div>
  </div>


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
          </script> Testech, Ltd
        </p>

      </footer>
    </div>
    <!-- footer  -->
  </div>

</body>

</html>