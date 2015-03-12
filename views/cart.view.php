<section id="offers">
    <h2>Your Shopping Cart</h2>
    <div class="cart-container">
        <?php if ($context->cart->items) { ?>
        <ul class="product-list-container">
            <?php foreach ($context->cart->items as $cart_item) { ?>
                <li class="product-list-item">
                    <h3><?= $cart_item->product->name ?></h3>
                    <p>
                        <?= $cart_item->product->description ?>
                        You ordered: <?= $cart_item->product_quantity ?>
                    </p>
                    <p>
                        <?php if ($cart_item->product->is_on_sale) { ?>
                            <span class="price">
                                <span class="old">$ <?= $cart_item->product->price ?></span>
                                <span class="new">$ <?= $cart_item->product->sale_price ?></span>
                            </span>
                        <?php } else { ?>
                            <span class="price">$ <?= $cart_item->product->price ?></span>
                        <?php } ?>
                    </p>
                </li>
            <?php } ?>
        </ul>
        <?php } else { ?>
            <h3 class="cart-empty-message">
                Your cart is empty! Go <a href="index.php">here</a> if you want to purchase something.
            </h3>
        <?php } ?>
        <p class="total-price">
            <span>Total: $ <?= $context->cart->total_price ?></span>
        </p>
        <div class="buttons">
            <form method='POST' action='cart.php'>
                <input type='submit' name='clear_cart_submit' value='Clear Cart'>
                <input type='button' name='add_to_cart_submit' value='Checkout' onclick="alert('Coming soon...');">
            </form>
        </div>
    </div>
</section>