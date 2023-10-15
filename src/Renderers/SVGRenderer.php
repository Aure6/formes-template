<?php

namespace Opmvpc\Formes\Renderers;

// Importing classes and namespaces
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

// Defining the SVGRenderer class implementing the Renderer interface
class SVGRenderer implements Renderer {
    // Declaring a private variable of type Canvas
    private Canvas $canvas;

    // Constructor of the SVGRenderer class
    public function __construct(Canvas $canvas) {
        $this->canvas = $canvas;
    }

    // Function to render the SVG image as a string
    public function render(): string {
        // Creating a new SVG image with the width and height of the canvas
        $image = new SVG($this->canvas->getWidth(), $this->canvas->getHeight());
        // Getting the SVG document for further manipulations
        $doc = $image->getDocument();
        
        // Creating a rectangle that covers the whole canvas
        $square = new SVGRect(0, 0, $this->canvas->getWidth(), $this->canvas->getHeight(), $this->canvas->getCouleur());
        // Setting the fill color of the SVG document
        $doc->setStyle('fill', $this->canvas->getCouleur());
        // Adding the rectangle to the SVG document
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
        // Iterating over the formes in the canvas
        foreach ($this->canvas->getFormes() as $forme) {
            // Switching based on the class of the forme
            switch (get_class($forme)) {
                // If the forme is a Line
                case Ligne::class:
                    $line = new SVGLine(
                        $forme->getPoint1()->getX(), 
                        $forme->getPoint1()->getY(), 
                        $forme->getPoint2()->getX(), 
                        $forme->getPoint2()->getY());
                    $line->setStyle('fill', $forme->getCouleur());
                    // Adding the line to the SVG document
                    $doc->addChild($line);
                    break;
                // If the forme is a Rectangle
                case Rectangle::class:
                    $rect = new SVGRect(
                        $forme->getPoint()->getX(), 
                        $forme->getPoint()->getY(), 
                        $forme->getWidth(), 
                        $forme->getHeight());
                    $rect->setStyle('fill', $forme->getCouleur());
                    // Adding the rectangle to the SVG document
                    $doc->addChild($rect);
                    break;
                // If the forme is a Cercle
                case Cercle::class:
                    $circle = new SVGCircle(
                        $forme->getCentre()->getX(), 
                        $forme->getCentre()->getY(), 
                        $forme->getRayon());
                    $circle->setStyle('fill', $forme->getCouleur());
                    // Adding the rectangle to the SVG document
                    $doc->addChild($circle);
                    break;
                // If the forme is a Polygone
                case Polygone::class:
                    /* $polygone = new SVGCircle(
                        $forme->getPoints()); 
                    $polygone->setStyle('fill', $forme->getCouleur());
                    // Adding the rectangle to the SVG document
                    $doc->addChild($polygone);
                    break; */
                    $polygonPoints = [];
                    foreach ($forme->getPoints() as $point) {
                        $polygonPoints[] = [$point->getX(), $point->getY()];
                    }
                    
                    $svgPolygon = new SVGPolygon($polygonPoints);
                    $svgPolygon->setStyle('fill', $forme->getCouleur());
                    $doc->addChild($svgPolygon);
                    break;
            }
        }
        //fin partie ajoutée

       // Returning the SVG image as a string
       return $image->toXMLString();
    }

    // Function to save the SVG image to a file
    public function save(string $path): void {
        // TODO: Implement the save functionality
    }
}