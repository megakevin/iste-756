<?php
    require_once "shared/show_product_container.view.php";
?>

<section id="offers">
    <h2>Today's Offers</h2>
    <?php
        show_product_container($context->products_on_sale);
    ?>
</section>
<section id="catalog">
    <h2>Product Catalog</h2>
    <?php
        show_product_container($context->products);
    ?>
</section>