<?php

namespace dimajolkin\snake\view;

use dimajolkin\snake\map\Map;
use phpdk\awt\Point;

class Draw
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
     * @param string $symbol
     * @deprecated
     */
    public function drawSymbol(Point $point, string $symbol): void
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

    public function draw(Map $map)
    {
        $this->hideCursor();
        $this->moveCursorToStart();
        $this->newLine();

        foreach ($map->getMatrix() as $line) {
            foreach ($line as $char) {
                fwrite($this->stream, (string)$char);
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