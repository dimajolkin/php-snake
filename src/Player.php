<?php

namespace dimajolkin\snake;

use dimajolkin\snake\view\Block;
use phpdk\awt\Point;

class Player
{
    /**
     * @var Block
     */
    private $block;

    /**
     * @var Point
     */
    private $position;

    private $look;

    protected $onChange;

    /**
     * Player constructor.
     * @param Point $position
     * @param Point $look
     * @param Block $block
     */
    public function __construct(Point $position, Point $look, Block $block)
    {
        $this->block = $block;
        $this->position = $position;
        $this->look = $look;
    }


    public function look(): Point
    {
        return $this->look;
    }

    private function move($x, $y): void
    {
        $this->look = new Point($x, $y);

        if (!$this->getPosition()->equals($this->look)) {
            $this->getPosition()->translate(
                $this->look->getX(),
                $this->look->getY()
            );
        }
    }

    public function next(): void
    {
        $this->move($this->look->getX(), $this->look->getY());
    }
    
    public function left(): void
    {
        $this->move(-1, 0);
    }

    public function right(): void
    {
        $this->move(1, 0);
    }

    public function top(): void
    {
        $this->move(0, -1);
    }

    public function bottom(): void
    {
        $this->move(0, 1);
    }

    /**
     * @return Point
     */
    public function getPosition(): Point
    {
        return $this->position;
    }

    /**
     * @return Block
     */
    public function getBlock(): Block
    {
        return $this->block;
    }
}