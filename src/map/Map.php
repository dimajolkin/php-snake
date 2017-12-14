<?php

namespace dimajolkin\snake\map;


use dimajolkin\snake\Matrix;
use dimajolkin\snake\view\Box;
use dimajolkin\snake\view\Char;
use phpdk\awt\Point;

class Map
{
    /** @var Matrix  */
    private $matrix;

    /** @var  Point */
    private $startPoint;
    /**
     * @var Char
     */
    private $emptyChar;


    public function __construct(Point $leftTopPoint, Point $bottomRightPoint, Char $emptyChar)
    {
        $this->startPoint = $leftTopPoint;
        $this->emptyChar = $emptyChar;
        $this->matrix = new Matrix(
            $leftTopPoint,
            $bottomRightPoint,
            $emptyChar
        );
    }

    public function getEmptyChar(): Char
    {
        return $this->emptyChar;
    }

    public function getStartPoint(): Point
    {
        return $this->startPoint;
    }

    public function has(Point $point): bool
    {
        return $this->matrix->has($point);
    }

    public function set(Point $point, Char $symbol): void
    {
        $this->matrix->set($point, $symbol);
    }

    public function clear(Point $point): void
    {
        $this->matrix->clear($point);
    }

    public function get(Point $point): Char
    {
        return $this->matrix->get($point);
    }

    /**
     * @return Matrix
     */
    public function getMatrix()
    {
        return $this->matrix;
    }
}