<?php
function renderProduct($row)
{
?>
    <div class="product-card">

        <div class="card-image">
            <figure class="image">
                <img src="images/products/<?php echo $row['image']; ?>"
                    onerror="this.src='images/products/test.png'">
            </figure>
        </div>

        <!-- FLOATING ADD TO CART BUTTON -->
        <form method="POST" action="">
            <input type="hidden" name="product_id" value="<?php echo $row['item_id']; ?>">
            <button class="add-cart-btn" name="add_to_cart">
                Add to Cart
            </button>
        </form>

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
                    <strong>₱<?php echo $row['price']; ?></strong>
                </div>
            </div>

            <p class="content">
                <?php echo $row['description']; ?>
            </p>

        </div>

    </div>
<?php
}
?>