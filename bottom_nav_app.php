<?php
// bottom_nav_app.php
$current_page = basename($_SERVER['PHP_SELF'], ".php");
?>
<nav class="bottom-nav d-md-none">
    <a href="index" class="nav-item <?php echo ($current_page == 'index') ? 'active' : ''; ?>">
        <i class="fa-solid fa-house"></i>
        <span>Home</span>
    </a>
    <a href="project" class="nav-item <?php echo ($current_page == 'project') ? 'active' : ''; ?>">
        <i class="fa-solid fa-book-open"></i>
        <span>Project</span>
    </a>
    <a href="downloads" class="nav-item <?php echo ($current_page == 'downloads') ? 'active' : ''; ?>">
        <i class="fa-solid fa-download"></i>
        <span>Downloads</span>
    </a>
    <a href="profilepage" class="nav-item <?php echo ($current_page == 'profilepage') ? 'active' : ''; ?>">
        <i class="fa-solid fa-user"></i>
        <span>Profile</span>
    </a>
</nav>