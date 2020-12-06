<?php


namespace ComposerIncludeFiles\Cribbage;


class HandCounter
{
    public const TWO = 2;
    const FIFTEEN = 15;

    public function getHandCount(Hand $hand): int {
        $total = 0;
        $total += $this->countFifteens($hand);
        $total += $this->countRuns($hand);
        $total += $this->countPairs($hand);
        $total += $this->countFlush($hand);

        return $total;
    }

    public function getHandCountWithCutCard(Hand $hand, Card $cutCard) : int {
        $countingHand = new Hand(5);
        foreach ($hand->getUnplayedCards() as $card) {
            $countingHand->addCard($card);
        }
        $countingHand->addCard($cutCard);
        $total = $this->getHandCount($countingHand);
        $total += $this->countNibs($hand, $cutCard);
        return $total;
    }

    private function countNibs(Hand $hand, Card $cutCard) : int {
        foreach ($hand->getUnplayedCards() as $card) {
            if ($card->getRank() == (Ranks::$JACK) && $card->getSuit() == $cutCard->getSuit()) {
                return 1;
            }
        }
        return 0;
    }

    private function countFifteens(Hand $hand): int {
        $total = 0;
        $twoCards = $this->getTwoCardPermutations($hand);
        foreach ($twoCards as $pair) {
            $fifteen = $pair[0]->getRank()->getCount() + $pair[1]->getRank()->getCount();
            if ($fifteen == HandCounter::FIFTEEN) {
                $total += HandCounter::TWO;
            }
        }

        $threeCardSets = $this->getThreeCardPermutations($hand);
        foreach ($threeCardSets as $cards) {
            $fifteen = $cards[0]->getRank()->getCount() + $cards[1]->getRank()->getCount() + $cards[2]->getRank()->getCount();
            if ($fifteen == HandCounter::FIFTEEN) {
                $total += HandCounter::TWO;
            }
        }
        $fourCardSets = $this->getFourCardPermutations($hand);
        foreach($fourCardSets as $cards) {
            $fifteen = $cards[0]->getRank()->getCount() + $cards[1]->getRank()->getCount() + $cards[2]->getRank()->getCount() + $cards[3]->getRank()->getCount();
            if ($fifteen == HandCounter::FIFTEEN) {
                $total += HandCounter::TWO;
            }
        }
        //five-card fifteen (including cut card)
        if (count($hand->getUnplayedCards())== 5) {
            $fifteen = 0;
            foreach ($hand->getUnplayedCards() as $card) {
                $fifteen += $card->getRank()->getCount();
            }
            if ($fifteen == HandCounter::FIFTEEN) {
                $total += HandCounter::TWO;
            }
        }
        return $total;
    }

    private function countRuns(Hand $hand): int {
        $total = 0;
        if (count($hand->getUnplayedCards()) == 5) {
            $fiveCardSets = $hand->getUnplayedCards();
            if ($this::isRun($fiveCardSets)) {
                return 5;
            }
        }
        $fourCardSets = $this->getFourCardPermutations($hand);
        foreach($fourCardSets as $cards) {
            if ($this::isRun($cards)) {
                $total += 4;
            }
        }
        if ($total > 0) {
            return $total;
        }
        $threeCardSets = $this->getThreeCardPermutations($hand);
        foreach($threeCardSets as $cards) {
            if ($this::isRun($cards)) {
                $total += 3;
            }
        }
        return $total;
    }

    private function countPairs(Hand $hand): int {
        $total = 0;
        $twoCards = $this->getTwoCardPermutations($hand);
        foreach ($twoCards as $pair) {
            if ($pair[0]->getRank()->getSequence() == ($pair[1]->getRank()->getSequence())) {
                $total += HandCounter::TWO;
            }
        }
        return $total;
    }

