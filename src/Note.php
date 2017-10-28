<?php
/**
 * Created by PhpStorm.
 * User: pdietrich
 * Date: 28.10.2017
 * Time: 23:17
 */

namespace Codesound;

class Note
{
    const BASE_FREQUENCY = 220;      # @TODO option to set Base
    const BASE_BAR_DURATION = 4000;  # @TODO option to set "bpm"

    private $hz;
    private $ms;

    public function __construct($index, $length = .25)
    {
        $this->index = $index;
        $this->length = $length;
        $this->hz = $this->getFrequencyForIndex($index);
        $this->ms = $this->getMSForLength($length);
    }

    private function getFrequencyForIndex($index)
    {
        $logstep = pow(2, 1 / 12);

        return self::BASE_FREQUENCY * pow($logstep, $index);
    }

    public function getHz()
    {
        return $this->hz;
    }

    public function getMs()
    {
        return $this->ms;
    }

    private function getMSForLength($length)
    {
        return self::BASE_BAR_DURATION * $length;
    }
}