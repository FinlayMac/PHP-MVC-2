<?php
include_once($_SERVER['DOCUMENT_ROOT'] . '/views/card-view.php');

class CardGridView
{

    public $arrayOfCards;

    public function __construct($arrayOfCards)
    {
        echo '<section class="book-grid">';

        foreach ($arrayOfCards as $singleCard) {
            $newCard = new CardView($singleCard->name, $singleCard->author, $singleCard->description);
        }

        echo '</section>';
    }
}