    private function countFlush(Hand $hand): int {
        $lastSuit = null;
        if (count($hand->getUnplayedCards()) == 4) {
            foreach ($hand->getUnplayedCards() as $card) {
                if ($card->getSuit() == $lastSuit) {
                    $lastSuit = $card->getSuit();
                } else {
                    if ($lastSuit != null) {
                        return 0;
                    } else {
                        $lastSuit = $card->getSuit();
                    }
                }
            }
            return 4;
        } else {
            foreach ($hand->getUnplayedCards() as $card) {
                if ($lastSuit != null && $card->getSuit() == $lastSuit) {
                    $lastSuit = $card->getSuit();
                } else {
                    if ($lastSuit != null) {
                        return 0;
                    } else {
                        $lastSuit = $card->getSuit();
                    }
                }
            }
            return 5;
        }
    }

    private function getTwoCardPermutations(Hand $hand): array {
        $permutations = array();
        $cards = $hand->getUnplayedCards();
        $firstIndex = 0;
        $secondIndex = 1;
        $maxIndex = count($cards) - 1;
        while ($firstIndex <= (count($cards) - 2)) {
            array_push(
                $permutations,
                [$cards[$firstIndex], $cards[$secondIndex]]
            );
            if ($secondIndex < $maxIndex) {
                $secondIndex++;
            } else {
                $firstIndex++;
                $secondIndex = $firstIndex + 1;
            }
        }

        return $permutations;
    }

    private function getThreeCardPermutations(Hand $hand): array
    {
        $permutations = array();
        $cards = $hand->getUnplayedCards();
        $firstIndex = 0;
        $secondIndex = 1;
        $thirdIndex = 2;
        $maxIndex = count($cards) - 1;
        while ($firstIndex <= count($cards) - 3) {
            array_push(
                $permutations,
                [
                    $cards[$firstIndex],
                    $cards[$secondIndex],
                    $cards[$thirdIndex]
                ]
            );
            if ($thirdIndex < $maxIndex) {
                $thirdIndex++;
            } else {
                if ($secondIndex < ($thirdIndex - 1)) {
                    $secondIndex++;
                    if ($thirdIndex - 1 > $secondIndex) {
                        $thirdIndex--;
                    }
                } else {
                    $firstIndex++;
                    $secondIndex = $firstIndex + 1;
                    $thirdIndex = $secondIndex + 1;
                }
            }
        }

        return $permutations;
    }

    private function getFourCardPermutations(Hand $hand) : array {
        $permutations = array();
        $cards = $hand->getUnplayedCards();
        $firstIndex = 0;
        $secondIndex = 1;
        $thirdIndex = 2;
        $fourthIndex = 3;
        $maxIndex = count($cards) - 1;
        while ($firstIndex <= count($cards) - 4) {
            array_push(
                $permutations,
                [
                    $cards[$firstIndex],
                    $cards[$secondIndex],
                    $cards[$thirdIndex],
                    $cards[$fourthIndex]
                ]
            );
            if ($fourthIndex < $maxIndex) {
                $fourthIndex++;
            } else {
                if ($thirdIndex < ($fourthIndex - 1)) {
                    $thirdIndex++;
                    if ($fourthIndex - 1 > $thirdIndex) {
                        $fourthIndex--;
                    }
                } else {
                    if ($secondIndex < ($thirdIndex - 1)) {
                        $secondIndex++;
                        if ($thirdIndex - 1 > $secondIndex) {
                            $thirdIndex--;
                        }
                    } else {
                        $firstIndex++;
                        $secondIndex = $firstIndex + 1;
                        $thirdIndex = $secondIndex + 1;
                    }
                }
            }
        }
        return $permutations;
    }

    private static function isRun(array $cards) : bool {
        sort($cards);
        $currentCount = $cards[0]->getRank()->getSequence();
        for ($i = 1; $i < count($cards); $i++) {
            if ($cards[$i]->getRank()->getSequence() - $currentCount != 1) {
                return false;
            }
            $currentCount = $cards[$i]->getRank()->getSequence();
        }
        return true;
    }
}
