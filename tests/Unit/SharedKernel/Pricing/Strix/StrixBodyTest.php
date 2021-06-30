<?php
declare(strict_types =1);

namespace SharedKernel\Pricing\Strix;


use Tests\TestCase;

class StrixBodyTest extends TestCase
{


    public function test_solution_positive_integer()
    {
        $strix = new StrixBody();
        $tabOne = [1,2,3,6,4,1,2];
        $solution = $strix->solution($tabOne);

        $this->assertEquals(5, $solution);
    }

    public function test_solution_negative_integer()
    {
        $strix = new StrixBody();
        $tabOne = [-1,-3];
        $solution = $strix->solution($tabOne);

        $this->assertEquals(1, $solution);
        
    }

    public function test_solution_mixed_integer()
    {
        $strix = new StrixBody();
        $tabOne = [-1,1,2];
        $solution = $strix->solution($tabOne);

        $this->assertEquals(3, $solution);
    }

    public function test_solution_mixed_integer2()
    {
        $strix = new StrixBody();
        $tabOne = [5,1,-3,-2];
        $solution = $strix->solution($tabOne);

        $this->assertEquals(2, $solution);
    }

    public function test_get_max_binary_gap_from_number15()
    {
        $strix = new StrixBody();
        $gap = $strix->getMaxBinaryGapFromNumber(15);

        $this->assertEquals(0, $gap);
    }

    public function test_get_max_binary_gap_from_number32()
    {
        $strix = new StrixBody();
        $gap = $strix->getMaxBinaryGapFromNumber(32);

        $this->assertEquals(0, $gap);
    }

    public function test_get_max_binary_gap_from_number20()
    {
        $strix = new StrixBody();
        $gap = $strix->getMaxBinaryGapFromNumber(20);

        $this->assertEquals(1, $gap);
    }

    public function test_get_max_binary_gap_from_number1041()
    {
        $strix = new StrixBody();
        $gap = $strix->getMaxBinaryGapFromNumber(1041);

        $this->assertEquals(5, $gap);
    }

    public function test_generate_number_from_range()
    {
        $strix = new StrixBody();
        $minRange = 2;
        $maxRange = 15;
        $numbers = $strix->generateNumberFromRange($minRange, $maxRange);

        $this->assertEquals(false, $numbers[$maxRange]);
    }

    public function test_generate_number_from_range_1mln()
    {
        $strix = new StrixBody();
        $minRange = 2;
        $maxRange = 1000000;
        $numbers = $strix->generateNumberFromRange($minRange, $maxRange);

        $this->assertEquals(false, $numbers[$maxRange]);
    }

    public function test_search_palindrome()
    {
        $strix = new StrixBody();
        $minRange = 2;
        $maxRange = 1000;
        $numbers = $strix->generateNumberFromRange($minRange, $maxRange);

        $palindromes = $strix->searchPalindrome($numbers);


        $this->assertEquals(true, $palindromes[33]);
    }

    public function test_generate_prime_numbers_from_range()
    {
    $strix = new StrixBody();
    $minRange = 2;
    $maxRange = 100;

    $primeNumbers = $strix->generatePrimeNumbersFromRange($minRange, $maxRange);


    $this->assertEquals(true, $primeNumbers[11]);
    }

    public function test_generate_prime_numbers_from_range_big_number()
    {
        $strix = new StrixBody();
        $minRange = 953000;
        $maxRange = 1000000;

        $primeNumbers = $strix->generatePrimeNumbersFromRange($minRange, $maxRange);

        $this->assertEquals(true, $primeNumbers[953431]);
    }
}
