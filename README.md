# Codesound #

# Works #

Add `Note` Objects to a `Sequence` which can be dumped into a wave file.


   REQUIRES "sox" http://sox.sourceforge.net/
   
   `sudo apt-get install sox`


The notes are indexed like this:

* 0 being A with 220 Hz
* 12 being A with 440 Hz
* 24 being A with 880 Hz


## Example ##

Play a simple A major scale

```
<?php 

$range = [0, 2, 4, 5, 7, 9, 11, 12];

$sequence = new Sequence();
foreach ($range as $index) {
    $note = new Note($index);
    $sequence->add($note);
}

$dumper = new SoundDumper();
$dumper->dump($sequence, __DIR__.'/bla.ul', __DIR__.'/bla.wav');

```

## TODO ##
Traverses a directory recursively and looks at the files.

Each file determines the Sound to play.

Size of the file determines the length of the sound.

Hash (md5) of the file determines the pitch.

To sound "reasonably harmonic", the hash is not translated into a frequency.

It translates into a note on the scale of A Major.
