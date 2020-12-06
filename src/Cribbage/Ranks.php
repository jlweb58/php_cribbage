<?php


namespace ComposerIncludeFiles\Cribbage;


class Ranks
{
    public static $ACE;
    public static $TWO;
    public static $THREE;
    public static $FOUR;
    public static $FIVE;
    public static $SIX;
    public static $SEVEN;
    public static $EIGHT;
    public static $NINE;
    public static $TEN;
    public static $JACK;
    public static $QUEEN;
    public static $KING;

    private static $values;

    static function init() {
        self::$ACE = new Rank(1, 1, "Ace");
        self::$TWO = new Rank(2, 2, "Two");
        self::$THREE = new Rank(3, 3, "Three");
        self::$FOUR = new Rank(4, 4, "Four");
        self::$FIVE = new Rank(5, 5, "Five");
        self::$SIX = new Rank(6, 6, "Six");
        self::$SEVEN = new Rank(7, 7, "Seven");
        self::$EIGHT = new Rank(8, 8, "Eight");
        self::$NINE = new Rank(9, 9, "Nine");
        self::$TEN = new Rank(10, 10, "Ten");
        self::$JACK = new Rank(10, 11, "Jack");
        self::$QUEEN = new Rank(10, 12, "Queen");
        self::$KING = new Rank(10, 13, "King");
        self::$values = [ self::$ACE, self::$TWO, self::$THREE, self::$FOUR, self::$FIVE, self::$SIX, self::$SEVEN, self::$EIGHT,
            self::$NINE, self::$TEN, self::$JACK, self::$QUEEN, self::$KING ];
    }

    public static function values() : array {
        return self::$values;
    }
}

Ranks::init();
