<?php


namespace ComposerIncludeFiles\Cribbage;

require_once('../../vendor/autoload.php');


class App
{
    public static function main() {
        $player1 = new Player();
        $player2 = new Player();
        $cardDeck = new CardDeck();
        $deal = new Deal($cardDeck, $player1, $player2, new HandCounter());


    }
}

App::main();
