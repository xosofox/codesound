<?php
/**
 * Created by PhpStorm.
 * User: pdietrich
 * Date: 28.10.2017
 * Time: 23:29
 */

namespace Codesound;

use PHPUnit\Framework\TestCase;

class PlayerTest extends TestCase
{
    public function testFrequencies()
    {
        $sequence = new Sequence();
        $sequence->add(new Note(0));
        $sequence->add(new Note(12));
        $sequence->add(new Note(3));

        $player = new Player($sequence);
        $player->setBaseFrequency(440);

        $tones = $player->getTones();

        $this->assertEquals(440, $tones[0]->getFrequency(), "Note A=0 has Frequency of 440");
        $this->assertEquals(880, $tones[1]->getFrequency(), "Note A=12 has Frequency of 880");
        $this->assertEquals(523.25, round($tones[2]->getFrequency(), 2), "Note C=3 has Frequency of 261.63");
    }
}
