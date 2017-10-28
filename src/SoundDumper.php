<?php
/**
 * Created by PhpStorm.
 * User: pdietrich
 * Date: 29.10.2017
 * Time: 00:11
 */

namespace Codesound;


class SoundDumper
{
    public function dump(Sequence $sequence, $tempfile, $filepath)
    {
        $file = new SoxRaw($tempfile);
        $notes = $sequence->getNotes();
        foreach ($notes as $note) {
            $file->addNote($note);
        }
        $file->close($filepath);
    }
}