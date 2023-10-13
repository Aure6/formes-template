<?php

namespace Opmvpc\Formes;

class Canvas extends Forme {
    private float $width;
    private float $height;
    private array $formes = [];
    
    function __construct(float $width, float $height, $couleur = '#FFFFFF') {
        parent::__construct($couleur);
        $this->width = $width;
        $this->height = $height;
    }

    // Methods
    public function add(Forme $formes) {
        $this->formes[] = $formes;
    } 
    public function getWidth(): float {
        return $this->width;
    }
    public function getHeight(): float {
        return $this->height;
    }
    public function getFormes(): array {
        return $this->formes;
    }
}
