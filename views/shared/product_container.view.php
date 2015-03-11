<ul class="product-container">
    <?php foreach ($products_to_show as $product) { ?>
        <li class="product">
            <h3><?= $product->name ?></h3>
            <div class="picture"><img src="<?= $product->picture ?>" alt="<?= $product->name ?>"/></div>
            <p><?= $product->description ?></p>
            <p class="stock"><?= $product->quantity_in_stock ?> left</p>
            <?php if ($product->is_on_sale) { ?>
                <p class="price">
                    <span class="old">$ <?= $product->price ?></span>
                    <span class="new">$ <?= $product->sale_price ?></span>
                </p>
            <?php } else { ?>
                <p class="price">$ <?= $product->price ?></p>
            <?php } ?>
            <div class="button">
                <form method="POST" action="index.php">
                    <input type="hidden" id="product_id" name="product_id" value="<?= $product->id ?>" />
                    <input type="submit" name="add_to_cart_submit" value="Add to cart">
                </form>
            </div>
        </li>
    <?php } ?>
</ul>