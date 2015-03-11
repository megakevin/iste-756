<h1>ISTE 756 - e-Store</h1>
<section id="offers">
    <h2>Today's Offers</h2>

    <ul class="product-container">
        <?php foreach ($context->products_on_sale as $product) { ?>
            <li class="product">
                <h3><?= $product->name ?></h3>
                <div class="picture"><img src="<?= $product->picture ?>" alt="<?= $product->name ?>"/></div>
                <p><?= $product->description ?></p>
                <p class="stock"><?= $product->quantity_in_stock ?> left</p>
                <p class="price">
                    <span class="old">$ <?= $product->price ?></span>
                    <span class="new">$ <?= $product->sale_price ?></span>
                </p>
                <div class="button">
                    <form method="POST" action="index.php">
                        <input type="hidden" id="product_id" name="product_id" value="<?= $product->id ?>" />
                        <input type="submit" name="add_to_cart_submit" value="Add to cart">
                    </form>
                </div>
            </li>
        <?php } ?>
    </ul>

<!--    <pre>-->
<!--    --><?php //print_r($context->products_on_sale) ?>
<!--    </pre>-->
</section>
<section id="catalog">
    <h2>Product Catalog</h2>

    <ul class="product-container">
        <?php foreach ($context->products as $product) { ?>
            <li class="product">
                <h3><?= $product->name ?></h3>
                <div class="picture"><img src="<?= $product->picture ?>" alt="<?= $product->name ?>"/></div>
                <p><?= $product->description ?></p>
                <p class="stock"><?= $product->quantity_in_stock ?> left</p>
                <p class="price">$ <?= $product->price ?></p>
                <div class="button">
                    <form method="POST" action="index.php">
                        <input type="hidden" id="product_id" name="product_id" value="<?= $product->id ?>" />
                        <input type="submit" name="add_to_cart_submit" value="Add to cart">
                    </form>
                </div>
            </li>
        <?php } ?>
    </ul>

<!--    <pre>-->
<!--    --><?php ////echo print_r($context->products) ?>
<!--    </pre>-->
</section>