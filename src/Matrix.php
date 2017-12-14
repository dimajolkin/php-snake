<?php

namespace dimajolkin\snake;


use dimajolkin\snake\view\Box;
use dimajolkin\snake\view\Char;
use phpdk\awt\Point;
use Traversable;

class Matrix implements \IteratorAggregate
{
    private $matrix = [];
    /**
     * @var Point
     */
    private $leftTopPoint;
    /**
     * @var Point
     */
    private $bottomRightPoint;
    /**
     * @var Char
     */
    private $defaultChar;

    protected $emptyChar;

    public function __construct(Point $leftTopPoint, Point $bottomRightPoint, Char $defaultChar)
    {
        $this->emptyChar = new Char(' ');

        for ($x = 0; $x < $bottomRightPoint->getY(); $x++) {
            for ($y = 0; $y < $bottomRightPoint->getX(); $y++) {
                if ($x < $leftTopPoint->getX()) {
                    $this->set(new Point($x, $y), $this->emptyChar);
                } elseif ($y < $leftTopPoint->getY()) {
                    $this->set(new Point($x, $y), $this->emptyChar);
                } else {
                    $this->set(new Point($x, $y), $defaultChar);
                }
            }
        }

        $this->leftTopPoint = $leftTopPoint;
        $this->bottomRightPoint = $bottomRightPoint;
        $this->defaultChar = $defaultChar;
    }

    /**
     * @return Char
     */
    public function getDefaultChar(): Char
    {
        return $this->defaultChar;
    }

    public function has(Point $point): bool
    {
        if (isset($this->matrix[$point->getY()]) && isset($this->matrix[$point->getY()][$point->getY()])) {
            return (string)$this->matrix[$point->getY()][$point->getY()] !== (string)$this->emptyChar;
        }

        return false;
    }

    public function set(Point $point, Char $symbol): void
    {
        $this->matrix[$point->getY()][$point->getX()] = $symbol;
    }

    public function clear(Point $point): void
    {
        $this->set($point, $this->defaultChar);
    }

    public function get(Point $point): Char
    {
        return $this->matrix[$point->getY()][$point->getX()];
    }

    /**
     * @return Point
     */
    public function getLeftTopPoint(): Point
    {
        return $this->leftTopPoint;
    }

    /**
     * @param Point $leftTopPoint
     */
    public function setLeftTopPoint(Point $leftTopPoint)
    {
        $this->leftTopPoint = $leftTopPoint;
    }

    /**
     * @return Point
     */
    public function getBottomRightPoint(): Point
    {
        return $this->bottomRightPoint;
    }

    /**
     * @param Point $bottomRightPoint
     */
    public function setBottomRightPoint(Point $bottomRightPoint)
    {
        $this->bottomRightPoint = $bottomRightPoint;
    }

    public function getIterator()
    {
        return new \ArrayIterator($this->matrix);
    }
}