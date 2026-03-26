<?php
include "../db.php";
$message = "";
if (isset($_POST['submit'])) {
    $username = trim($_POST['username']);
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);
    $address = trim($_POST['address']);
    $role = "user";

    if (empty($username) || empty($email) || empty($password) || empty($address)) {
        $message = "Error: All fields are required.";
    } else {
        $sql = "insert into users(username, email, pword, address, role) values ('$username', '$email', '$password', '$address', '$role')";

        $result = mysqli_query($conn, $sql);
        if (!$result) {
            $message = "Error: {$conn->error}";
        } else {
            $message = "Registered Successfully!";
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
    <link rel="stylesheet" href="css/registerstyle.css">
</head>

<body>
    <aside class="sidebar">
        <div class="sidebar-header">
            <a href="../index.html">
                <img src="../images/logo.png" alt="logo">
            </a>
            <h2>SPIEGEL</h2>
        </div>

        <ul class="sidebar-links">
            <li>
                <a href="browsing.html">
                    <span class="material-icons">
                        home
                    </span>
                    Home
                </a>
            </li>
            <li>
                <a href="reflections.html">
                    <span class="material-icons">
                        window
                    </span>
                    Reflections
                </a>
            </li>
            <li>
                <a href="cart.html">
                    <span class="material-icons">
                        shopping_cart
                    </span>
                    Cart
                </a>
            </li>
            <div class="sidebar-bottom">
                <h4><span>Own Your Reflection</span></h4>
                <li>
                    <a href="settings.html">
                        <span class="material-icons">
                            settings
                        </span>
                        Settings
                    </a>
                </li>
            </div>
        </ul>
    </aside>

    <nav class="navbar">
        <ul class="navbar-links">
            <form>
                <div class="search">
                    <span class="search-icon material-icons">search</span>
                    <input class="search-input" type="search" placeholder="Search">
                </div>
            </form>
        </ul>
    </nav>

    <main class="container my-3">
        <div class="content">
            <div class="box has-background-primary-dark mx-6">
                <h1 class="title is-size-3 has-text-centered my-4">Sign Up</h1>
                <?php if ($message): ?>
                    <div class="notification <?php echo strpos($message, 'Error') === 0 ? 'is-danger' : 'is-success'; ?>">
                        <?php echo $message; ?>
                    </div>
                <?php endif; ?>
                <div class="columns is-centered">
                    <div class="column is-8">
                        <form action="" method="post">
                            <div class="field">
                                <label class="label">
                                    Username
                                </label>
                                <div class="control has-icons-left">
                                    <input type="username" name="username" class="input is-primary" placeholder="username" spellcheck="false">
                                    <span class="icon is-small is-left">
                                        <i class="fa-solid fa-user"></i>
                                    </span>
                                </div>
                            </div>


                            <div class="field">
                                <label class="label">
                                    Email
                                </label>
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
                                <label class="label">
                                    Address
                                </label>
                                <div class="control has-icons-left">
                                    <input type="text" name="address" class="input is-primary" placeholder="1273 Rockefeller St" spellcheck="false">
                                    <span class="icon is-small is-left">
                                        <i class="fa-solid fa-address-book"></i>
                                    </span>
                                </div>
                            </div>

                            <div class="field">
                                <button class="button is-success" name="submit" type="submit">Sign Up
                                </button>
                            </div>

                        </form>
                    </div>
                </div>
            </div>

        </div>
    </main>

    <script src="" async defer></script>
    <script src="https://kit.fontawesome.com/4b57f7d9e6.js" crossorigin="anonymous"></script>
</body>

</html>