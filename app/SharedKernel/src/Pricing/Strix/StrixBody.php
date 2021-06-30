<?php
declare(strict_types =1);


namespace SharedKernel\Pricing\Strix;

/**
 * @author Bogusław Trojański
 */
class StrixBody
{
    public function generateNumberFromRange(int $minRange, int $maxRange): array
    {
        $numbers = [];

        for ($i = $minRange; $i <= $maxRange; $i++) {
            $numbers[$i] = false;
        }

        return $numbers;
    }

    public function searchPalindrome(array $numbers): array
    {
        $palindromes = [];

        $numbersFromKeys = array_keys($numbers);

        foreach ($numbersFromKeys as $number) {
                $borderNumber = strval($number);

                if (strlen($borderNumber) > 1) {
                $revers = strrev($borderNumber);

                if ($borderNumber === $revers) {
                    $palindromes[$number] = true;
                }
            }
        }

        return $palindromes;
    }

    public function generatePrimeNumbersFromRange(int $minRange, int $maxRange): array
    {
        $primeNumbers = [];

        if ($minRange < 2 || $maxRange < 2) {
            throw new \Exception("Range must be greater than 1");
        }

        $allNumbers = $this->getTabWithAllNumbers($minRange, $maxRange);
        $checkedNumbers = $this->checkTabWithAllNumbers($allNumbers, $maxRange);

        foreach ($checkedNumbers as $key => $value) {
            if ($value) {
                $primeNumbers[$key] = $value;
            }
        }

        return $primeNumbers;
    }

    private function getTabWithAllNumbers(int $minRange, int $maxRange): array
    {
        $allNumbers = [];

        for ($i = $minRange; $i < $maxRange; $i++) {
            $allNumbers[$i] = true;
        }

        return $allNumbers;
    }

    private function checkTabWithAllNumbers(array $allNumbers, int $maxRange)
    {

        for ($i = 2; $i <= $maxRange; $i++) {
            $index = $i;
            if ($index === 2) {
                $allNumbers[$index] = false;
            }

            while ($index < $maxRange) {
                $index += $i;
                $allNumbers[$index] = false;
            }
        }

        return $allNumbers;
    }

    public function getMaxBinaryGapFromNumber(int $number): int
    {
        $maxGap = 0;
        $binaryNotation = decbin($number);

        if (strlen($binaryNotation) > 2) {
            $gaps = $this->findOccurrenceNumberOne($binaryNotation);
            $maxGap = $this->calculateMaxGap($gaps);

            return $maxGap;
        }

        return $maxGap;
    }

    /**
     * @param string $binaryNotation
     * @return array
     */
    private function findOccurrenceNumberOne(string $binaryNotation): array
    {
        $gaps = [];
        $occurrenceNumberOne = true;
        $lastOccurrence = 0;
        $firstStep = 1;

        while ($occurrenceNumberOne) {
            $nextOccurrence = stripos($binaryNotation, "1", $lastOccurrence);
            array_push($gaps, $nextOccurrence);

            if ($nextOccurrence == 0) {
                $lastOccurrence += $firstStep;
            }
            if (is_numeric($nextOccurrence)) {
                $lastOccurrence += $nextOccurrence;
            } else {
                $occurrenceNumberOne = false;
            }

            if ($nextOccurrence === strlen($binaryNotation) - 1) {
                $occurrenceNumberOne = false;
            }
        }

        return $gaps;
    }

    /**
     * @param array $gaps contains the numbers of the place where the number 1 appears.
     * @return int it is result of a subtraction array elements.
     */
    private function calculateMaxGap(array $gaps): int
    {
        $results = [];

        for ($i = 0; $i < count($gaps) - 1; $i++) {
            $result = $gaps[$i + 1] - ($gaps[$i] + 1); // because array numbering starts with 0.
            array_push($results, $result);
        }
        asort($results);
        if (last($results) <= 0) {

            return 0;
        } else {

            return last($results);
        }
    }


    // Codility task 2
    function solution(array $numbers)//: int
    {
        $tabToDiff = [];

        if (!in_array(1, $numbers)) {

            return 1;
        }
        $tabUnique = array_unique($numbers);
        asort($tabUnique);
        $minNumber = $this->getMinNumberFromArray($tabUnique);
        $maxNumber = last($tabUnique);

        $negativeNumbers = [];

        if ($minNumber < 0) {
            foreach ($tabUnique as $number) {
                if ($number < 0) {
                    array_push($negativeNumbers, $number);
                }
                $positiveDif = array_diff($tabUnique, $negativeNumbers);
                $tabUnique = [];
                $tabUnique = $positiveDif;

            }
        }

        if (sizeof($tabUnique) < 2) {
            $minNumber = $this->getMinNumberFromArray($tabUnique);

           if ($minNumber > 1) {
               $solution = $minNumber -1;

               return $solution;
           }
        }

        $minNumber = $this->getMinNumberFromArray($tabUnique);

        for ($i = $minNumber; $i <= ($maxNumber + 1); $i++) {
            array_push($tabToDiff, $i);
        }

        $difference = array_diff($tabToDiff, $tabUnique);

        asort($difference);
        $keyFirst = array_key_first($difference);
        $solution = $difference[$keyFirst];

         return $solution;

    }

    /**
     * return minValue from sorted array
     * @param array $tabUnique
     */
    public function getMinNumberFromArray(array $tabUnique): int
    {
        $keyMin = array_key_first($tabUnique);
        $minNumber = $tabUnique[$keyMin];

        return $minNumber;
    }

    function FirstFactorial($num) {

        $product = 0;
        $allNumbers = [];
        // code goes here
        for ($i = $num; $i > 0; $i--) {
            array_push($allNumbers, $i);
        }

        for ($i = 0; $i < count($allNumbers) - 1; $i++){
            if ($i === 0) {
                $product = $allNumbers[$i] * $allNumbers[$i + 1];
            }
            if($i > 0) {
                $product *= $allNumbers[$i + 1];
            }
        }

        return $product;
    }




}
