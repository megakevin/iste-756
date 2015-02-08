<?php    
    $errors = array();
    
    function validate_required($value)
    {
        return isset($value) && trim($value) !== "";
    }
    
    function validate_email($value)
    {
        # php magic validates emails.
        return filter_var($value, FILTER_VALIDATE_EMAIL);
    }
     
    function is_valid()
    {
        global $errors;
        
        # Required field validators
        if (!validate_required($_POST["contact_name"]))
        {
            $errors["contact_name"][] = "Please enter your Name.";
        }
        if (!validate_required($_POST["contact_email"]))
        {
            $errors["contact_email"][] = "Please enter your Email.";
        }
        if (!validate_required($_POST["contact_comments"]))
        {
            $errors["contact_comments"][] = "Please enter your comments.";
        }
        
        # Regex validators
        if (!validate_email($_POST["contact_email"]))
        { 
            $errors["contact_email"][] = "Please enter a valid Email address.";
        }
        
        # If there are no errors, then the input is valid
        return empty($errors);        
    }
    
    function is_post()
    {
        return isset($_POST["contact_submit"]);
    }
    
    function post()
    {
        global $errors;
        
        if (is_valid())
        {
            $to = "Kevin <kac2375@rit.edu>";
            $subject = "Message from ISTE-756";
            $message = $_POST["contact_name"] . " says : \r\n";
            $message .= $_POST["contact_comments"];
            
            $headers = "From: kac2375@rit.edu" . "\r\n";
            $headers .= "Cc: " . $_POST["contact_email"] . "\r\n";
            
            //echo "sending email!";
            mail($to, $subject, $message, $headers);        
        }
    }
    
    function process_request()
    {
        if (is_post())
        {
            post();
        }
    }

    process_request();
?>

<?php
    $page_title = "ISTE 756 - Form Validation";
    $page_content = "form_validation.view.php";
    include('layout.php');
?>