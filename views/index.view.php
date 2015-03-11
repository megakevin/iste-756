<section id="offers">
    <h2>Today's Offers</h2>
    <?php
        $products_to_show = $context->products_on_sale;
        include "shared/product_container.view.php";
    ?>
    <?php //show_product_container($context->products_on_sale) ?>
</section>
<section id="catalog">
    <h2>Product Catalog</h2>
    <?php
        $products_to_show = $context->products;
        include "shared/product_container.view.php";
    ?>
    <?php //show_product_container($context->products) ?>
</section>