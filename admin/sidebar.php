<nav class="sidebar sidebar-offcanvas" id="sidebar">
    <ul class="nav">
        <li class="nav-item">
            <a class="nav-link" href="index">
                <i class="mdi mdi-grid-large menu-icon"></i>
                <span class="menu-title">Dashboard</span>
            </a>
        </li>
        <li class="nav-item nav-category">Books</li>
        <li class="nav-item">
            <a class="nav-link" data-bs-toggle="collapse" href="#books-menu" aria-expanded="false" aria-controls="books-menu">
                <i class="menu-icon mdi mdi-book-open-page-variant"></i>
                <span class="menu-title">Books</span>
                <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="books-menu">
                <ul class="nav flex-column sub-menu">
                    <li class="nav-item">
                        <a class="nav-link" href="books">View Books</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="books_add">Upload Books</a>
                    </li>
                </ul>
            </div>
        </li>
        <li class="nav-item nav-category">Schools</li>
        <li class="nav-item">
            <a class="nav-link" data-bs-toggle="collapse" href="#schools-menu" aria-expanded="false" aria-controls="schools-menu">
                <i class="menu-icon mdi mdi-school"></i>
                <span class="menu-title">School Management</span>
                <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="schools-menu">
                <ul class="nav flex-column sub-menu">
                    <li class="nav-item">
                        <a class="nav-link" href="add_university">Add University details</a>
                    </li>
                    <!-- <li class="nav-item">
                        <a class="nav-link" href="pages/forms/add-faculty.html">Add Faculty</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="pages/forms/add-department.html">Add Department</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="pages/forms/add-course.html">Add Course</a>
                    </li> -->
                </ul>
            </div>
        </li>
        <li class="nav-item nav-category">Transactions</li>
        <li class="nav-item">
            <a class="nav-link" data-bs-toggle="collapse" href="#transactions-menu" aria-expanded="false" aria-controls="transactions-menu">
                <i class="menu-icon mdi mdi-currency-usd"></i>
                <span class="menu-title">Transactions</span>
                <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="transactions-menu">
                <ul class="nav flex-column sub-menu">
                    <li class="nav-item">
                        <a class="nav-link" href="payments">Payments</a>
                    </li>
                </ul>
            </div>
        </li>
        <li class="nav-item nav-category">Settings</li>
        <li class="nav-item">
            <a class="nav-link" data-bs-toggle="collapse" href="#settings-menu" aria-expanded="false" aria-controls="settings-menu">
                <i class="menu-icon mdi mdi-settings"></i>
                <span class="menu-title">Settings</span>
                <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="settings-menu">
                <ul class="nav flex-column sub-menu">
                    <li class="nav-item">
                        <a class="nav-link" href="web_details">Web Details</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="notification">Notifications</a>
                    </li>
                </ul>
            </div>
        </li>
        <li class="nav-item">
            <a class="nav-link" data-bs-toggle="collapse" href="#users-menu" aria-expanded="false" aria-controls="users-menu">
                <i class="menu-icon mdi mdi-users"></i>
                <span class="menu-title">Users</span>
                <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="users-menu">
                <ul class="nav flex-column sub-menu">
                    <li class="nav-item">
                        <a class="nav-link" href="users">Users</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="users_add">Add Users</a>
                    </li>
                    
                </ul>
            </div>
        </li>
    </ul>
</nav>