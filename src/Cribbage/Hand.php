<?php


namespace ComposerIncludeFiles\Cribbage;


class Hand
{
    private int $hand_size;

    private array $unplayed_cards;

    public function __construct($hand_size) {
        $this->hand_size = $hand_size;
        $this->unplayed_cards = array();
    }

    public function addCard($card) : void {
        array_push($this->unplayed_cards, $card);
    }

    public function getUnplayedCards() : array {
        return $this->unplayed_cards;
    }
}
