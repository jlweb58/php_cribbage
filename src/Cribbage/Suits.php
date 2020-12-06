<?php


namespace ComposerIncludeFiles\Cribbage;


class Suits
{
    public static $CLUBS;
    public static $DIAMONDS;
    public static $HEARTS;
    public static $SPADES;

    private static $values;

    static function init() {
        self::$CLUBS = new Suit(1, "Clubs");
        self::$DIAMONDS = new Suit(2, "Diamonds");
        self::$HEARTS = new Suit(3, "Hearts");
        self::$SPADES = new Suit(4, "Spades");
        self::$values = [ self::$CLUBS, self::$DIAMONDS, self::$HEARTS, self::$SPADES ];
    }

    public static function values() : array {
        return self::$values;
    }
}

Suits::init();
