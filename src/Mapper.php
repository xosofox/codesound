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
    const HARMONIC = "harmonic";
    const CHROMATIC = "chromatic";
    private $indexes;
    private $octaves;

    public function __construct()
    {
        $this->mapping = self::HARMONIC;
        $this->octaves = 1;


        $this->harmonics = [0, 2, 4, 5, 7, 9, 11];
        $this->lengths = [1 / 8, 1 / 4, 1 / 2, 1];

        $this->buildMap();
    }

    /**
     * Build the maps of available indexes and available lengths, considering limits and octaves
     */
    public function buildMap()
    {
        //consider octaves
        $this->indexes = [];
        for ($i = 0; $i < $this->octaves; $i++) {
            $indexes = array_map(
                function ($idx) use ($i) {
                    return $idx + (12 * $i);
                },
                $this->harmonics
            );

            $this->indexes = array_merge($this->indexes, $indexes);
        }
    }

    public function getIndexes()
    {
        return $this->indexes;
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

    public function setOctaves($int)
    {
        $this->octaves = $int;
    }


}