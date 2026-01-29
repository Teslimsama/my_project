<?php
// header_app.php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
?>
<header class="app-header">
    <a href="index" class="d-flex align-items-center text-decoration-none">
        <img src="Images/unibooks copy.png" height="32" alt="logo" class="me-2">
        <h5 class="mb-0 fw-bold text-dark">Unibooks</h5>
    </a>
    <div class="search-container d-none d-md-block">
        <i class="fa fa-search search-icon"></i>
        <form action="search" method="GET" class="m-0">
            <input type="text" id="search_box_desktop" name="k" class="search-input" placeholder="Search for books, authors...">
        </form>
    </div>
    <div class="d-flex align-items-center">
        <?php if (isset($_SESSION['user'])): ?>
            <a href="profilepage" class="text-dark me-3" title="Profile"><i class="fa-regular fa-user fs-5"></i></a>
            <a href="logout" class="text-danger me-3" title="Logout"><i class="fa-solid fa-arrow-right-from-bracket fs-5"></i></a>
        <?php else: ?>
            <a href="Signin" class="btn btn-primary btn-sm rounded-pill px-3">Sign In</a>
        <?php endif; ?>
    </div>
</header>