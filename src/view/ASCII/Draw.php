<?php

namespace dimajolkin\snake\view\ASCII;

use dimajolkin\snake\map\Map;
use dimajolkin\snake\view\Block;
use dimajolkin\snake\view\DrawDriver;
use dimajolkin\snake\view\Pixel;
use phpdk\awt\Point;

class Draw implements DrawDriver
{
    /** @var bool|resource */
    private $stream;

    /**
     * Draw constructor.
     * @param $stream
     */
    public function __construct($stream)
    {
        $this->stream = $stream;
    }

    /**
     * @param Point $point
     * @param Block $symbol
     * @deprecated
     */
    public function block(Point $point, Block $symbol): void
    {
        $this->hideCursor();
        $this->moveCursor($point);
        fwrite($this->stream, $symbol);
        $this->showCursor();

        fwrite($this->stream, PHP_EOL);
        fwrite($this->stream, PHP_EOL);
        fwrite($this->stream, PHP_EOL);
        fwrite($this->stream, PHP_EOL);
        fwrite($this->stream, PHP_EOL);
        fwrite($this->stream, PHP_EOL);
    }

    public function map(Map $map): void
    {
        $this->hideCursor();
        $this->moveCursorToStart();
        $this->newLine();

        foreach ($map->getMatrix() as $line) {
            foreach ($line as $box) {
                if ($box instanceof Block) {
                    foreach ($box->getListPixels() as $pixel) {
                        fwrite($this->stream, (string)$pixel);
                    }
                }
            }
            $this->newLine();
        }
        $this->showCursor();
    }


    private function newLine()
    {
        fwrite($this->stream, PHP_EOL);
    }

    private function moveCursorToStart()
    {
        fwrite($this->stream, "\033[0;0f");
    }

    private function moveCursor(Point $point)
    {
        $x = $point->getX() + 2;
        $y = $point->getY() + 1;
        fwrite($this->stream, "\033[{$x};{$y}f");
    }

    private function hideCursor()
    {
        fwrite($this->stream, "\033[?25l");
    }

    private function showCursor()
    {
        fwrite($this->stream, "\033[?25h\033[?0c");
    }
}