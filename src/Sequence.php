<?php
/**
 * Created by PhpStorm.
 * User: pdietrich
 * Date: 29.10.2017
 * Time: 00:08
 */

namespace Codesound;


/**
 * Class Sequence
 *
 * A collection of Notes
 * @package Codesound
 */
class Sequence
{
    private $notes = [];

    public function add(Note $note)
    {
        $this->notes[] = $note;
    }

    public function getNotes()
    {
        return $this->notes;
    }
}