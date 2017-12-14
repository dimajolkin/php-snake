<?php

namespace dimajolkin\snake\map;

use dimajolkin\snake\view\Char;
use phpdk\awt\Point;

class LoopMap extends Map
{
    public function set(Point $point, Char $symbol): void
    {
        if ($point->getX() >= $this->getMatrix()->getBottomRightPoint()->getX()) {
            $point->translate(-$this->getMatrix()->getBottomRightPoint()->getX(), 0);
            parent::set($point, $symbol);
            return;
        }

        if ($point->getX() < $this->getMatrix()->getLeftTopPoint()->getX()) {
            $point->translate($this->getMatrix()->getBottomRightPoint()->getX(), 0);
            parent::set($point, $symbol);
            return;
        }

        if ($point->getY() >= $this->getMatrix()->getBottomRightPoint()->getY()) {
            $point->translate(0, -$this->getMatrix()->getBottomRightPoint()->getY());
            parent::set($point, $symbol);
            return;
        }

        if ($point->getY() < $this->getMatrix()->getLeftTopPoint()->getY()) {
            $point->translate(0, $this->getMatrix()->getBottomRightPoint()->getY());
            parent::set($point, $symbol);
            return;
        }

        parent::set($point, $symbol);
    }


}