<?php include "session.php" ?>
<!DOCTYPE html>
<html lang="en">

<head>
  <?php include "meta.php" ?>
  <title>
    FAQs || UniBooks
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
  <link id="pagestyle" href="assets/css/material-dashboard.css?v=3.0.4" rel="stylesheet" />
  <link id="pagestyle" href="assets/css/faq.css" rel="stylesheet" />
  <!-- <link rel="stylesheet" href="assets/css/cheatsheet.css"> -->
  <script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js?client=ca-pub-9952650109664010" crossorigin="anonymous"></script>

</head>

<body class="g-sidenav-show  bg-gray-200">
  <?php include 'sidebar.php' ?>

  <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
    <!-- Navbar -->
    <nav class="navbar navbar-main navbar-expand-lg px-0 mx-4 shadow-none border-radius-xl" id="navbarBlur" data-scroll="true">
      <div class="container-fluid py-1 px-3">
        <nav aria-label="breadcrumb">
          <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
            <li class="breadcrumb-item text-sm"><a class="opacity-5 text-dark" href="index">Home</a></li>
            <li class="breadcrumb-item text-sm text-dark active" aria-current="page">FAQs</li>
          </ol>
          <h6 class="font-weight-bolder mb-0">FAQs</h6>
        </nav>
        <div class="collapse navbar-collapse mt-sm-0 mt-2 me-md-0 me-sm-4" id="navbar">
          <div class="ms-md-auto pe-md-3 d-flex align-items-center">
            <form action="search" method="GET">
              <div class="input-group input-group-outline">
                <label class="form-label">Type here...</label>
                <input type="text" name="k" class="form-control">

              </div>
            </form>
          </div>
        </div>
        <li class="nav-item d-xl-none ps-3 d-flex align-items-center">
          <a href="javascript:;" class="nav-link text-body p-0" id="iconNavbarSidenav">
            <div class="sidenav-toggler-inner">
              <i class="sidenav-toggler-line"></i>
              <i class="sidenav-toggler-line"></i>
              <i class="sidenav-toggler-line"></i>
            </div>
          </a>
        </li>
      </div>
    </nav>
    <!-- End Navbar -->
    <div class="container-fluid py-4">
      <div class="row min-vh-80">
        <div class="col-12 mx-auto">
          <div class="card mt-4">
            <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
              <div class="bg-gradient-primary shadow-primary border-radius-lg pt-4 pb-3">
                <h6 class="text-white text-center text-capitalize ps-3">Frequently Asked Questions</h6>

              </div>
            </div>
            <div class="card-body">

              <div>
                <div class="bd-example">
                  <div class="accordion" id="accordionExample">
                    <div class="accordion-item text-dark">
                      <h4 class="accordion-header" id="headingSeventeen">
                        <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseSeventeen" aria-expanded="true" aria-controls="collapseSeventeen">
                          What is our website all about?<i class="material-icons opacity-10"></i>
                        </button>
                      </h4>
                      <div id="collapseSeventeen" class="accordion-collapse collapse show" aria-labelledby="headingSeventeen" data-bs-parent="#accordionExample">
                        <div class="accordion-body">

                          Our website is a platform designed specifically for university students. It offers three main services: free book downloads, buying and selling books (projects), and connecting with individuals who can assist with assignments for a fixed fee.
                        </div>
                      </div>
                    </div>
                    <div class="accordion-item text-dark">
                      <h4 class="accordion-header" id="headingOne">
                        <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                          What to do if i can't find the subject or course for my school ?<i class="material-icons opacity-10"></i>
                        </button>
                      </h4>
                      <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                        <div class="accordion-body">

                          Reach out to our customer support team and provide them with details about the subject or course you're searching for. Our team will make every effort to assist you and may be able to provide alternative suggestions or inform you about future updates to our collection.
                        </div>
                      </div>
                    </div>
                    <div class="accordion-item text-dark">
                      <h4 class="accordion-header" id="headingTwo">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                          Is Unibooks a free service ?
                        </button>
                      </h4>
                      <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo" data-bs-parent="#accordionExample">
                        <div class="accordion-body">
                          Yes, Unibooks offers many free services to students. You can access and download a wide range of digital books for free, helping you save money on purchasing textbooks. However, please note that certain premium services or features may require a fee. We strive to provide a balance between free and paid services to cater to different student needs. </div>
                      </div>
                    </div>
                    <div class="accordion-item text-dark">
                      <h4 class="accordion-header" id="headingSixteen">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseSixteen" aria-expanded="false" aria-controls="collapseSixteen">
                          How do i get started with Unibooks ?
                        </button>
                      </h4>
                      <div id="collapseSixteen" class="accordion-collapse collapse" aria-labelledby="headingSixteen" data-bs-parent="#accordionExample">
                        <div class="accordion-body">

                          To get started with Unibooks, simply visit our website and create an account. Click on the "Sign Up" or "Register" button and follow the prompts to provide the required information. Once your account is created, you can start exploring our platform and accessing the available resources.


                        </div>
                      </div>
                    </div>
                    <div class="accordion-item text-dark">
                      <h4 class="accordion-header" id="headingFour">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseFour" aria-expanded="false" aria-controls="collapseFour">
                          How much do i pay for unibooks ?
                        </button>
                      </h4>
                      <div id="collapseFour" class="accordion-collapse collapse" aria-labelledby="headingFour" data-bs-parent="#accordionExample">
                        <div class="accordion-body">

                          The majority of Unibooks services are free of charge. However, certain premium services or features may have associated costs. These costs will be clearly indicated on our platform, and you will have the option to opt-in or purchase these additional services if you choose to do so. We aim to provide transparency regarding any fees or charges to ensure you can make informed decisions.
                        </div>
                      </div>
                    </div>
                    <div class="accordion-item text-dark">
                      <h4 class="accordion-header" id="headingFive">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseFive" aria-expanded="false" aria-controls="collapseFive">
                          Do i need to be a member to sell my books on Unibooks ?
                        </button>
                      </h4>
                      <div id="collapseFive" class="accordion-collapse collapse" aria-labelledby="headingFive" data-bs-parent="#accordionExample">
                        <div class="accordion-body">

                          Yes, you need to be a registered member of Unibooks to sell your books on our platform. Membership allows you to create listings, communicate with potential buyers, and manage your transactions securely. Registering as a member is a simple process that enables you to access all the features available on Unibooks.
                        </div>
                      </div>
                    </div>
                    <div class="accordion-item text-dark">
                      <h4 class="accordion-header" id="headingSix">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseSix" aria-expanded="false" aria-controls="collapseSix">
                          How do i download a free books on Unibooks
                        </button>
                      </h4>
                      <div id="collapseSix" class="accordion-collapse collapse" aria-labelledby="headingSix" data-bs-parent="#accordionExample">
                        <div class="accordion-body">

                          Downloading free books from Unibooks is easy. Once you have logged into your account, browse our collection of digital books. When you find a book you want to download, click on the download button or link provided. The book will then be available for offline access on your device, allowing you to read it at your convenience.
                        </div>
                      </div>
                    </div>
                    <div class="accordion-item text-dark">
                      <h4 class="accordion-header" id="headingSeven">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseSeven" aria-expanded="false" aria-controls="collapseSeven">
                          How does the buying and selling of books (projects) work?
                        </button>
                      </h4>
                      <div id="collapseSeven" class="accordion-collapse collapse" aria-labelledby="headingSeven" data-bs-parent="#accordionExample">
                        <div class="accordion-body">

                          If you have books or academic projects you want to sell, you can create a listing on our platform. Provide details about the book or project, including its condition, price, and any additional information. Interested buyers can browse the listings and contact you to initiate the purchase.
                        </div>
                      </div>
                    </div>
                    <div class="accordion-item text-dark">
                      <h4 class="accordion-header" id="headingEight">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseEight" aria-expanded="false" aria-controls="collapseEight">
                          How do i find the book i'm looking for on UniBooks ?
                        </button>
                      </h4>
                      <div id="collapseEight" class="accordion-collapse collapse" aria-labelledby="headingEight" data-bs-parent="#accordionExample">
                        <div class="accordion-body">
                          Finding the book you're looking for on Unibooks is straightforward. You can use the search bar located on our website or mobile app to enter the book's title, author, ISBN, or keywords related to the subject. Alternatively, you can browse our categories or use filters to refine your search results. If you're having trouble finding a specific book, our customer support team is ready to assist you. Simply reach out to us, providing as much detail as possible about the book you're searching for, and we'll do our best to help you locate it.
                        </div>
                      </div>
                    </div>
                    <div class="accordion-item text-dark">
                      <h4 class="accordion-header" id="headingNine">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseNine" aria-expanded="false" aria-controls="collapseNine">
                          What percentage does the website take from book sales?
                        </button>
                      </h4>
                      <div id="collapseNine" class="accordion-collapse collapse" aria-labelledby="headingNine" data-bs-parent="#accordionExample">
                        <div class="accordion-body">

                          For each successful sale made through our platform, we charge a certain percentage as a transaction fee. The exact percentage will be mentioned during the listing creation process and will depend on the value of the item being sold.
                        </div>
                      </div>
                    </div>
                    <div class="accordion-item text-dark">
                      <h4 class="accordion-header" id="headingTen">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTen" aria-expanded="false" aria-controls="collapseTen">How can I find someone to help with my assignments?
                        </button>
                      </h4>
                      <div id="collapseTen" class="accordion-collapse collapse" aria-labelledby="headingTen" data-bs-parent="#accordionExample">
                        <div class="accordion-body">
                          If you require assistance with your assignments, you can post a request outlining the requirements and deadline. Interested individuals can review your request and submit proposals with their offer and relevant experience. You can then choose the most suitable person to help you based on their expertise and pricing.
                        </div>
                      </div>
                    </div>
                    <div class="accordion-item text-dark">
                      <h4 class="accordion-header" id="headingEleven">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseEleven" aria-expanded="false" aria-controls="collapseEleven">
                          How is the price for assignment assistance determined?
                        </button>
                      </h4>
                      <div id="collapseEleven" class="accordion-collapse collapse" aria-labelledby="headingEleven" data-bs-parent="#accordionExample">
                        <div class="accordion-body">
                          The price for assignment assistance is determined by the individuals offering their services. They will consider factors such as the complexity of the task, the time required, and their expertise. You can review the proposals received and choose the one that best fits your budget and requirements.
                        </div>
                      </div>
                    </div>
                    <div class="accordion-item text-dark">
                      <h4 class="accordion-header" id="headingTwelve">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwelve" aria-expanded="false" aria-controls="collapseTwelve">Is there any guarantee of the quality of work for assignment assistance?
                        </button>
                      </h4>
                      <div id="collapseTwelve" class="accordion-collapse collapse" aria-labelledby="headingTwelve" data-bs-parent="#accordionExample">
                        <div class="accordion-body">
                          While we strive to maintain a high standard of quality on our platform, the ultimate responsibility for assessing and approving the work lies with the individuals providing the assignment assistance. We encourage you to review their proposals, ask for samples if available, and communicate with them to ensure they understand your requirements.
                        </div>
                      </div>
                    </div>
                    <div class="accordion-item text-dark">
                      <h4 class="accordion-header" id="headingThirteen ">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThirteen " aria-expanded="false" aria-controls="collapseThirteen ">
                          How do I make payments for books or assignment assistance?
                        </button>
                      </h4>
                      <div id="collapseThirteen " class="accordion-collapse collapse" aria-labelledby="headingThirteen " data-bs-parent="#accordionExample">
                        <div class="accordion-body">
                          We provide a secure payment system that allows you to make transactions conveniently. You can use various payment methods, such as credit cards, debit cards, or digital wallets, to complete your purchases or payments for assignment assistance.
                        </div>
                      </div>
                    </div>
                    <div class="accordion-item text-dark">
                      <h4 class="accordion-header" id="headingFourteen ">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseFourteen " aria-expanded="false" aria-controls="collapseFourteen ">
                          Are there any restrictions on the usage of downloaded books?

                        </button>
                      </h4>
                      <div id="collapseFourteen " class="accordion-collapse collapse" aria-labelledby="headingFourteen " data-bs-parent="#accordionExample">
                        <div class="accordion-body">The downloaded books are meant for personal use only and should not be shared or distributed without proper authorization. Please respect copyright laws and use the books responsibly.
                        </div>
                      </div>
                    </div>
                    <div class="accordion-item text-dark">
                      <h4 class="accordion-header" id="headingFifteen">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseFifteen" aria-expanded="false" aria-controls="collapseFifteen">
                          What should I do if I encounter any issues or have further questions?
                        </button>
                      </h4>
                      <div id="collapseFifteen" class="accordion-collapse collapse" aria-labelledby="headingFifteen" data-bs-parent="#accordionExample">
                        <div class="accordion-body">If you encounter any issues with our website or have additional questions, please reach out to our customer support team. You can find the contact information on our website, and we'll be happy to assist you.
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <?php include "footer.php" ?>

    </div>
  </main>
  <?php include "plugin.php" ?>

  <!--   Core JS Files   -->
  <script src="assets/js/core/popper.min.js"></script>
  <script src="assets/js/core/bootstrap.min.js"></script>
  <script src="assets/js/plugins/perfect-scrollbar.min.js"></script>
  <script src="assets/js/plugins/smooth-scrollbar.min.js"></script>
  <script src="a"></script>
  <script>
    var win = navigator.platform.indexOf('Win') > -1;
    if (win && document.querySelector('#sidenav-scrollbar')) {
      var options = {
        damping: '0.5'
      }
      Scrollbar.init(document.querySelector('#sidenav-scrollbar'), options);
    }
  </script>
  <!-- Github buttons -->
  <script async defer src="https://buttons.github.io/buttons.js"></script>
  <!-- Control Center for Material Dashboard: parallax effects, scripts for the example pages etc -->
  <script src="assets/js/material-dashboard.min.js?v=3.0.4"></script>
</body>

</html>