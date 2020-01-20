<?php

namespace DinoGame\System;

class Runtime
{
    private $tick;

    public function loop(callable $loop)
    {
        while (true) {
            usleep(100000);
            $this->tick++;
            $loop($this);
        }
    }
}
