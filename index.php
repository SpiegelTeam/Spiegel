<?php
include("config/session.php");
require("config/db.php");
require("assets/product_card.php");
// ================= CART HANDLER =================
if (isset($_POST['add_to_cart'])) {
    $product_id = intval($_POST['product_id']);

    if (!isset($_SESSION['cart'])) {
        $_SESSION['cart'] = [];
    }

    if (isset($_SESSION['cart'][$product_id])) {
        $_SESSION['cart'][$product_id]++;
    } else {
        $_SESSION['cart'][$product_id] = 1;
    }

    header("Location: index.php");
    exit();
}
// ================================================

$search = "";
$category = "";

$sql = "SELECT DISTINCT p.* 
        FROM products p
        LEFT JOIN product_aesthetics pa ON p.item_id = pa.product_id
        LEFT JOIN aesthetics a ON pa.aesthetic_id = a.aesthetic_id
        WHERE 1=1";

if (isset($_GET['search']) && !empty($_GET['search'])) {
    $search = mysqli_real_escape_string($conn, $_GET['search']);
    $sql .= " AND (p.product_name LIKE '%$search%' 
                OR p.description LIKE '%$search%' 
                OR p.gender LIKE '%$search%')";
}

if (isset($_GET['category']) && !empty($_GET['category'])) {
    $category = mysqli_real_escape_string($conn, $_GET['category']);
    $sql .= " AND a.aesthetic_name = '$category'";
}

$result = mysqli_query($conn, $sql);

