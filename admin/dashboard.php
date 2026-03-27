<?php session_start();
if (isset($_SESSION['user_id'])) {
    if ($_SESSION['user_role'] == "admin") {
    } else {
        echo "Go for User Dashboard";
    }
} else {
    header("Location: ../index.php");
}
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title></title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="dashboardstyle.css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined" rel="stylesheet" />
</head>

<body>
    <aside class="sidebar">
        <div class="sidebar-header">
            <a href="../index.php">
                <img src="../images/logo.png" alt="logo">
            </a>
            <h2>SPIEGEL</h2>
        </div>
        <ul class="sidebar-links">
            <li>
                <a href="addproduct.php">
                    <span class="material-symbols-outlined">
                        add
                    </span>
                    Add Product
                </a>
            </li>
            <li>
                <a href="">
                    <span class="material-symbols-outlined">
                        eye_tracking
                    </span>
                    View Order
                </a>
            </li>

            <div class="sidebar-bottom">
                <h4><span>Own Your Reflection</span></h4>
                <li>
                    <a href="../php/logout.php">
                        <span class="material-symbols-outlined">
                            logout
                        </span>
                        Logout
                    </a>
                </li>
            </div>
        </ul>
    </aside>

    <main class="main-container">
        <div class="main-content">

        </div>
    </main>

    <script src="https://kit.fontawesome.com/4b57f7d9e6.js" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.6.3.min.js"></script>

</body>

</html>