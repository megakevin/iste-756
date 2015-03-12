<section id="offers">
    <h2>Your Shopping Cart</h2>

    <ul class="cart-item-container">
        <?php foreach ($context->cart_items as $cart_item) { ?>
            <li class="cart-item">
                <?= $cart_item->product->name ?>
                <?= $cart_item->product->description ?>
                <?= $cart_item->product_quantity ?>

                <?php if ($cart_item->product->is_on_sale) { ?>
                    <p class='price'>
                        <span class='old'>$ <?= $cart_item->product->price ?></span>
                        <span class='new'>$ <?= $cart_item->product->sale_price ?></span>
                    </p>
                <?php } else { ?>
                    <p class='price'>$ <?= $cart_item->product->price ?></p>
                <?php } ?>
            </li>
        <?php } ?>
    </ul>

    <pre>
        <?php print_r($context) ?>
    </pre>

</section>