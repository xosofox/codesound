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
    public function dump(Player $player, $tempfile, $filepath)
    {
        $file = new SoxRaw($tempfile);
        $tones = $player->getTones();
        foreach ($tones as $tone) {
            $file->addTone($tone);
        }
        $file->close($filepath);
    }
}