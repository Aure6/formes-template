<?php

use Opmvpc\Formes\Canvas;
use Opmvpc\Formes\Point;
use Opmvpc\Formes\Rectangle;

it('is a Canvas', function () {
    $canvas = new Canvas(100, 100);
    expect($canvas)->toBeInstanceOf(Canvas::class);
    expect($canvas->getWidth())->toBe(100.0);
    expect($canvas->getHeight())->toBe(100.0);
    expect($canvas->getFormes())->toBeArray();
    expect($canvas->getFormes())->toBeEmpty();
    expect($canvas->getCouleur())->toBe('#FFFFFF');
});

it('can add formes', function () {
    $canvas = new Canvas(100, 100);
    expect($canvas->getFormes())->toBeArray();
    expect($canvas->getFormes())->toBeEmpty();
    $canvas->add(new Rectangle(new Point(0, 0), 10, 10));
    expect($canvas->getFormes())->toBeArray();
    expect($canvas->getFormes())->toHaveLength(1);
    $canvas->add(new Rectangle(new Point(0, 0), 10, 10));
    expect($canvas->getFormes())->toBeArray();
    expect($canvas->getFormes())->toHaveLength(2);//2 car 2 rectangles
});
