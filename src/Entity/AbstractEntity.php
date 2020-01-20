<?php

namespace DinoGame\Entity;

use DinoGame\ElementInterface;
use DinoGame\Point;

abstract class AbstractEntity implements ElementInterface
{
    private $matrix = [];
    /** @var Point */
    private $point;

    /**
     * Dino constructor.
     * @param string $str
     * @param Point $point
     */
    public function __construct($str, Point $point)
    {
        $str = str_replace('─', ' ', $str);
        $this->matrix = array_map('str_split', explode(PHP_EOL, $str));
        foreach ($this->matrix as $i => &$line) {
            foreach ($line as $j => &$char) {
                $char = in_array($char, ['', ' '], true) ? null : $char;
            }
        }
        $this->setPosition($point);
    }

    public function setPosition(Point $point)
    {
        $this->point = $point;
        $newMatrix = [];
        foreach ($this->matrix as $i => $line) {
            foreach ($line as $j => $value) {
                $newMatrix[$i + $point->getY()][$j + $point->getX()] = $value;
            }
        }

        $this->matrix = $newMatrix;

        return $this;
    }

    public function onAfterRender(): void
    {
    }

    public function getPosition(): Point
    {
        return $this->point;
    }

    public function matrix()
    {
        return $this->matrix;
    }
}
