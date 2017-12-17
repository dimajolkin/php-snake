<?php

namespace dimajolkin\snake\view\ASCII;


use dimajolkin\snake\view\Block;
use dimajolkin\snake\view\Color;
use dimajolkin\snake\view\Pixel;
use phpdk\lang\TObject;

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

    public function __toString()
    {
        if ($this->color) {
            return "\e[{$this->color}m\e[30m{$this->symbol}\e[0m";
        }

        return $this->symbol;
    }
}