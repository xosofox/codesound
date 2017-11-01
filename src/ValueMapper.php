<?php
/**
 * Created by PhpStorm.
 * User: pdietrich
 * Date: 29.10.2017
 * Time: 22:32
 */

namespace Codesound;

class  ValueMapper
{
    /** @var array */
    private $indexes;

    public function __construct($indexes = [])
    {
        $this->indexes = $indexes;
    }

    public function map($values)
    {
        if (count($this->indexes) === 0) {
            throw new \Exception("Missing indexes to map to");
        }

        list($min, $max) = $this->findLimits($values);

        $c = count($this->indexes);
        $diff = $max - $min + 1;
        $step = $diff / $c;
        $maxIndex = $c - 1;

        $mapped = [];
        foreach ($values as $value) {
            $idx = floor(($value - $min) / $step);
            // Due to float inaccuracy, with big numbers, index can be too high; so we need to limit it
            if ($idx > $maxIndex) {
                $idx = $maxIndex;
            }
            $mapped[] = $this->indexes[$idx];
        }

        return $mapped;
    }

    public function findLimits($values)
    {
        $min = 9e99;
        $max = 0;
        foreach ($values as $value) {

            if ($min > $value) {
                $min = $value;
            }

            if ($max < $value) {
                $max = $value;
            }
        }

        return [$min, $max];
    }
}