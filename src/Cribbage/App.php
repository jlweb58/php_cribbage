<?php


namespace ComposerIncludeFiles\Cribbage;

require_once('../../vendor/autoload.php');


class App
{
    public static function main() {
        $cardDeck = new CardDeck();
        $cardDeck->shuffle();
        foreach ($cardDeck->getDeck() as $card) {
            echo $card . ", ";
        }
    }
}

App::main();
