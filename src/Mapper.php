<?php
/**
 * Created by PhpStorm.
 * User: pdietrich
 * Date: 29.10.2017
 * Time: 22:32
 */

namespace Codesound;

class  Mapper
{
    const SCALE = "scale";
    const HARMONIC = "harmonic";
    const CHROMATIC = "chromatic";

    public function __construct()
    {
        $this->scale = self::SCALE;
        $this->mapping = self::HARMONIC;
    }

    public function map($tuples)
    {
        list($minIndex, $maxIndex, $minLength, $maxLength) = $this->findLimits($tuples);

        return [
            0,
            1,
            [2, 1 / 8],
            3,
            4,
        ];
    }

    public function findLimits($tuples)
    {
        $minIndex = 9e99;
        $maxIndex = 0;
        $minLength = 9e99;
        $maxLength = 0;
        foreach ($tuples as $tuple) {
            if (is_numeric($tuple)) {
                $index = $tuple;
                $length = 0;
            } else {
                $index = $tuple[0];
                $length = $tuple[1];
            }

            if ($minIndex > $index) {
                $minIndex = $index;
            }

            if ($maxIndex < $index) {
                $maxIndex = $index;
            }

            if ($minLength > $length) {
                $minLength = $length;
            }

            if ($maxLength < $length) {
                $maxLength = $length;
            }
        }

        return [$minIndex, $maxIndex, $minLength, $maxLength];
    }


}