<?php
require '../config/db.php';
require '../config/session.php';

$search = "";

if (isset($_GET['search']) && !empty($_GET['search'])) {
    $search = $conn->real_escape_string($_GET['search']);

    $sql = "SELECT * FROM products 
            WHERE product_name LIKE '%$search%' 
            OR description LIKE '%$search%'
            OR gender LIKE '%$search%'";
} else {
    $sql = "SELECT * FROM products";
}

$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="stylesheet" href="dashboardstyle.css">
    <link rel="stylesheet" href="../assets/products.css">

    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined" rel="stylesheet" />

    <title>Display Products</title>

</head>

<body>

    <aside class="sidebar">
        <div class="sidebar-header">
            <a href="../index.php">
                <img src="../images/logo.png">
            </a>
            <h2>SPIEGEL</h2>
        </div>

        <ul class="sidebar-links">
            <li>
                <a href="dashboard.php">
                    <span class="material-symbols-outlined">eye_tracking</span>
                    Dashboard
                </a>
            </li>

            <li>
                <a href="addproduct.php">
                    <span class="material-symbols-outlined">add</span>
                    Add Product
                </a>
            </li>

            <div class="sidebar-bottom">
                <h4><span>Own Your Reflection</span></h4>

                <li>
                    <a href="../php/logout.php">
                        <span class="material-symbols-outlined">logout</span>
                        Logout
                    </a>
                </li>

            </div>
        </ul>
    </aside>

    <nav class="navbar">
        <ul class="navbar-links">
            <form method="GET">
                <div class="search">
                    <span class="search-icon material-icons">search</span>
                    <input
                        class="search-input"
                        type="search"
                        name="search"
                        placeholder="Search"
                        value="<?php echo isset($_GET['search']) ? htmlspecialchars($_GET['search']) : ''; ?>">
                </div>
            </form>
        </ul>
    </nav>

    <main>

        <div class="main-content">
            <div class="products-container">

                <?php include '../assets/products.php'; ?>

            </div>
        </div>

    </main>
</body>

</html>