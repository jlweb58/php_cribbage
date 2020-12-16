<?php

namespace Cribbage;

use ComposerIncludeFiles\Cribbage\CardDeck;
use ComposerIncludeFiles\Cribbage\Deal;
use ComposerIncludeFiles\Cribbage\Hand;
use ComposerIncludeFiles\Cribbage\HandCounter;
use ComposerIncludeFiles\Cribbage\Player;
use PHPUnit\Framework\TestCase;

class DealTest extends TestCase
{
    private CardDeck $cardDeck;

    private Player $player1;

    private Player $player2;

    private Deal $deal;

    public function setUp() : void {
        $this->player1 = new Player();
        $this->player2 = new Player();
        $this->cardDeck = new CardDeck();
        $this->deal = new Deal($this->cardDeck, $this->player1, $this->player2, new HandCounter());
    }

    public function testDealHand() {
        $this->deal->dealHand();
        $this->assertTrue(count($this->player1->getCurrentHand()->getUnplayedCards()) == 4);
        $this->assertTrue(count($this->player2->getCurrentHand()->getUnplayedCards()) == 4);
    }

    public function testCutCard() {
        $this->deal->dealHand();
        $cutCard = $this->deal->cutCard();
        $this->assertNotNull($cutCard);
    }

}
