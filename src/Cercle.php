<?php

namespace Opmvpc\Formes;

class Cercle extends Forme {
    
    private Point $centre;
    private float $rayon;
    public function __construct(Point $centre, float $rayon, string $couleur = '#000000') {
        parent::__construct($couleur);
        $this->rayon = $rayon;
        $this->centre = $centre;
    }

    public function getCentre(): Point {
        return $this->centre;
    }
    public function getRayon(): float {
        return $this->rayon;
    }
}
