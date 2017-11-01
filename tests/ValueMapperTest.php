<?php
/**
 * Created by PhpStorm.
 * User: pdietrich
 * Date: 28.10.2017
 * Time: 23:29
 */

namespace Codesound;

use PHPUnit\Framework\TestCase;

class ValueMapperTest extends TestCase
{
    public function testFindLimits()
    {
        $values = [
            5,
            7,
            4,
            12,
            8,
            3,
        ];

        $mapper = new ValueMapper();
        list($min, $max) = $mapper->findLimits($values);

        $this->assertEquals(3, $min);
        $this->assertEquals(12, $max);
    }

    public function testEmptyIndexes()
    {
        $this->expectException(\Exception::class);

        $indexes = [];
        $converter = new ValueMapper($indexes);
        $mapped = $converter->map([1, 2, 3]);
    }

    public function testSingleIndex()
    {
        $indexes = [42];
        $values = [3, 4, 5, 6, 7];
        $converter = new ValueMapper($indexes);
        $mapped = $converter->map($values);
        $expect = [42, 42, 42, 42, 42];

        $this->assertEquals($expect, $mapped);
    }

    public function testMap()
    {

        $values = [4, 8, 15];

        $mapper = new ValueMapper([3, 6, 9]);

        $mapped = $mapper->map($values);

        $expected = [3, 6, 9];

        $this->assertEquals($expected, $mapped, "Mapping maps to harmonics");
    }

    public function testMap2()
    {

        $values = [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12];
        $harmonics = [0, 2, 4, 5, 7, 9, 11, 12];

        $mapper = new ValueMapper($harmonics);

        $mapped = $mapper->map($values);

        $expected = [
            0,
            0,
            2,
            2,
            4,
            5,
            5,
            7,
            7,
            9,
            11,
            11,
            12,
        ];

        $this->assertEquals($expected, $mapped, "Mapping chromatics to harmonics");
    }

    public function testBig()
    {
        $values = array(
            113881560167520528,
            240742034022850490,
            1066747282849892953,
            643058174815935281,
            746685572112197002,
            878873602786038165,
            481357328889769461,
            778777184553630502,
            635897285630891612,
            854253631401943795,
            481011469280177185,
            258248419042673932,
        );

        $indexes = array(
            0 => 0,
            1 => 2,
            2 => 4,
            3 => 5,
            4 => 7,
            5 => 9,
            6 => 11,
            7 => 12,
        );

        $mapper = new ValueMapper($indexes);
        $mapped = $mapper->map($values);

        $expected = [
            0,
            2,
            12,
            7,
            9,
            11,
            5,
            9,
            7,
            11,
            5,
            2,
        ];
        $this->assertEquals($expected, $mapped, "Mapping chromatics to harmonics");
    }
}
