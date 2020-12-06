<?php


namespace ComposerIncludeFiles\Cribbage;


class Card
{
    private Rank $rank;

    private Suit $suit;

    public function __construct($suit, $rank) {
        $this->rank = $rank;
        $this->suit = $suit;
    }

    public function getRank() : Rank {
        return $this->rank;
    }

    public function getSuit() : Suit {
        return $this->suit;
    }

    public function __toString() : string {
        return $this->rank->getName() . ' of ' . $this->getSuit()->getName();
    }
}