$result = mysqli_query($conn, $sql);
$message = "";
if (isset($_POST['submit'])) {
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);

    if (empty($email) || empty($password)) {
        $message = "Error: Email and password are required.";
    } else {
        $sql = "select * from users where email = '$email'";
        $result = mysqli_query($conn, $sql);
        if ($result->num_rows > 0) {
            $row = mysqli_fetch_assoc($result);
            if ($row['pword'] == $password) {
                $message = "Login Successful!";
                $_SESSION['user_id'] = $row['user_id'];
                $_SESSION['username'] = $row['username'];
                $_SESSION['user_role'] = $row['role'];
                if ($_SESSION['user_role'] == "admin") {
                    header("Location: admin/dashboard.php");
                } else {
                    echo "dashboard for user";
                }
            } else {
                $message = "Wrong Password";
            }
        } else {
            $message = "There is no account registered to that email";
        }
    }
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
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" href="assets/product_cardstyle.css">
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <aside class="sidebar">
        <div class="sidebar-header">
            <a href="index.html">
                <img src="images/logo.png" alt="logo">
            </a>
            <h2>SPIEGEL</h2>
        </div>
        <ul class="sidebar-links">
            <li>
                <a href="pages/browsing.html">
                    <span class="material-icons">
                        home
                    </span>
                    Home
                </a>
            </li>
            <li>
                <a href="pages/cart.php">
                    <span class="material-icons">
                        shopping_cart
                    </span>
                    Cart
                </a>
            </li>
            <div class="sidebar-bottom">
                <h4><span>Own Your Reflection</span></h4>
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
                        value="<?php echo isset($_GET['search']) ? htmlspecialchars($_GET['search']) : ''; ?>"
                        spellcheck="false">
                </div>
            </form>
            <div class="user-account">
                <div class="user-profile">
                    <img src="images/account_draft.png" alt="Profile" id="signup">
                </div>
                <div class="user-detail">
                </div>
            </div>
        </ul>
    </nav>


    <?php $currentCategory = $_GET['category'] ?? ''; ?>
    <nav class="categories">

        <ul>
            <li>
                <a href="index.php?search=<?php echo urlencode($search); ?>" class="active">
                    ALL
                </a>
            </li>

            <li>
                <a href="#">MAIN AESTHETICS</a>
                <ul>
                    <li><a href="?category=Casual&search=<?php echo urlencode($search); ?>">Casual</a></li>
                    <li><a href="?category=Formal&search=<?php echo urlencode($search); ?>">Formal</a></li>
                    <li><a href="?category=Streetwear&search=<?php echo urlencode($search); ?>">Streetwear</a></li>
                    <li><a href="?category=Y2K&search=<?php echo urlencode($search); ?>">Y2K</a></li>
                    <li><a href="?category=Indie&search=<?php echo urlencode($search); ?>">Indie</a></li>
                    <li><a href="?category=Kawaii&search=<?php echo urlencode($search); ?>">Kawaii</a></li>
                    <li><a href="?category=Baddie&search=<?php echo urlencode($search); ?>">Baddie</a></li>
                    <li><a href="?category=Visco&search=<?php echo urlencode($search); ?>">Visco</a></li>
                    <li><a href="?category=80s%20%26%2090s&search=<?php echo urlencode($search); ?>">80s & 90s</a></li>
                    <li><a href="?category=Vintage&search=<?php echo urlencode($search); ?>">Vintage</a></li>
                </ul>
            </li>

            <li>
                <a href="#">SUB-CULTURE AESTHETICS</a>
                <ul>
                    <li><a href="?category=Academia&search=<?php echo urlencode($search); ?>">Academia</a></li>
                    <li><a href="?category=Coquette&search=<?php echo urlencode($search); ?>">Coquette</a></li>
                    <li><a href="?category=Soft%20Boy&search=<?php echo urlencode($search); ?>">Soft Boy</a></li>
                    <li><a href="?category=Soft%20Girl&search=<?php echo urlencode($search); ?>">Soft Girl</a></li>
                    <li><a href="?category=Wednesday&search=<?php echo urlencode($search); ?>">Wednesday</a></li>
                    <li><a href="?category=Korean&search=<?php echo urlencode($search); ?>">Korean</a></li>
                    <li><a href="?category=Art%20Hoe&search=<?php echo urlencode($search); ?>">Art Hoe</a></li>
                </ul>
            </li>

            <li>
                <a href="#">ALT AESTHETICS</a>
                <ul>
                    <li><a href="?category=Grunge&search=<?php echo urlencode($search); ?>">Grunge</a></li>
                    <li><a href="?category=E-Girl&search=<?php echo urlencode($search); ?>">E-Girl</a></li>
                    <li><a href="?category=Goth&search=<?php echo urlencode($search); ?>">Goth</a></li>
                    <li><a href="?category=Pastel&search=<?php echo urlencode($search); ?>">Pastel</a></li>
                    <li><a href="?category=Edgy&search=<?php echo urlencode($search); ?>">Edgy</a></li>
                </ul>
            </li>

            <li>
                <a href="#">CORE AESTHETICS</a>
                <ul>
                    <li><a href="?category=Sanriocore&search=<?php echo urlencode($search); ?>">Sanriocore</a></li>
                    <li><a href="?category=Cottagecore&search=<?php echo urlencode($search); ?>">Cottagecore</a></li>
                    <li><a href="?category=Kidcore&search=<?php echo urlencode($search); ?>">Kidcore</a></li>
                    <li><a href="?category=Goblincore&search=<?php echo urlencode($search); ?>">Goblincore</a></li>
                    <li><a href="?category=Fairycore&search=<?php echo urlencode($search); ?>">Fairycore</a></li>
                    <li><a href="?category=Angelcore&search=<?php echo urlencode($search); ?>">Angelcore</a></li>
                    <li><a href="?category=Grandmacore&search=<?php echo urlencode($search); ?>">Grandmacore</a></li>
                </ul>
            </li>
        </ul>
    </nav>

    <main class="main-container">
        <div class="main-content">

            <div class="products-container">

                <?php if ($result->num_rows > 0): ?>
                    <?php while ($row = mysqli_fetch_assoc($result)): ?>
                        <?php renderProduct($row); ?>
                    <?php endwhile; ?>
                <?php else: ?>
                    <p>No products found.</p>
                <?php endif; ?>

            </div>
        </div>
    </main>

    <!-- modal -->

    <div class="modal">
        <div class="modal-background">
            <div class="modal-content">
                <div class="row">
                    <div class="box has-background-primary-dark" id="login-box">
                        <h1 class="title is-size-3 has-text-centered my-4">Login</h1>
                        <?php if ($message): ?>
                            <div class="notification <?php echo strpos($message, 'Error') === 0 || strpos($message, 'Wrong') === 0 || strpos($message, 'There') === 0 ? 'is-danger' : 'is-success'; ?>">
                                <?php echo $message; ?>
                            </div>
                        <?php endif; ?>
                        <div class="columns is-centered">
                            <div class="column is-8">
                                <form action="" method="post" id="login-form">
                                    <div class="field">
                                        <div class="columns">
                                            <div class="column is-narrow">
                                                <label class="label">
                                                    Email
                                                </label>
                                            </div>
                                            <div class="column register">
                                                <a href="pages/register.php" class="has-text-primary-light">
                                                    No Account? Sign Up Here
                                                </a>
                                            </div>
                                        </div>

                                        <div class="control has-icons-left">
                                            <input type="email" name="email" class="input is-primary" placeholder="john@example.com" spellcheck="false">
                                            <span class="icon is-small is-left">
                                                <i class="fa-solid fa-envelope"></i>
                                            </span>
                                        </div>
                                    </div>

                                    <div class="field">
                                        <label class="label">
                                            Password
                                        </label>
                                        <div class="control has-icons-left">
                                            <input type="password" name="password" class="input is-primary" placeholder="password" spellcheck="false">
                                            <span class="icon is-small is-left">
                                                <i class="fa-solid fa-lock"></i>
                                            </span>
                                        </div>
                                    </div>
                                    <div class="field">
                                        <label>
                                            <input type="checkbox" class="checkbox mr-2">Remember Me
                                            <a href="#" id="forgot-btn" class="float-right has-text-primary-light">Forgot Password?</a>
                                        </label>
                                    </div>
                                    <div class="field">
                                        <button class="button is-success" type="submit" name="submit">Login</button>
                                    </div>

                                </form>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="box has-background-primary-dark" id="forgot-box">
                        <h1 class="title is-size-3 has-text-centered my-4">Forgot Password</h1>
                        <div class="exit-modal has-icons-right">
                            <span class="exit is-small is-right">
                                <i class="fa-solid fa-x"></i>
                            </span>
                        </div>
                        <div class="columns is-centered">
                            <div class="column is-8">
                                <form action="" method="post">

                                    <div class="field">
                                        <small class="faded-text faded-center">
                                            To reset your password, enter the email address and we will send the reset password shortly.
                                        </small>
                                        <label class="label mt-3">
                                            Forgot Password
                                        </label>
                                        <div class="control has-icons-left">
                                            <input type="email" name="femail" class="input is-primary" placeholder="john@example.com" spellcheck="false">
                                            <span class="icon is-small is-left">
                                                <i class="fa-solid fa-envelope"></i>
                                            </span>
                                        </div>
                                    </div>
                                    <div class="field">
                                        <label>
                                            <a href="#" id="login-btn" class="float-right has-text-primary-light mt-2">Return to Login</a>
                                        </label>
                                    </div>
                                    <div class="field">
                                        <button class="button is-success" type="forgot" name="forgot" value="Reset">Forgot Password</button>
                                    </div>

                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="script/account-register.js" async defer></script>
    <script src="https://kit.fontawesome.com/4b57f7d9e6.js" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.6.3.min.js"></script>

</body>

</html>