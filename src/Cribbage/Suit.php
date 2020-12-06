<?php


namespace ComposerIncludeFiles\Cribbage;


final class Suit
{
    private int $sequence;
    private string $name;

    public function __construct(int $sequence, string $name) {
        $this->sequence = $sequence;
        $this->name = $name;
    }

    public function getSequence(): int {
        return $this->sequence;
    }

    public function getName(): string {
        return $this->name;
    }

}
