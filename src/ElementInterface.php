<?php

namespace DinoGame;

interface ElementInterface
{
    public function matrix();

    public function getPosition(): Point;

    public function setPosition(Point $point);

    public function onAfterRender(): void;
}
