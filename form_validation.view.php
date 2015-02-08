<?php
    function show_error_messages($field_name)
    {
        global $errors;
        
        if ($errors[$field_name])
        {
            echo '<ul class="error-messages">';
            foreach ($errors[$field_name] as $error_message)
            {
                echo "<li>" . $error_message . "</li>";
            }
            echo "</ul>";
        }
    }
?>

<h1>ISTE 756 - Form Validation</h1>
<section id="contact">
    <h2>Contact me</h2>
    <form id="form_contact" method="POST" action="form_validation.php">        
        <table>
            <tr>
                <th><label for="contact_name">Name:</label></th>
                <td>                    
                    <input type="text" name="contact_name" id="contact_name"
                           class="<?= ($errors["contact_name"]) ? "validation-error" : "" ?>"
                           value="<?= $_POST["contact_name"] ?>"/>
                    <?php show_error_messages("contact_name"); ?>
                </td>
            </tr>
            
            <tr>
                <th><label for="contact_email">Email:</label></th>
                <td>                    
                    <input type="text" name="contact_email" id="contact_email"
                           class="<?= ($errors["contact_email"]) ? "validation-error" : "" ?>"
                           alt="lolollo"
                           value="<?= $_POST["contact_email"] ?>"/>
                    <?php show_error_messages("contact_email"); ?>                 
                </td>
            </tr>
            
            <tr>
                <th><label for="contact_comments">Comments:</label></th>
                <td>                    
                    <textarea type="text" name="contact_comments" id="contact_comments" cols="40" rows="15"
                              class="<?= ($errors["contact_comments"]) ? "validation-error" : "" ?>"><?= $_POST["contact_comments"] ?></textarea>
                    <?php show_error_messages("contact_comments"); ?>               
                </td>
            </tr>
        </table>
    
        <input type="submit" name="contact_submit">
    </form>
</section>