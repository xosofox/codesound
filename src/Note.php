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
    /** @var  integer */
    private $index;
    /** @var float  */
    private $length;

    public function __construct($index, $length = .25)
    {
        $this->index = $index;
        $this->length = $length;
    }

    /**
     * @return int
     */
    public function getIndex()
    {
        return $this->index;
    }

    /**
     * @return float
     */
    public function getLength()
    {
        return $this->length;
    }
}