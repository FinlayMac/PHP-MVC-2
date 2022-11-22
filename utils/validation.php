<?php

namespace validation;

function InputIsMinLength($input, $minChars)
{
    if (strlen($input) >= $minChars) {
        return true;
    } else return false;
}

function InputsMatch($input1, $input2)
{
    if ($input1 == $input2) {
        return true;
    } else return false;
}

function EmailIsAppropriate($email)
{
    $email = filter_var($email, FILTER_SANITIZE_EMAIL);
    if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
        return true;
    } else return false;
}
