<?php
include("../config/session.php");
require("../config/db.php");

if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = [];
}

/* ================= ACTION HANDLER ================= */

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    if (isset($_POST['increase'])) {
        $id = $_POST['product_id'];
        $_SESSION['cart'][$id]++;
    }

    if (isset($_POST['decrease'])) {
        $id = $_POST['product_id'];
        $_SESSION['cart'][$id]--;

        if ($_SESSION['cart'][$id] <= 0) {
            unset($_SESSION['cart'][$id]);
        }
    }

    if (isset($_POST['remove'])) {
        $id = $_POST['product_id'];
        unset($_SESSION['cart'][$id]);
    }

    // ✅ ONLY REDIRECT AFTER POST
    header("Location: cart.php");
    exit();
}
?>

<?php
$cart = $_SESSION['cart'];
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>Cart</title>

    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" href="../assets/product_cardstyle.css">
    <link rel="stylesheet" href="css/cartstyle.css">
</head>

<body>

    <!-- SIDEBAR -->
    <aside class="sidebar">
        <div class="sidebar-header">
            <a href="../index.php">
                <img src="../images/logo.png">
            </a>
            <h2>SPIEGEL</h2>
        </div>

        <ul class="sidebar-links">
            <li><a href="../index.php"><span class="material-icons">home</span>Home</a></li>
            <li><a href="#"><span class="material-icons">window</span>Reflections</a></li>
            <li><a href="cart.php"><span class="material-icons">shopping_cart</span>Cart</a></li>
        </ul>
    </aside>

    <!-- MAIN -->
    <main style="grid-area: main; padding: 30px;">
        <div class="cart-container">
            <h1 class="title">Your Cart</h1>

            <?php if (empty($cart)): ?>
                <div class="empty-cart">Your cart is empty.</div>
            <?php else: ?>

                <?php
                $ids = implode(",", array_keys($cart));
                $result = mysqli_query($conn, "SELECT * FROM products WHERE item_id IN ($ids)");
                $total = 0;
                ?>

                <?php while ($row = mysqli_fetch_assoc($result)):
                    $id = $row['item_id'];
                    $qty = $cart[$id];
                    $subtotal = $qty * $row['price'];
                    $total += $subtotal;
                ?>

                    <div class="cart-item">

                        <img src="../images/products/<?php echo $row['image']; ?>"
                            onerror="this.src='../images/products/test.png'">

                        <div class="cart-details">
                            <div class="cart-name"><?php echo $row['product_name']; ?></div>
                            <div class="cart-price">₱<?php echo $row['price']; ?></div>
                        </div>

                        <!-- QUANTITY -->
                        <div class="cart-qty">

                            <form method="POST">
                                <input type="hidden" name="product_id" value="<?php echo $id; ?>">
                                <button name="decrease">−</button>
                            </form>

                            <span><?php echo $qty; ?></span>

                            <form method="POST">
                                <input type="hidden" name="product_id" value="<?php echo $id; ?>">
                                <button name="increase">+</button>
                            </form>

                        </div>

                        <!-- RIGHT SIDE -->
                        <div class="cart-actions">

                            <div class="cart-subtotal">
                                ₱<?php echo $subtotal; ?>
                            </div>

                            <form method="POST">
                                <input type="hidden" name="product_id" value="<?php echo $id; ?>">
                                <button class="remove-btn" name="remove">Remove</button>
                            </form>

                        </div>

                    </div>

                <?php endwhile; ?>

                <div class="cart-summary">
                    <div>Total</div>
                    <div class="cart-total">₱<?php echo $total; ?></div>
                </div>

            <?php endif; ?>
        </div>
    </main>

</body>

</html>