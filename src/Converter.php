<?php
/**
 * Created by PhpStorm.
 * User: pdietrich
 * Date: 29.10.2017
 * Time: 22:32
 */

namespace Codesound;

class  Converter
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
        list($indexes, $lengths) = $this->split($tuples);

        $this->buildMap();

        $mappedIndexes = (new Mapper($this->indexes))->map($indexes);
        $mappedLengths = (new Mapper($this->lengths))->map($lengths);


        $mapped = [];
        $l = count($tuples);
        for ($i = 0; $i < $l; $i++) {
            $mapped[] = [$mappedIndexes[$i], $mappedLengths[$i]];
        }

        return $mapped;
    }

    public function split($tuples)
    {
        $indexes = [];
        $lenghts = [];
        foreach ($tuples as $tuple) {
            list ($index, $length) = $this->normalize($tuple);
            $indexes[] = $index;
            $lenghts[] = $length;
        }

        return [$indexes, $lenghts];
    }

    public function normalize($tuple)
    {
        if (is_numeric($tuple)) {
            return [$tuple, 0];
        }

        return $tuple;
    }

    public function setOctaves($int)
    {
        $this->octaves = $int;
    }


}