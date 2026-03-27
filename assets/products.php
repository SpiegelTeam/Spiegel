<?php if ($result->num_rows > 0) { ?>

    <?php while ($row = $result->fetch_assoc()) { ?>

        <div class="card product-card">

            <div class="card-image">
                <figure class="image">
                    <img class="product-photos"
                        src="/spiegel/images/products/<?php echo $row['image']; ?>"
                        alt="Product"
                        onerror="this.src='/spiegel/images/products/test.png'">
                </figure>
            </div>



            <div class="card-content">

                <div class="buttons mt-2">
                    <a href="editproduct.php?id=<?php echo $row['item_id']; ?>"
                        class="button is-small is-info">
                        Edit
                    </a>

                    <form action="deleteproduct.php" method="POST"
                        onsubmit="return confirm('Delete this product?');">
                        <input type="hidden" name="id" value="<?php echo $row['item_id']; ?>">
                        <button class="button is-small is-danger" type="submit">
                            Delete
                        </button>
                    </form>
                </div>

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

<?php } else { ?>
    <p>No products found.</p>
<?php } ?>