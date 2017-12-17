<?php

namespace dimajolkin\snake\view;


use dimajolkin\snake\map\Map;
use phpdk\awt\Point;

interface DrawDriver
{
    public function map(Map $map): void;

    public function block(Point $point, Block $block): void;
}