<?php

namespace Cribbage;

use ComposerIncludeFiles\Cribbage\Hand;
use ComposerIncludeFiles\Cribbage\Card;
use ComposerIncludeFiles\Cribbage\Ranks;
use ComposerIncludeFiles\Cribbage\Suits;
use ComposerIncludeFiles\Cribbage\HandCounter;
use PHPUnit\Framework\TestCase;

class HandCounterTest extends TestCase
{
    private Hand $hand;
    private HandCounter $handCounter;

    public function setUp() : void {
        $this->hand = new Hand(4);
        $this->handCounter = new HandCounter();
    }


    function testSetUp() {
        $this->assertTrue($this->hand != null);
        $this->assertTrue($this->handCounter != null);
        $this->assertTrue(Ranks::$ACE != null);
    }

    function testHandNoPoints() {
        $this->hand->addCard(new Card(Suits::$SPADES, Ranks::$THREE));
        $this->hand->addCard(new Card(Suits::$SPADES, Ranks::$FOUR));
        $this->hand->addCard(new Card(Suits::$SPADES, Ranks::$SIX));
        $this->hand->addCard(new Card(Suits::$HEARTS, Ranks::$ACE));
        $this::assertCountCorrect(0);
    }

    function testHandOneTwoCardFifteen() {
        $this->hand->addCard(new Card(Suits::$SPADES, Ranks::$TWO));
        $this->hand->addCard(new Card(Suits::$SPADES, Ranks::$FOUR));
        $this->hand->addCard(new Card(Suits::$SPADES, Ranks::$FIVE));
        $this->hand->addCard(new Card(Suits::$HEARTS, Ranks::$KING));
        $this::assertCountCorrect(2);
    }

    function testHandTwoTwoCardFifteens() {
        $this->hand->addCard(new Card(Suits::$SPADES, Ranks::$TEN));
        $this->hand->addCard(new Card(Suits::$SPADES, Ranks::$FOUR));
        $this->hand->addCard(new Card(Suits::$SPADES, Ranks::$FIVE));
        $this->hand->addCard(new Card(Suits::$HEARTS, Ranks::$KING));
        $this::assertCountCorrect(4);
    }

    function testHandOneThreeCardFifteen() {
        $this->hand->addCard(new Card(Suits::$SPADES, Ranks::$THREE));
        $this->hand->addCard(new Card(Suits::$SPADES, Ranks::$FOUR));
        $this->hand->addCard(new Card(Suits::$SPADES, Ranks::$EIGHT));
        $this->hand->addCard(new Card(Suits::$HEARTS, Ranks::$ACE));
        $this::assertCountCorrect(2);
    }

    function testHandTwoThreeCardFifteens() {
        $this->hand->addCard(new Card(Suits::$SPADES, Ranks::$THREE));
        $this->hand->addCard(new Card(Suits::$SPADES, Ranks::$FOUR));
        $this->hand->addCard(new Card(Suits::$SPADES, Ranks::$EIGHT));
        $this->hand->addCard(new Card(Suits::$HEARTS, Ranks::$THREE));
        $this::assertCountCorrect(6);
    }

    function testHandFourCardFifteen() {
        $this->hand->addCard(new Card(Suits::$SPADES, Ranks::$ACE));
        $this->hand->addCard(new Card(Suits::$SPADES, Ranks::$THREE));
        $this->hand->addCard(new Card(Suits::$SPADES, Ranks::$SIX));
        $this->hand->addCard(new Card(Suits::$HEARTS, Ranks::$FIVE));
        $this::assertCountCorrect(2);
    }

    function testHandFiveCardFifteenPlusPair() {
        $this->hand->addCard(new Card(Suits::$SPADES, Ranks::$TWO));
        $this->hand->addCard(new Card(Suits::$SPADES, Ranks::$FOUR));
        $this->hand->addCard(new Card(Suits::$SPADES, Ranks::$SIX));
        $this->hand->addCard(new Card(Suits::$HEARTS, Ranks::$ACE));
        $cutCard = new Card(Suits::$HEARTS, Ranks::$TWO);
        $this->assertEquals(4, $this->handCounter->getHandCountWithCutCard($this->hand, $cutCard));
    }

    function testCountThreeCardRun() {
        $this->hand->addCard(new Card(Suits::$SPADES, Ranks::$TEN));
        $this->hand->addCard(new Card(Suits::$SPADES, Ranks::$JACK));
        $this->hand->addCard(new Card(Suits::$SPADES, Ranks::$QUEEN));
        $this->hand->addCard(new Card(Suits::$HEARTS, Ranks::$ACE));
        $this->assertCountCorrect(3);
    }

    function testCountFourCardRun() {
        $this->hand->addCard(new Card(Suits::$SPADES, Ranks::$TEN));
        $this->hand->addCard(new Card(Suits::$SPADES, Ranks::$JACK));
        $this->hand->addCard(new Card(Suits::$SPADES, Ranks::$QUEEN));
        $this->hand->addCard(new Card(Suits::$HEARTS, Ranks::$KING));
        $this->assertCountCorrect(4);
    }

    function testCountThreeCardDoubleRun() {
        $this->hand->addCard(new Card(Suits::$SPADES, Ranks::$TEN));
        $this->hand->addCard(new Card(Suits::$SPADES, Ranks::$JACK));
        $this->hand->addCard(new Card(Suits::$SPADES, Ranks::$QUEEN));
        $this->hand->addCard(new Card(Suits::$HEARTS, Ranks::$TEN));
        $this->assertCountCorrect(8);
    }

    function testCountTwoPairs() {
        $this->hand->addCard(new Card(Suits::$SPADES, Ranks::$TEN));
        $this->hand->addCard(new Card(Suits::$SPADES, Ranks::$NINE));
        $this->hand->addCard(new Card(Suits::$HEARTS, Ranks::$NINE));
        $this->hand->addCard(new Card(Suits::$HEARTS, Ranks::$TEN));
        $this->assertCountCorrect(4);
    }

    function testCountThreeOfAKind() {
        $this->hand->addCard(new Card(Suits::$DIAMONDS, Ranks::$NINE));
        $this->hand->addCard(new Card(Suits::$SPADES, Ranks::$NINE));
        $this->hand->addCard(new Card(Suits::$HEARTS, Ranks::$NINE));
        $this->hand->addCard(new Card(Suits::$HEARTS, Ranks::$TEN));
        $this->assertCountCorrect(6);
    }

    function testCountFourOfAKind() {
        $this->hand->addCard(new Card(Suits::$DIAMONDS, Ranks::$NINE));
        $this->hand->addCard(new Card(Suits::$SPADES, Ranks::$NINE));
        $this->hand->addCard(new Card(Suits::$HEARTS, Ranks::$NINE));
        $this->hand->addCard(new Card(Suits::$CLUBS, Ranks::$NINE));
        $this->assertCountCorrect(12);
    }

    function testCountFourFlush() {
        $this->hand->addCard(new Card(Suits::$SPADES, Ranks::$ACE));
        $this->hand->addCard(new Card(Suits::$SPADES, Ranks::$TWO));
        $this->hand->addCard(new Card(Suits::$SPADES, Ranks::$FOUR));
        $this->hand->addCard(new Card(Suits::$SPADES, Ranks::$SIX));
        $this->assertCountCorrect(4);
    }
    
    function assertCountCorrect($expected) {
        $this->assertEquals($expected, $this->handCounter->getHandCount($this->hand));
    }

}
