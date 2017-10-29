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

        //put next octaves 0 at the end
        $this->indexes[] = 12 * $this->octaves;
    }

    public function getIndexes()
    {
        return $this->indexes;
    }

    public function map($tuples)
    {
        list($minIndex, $maxIndex, $minLength, $maxLength) = $this->findLimits($tuples);

        $this->buildMap();

        $indexDiff = $maxIndex - $minIndex;
        $indexStep = $indexDiff / count($this->indexes);

        $mapped = [];
        foreach ($tuples as $tuple) {
            list ($index, $length) = $this->normalize($tuple);

            $idx = round(($index - $minIndex) / $indexStep);
            $length = .25;

            $mapped[] = [$idx, $length];
        }

        return $mapped;
    }

    public function normalize($tuple)
    {
        if (is_numeric($tuple)) {
            return [$tuple, 0];
        }

        return $tuple;
    }

    public function findLimits($tuples)
    {
        $minIndex = 9e99;
        $maxIndex = 0;
        $minLength = 9e99;
        $maxLength = 0;
        foreach ($tuples as $tuple) {
            list ($index, $length) = $this->normalize($tuple);

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