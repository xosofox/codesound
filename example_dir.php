<?php
/**
 * Created by PhpStorm.
 * User: pdietrich
 * Date: 29.10.2017
 * Time: 00:32
 */

use Codesound\Mapper;
use Codesound\Player;
use Codesound\Sequence;
use Codesound\SoundDumper;

include __DIR__.'/vendor/autoload.php';

function bignum($filepath)
{
    return hexdec(substr(sha1($filepath), 0, 15));
}


$values = [];

if ($handle = opendir(__DIR__)) {

    /* Das ist der korrekte Weg, ein Verzeichnis zu durchlaufen. */
    while (false !== ($entry = readdir($handle))) {
        if (is_dir($entry)) {
            $values[] = null;
        } else {
            $index = bignum($entry);
            $length = filesize($entry);
            $values[] = [$index, $length];
        }
    }
    closedir($handle);
}

$mapper = new Mapper();
$tuples = $mapper->map($values);

$sequence = Sequence::fromTuples($tuples);

$player = new Player($sequence);
$dumper = new SoundDumper();
$dumper->dump($player, __DIR__.'/lala.ul', __DIR__.'/lala.wav');
