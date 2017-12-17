<?php

namespace dimajolkin\snake;


use dimajolkin\snake\view\Block;
use phpdk\awt\Point;

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
     * @var Block
     */
    private $defaultChar;

    /**
     * @var Block
     */
    protected $emptyChar;

    public function __construct(
        Point $leftTopPoint,
        Point $bottomRightPoint,
        Block $defaultChar,
        Block $emptyBlock
    )
    {
        $this->emptyChar = $emptyBlock;

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
     * @return Block
     */
    public function getDefaultChar(): Block
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

    public function set(Point $point, Block $symbol): void
    {
        $this->matrix[$point->getY()][$point->getX()] = $symbol;
    }

    public function clear(Point $point): void
    {
        $this->set($point, $this->defaultChar);
    }

    public function get(Point $point): Block
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