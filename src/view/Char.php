<?php

namespace dimajolkin\snake\view;


class Char
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
    public function __construct(string $symbol,  int $color = null)
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