<?php
namespace sanitising;

function validateInput($DataToValidate)
{
    $DataToValidate = trim($DataToValidate);
    $DataToValidate = stripslashes($DataToValidate);
    $DataToValidate = htmlspecialchars($DataToValidate);
    return $DataToValidate;
}
