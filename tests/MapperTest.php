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

    public function testBuildHarmonicMapOneOctave()
    {
        $mapper = new Mapper();
        $mapper->buildMap();

        $indexes = $mapper->getIndexes();
        $this->assertEquals([0, 2, 4, 5, 7, 9, 11, 12], $indexes, "Build Map of Harmonics of one Octave");

    }

    public function testBuildHarmonicMapThreeOctaves()
    {
        $mapper = new Mapper();
        $mapper->setOctaves(3);
        $mapper->buildMap();

        $expect = [0, 2, 4, 5, 7, 9, 11, 12, 14, 16, 17, 19, 21, 23, 24, 26, 28, 29, 31, 33, 35, 36];

        $indexes = $mapper->getIndexes();
        $this->assertEquals($expect, $indexes, "Build Map of Harmonics of one Octave");

    }
}
