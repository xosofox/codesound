<?php
/**
 * Created by PhpStorm.
 * User: pdietrich
 * Date: 29.10.2017
 * Time: 00:32
 */

use Codesound\Note;
use Codesound\Player;
use Codesound\Sequence;
use Codesound\SoundDumper;

include __DIR__.'/vendor/autoload.php';

$range = [0, 2, 4, 5, 7, 9, 11, 12];

$sequence = new Sequence();
foreach ($range as $index) {
    $note = new Note($index);
    $sequence->add($note);
}

$player = new Player($sequence);
$dumper = new SoundDumper();
$dumper->dump($player, __DIR__.'/lala.ul', __DIR__.'/lala.wav');
