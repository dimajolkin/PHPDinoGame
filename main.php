<?php

use DinoGame\Entity\Animation;
use DinoGame\Entity\Dino;
use DinoGame\Entity\Map;
use DinoGame\Entity\Rock;
use DinoGame\Point;
use DinoGame\Render\Render;
use DinoGame\System\Runtime;

include __DIR__ . '/vendor/autoload.php';

$runtime = new Runtime();

$map = new Map(file_get_contents(__DIR__ . '/object/map'), new Point(0, 0));

$dinoPoint = new Point(0, 8);
$dino = new Animation([
    new Dino(file_get_contents(__DIR__ . '/object/dino'), $dinoPoint),
    new Dino(file_get_contents(__DIR__ . '/object/dino1'), $dinoPoint),
]);

$rock = new Rock(file_get_contents(__DIR__ . '/object/rock'), new Point(130, 20));

$render = new Render([48, 180]);

$render->add($map);
$render->add($dino);
$render->add($rock);

$start = 0;
$stop = 5;
$rockPos = 130;
$runtime->loop(function () use ($dino, $rock, &$rockPos,  &$start, $stop, $render) {
    system("clear");
    if ($start < $stop) {
        $dino->setPosition(new Point($start++, 0));
    }
    if ($rockPos < 0) {
        $rockPos = 130;
    }
//    $rock->setPosition(new Point(-1, 20));

    $render->draw();

});



