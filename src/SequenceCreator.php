<?php
/**
 * Created by PhpStorm.
 * User: pdietrich
 * Date: 29.10.2017
 * Time: 01:22
 */

namespace Codesound;


class SequenceCreator
{
    private $sequence;

    /**
     * Match to whole notes, opposite of chromatic
     * @var bool
     */
    private $harmonic = true;

    public function __construct()
    {
        $this->sequence = new Sequence();
    }

    public function addFromFileList($files)
    {

    }

    /**
     * @return Sequence
     */
    public function getSequence()
    {
        return $this->sequence;
    }
}