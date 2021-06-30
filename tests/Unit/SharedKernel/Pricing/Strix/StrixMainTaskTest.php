<?php
declare(strict_types =1);

namespace Tests\Unit\SharedKernel\Pricing\Strix;

use Tests\TestCase;

/**
 * @author Bogusław Trojański
 */
class StrixMainTaskTest extends TestCase
{

    function test_solution() {
        $str = new StrixMainTask();
        $ar = [-999, 2, 5, -18, -998, 500, -800, 900, -600, -18, 999];
        $ans = $str->solution($ar);

        $this->assertEquals(-999, $ans);
    }

    function test_solution2()
    {
        $str = new StrixMainTask();
        $ar = [5, -999, 0 , -996, 2, 5, -18, -998, 500, -800, 900, -600, -18, 999];
        $ans = $str->solution($ar);

        $this->assertEquals(-999, $ans);
    }

    function test_solution_village()
    {
        $str = new StrixMainTask();
        $arr = [2, 0, 2, 2, 1, 0];

        $answer = $str->solutionHolidayInVillages($arr);
        $x = count($answer);

        $this->assertEquals(12, $x);
    }

    function test_solution_village2()
    {
        $str = new StrixMainTask();
        $arr = [2, 0, 2, 2, 1, 0, 4];

        $answer = $str->solutionHolidayInVillages($arr);
        $x = count($answer);

        $this->assertEquals(14, $x);
    }

    }
