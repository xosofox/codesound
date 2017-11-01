<?php
/**
 * Created by PhpStorm.
 * User: pdietrich
 * Date: 29.10.2017
 * Time: 00:32
 */

use Codesound\Converter;
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

    //For every file in directory, create an hashed "bignum" to be used for defining the pitch/index
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

$Converter = new Converter();
$tuples = $Converter->convert($values);


$sequence = Sequence::fromTuples($tuples);

$player = new Player($sequence);
$dumper = new SoundDumper();
$dumper->dump($player, __DIR__.'/lala.ul', __DIR__.'/lala.wav');
