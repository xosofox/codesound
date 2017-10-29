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
     * Add Tone to raw file
     *
     * @param Tone $tone
     *
     */
    public function addTone(Tone $tone)
    {
        $this->cmd->execute(
            '-e mu-law -r '.$this->rate.' -n -t raw - synth '.$tone->getSeconds().' sine '.$tone->getFrequency().' gain -3 >> '.$this->filepath
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