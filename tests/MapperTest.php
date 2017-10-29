<?php
/**
 * Created by PhpStorm.
 * User: pdietrich
 * Date: 28.10.2017
 * Time: 23:29
 */

namespace Codesound;

use PHPUnit\Framework\TestCase;

class MapperTest extends TestCase
{
    public function testFindLimits()
    {

        $tuples = [
            5,
            7,
            [4, 6],
            [12, 67],
            8,
            [3, 3],
        ];

        $mapper = new Mapper();
        list($minIndex, $maxIndex, $minLength, $maxLength) = $mapper->findLimits($tuples);

        $this->assertEquals(3, $minIndex);
        $this->assertEquals(12, $maxIndex);
        $this->assertEquals(0, $minLength);
        $this->assertEquals(67, $maxLength);
    }

    public function testFindLimitsOfTuples()
    {

        $tuples = [
            [4, 6],
            [12, 67],
            [3, 3],
        ];

        $mapper = new Mapper();
        list($minIndex, $maxIndex, $minLength, $maxLength) = $mapper->findLimits($tuples);

        $this->assertEquals(3, $minIndex);
        $this->assertEquals(12, $maxIndex);
        $this->assertEquals(3, $minLength);
        $this->assertEquals(67, $maxLength);
    }
}
