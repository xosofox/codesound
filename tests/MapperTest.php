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

    public function testMap()
    {

        $tuples = [4, 8, 16];

        $mapper = new Mapper();

        $mapped = $mapper->map($tuples);

        $expected = [
            [0, 0.25],
            [3, 0.25],
            [8, 0.25],
        ];

        $this->assertEquals($expected, $mapped, "Mapping maps to harmonics");
    }

    public function testMap2()
    {

        $tuples = [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12];

        $mapper = new Mapper();

        $mapped = $mapper->map($tuples);

        $expected = [
            [0, 0.25],
            [1, 0.25],
            [1, 0.25],
            [2, 0.25],
            [3, 0.25],
            [3, 0.25],
            [4, 0.25],
            [5, 0.25],
            [5, 0.25],
            [6, 0.25],
            [7, 0.25],
            [7, 0.25],
            [8, 0.25],
        ];

        $this->assertEquals($expected, $mapped, "Mapping chromatics to harmonics");
    }
}
