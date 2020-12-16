<?php

namespace Cribbage;

use ComposerIncludeFiles\Cribbage\Card;
use ComposerIncludeFiles\Cribbage\Hand;
use ComposerIncludeFiles\Cribbage\Player;
use ComposerIncludeFiles\Cribbage\Ranks;
use ComposerIncludeFiles\Cribbage\Suits;
use PHPUnit\Framework\TestCase;

class PlayerTest extends TestCase
{
    private Player $player;

    public function setUp() : void {
        $hand = new Hand(4);
        $hand->addCard(new Card(Suits::$DIAMONDS, Ranks::$NINE));
        $hand->addCard(new Card(Suits::$CLUBS, Ranks::$EIGHT));
        $hand->addCard(new Card(Suits::$SPADES, Ranks::$TWO));
        $hand->addCard(new Card(Suits::$HEARTS, Ranks::$ACE));
        $this->player = new Player();
        $this->player->setCurrentHand($hand);
    }

    function testPlayCard() {
        $this->player->playCard();
        $this->assertTrue($this->player->hasCardsLeft());
        $this->player->playCard();
        $this->assertTrue($this->player->hasCardsLeft());
        $this->player->playCard();
        $this->assertTrue($this->player->hasCardsLeft());
        $this->player->playCard();
        $this->assertFalse($this->player->hasCardsLeft());
    }
}
