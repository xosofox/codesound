<?php
/**
 * Created by PhpStorm.
 * User: pdietrich
 * Date: 29.10.2017
 * Time: 12:43
 */

namespace Codesound;

/**
 * Class Tone
 * consists of frequency and length in milliseconds
 * @package Codesound
 */
class Tone
{
    /** @var  float */
    private $frequency;
    /** @var  float */
    private $milliseconds;

    public function __construct($frequency, $milliseconds)
    {
        $this->frequency = $frequency;
        $this->milliseconds = $milliseconds;
    }

    /**
     * Length in milliseconds
     * @return float
     */
    public function getLength()
    {
        return $this->milliseconds;
    }

    /**
     * Length in seconds
     * @return float
     */
    public function getSeconds()
    {
        return $this->milliseconds/1000;
    }

    /**
     * @return float
     */
    public function getFrequency()
    {
        return $this->frequency;
    }

}