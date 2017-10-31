<?php
/**
 * Created by PhpStorm.
 * User: pdietrich
 * Date: 28.10.2017
 * Time: 23:29
 */

namespace Codesound;

use PHPUnit\Framework\TestCase;

class ConverterTest extends TestCase
{
    public function testBuildHarmonicMapOneOctave()
    {
        $Converter = new Converter();
        $Converter->buildMap();

        $indexes = $Converter->getIndexes();
        $this->assertEquals([0, 2, 4, 5, 7, 9, 11, 12], $indexes, "Build Map of Harmonics of one Octave");

    }

    public function testBuildHarmonicMapThreeOctaves()
    {
        $Converter = new Converter();
        $Converter->setOctaves(3);
        $Converter->buildMap();

        $expect = [0, 2, 4, 5, 7, 9, 11, 12, 14, 16, 17, 19, 21, 23, 24, 26, 28, 29, 31, 33, 35, 36];

        $indexes = $Converter->getIndexes();
        $this->assertEquals($expect, $indexes, "Build Map of Harmonics of three Octaves");
    }

}
