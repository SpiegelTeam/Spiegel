<?php
require("../php/admincheck.php");
require("../config/db.php");

$message = "";

// ✅ GET PRODUCT ID
if (!isset($_GET['id'])) {
    die("No product selected");
}

$id = (int)$_GET['id'];

// ✅ FETCH PRODUCT
$product_q = mysqli_query($conn, "SELECT * FROM products WHERE item_id = '$id'");
$product = mysqli_fetch_assoc($product_q);

if (!$product) {
    die("Product not found");
}

// ✅ GET CURRENT BRAND NAME
$brand_q = mysqli_query($conn, "SELECT brand_name FROM brands WHERE brand_id = '{$product['brand_id']}'");
$brand_data = mysqli_fetch_assoc($brand_q);
$current_brand = $brand_data['brand_name'];

// ✅ GET CURRENT AESTHETICS
$current_aesthetics = [];
$aesthetic_q = mysqli_query($conn, "SELECT aesthetic_id FROM product_aesthetics WHERE product_id = '$id'");
while ($row = mysqli_fetch_assoc($aesthetic_q)) {
    $current_aesthetics[] = $row['aesthetic_id'];
}


// ================= UPDATE LOGIC =================
if (isset($_POST['submit'])) {

    $product_name = $_POST['product_name'];
    $description = $_POST['description'];
    $price = $_POST['price'];
    $stock = $_POST['stock'];
    $gender = $_POST['gender'];
    $brand_name = $_POST['brand'];

    // ✅ IMAGE (optional update)
    $image_name = $product['image'];

    if (!empty($_FILES['image']['name'])) {
        $image_name = $_FILES['image']['name'];
        $image_tmp = $_FILES['image']['tmp_name'];
        move_uploaded_file($image_tmp, "../images/products/" . $image_name);
    }

    // ✅ BRAND
    $check_brand = mysqli_query($conn, "SELECT brand_id FROM brands WHERE brand_name='$brand_name'");

    if (mysqli_num_rows($check_brand) > 0) {
        $brand = mysqli_fetch_assoc($check_brand);
        $brand_id = $brand['brand_id'];
    } else {
        mysqli_query($conn, "INSERT INTO brands (brand_name) VALUES ('$brand_name')");
        $brand_id = mysqli_insert_id($conn);
    }

    // ✅ UPDATE PRODUCT
    mysqli_query($conn, "
        UPDATE products SET
        product_name='$product_name',
        price='$price',
        stock='$stock',
        description='$description',
        image='$image_name',
        brand_id='$brand_id',
        gender='$gender'
        WHERE item_id='$id'
    ");

    // ✅ RESET AESTHETICS
    mysqli_query($conn, "DELETE FROM product_aesthetics WHERE product_id='$id'");

    $all_aesthetics = [];

    if (!empty($_POST['main_aesthetic'])) {
        $all_aesthetics = array_merge($all_aesthetics, $_POST['main_aesthetic']);
    }
    if (!empty($_POST['sub_aesthetic'])) {
        $all_aesthetics = array_merge($all_aesthetics, $_POST['sub_aesthetic']);
    }
    if (!empty($_POST['alt_aesthetic'])) {
        $all_aesthetics = array_merge($all_aesthetics, $_POST['alt_aesthetic']);
    }
    if (!empty($_POST['core_aesthetic'])) {
        $all_aesthetics = array_merge($all_aesthetics, $_POST['core_aesthetic']);
    }

    foreach ($all_aesthetics as $aesthetic_id) {
        mysqli_query($conn, "
            INSERT INTO product_aesthetics(product_id,aesthetic_id)
            VALUES('$id','$aesthetic_id')
        ");
    }

    $message = "Product updated successfully!";
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
                        <span class="material-symbols-outlined">
                            logout
                        </span>
                        Logout
                    </a>
                </li>
            </div>
        </ul>
    </aside>

    <main class="container my-3">
        <div class="content">
            <div class="box has-background-primary-dark mx-6">
                <h1 class="title is-size-3 has-text-centered my-4">Edit Product</h1>
                <?php if ($message): ?>
                    <div class="notification is-success">
                        <?php echo $message; ?>
                    </div>
                <?php endif; ?>
                <div class="columns is-centered">
                    <div class="column is-8">
                        <form method="post" enctype="multipart/form-data">
                            <div class="field">
                                <label class="label">
                                    Product Name
                                </label>
                                <div class="control has-icons-left">
                                    <input type="text" name="product_name" class="input is-primary"
                                        value="<?php echo $product['product_name']; ?>" required>
                                </div>
                            </div>

                            <div class="field">
                                <label class="label">Description</label>

                                <div class="control">
                                    <textarea class="textarea is-primary" name="description"><?php echo $product['description']; ?></textarea>
                                </div>

                            </div>

                            <div class="field">
                                <label class="label">
                                    Price
                                </label>
                                <div class="control has-icons-left">
                                    <input type="number" name="price" class="input is-primary"
                                        value="<?php echo $product['price']; ?>" required>
                                </div>
                            </div>

                            <div class="field">
                                <label class="label">
                                    Stock
                                </label>
                                <div class="control has-icons-left">
                                    <input type="number" name="stock" class="input is-primary"
                                        value="<?php echo $product['stock']; ?>">
                                </div>
                            </div>

                            <div class="field">
                                <label class="label">
                                    Image
                                </label>
                                <div class="control has-icons-left">
                                    <input type="file" name="image" class="input is-primary">
                                </div>
                            </div>

                            <p class="mt-5"><small class="has-text-white">CTRL + Click to Select Multiple</small></p>

                            <div class="field">
                                <label class="label">Main Aesthetic</label>

                                <div class="control">
                                    <select class="select is-multiple is-fullwidth" name="main_aesthetic[]" multiple size="5">

                                        <?php
                                        $q = mysqli_query($conn, "SELECT * FROM aesthetics WHERE type_id = 1");

                                        while ($row = mysqli_fetch_assoc($q)) {
                                        ?>

                                            <option value="<?php echo $row['aesthetic_id']; ?>"
                                                <?php if (in_array($row['aesthetic_id'], $current_aesthetics)) echo 'selected'; ?>>
                                                <?php echo $row['aesthetic_name']; ?>
                                            </option>

                                        <?php } ?>

                                    </select>
                                </div>
                            </div>

                            <div class="field">
                                <label class="label">Sub Aesthetic</label>

                                <div class="control">
                                    <select class="select is-multiple is-fullwidth" name="sub_aesthetic[]" multiple size="5">

                                        <?php
                                        $q = mysqli_query($conn, "SELECT * FROM aesthetics WHERE type_id = 2");

                                        while ($row = mysqli_fetch_assoc($q)) {
                                        ?>

                                            <option value="<?php echo $row['aesthetic_id']; ?>"
                                                <?php if (in_array($row['aesthetic_id'], $current_aesthetics)) echo 'selected'; ?>>
                                                <?php echo $row['aesthetic_name']; ?>
                                            </option>

                                        <?php } ?>

                                    </select>
                                </div>
                            </div>

                            <div class="field">
                                <label class="label">Alt Aesthetic</label>

                                <div class="control">
                                    <select class="select is-multiple is-fullwidth" name="alt_aesthetic[]" multiple size="5">

                                        <?php
                                        $q = mysqli_query($conn, "SELECT * FROM aesthetics WHERE type_id = 3");

                                        while ($row = mysqli_fetch_assoc($q)) {
                                        ?>

                                            <option value="<?php echo $row['aesthetic_id']; ?>"
                                                <?php if (in_array($row['aesthetic_id'], $current_aesthetics)) echo 'selected'; ?>>
                                                <?php echo $row['aesthetic_name']; ?>
                                            </option>

                                        <?php } ?>

                                    </select>
                                </div>
                            </div>

                            <div class="field">
                                <label class="label">Core Aesthetic</label>

                                <div class="control">
                                    <select class="select is-multiple is-fullwidth" name="core_aesthetic[]" multiple size="5">

                                        <?php
                                        $q = mysqli_query($conn, "SELECT * FROM aesthetics WHERE type_id = 4");

                                        while ($row = mysqli_fetch_assoc($q)) {
                                        ?>

                                            <option value="<?php echo $row['aesthetic_id']; ?>"
                                                <?php if (in_array($row['aesthetic_id'], $current_aesthetics)) echo 'selected'; ?>>
                                                <?php echo $row['aesthetic_name']; ?>
                                            </option>

                                        <?php } ?>

                                    </select>
                                </div>
                            </div>

                            <div class="field">
                                <label class="label">Gender</label>

                                <div class="control">
                                    <div class="select is-fullwidth is-primary">
                                        <select name="gender" required>
                                            <option value="masculine" <?php if ($product['gender'] == 'masculine') echo 'selected'; ?>>Masculine</option>
                                            <option value="feminine" <?php if ($product['gender'] == 'feminine') echo 'selected'; ?>>Feminine</option>
                                            <option value="unisex" <?php if ($product['gender'] == 'unisex') echo 'selected'; ?>>Unisex</option>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="field">
                                <label class="label">Brand</label>

                                <div class="control">
                                    <input class="input is-primary" type="text" name="brand"
                                        value="<?php echo $current_brand; ?>" required>
                                </div>

                            </div>

                            <!-- product fields here -->


                            <div class="field is-grouped">
                                <div class="control">
                                    <button class="button is-primary" type="submit" name="submit">
                                        Edit Product
                                    </button>
                                </div>

                                <div class="control">
                                    <a href="products.php" class="button is-light">Cancel</a>
                                </div>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <script src="https://kit.fontawesome.com/4b57f7d9e6.js" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.6.3.min.js"></script>

</body>

</html>