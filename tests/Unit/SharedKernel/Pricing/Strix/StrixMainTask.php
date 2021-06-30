<?php
declare(strict_types =1);

namespace Tests\Unit\SharedKernel\Pricing\Strix;

/**
 * @author Bogusław Trojański
 */
class StrixMainTask
{
    function solution(array $A): int {
        $ans = 1001;
        for ($i = 0; $i < sizeof($A); $i++) {
            if ($ans > $A[$i] && $ans !== 1001) {
                $ans = $A[$i];
            }   if($ans === 1001) { $ans = $A[$i]; }}
                return $ans;
            }
            //$ar = [-999, 2, 5, -18, -998, 500, -800, 900, -600, -18, 999];


    function solutionHolidayInVillages(array $tabWays) {
        $allCombinations = $this-> getAllCombinations($tabWays);
        $answer =[];

        foreach ($allCombinations as $pair) {
            $pointA = $pair[0];
            $pointB = $pair[1];
            if ($pointA === $pointB) {

                array_push($answer, $pair);
            }

            if ($pointA < $pointB) {

                    if ($pointA === 0 && $pointB < count($tabWays)  && ($pointB - $pointA) > 1) {
                        array_push($answer, $pair);
                    }

                   foreach ($tabWays as $kay => $way) {
                       $ways = [];
                       array_push($ways, $kay, $way);
                       if (in_array($pointA, $ways) && in_array($pointB, $ways) && ($pointB - $pointA) === 1) {
                           array_push($answer, $pair);
                       }
                   }
            }
        }

        return $answer;
}

    private function getAllCombinations(array $tabWays): array
    {
        $allCombinations = [];

        for ($i = 0; $i < count($tabWays); $i++) {
            for ($k = 0; $k < count($tabWays); $k++) {
                array_push($allCombinations, [$i, $k]);
            }
        }

        return  $allCombinations;
    }


}