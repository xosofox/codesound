<?php
/**
 * Created by PhpStorm.
 * User: pdietrich
 * Date: 29.10.2017
 * Time: 00:08
 */

namespace Codesound;

/**
 * Class Sequence
 *
 * A collection of Notes
 * @package Codesound
 */
class Sequence
{
    private $notes = [];

    public function __construct($notes = [])
    {
        $this->notes = $notes;
    }

    /**
     * Tuples is an array, consisting of either numbers (index for the note) or an array of ($inted, $length)
     * @param $tuples
     * @return Sequence
     */
    public static function fromTuples($tuples)
    {
        $notes = array_map(
            function ($t) {
                if (is_numeric($t)) {
                    return new Note($t);
                }

                return new Note($t[0], $t[1]);
            },
            $tuples
        );
        $sequence = new Sequence($notes);

        return $sequence;
    }

    public function add(Note $note)
    {
        $this->notes[] = $note;
    }

    /**
     * @return Note[]
     */
    public function getNotes()
    {
        return $this->notes;
    }
}