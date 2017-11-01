<?php
/**
 * Created by PhpStorm.
 * User: pdietrich
 * Date: 01.11.2017
 * Time: 01:10
 */

namespace Codesound;


class Mapper
{
    /**
     * Mapper for BC
     * Mapper has been split into Converter and ValueMapper
     * This class will be removed in Version 2.0
     *
     * @deprecated since version 1.1, to be removed in 2.0. Use Converter instead.
     *
     * Mapper constructor.
     */
    public function __construct()
    {
        $this->converter = new Converter();
    }

    /**
     * @param $values
     * @return array
     * @deprecated since version 1.1, to be removed in 2.0. Use Converter::convert instead.
     */
    public function map($values)
    {
        return $this->converter->convert($values);
    }
}