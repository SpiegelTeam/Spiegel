<?php
require("../php/admincheck.php");
require("../config/db.php");

if (!isset($_POST['id'])) {
    die("No product ID provided");
}

$id = (int)$_POST['id'];

// ✅ Get image first (so we can delete file)
$q = mysqli_query($conn, "SELECT image FROM products WHERE item_id = '$id'");
$product = mysqli_fetch_assoc($q);

if (!$product) {
    die("Product not found");
}

// ✅ Delete image file (optional but good practice)
if (!empty($product['image'])) {
    $image_path = "../images/products/" . $product['image'];
    if (file_exists($image_path)) {
        unlink($image_path);
    }
}

// ✅ Delete aesthetics relation first (FOREIGN KEY safety)
mysqli_query($conn, "DELETE FROM product_aesthetics WHERE product_id = '$id'");

// ✅ Delete product
mysqli_query($conn, "DELETE FROM products WHERE item_id = '$id'");

// ✅ Redirect back
header("Location: dashboard.php");
exit();
