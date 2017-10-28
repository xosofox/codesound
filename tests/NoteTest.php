<?php
/**
 * Created by PhpStorm.
 * User: pdietrich
 * Date: 28.10.2017
 * Time: 23:29
 */

namespace Codesound;

use PHPUnit\Framework\TestCase;

class NoteTest extends TestCase
{
    public function testFrequencies()
    {
        $note = new Note(0);
        $this->assertEquals(220, $note->getHz(), "Note A=0 has Frequency of 220");
        $note = new Note(12);
        $this->assertEquals(440, $note->getHz(), "Note A=12 has Frequency of 440");
        $note = new Note(3);
        $this->assertEquals(261.63, round($note->getHz(), 2), "Note C=3 has Frequency of 261.63");
    }
}
