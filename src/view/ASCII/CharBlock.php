<?php

namespace dimajolkin\snake\view\ASCII;

use dimajolkin\snake\view\Block;
use dimajolkin\snake\view\Color;
use dimajolkin\snake\view\Pixel;
use phpdk\lang\TObject;
use phpdk\lang\TString;
use phpdk\util\TList;

class CharBlock extends TObject implements Block, Pixel
{
    /** @var  string */
    private $symbol;

    /** @var int */
    private $color;

    /**
     * Char constructor.
     * @param string $symbol
     * @param $color
     */
    public function __construct(string $symbol,  Color $color = null)
    {
        $this->symbol = $symbol;
        $this->color = $color;
    }

    public function getListPixels(): TList
    {
        return new TList(Pixel::class, [
            $this,
        ]);
    }

    public function toString(): TString
    {
        if ($this->color) {
            return new TString("\e[{$this->color}m\e[30m{$this->symbol}\e[0m");
        }

        return new TString($this->symbol);
    }
}