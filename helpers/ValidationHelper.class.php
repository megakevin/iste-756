<?php
    class ValidationHelper
    {        
        public function __construct() { }
        
        function validate_required($value)
        {
            return isset($value) && trim($value) !== "";
        }
        
        function validate_email($value)
        {
            # php magic validates emails.
            return filter_var($value, FILTER_VALIDATE_EMAIL);
        }
        
        function validate_max_length($value, $max_length)
        {
            return strlen(trim($value)) <= $max_length;
        }
        
        function validate_number($value)
        {
            return filter_var($value, FILTER_VALIDATE_INT);
        }
        
        function validate_equals($value, $equal_value)
        {
            return $value == $equal_value;
        }
    }
?>