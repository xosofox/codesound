<?php
/**
 * Created by PhpStorm.
 * User: pdietrich
 * Date: 29.10.2017
 * Time: 00:32
 */

use Codesound\Player;
use Codesound\Sequence;
use Codesound\SoundDumper;

include __DIR__.'/vendor/autoload.php';

// all notes of a major scale (Yes, the white keys of a piano when doing C Major)
$range = [0, 2, 4, 5, 7, 9, 11, 12];

$alleMeineEntchen = [0, 2, 4, 5, [7, 1 / 2], [7, 1 / 2], 9, 9, 9, 9, [7, 1/2]];

/*
$sequence = Sequence();
foreach ($range as $index) {
    $note = new Note($index);
    $sequence->add($note);
}
*/
$sequence = Sequence::fromTuples($alleMeineEntchen);

$player = new Player($sequence);
$dumper = new SoundDumper();
$dumper->dump($player, __DIR__.'/lala.ul', __DIR__.'/lala.wav');
