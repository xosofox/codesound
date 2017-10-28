<?php
/**
 * Created by PhpStorm.
 * User: pdietrich
 * Date: 29.10.2017
 * Time: 00:17
 */

namespace Codesound;


class SoxRaw
{
    private $filepath;

    public function __construct($filepath)
    {
        $this->filepath = $filepath;
        $this->rate = 8000;
        $this->cmd = new SoxCommand("sox");
        if (file_exists($this->filepath)) {
            unlink($this->filepath);
        }
    }

    /**
     * Add Note (frequency) to raw file
     *
     * @param Note $note
     *
     */
    public function addNote(Note $note)
    {
        $freq = $note->getHz();
        $ms = $note->getMs();
        $this->cmd->execute(
            '-e mu-law -r '.$this->rate.' -n -t raw - synth '.($ms / 1000).' sine '.$freq.' gain -3 >> '.$this->filepath
        );

    }

    /**
     * Add correct file header to raw file
     */
    public function close($resultfile)
    {
        $this->cmd->execute(' -c 1 -r '.$this->rate.' '.$this->filepath.' '.$resultfile);
    }
}