<?php

namespace Opmvpc\Formes;

class Polygone extends Forme {
    private array $points;
    public function __construct(array $points, string $couleur = '#000000') {
        parent::__construct($couleur);
        $this->points = $points;
    }

    public function getPoints() {
        return $this->points; 
    }
}
