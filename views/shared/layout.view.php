<!DOCTYPE html>
<html>
    <head>
        <title><?php echo $page_title; ?></title>
        <link rel="stylesheet" href="css/style.css">
    </head>
    <body>
        <div id="main-container">
            <h1>ISTE 756 - e-Store</h1>
            <section id="navigation">
                <ul id="navigation-container">
                    <li class="navigation-item">
                        <a class="button" href="index.php">Catalog</a>
                    </li>
                    <li class="navigation-item">
                        <a class="button" href="cart.php">Cart</a>
                    </li>

                    <?php if ($_SESSION["user"]["role"] == "admin") { ?>
                        <li class="navigation-item">
                            <a class="button" href="admin.php">Admin</a>
                        </li>
                    <?php } ?>

                    <?php if (!isset($_SESSION["user"])) { ?>
                        <li class="navigation-item">
                            <form method="POST" action="login.php">
                                <input type="text" name="username" id="username" placeholder="Enter your username">
                                <input type="password" name="password" id="password" placeholder="Enter your password">
                                <input type="submit" name="login_submit" value="Login">
                            </form>
                        </li>
                    <?php } ?>
                </ul>
            </section>
            <?php include($page_content); ?>
        </div>
    </body>
</html>