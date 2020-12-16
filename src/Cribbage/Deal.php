<?php


namespace ComposerIncludeFiles\Cribbage;


final class Deal
{
    private CardDeck $deck;

    private Player $player1;

    private Player $player2;

    private HandCounter $handCounter;

    private Card $cutCard;

    public function __construct(CardDeck $cardDeck, Player $player1, Player  $player2, HandCounter $handCounter) {
        $this->deck = $cardDeck;
        $this->player1 = $player1;
        $this->player2 = $player2;
        $this->handCounter = $handCounter;
    }

    public function dealHand() : void {
        $this->deck->shuffle();
        $player1Hand = new Hand(4);
        $player2Hand = new Hand(4);
        for ($i = 0; $i < 8; $i++) {
            switch ($i % 2) {
                case 0:
                    $player1Hand->addCard($this->deck->dealCard());
                    break;
                case 1:
                    $player2Hand->addCard($this->deck->dealCard());
            }
        }
        $this->player1->setCurrentHand($player1Hand);
        $this->player2->setCurrentHand($player2Hand);
    }

    public function cutCard() : Card {
        $this->cutCard = $this->deck->dealCard();
        return $this->cutCard;
    }

    // If a jack is cut give the dealer nibs
    // (play the hand - later)
    // Count the hands for each player

}
