<?php

namespace DinoGame\Entity;

use DinoGame\ElementInterface;
use DinoGame\Point;

class Animation implements ElementInterface
{
    /** @var ElementInterface[] */
    protected $entities = [];

    protected $current = 0;
    /**
     * Animation constructor.
     * @param ElementInterface[] $entities
     */
    public function __construct(array $entities)
    {
        $this->entities = $entities;
    }

    public function matrix()
    {
        return $this->entities[$this->current]->matrix();
    }

    public function setPosition(Point $point)
    {
        foreach ($this->entities as $element) {
            $element->setPosition($point);
        }
    }

    public function getPosition(): Point
    {
        return $this->entities[$this->current];
    }

    public function onAfterRender(): void
    {
        if (isset($this->entities[$this->current + 1])) {
            $this->current++;
        } else {
            $this->current = 0;
        }
    }
}
