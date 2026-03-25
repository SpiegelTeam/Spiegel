<?php
include "db.php";
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
                <a href="pages/reflections.html">
                    <span class="material-icons">
                        window
                    </span>
                    Reflections
                </a>
            </li>
            <li>
                <a href="pages/cart.html">
                    <span class="material-icons">
                        shopping_cart
                    </span>
                    Cart
                </a>
            </li>
            <div class="sidebar-bottom">
                <h4><span>Own Your Reflection</span></h4>
                <li>
                    <a href="pages/settings.html">
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
                    <input class="search-input" type="search" placeholder="Search" spellcheck="false">
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

    <nav class="categories">
        <ul>
            <li><a class="active" href="#">ALL</a></li>
            <li><a href="#">MAIN AESTHETICS
                    <ul>
                        <li><a href="#">Casual</a></li>
                        <li><a href="#">Formal</a></li>
                        <li><a href="#">Streetwear</a></li>
                        <li><a href="#">Y2K</a></li>
                        <li><a href="#">Indie</a></li>
                        <li><a href="#">Kawaii</a></li>
                        <li><a href="#">Baddie</a></li>
                        <li><a href="#">Visco</a></li>
                        <li><a href="#">80s & 90s</a></li>
                        <li><a href="#">Vintage</a></li>
                    </ul>
                </a></li>
            <li><a href="#">SUB-CULTURE AESTHETICS</a>
                <ul>
                    <li><a href="#">Academia</a></li>
                    <li><a href="#">Coquette</a></li>
                    <li><a href="#">Soft Boy</a></li>
                    <li><a href="#">Soft Girl</a></li>
                    <li><a href="#">Wednesday</a></li>
                    <li><a href="#">Korean</a></li>
                    <li><a href="#">Art Hoe</a></li>
                </ul>
            </li>
            <li><a href="#">ALT AESTHETICS</a>
                <ul>
                    <li><a href="#">Grunge</a></li>
                    <li><a href="#">E-Girl</a></li>
                    <li><a href="#">Goth</a></li>
                    <li><a href="#">Pastel</a></li>
                    <li><a href="#">Edgy</a></li>
                </ul>
            </li>
            <li><a href="#">CORE AESTHETICS</a>
                <ul>
                    <li><a href="#">Sanriocore</a></li>
                    <li><a href="#">Cottagecore</a></li>
                    <li><a href="#">Kidcore</a></li>
                    <li><a href="#">Goblincore</a></li>
                    <li><a href="#">Fairycore</a></li>
                    <li><a href="#">Angelcore</a></li>
                    <li><a href="#">Grandmacore</a></li>
                </ul>
            </li>
        </ul>
    </nav>

    <main class="main-container">

        <div class="main-content">


            <div class="grid is-col-min-9">
                <div class="cell">
                    <div class="card has-background-primary-dark">
                        <div class="card-image">
                            <figure class="image is-3by5">
                                <img
                                    src="images/random_filler.png"
                                    alt="Placeholder image" />
                            </figure>
                        </div>
                        <div class="card-content">
                            <div class="media">
                                <div class="media-content">
                                    <p class="title is-4">product title</p>
                                    <p class="is-size-6 mb-2">product description</p>
                                    <div class="fixed-grid">
                                        <div class="grid is-size-7">
                                            <div class="cell">product quantity</div>
                                            <div class="cell price-right">product price</div>
                                        </div>
                                    </div>
                                    <a href="#"><button class="button is-primary mt-5">Add to Cart</button></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </main>

    <!-- modal -->

    <div class="modal">
        <div class="modal-background">
            <div class="modal-content">
                <div class="box has-background-primary-dark">
                    <div class="exit-modal has-icons-right">
                        <span class="exit is-small is-right">
                            <i class="fa-solid fa-x"></i>
                        </span>
                    </div>
                    <?php if ($message): ?>
                        <div class="notification <?php echo strpos($message, 'Error') === 0 || strpos($message, 'Wrong') === 0 || strpos($message, 'There') === 0 ? 'is-danger' : 'is-success'; ?>">
                            <?php echo $message; ?>
                        </div>
                    <?php endif; ?>
                    <div class="columns is-centered">
                        <div class="column is-8">
                            <form action="" method="post">
                                <div class="field">
                                    <div class="columns">
                                        <div class="column is-narrow">
                                            <label class="label">
                                                Email
                                            </label>
                                        </div>
                                        <div class="column register">
                                            <a href="pages/register.php">
                                                <p class="has-text-primary-light">No Account? Sign Up Here
                                            </a>
                                        </div>
                                    </div>

                                    <div class="control has-icons-left">
                                        <input type="email" name="email" class="input" placeholder="john@example.com" spellcheck="false">
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
                                        <input type="password" name="password" class="input" placeholder="password" spellcheck="false">
                                        <span class="icon is-small is-left">
                                            <i class="fa-solid fa-lock"></i>
                                        </span>
                                    </div>
                                </div>
                                <div class="field">
                                    <label>
                                        <input type="checkbox" class="checkbox"> Remember Me
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
        </div>
    </div>

    <script src="script/account-register.js" async defer></script>
    <script src="https://kit.fontawesome.com/4b57f7d9e6.js" crossorigin="anonymous"></script>
</body>

</html>