<?php

namespace Opmvpc\Formes;

class Point {
    protected float $x;
    protected float $y;

    public function __construct(float $x, float $y = 0) {
        $this->x = $x;
        $this->y = $y;
    }

    public function getX(): float {
        return $this->x;
    }
    public function getY(): float {
        return $this->y;
    }
}
