<?php

namespace Opmvpc\Formes\Renderers;

use Opmvpc\Formes\Canvas;
use Opmvpc\Formes\Rectangle;
use Opmvpc\Formes\Cercle; 
use Opmvpc\Formes\Ligne; 
use Opmvpc\Formes\Polygone;
use SVG\Nodes\Shapes\SVGCircle;
use SVG\Nodes\Shapes\SVGLine;
use SVG\Nodes\Shapes\SVGPolygon;
use SVG\Nodes\Shapes\SVGRect;
use SVG\SVG;

class SVGRenderer implements Renderer {
    private Canvas $canvas;

    public function __construct(Canvas $canvas) {
        $this->canvas = $canvas;
    }
    public function render(): string {
        $image = new SVG($this->canvas->getWidth(), $this->canvas->getHeight());
        $doc = $image->getDocument();
        
        $square = new SVGRect(0, 0, $this->canvas->getWidth(), $this->canvas->getHeight(), $this->canvas->getCouleur());
        $doc->setStyle('fill', $this->canvas->getCouleur());
        $doc->addChild($square);
        
        //partie ajoutée
        /* foreach($this->canvas->getFormes() as $forme) {
            switch(get_class($forme)) {
                case Rectangle::class:
                    $line = new SVGLine($forme->getPoint1()->getX(), $forme->getPoint2()->getY());
                    $line->setStyle('fill', $forme->getCouleur());
                    break;
                case Cercle::class:
                    break;
                case Polygone::class:
                    break;
            }
        } */
        foreach ($this->canvas->getFormes() as $forme) {
            switch (get_class($forme)) {
                case Rectangle::class:
                    $rect = new SVGRect($forme->getPoint1()->getX(), $forme->getPoint2()->getY(), $forme->getWidth(), $forme->getHeight());
                    $rect->setStyle('fill', $forme->getCouleur());
                    $doc->addChild($rect);
                    break;
                case Ligne::class:
                    $line = new SVGLine($forme->getPoint1()->getX(), $forme->getPoint2()->getY());
                    $line->setStyle('stroke', $forme->getCouleur());
                    $doc->addChild($line);
                    break;
                case Cercle::class:
                    // Implement Cercle rendering here
                    break;
                case Polygone::class:
                    // Implement Polygone rendering here
                    break;
            }
        }
        //fin partie ajoutée
         
        return $image->toXMLString();
    }
    public function save(string $path): void {}
}