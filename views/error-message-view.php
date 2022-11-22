<?php

class ErrorMessage
{
    public function __construct($errorMessage)
    {
        echo    "<div class='error-message'>" . $errorMessage . "</div><br><br>";
    }
}
