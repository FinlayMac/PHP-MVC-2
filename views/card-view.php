<?php

class CardView
{
    public $bigHeading;
    public $smallHeading;
    public $description;

    public function __construct($bigHeading, $smallHeading, $description)
    {
        echo ' <div class="book">
                    <img src="/images/Book.png" alt="A vector drawing of a book" title="' . $description . '">
                    <h3>' . $bigHeading . '</h3>
                    <h4>' . $smallHeading . '</h4>
                </div>';
    }
}
