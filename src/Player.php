<?php
/**
 * Created by PhpStorm.
 * User: pdietrich
 * Date: 29.10.2017
 * Time: 12:40
 */

namespace Codesound;

class Player
{
    private $bpm = 60;
    private $base = 220;

    /**
     * @var Sequence
     */
    private $sequence;
    /** @var float Lenght of a bar in milliseconds (assuming 4/4) */
    private $barLength;

    public function __construct(Sequence $sequence, $bpm = 60, $base = 220)
    {
        if ($bpm < 1) {
            throw new \Exception("BPM below 1, dafuq?");
        }
        $this->sequence = $sequence;
        $this->bpm = $bpm;
        $this->base = $base;
        $this->barLength = 60 / $bpm * 1000;
        // Assuming the notes in an octave are on a purely logarithmic scale, it takes  12 to double the frequency
        $this->logstep = pow(2, 1 / 12);
    }

    /**
     * @param int $base
     */
    public function setBaseFrequency($base)
    {
        $this->base = $base;
    }

    /**
     * @return Tone[]
     */
    public function getTones()
    {
        $tones = [];
        $notes = $this->sequence->getNotes();
        foreach ($notes as $note) {
            $tones[] = $this->getToneFromNote($note);
        }

        return $tones;
    }

    public function getToneFromNote(Note $note)
    {
        $ms = $this->barLength * $note->getLength();
        $hz = $this->base * pow($this->logstep, $note->getIndex());

        return new Tone($hz, $ms);
    }
}