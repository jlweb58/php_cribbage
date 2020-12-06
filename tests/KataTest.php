<?php


use PHPUnit\Framework\TestCase;


function chooseBestSum($t, $k, $ls) {

    return -1;
}

function arr_permutations($arr, $num_p) : array {


}





class KataTest extends TestCase
{
    private function revTest($actual, $expected) {
        $this->assertSame($expected, $actual);
    }
    public function testBasics() {
        $ts = [50, 55, 56, 57, 58];
        $this->revTest(chooseBestSum(163, 3, $ts), 163);
        $ts = [50];
        $this->revTest(chooseBestSum(163, 3, $ts), null);
        $ts = [91, 74, 73, 85, 73, 81, 87];
        $this->revTest(chooseBestSum(230, 3, $ts), 228);
    }
}
