<?php

namespace DinoGame\Render;

use DinoGame\ElementInterface;

class Render
{
    private $window = [];
    /** @var ElementInterface[] */
    private $elements = [];

    /**
     * Render constructor.
     * @param array $window
     */
    public function __construct(array $window)
    {
        $this->window = $window;
    }

    public function add(ElementInterface $element)
    {
        $this->elements[] = $element;
    }

    protected function priorityChar(array $chars)
    {
        foreach (array_reverse($chars) as $c) {
            if (!is_null($c)) {
                return $c;
            }
        }

        return null;
    }

    public function merge(ElementInterface ...$other)
    {
        $result = [];
        for ($i = 0; $i <= $this->window[0]; $i++) {
            for ($j = 0; $j <= $this->window[1]; $j++) {
                $chars = [];
                foreach ($other as $b) {
                    $char = $b->matrix()[$i][$j] ?? null;
                    $chars[] = $char;
                }

                $result[$i][$j] = $this->priorityChar($chars);
            }
        }
        return $result;
    }

    public function draw()
    {
        $matrix = $this->merge(...$this->elements);
        foreach ($matrix as $n => $line) {
            foreach ($line as $symbol) {
                echo $symbol ?: ' ';
            }
            echo PHP_EOL;
        }

        foreach ($this->elements as $element) {
            $element->onAfterRender();
        }
    }
}
