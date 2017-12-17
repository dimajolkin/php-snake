<?php

namespace dimajolkin\snake\map;


use dimajolkin\snake\Matrix;
use dimajolkin\snake\view\Block;
use phpdk\awt\Point;

class Map
{
    /** @var Matrix  */
    private $matrix;

    /** @var  Point */
    private $startPoint;
    /**
     * @var Block
     */
    private $emptyChar;


    public function __construct(
        Point $leftTopPoint,
        Point $bottomRightPoint,
        Block $defaultBlock,
        Block $emptyBlock
)
    {
        $this->startPoint = $leftTopPoint;
        $this->emptyChar = $defaultBlock;
        $this->matrix = new Matrix(
            $leftTopPoint,
            $bottomRightPoint,
            $defaultBlock,
            $emptyBlock
        );
    }

    public function getEmptyChar(): Block
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

    public function set(Point $point, Block $symbol): void
    {
        $this->matrix->set($point, $symbol);
    }

    public function clear(Point $point): void
    {
        $this->matrix->clear($point);
    }

    public function get(Point $point): Block
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