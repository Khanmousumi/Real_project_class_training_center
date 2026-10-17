
<?php
session_start();

if (!isset($_SESSION['email_login'])) {
    header('Location: ../login/login.php');
    exit;
}

require_once '../../config/db.php';

$sesion_email = $_SESSION['email_login'];

$email_safe = mysqli_real_escape_string($dbcon, $sesion_email);

$data_select = mysqli_query(
    $dbcon,
    "SELECT * FROM `users` WHERE `email`='$email_safe'"
);

$data_rows = mysqli_fetch_assoc($data_select);

if (!$data_rows) {
    session_unset();
    session_destroy();

    header('Location: ../login/login.php');
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Admin Dashboard</title>

    <link rel="stylesheet"
          href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <link rel="stylesheet" href="css/dashboard.css">
</head>

<body>

<div class="dashboard-container">

    <!-- Sidebar -->
    <aside class="sidebar">

        <div class="logo">
            <div class="logo-icon">
                <i class="bi bi-mortarboard-fill"></i>
            </div>
            <span>My Dashboard</span>
        </div>

        <p class="menu-title">MAIN MENU</p>

        <nav class="sidebar-menu">
            <a href="admin_index.php ?page=dashboard" class="active">
                <i class="bi bi-grid-fill"></i>
                <span>Dashboard</span>
            </a>

            <a href="admin_index.php ?page=students">
                <i class="bi bi-people-fill"></i>
                <span>Students</span>
            </a>

            <a href="admin_index.php ?page=teachers">
                <i class="bi bi-person-video3"></i>
                <span>Teachers</span>
            </a>

            <a href="admin_index.php ?page=courses">
                <i class="bi bi-book-fill"></i>
                <span>Courses</span>
            </a>

            <a href="admin_index.php ?page=attendance">
                <i class="bi bi-calendar-check-fill"></i>
                <span>Attendance</span>
            </a>

            <a href="admin_index.php ?page=reports">
                <i class="bi bi-bar-chart-fill"></i>
                <span>Reports</span>
            </a>
        </nav>

        <p class="menu-title">ACCOUNT</p>

        <nav class="sidebar-menu">
            <a href="admin_index.php ?page=my_profile">
                <i class="bi bi-person-circle"></i>
                <span>My Profile</span>
            </a>

            <a href="logout.php" class="logout">
                <i class="bi bi-box-arrow-right"></i>
                <span>Logout</span>
            </a>
        </nav>

        <div class="sidebar-bottom">
            Student Management System
        </div>

    </aside>

    <!-- Main Content -->
    <main class="main-content">

<header class="topbar">

    <!-- Left Side -->
    <div class="page-heading">
        <h2>Dashboard</h2>
       
    </div>

    <!-- Right Side -->
    <div class="topbar-right">

        <!-- Notification -->
        <button
            type="button"
            class="notification-btn"
            aria-label="Notifications"
            title="Notifications">

            <i class="bi bi-bell-fill"></i>
            <span class="notification-dot"></span>

        </button>

        <!-- Logged-in User: Last Item -->
        <div class="profile">

            <div class="profile-icon">
                <i class="bi bi-person-fill"></i>
            </div>

            <div class="profile-text">
                <h4>
                    <?php
                    echo htmlspecialchars(
                        $data_rows['username'],
                        ENT_QUOTES,
                        'UTF-8'
                    );
                    ?>
                </h4>

                <p>Admin</p>
            </div>

        </div>

    </div>

</header>

        

<div class="content-area">

<?php
$page = isset($_GET['page'])
    ? $_GET['page'] . '.php'
    : 'dashboard.php';

if (file_exists($page)) {
    require $page;
}else{
    require '404.php';
}

?>

</div>

       
           

    </main>

</div>

</body>
</html>

