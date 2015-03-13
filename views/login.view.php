<?php
    require "shared/show_error_messages.view.php";
?>

<section id="login">
    <h2>Login</h2>
    <form method="POST" action="login.php">
        <input type="text" name="username" id="username" placeholder="Enter your username">
        <input type="password" name="password" id="password" placeholder="Enter your password">
        <input type="submit" name="login_submit" value="Login">
    </form>
    <?php if ($context->errors) { ?>
        <div>
            <?php show_error_messages("rule_error"); ?>
            <?php show_error_messages("username"); ?>
            <?php show_error_messages("password"); ?>
        </div>
    <?php } ?>
</section>