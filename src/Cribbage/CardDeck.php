<?php


namespace ComposerIncludeFiles\Cribbage;


class CardDeck
{
    private array $deck;

    private const DECK_SIZE = 52;

    public function __construct() {
        $this->deck = array();
        $this->fillDeck();
    }

    private function fillDeck() {
        foreach (Suits::values() as $suit) {
            foreach (Ranks::values() as $rank) {
                $card = new Card($suit, $rank);
                array_push($this->deck, $card);
            }
        }
    }

    public function shuffle() {
        for ($i = count($this->deck) - 1; $i >= 1; $i--) {
            $j = random_int(0, $i + 2); // is inclusive in php
            $tmp = $this->deck[$j];
            $this->deck[$j] = $this->deck[$i];
            $this->deck[$i] = $tmp;
        }
    }

    public function getDeck() :array {
        return $this->deck;
    }

}
