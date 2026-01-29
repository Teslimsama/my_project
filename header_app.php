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
            <!-- Navigation Menu Dropdown -->
            <div class="dropdown me-3 d-none d-md-block">
                <a href="#" class="text-dark" id="navMenuDropdown" data-bs-toggle="dropdown" aria-expanded="false" title="Menu">
                    <i class="fa-solid fa-bars fs-5"></i>
                </a>
                <ul class="dropdown-menu dropdown-menu-end shadow" aria-labelledby="navMenuDropdown">
                    <li><a class="dropdown-item" href="index"><i class="fa fa-home me-2"></i>Library</a></li>
                    <li><a class="dropdown-item" href="project"><i class="fa fa-book-open me-2"></i>Project</a></li>
                    <li><a class="dropdown-item" href="downloads"><i class="fa fa-download me-2"></i>Downloads</a></li>
                    <li><a class="dropdown-item" href="payments"><i class="fa fa-receipt me-2"></i>Payments</a></li>
                    <li><a class="dropdown-item" href="books"><i class="fa fa-book me-2"></i>My Books</a></li>
                </ul>
            </div>
            <a href="profilepage" class="text-dark me-3" title="Profile"><i class="fa-regular fa-user fs-5"></i></a>
            <a href="logout" class="text-danger me-3" title="Logout"><i class="fa-solid fa-arrow-right-from-bracket fs-5"></i></a>
        <?php else: ?>
            <a href="Signin" class="btn btn-primary btn-sm rounded-pill px-3">Sign In</a>
        <?php endif; ?>
    </div>
</header>