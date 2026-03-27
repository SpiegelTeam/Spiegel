<?php
require_once __DIR__ . "/../config/db.php";

$sql = "SELECT * FROM products";
$result = $conn->query($sql);
?>

<?php while ($row = $result->fetch_assoc()) { ?>

    <div class="card product-card">

        <div class="card-image">
            <figure class="image">
                <img class="product-photos"
                    src="/spiegel/images/products/<?php echo $row['image']; ?>"
                    alt="Product"
                    onerror="this.src='/spiegel/images/products/test.png'">
            </figure>

            <button class="add-to-cart">
                Add to Cart
            </button>
        </div>

        <div class="card-content">

            <p class="title is-6">
                <?php echo $row['product_name']; ?>
            </p>

            <div class="columns is-mobile is-gapless">
                <div class="column">
                    <p class="subtitle is-7">
                        <?php echo $row['gender']; ?>
                    </p>
                </div>

                <div class="column has-text-right">
                    <strong>$<?php echo $row['price']; ?></strong>
                </div>
            </div>

            <p class="content">
                <?php echo $row['description']; ?>
            </p>

        </div>

    </div>

<?php } ?>