<?php


namespace ComposerIncludeFiles\Cribbage;


final class Player
{
    private Hand $currentHand;


    public function __construct() {
    }

    public function setCurrentHand(Hand $currentHand): void {
        $this->currentHand = $currentHand;
    }

    public function getCurrentHand() : Hand {
        return $this->currentHand;
    }

    public function playCard() : Card {
       return $this->currentHand->playCard();
    }

    public function hasCardsLeft() : bool {
        return count($this->currentHand->getUnplayedCards()) > 0;
    }
}
