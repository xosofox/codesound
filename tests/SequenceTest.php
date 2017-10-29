<?php
/**
 * Created by PhpStorm.
 * User: pdietrich
 * Date: 28.10.2017
 * Time: 23:29
 */

namespace Codesound;

use PHPUnit\Framework\TestCase;

class SequenceTest extends TestCase
{
    public function testFromTuples()
    {
        $tuples = [
            0,
            [2, 1],
            5,
        ];
        $sequence = Sequence::fromTuples($tuples);

        $notes = $sequence->getNotes();
        $this->assertEquals(3, count($notes), "Returns 3 notes");
        $this->assertEquals(0, $notes[0]->getIndex(), "Note0 has index 0");
        $this->assertEquals(0.25, $notes[0]->getLength(), "Note0 has default length of .25");
        $this->assertEquals(2, $notes[1]->getIndex(),"Note1 has index of 2");
        $this->assertEquals(1, $notes[1]->getLength(),"Note1 has length of 1");
        $this->assertEquals(5, $notes[2]->getIndex(),"Note2 has index of 5");
        $this->assertEquals(0.25, $notes[2]->getLength(), "Note2 has default length of .25");
    }
}
