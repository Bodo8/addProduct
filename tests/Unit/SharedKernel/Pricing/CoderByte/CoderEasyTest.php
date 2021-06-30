<?php

namespace Tests\src\Pricing\CoderByte;

use SharedKernel\Pricing\CoderByte\CoderEasy;
use Tests\TestCase;

class CoderEasyTest extends TestCase
{

    public function test_letter_changes()
    {
        $letterChanges = new CoderEasy();
        $changeString = $letterChanges->LetterChanges("Animal zoo*3");

       //var_dump($changeString);

        $this->assertEquals("bOjnbm App*3", $changeString);
    }

    public function test_letter_changes2()
    {
        $letterChanges = new CoderEasy();
        $changeString = $letterChanges->LetterChanges2("Animal zoo*3");

        $this->assertEquals("bOjnbm App*3", $changeString);
    }

    public function test_longest_Word()
    {
        $letterChanges = new CoderEasy();
        $changeString = $letterChanges->LongestWord("Anima zoo*3 Edytka ler#*");

        //var_dump($changeString);

        $this->assertEquals("Edytka", $changeString);
    }

    public function test_narcissistic_number12()
    {
        $letterChanges = new CoderEasy();
        $number = $letterChanges->narcissistic(12);

        $this->assertEquals(false, $number);
    }

    public function test_narcissistic_number153()
    {
        $letterChanges = new CoderEasy();
        $number = $letterChanges->narcissistic(153);

        $this->assertEquals(true, $number);
    }

    public function test_narcissistic_number1634()
    {
        $letterChanges = new CoderEasy();
        $number = $letterChanges->narcissistic(1634);

        $this->assertEquals(true, $number);
    }
}
