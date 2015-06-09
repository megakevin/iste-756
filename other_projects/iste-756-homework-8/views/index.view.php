<section>
    <h2>Beer Price</h2>
    <div>
        <form method="POST" action="index.php">
            <select name="beer" id="beer">
                <?php foreach ($context->beers as $beer) { ?>
                    <option value="<?= $beer ?>" <?= ($_POST["beer"] == $beer) ? 'selected' : '' ?>><?= $beer ?></option>
                <?php } ?>
            </select>

            <?php if ($context->beer_price) { ?>
                Price: <span id="price"><?= $context->beer_price ?></span>
            <?php } ?>

            <br />

            <input type="submit" name="get_price_submit" value="Get Price">
        </form>
    </div>
</section>

<section>
    <h2>Cheapest Beer</h2>
    <div>
        <span><?= $context->cheapest_beer ?></span>
    </div>
</section>

<section>
    <h2>Costliest Beer</h2>
    <div>
        <span><?= $context->costliest_beer ?></span>
    </div>
</section>

<section>
    <h2>Available Beers</h2>
    <ul>
        <?php foreach ($context->beers as $beer) { ?>
            <li><?= $beer ?></li>
        <?php } ?>
    </ul>
</section>

<section>
    <h2>Service's Methods</h2>
    <ul>
        <?php foreach ($context->methods as $method) { ?>
            <li><?= $method ?></li>
        <?php } ?>
    </ul>
</section>