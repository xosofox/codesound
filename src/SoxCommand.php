<?php
/**
 * Created by PhpStorm.
 * User: pdietrich
 * Date: 29.10.2017
 * Time: 00:14
 */

namespace Codesound;


class SoxCommand
{

    private $soxpath = "sox";

    public function __construct($soxpath = "sox")
    {
        $this->soxpath = $soxpath;
    }

    public function execute($cmd)
    {
        exec($this->soxpath.' '.$cmd);
    }
}