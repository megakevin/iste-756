<?php
    require "shared/show_error_messages.view.php";
?>

<section id="offers">
    <h2>Available Products</h2>
    <div class="control-panel">
        <ul class="product-list-container">
            <?php foreach ($context->products as $product) { ?>
                <li class="product-list-item">
                    <form method="POST" action="admin.php" enctype="multipart/form-data">
                        <p>
                            <input type="text" name="name" id="name"
                                   class="<?= ($context->errors["name"]) ? "validation-error" : "" ?>"
                                   value="<?= $product->name ?>"/>
                        </p>
                        <div class="picture">
                            <img src="<?= $product->picture ?>" alt="<?= $product->name ?>"/>
                        </div>
                        <p>
                            <input type="file" name="picture" id="picture"
                                   class="<?= ($context->errors["picture"]) ? "validation-error" : "" ?>">
                        </p>
                        <p>
                            <textarea class="<?= ($context->errors["description"]) ? "validation-error" : "" ?>"
                                      name="description" id="description"><?= $product->description ?></textarea>

                        </p>
                        <p>

                            Regular price:
                            <input type="number" name="price" id="price"
                                   class="<?= ($context->errors["price"]) ? "validation-error" : "" ?>"
                                   value="<?= $product->price ?>"/>
                            Stock:
                            <input type="number" name="quantity_in_stock" id="quantity_in_stock"
                                   class="<?= ($context->errors["quantity_in_stock"]) ? "validation-error" : "" ?>"
                                   value="<?= $product->quantity_in_stock ?>"/>
                        </p>
                        <p>
                            Discount price:
                            <input type="number" name="sale_price" id="sale_price"
                                   class="<?= ($context->errors["sale_price"]) ? "validation-error" : "" ?>"
                                   value="<?= $product->sale_price ?>"/>
                            On Discount?:
                            <input type="hidden" name="is_on_sale" id="is_on_sale" value="0">
                            <input type="checkbox" name="is_on_sale" id="is_on_sale" value="1"
                                   class="<?= ($context->errors["is_on_sale"]) ? "validation-error" : "" ?>"
                                   <?= $product->is_on_sale ? "checked" : "" ?>/>
                        </p>
                        <?php if ($context->errors) { ?>
                            <div>
                                <?php show_error_messages("name"); ?>
                                <?php show_error_messages("description"); ?>
                                <?php show_error_messages("price"); ?>
                                <?php show_error_messages("sale_price"); ?>
                                <?php show_error_messages("is_on_sale"); ?>
                                <?php show_error_messages("quantity_in_stock"); ?>
                                <?php show_error_messages("picture"); ?>
                            </div>
                        <?php } ?>
                        <div>
                            <input type="hidden" id="product_id" name="product_id" value="<?= $product->id ?>">
                            <input type='submit' name='edit_product_submit' value='Save'>
                            <input type='submit' name='delete_product_submit' value='Delete'>
                        </div>
                    </form>
                </li>
            <?php } ?>
        </ul>
    </div>
</section>