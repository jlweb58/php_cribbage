<?php


namespace ComposerIncludeFiles\Cribbage;


final class Rank
{
    private int $count;

    private int $sequence;

    private string $name;

   public function __construct($count, $sequence, $name) {
       $this->count = $count;
       $this->sequence = $sequence;
       $this->name = $name;
   }

    public function getCount() : int {
        return $this->count;
    }

    public function getSequence() : int {
        return $this->sequence;
    }

    public function getName() : string {
       return $this->name;
    }
}

