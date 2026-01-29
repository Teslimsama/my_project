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
  <link id="pagestyle" href="assets/css/app.css" rel="stylesheet" />
  <link id="pagestyle" href="assets/css/faq.css" rel="stylesheet" />
  <!-- <link rel="stylesheet" href="assets/css/cheatsheet.css"> -->
  <script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js?client=ca-pub-9952650109664010" crossorigin="anonymous"></script>

</head>

<body class="bg-light">
  <?php include "header_app.php"; ?>

  <main class="container py-5">
    <div class="card shadow-sm border-radius-xl p-4 p-md-5">
      <h1 class="text-center mb-5">Frequently Asked Questions</h1>

      <div class="accordion accordion-flush" id="faqAccordion">
        <div class="accordion-item border-radius-lg mb-3 shadow-sm">
          <h2 class="accordion-header">
            <button class="accordion-button collapsed border-radius-lg" type="button" data-bs-toggle="collapse" data-bs-target="#faq1">
              What is Unibooks all about?
            </button>
          </h2>
          <div id="faq1" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
            <div class="accordion-body prose">
              Our website is a platform designed specifically for university students. It offers three main services: free book downloads, buying and selling books (projects), and connecting with individuals who can assist with assignments for a fixed fee.
            </div>
          </div>
        </div>

        <div class="accordion-item border-radius-lg mb-3 shadow-sm">
          <h2 class="accordion-header">
            <button class="accordion-button collapsed border-radius-lg" type="button" data-bs-toggle="collapse" data-bs-target="#faq2">
              Is Unibooks a free service?
            </button>
          </h2>
          <div id="faq2" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
            <div class="accordion-body prose">
              Yes, Unibooks offers many free services. You can access and download a wide range of digital books for free. However, premium services or features like project purchases or assignment assistance have associated costs.
            </div>
          </div>
        </div>

        <div class="accordion-item border-radius-lg mb-3 shadow-sm">
          <h2 class="accordion-header">
            <button class="accordion-button collapsed border-radius-lg" type="button" data-bs-toggle="collapse" data-bs-target="#faq3">
              How do I get started with Unibooks?
            </button>
          </h2>
          <div id="faq3" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
            <div class="accordion-body prose">
              Simply visit our website and create an account. Click the "Sign Up" button, provide your academic details, and you'll have immediate access to our resources and community.
            </div>
          </div>
        </div>

        <div class="accordion-item border-radius-lg mb-3 shadow-sm">
          <h2 class="accordion-header">
            <button class="accordion-button collapsed border-radius-lg" type="button" data-bs-toggle="collapse" data-bs-target="#faq4">
              How does the buying and selling of books work?
            </button>
          </h2>
          <div id="faq4" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
            <div class="accordion-body prose">
              If you have books or projects to sell, you can create a listing. Interested buyers can browse listings and contact you. We provide a secure platform to facilitate these academic exchanges.
            </div>
          </div>
        </div>

        <div class="accordion-item border-radius-lg mb-3 shadow-sm">
          <h2 class="accordion-header">
            <button class="accordion-button collapsed border-radius-lg" type="button" data-bs-toggle="collapse" data-bs-target="#faq5">
              How can I find help with my assignments?
            </button>
          </h2>
          <div id="faq5" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
            <div class="accordion-body prose">
              You can browse our dedicated assignments section or post a request. Verified helpers in your field can then offer their expertise to assist you for a fixed, agreed-upon fee.
            </div>
          </div>
        </div>
      </div>
    </div>

    <?php include "footer.php" ?>
  </main>

  <?php include "bottom_nav_app.php"; ?>
  <?php include "plugin.php" ?>
</body>

</html>