<!DOCTYPE html>
<html>
    <head>
        <title><?php echo $page_title; ?></title>
        <link rel="stylesheet" href="css/style.css">
    </head>
    <body>
        <div id="container">
            <h1>ISTE 756 - e-Store</h1>
            <section id="navigation">
                <ul id="navigation-container">
                    <li class="navigation-item">
                        <a class="button" href="index.php">Catalog</a>
                    </li>
                    <li class="navigation-item">
                        <a class="button" href="cart.php">Cart</a>
                    </li>
                </ul>
            </section>
            <?php include($page_content); ?>
        </div>
    </body>
</html>