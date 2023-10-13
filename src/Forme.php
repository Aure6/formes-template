<?php

namespace Opmvpc\Formes;

abstract class Forme {
    protected string $couleur = '#FFFFFF';
    
    function __construct($couleur) {
        $this->couleur = $couleur;
    }

    // Methods
    public function setCouleur($couleur) {
        $this->couleur = $couleur;
    }
    public function getCouleur(): string {
        return $this->couleur;
    }
}
