<?php

namespace dimajolkin\snake;


use dimajolkin\snake\view\Char;
use phpdk\awt\Point;

class Player
{
    /**
     * @var Char
     */
    private $char;

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
     * @param Char $char
     */
    public function __construct(Point $position, Point $look, Char $char)
    {
        $this->char = $char;
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
            $old = clone $this->getPosition();
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
     * @return Char
     */
    public function getChar(): Char
    {
        return $this->char;
    }
}