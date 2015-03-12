<?php
    function show_product($product)
    {
        echo "<li class='product'>
                <h3>$product->name</h3>
                <div class='picture'><img src='$product->picture' alt='$product->name'/></div>
                <p>$product->description</p>
                <p class='stock'>$product->quantity_in_stock left</p>";

        if ($product->is_on_sale)
        {
            echo "<p class='price'>
                        <span class='old'>$ $product->price</span>
                        <span class='new'>$ $product->sale_price</span>
                    </p>";
        }
        else
        {
            echo "<p class='price'>$ $product->price</p>";
        }

        $disabled = ($product->quantity_in_stock == 0 ? "disabled" : "");

        echo "<div class='button'>
                <form method='POST' action='index.php'>
                    <input type='hidden' id='product_id' name='product_id' value='$product->id'/>
                    <input type='submit' name='add_to_cart_submit' value='Add to cart' $disabled>
                </form>
            </div>
        </li>";
    }
?>


