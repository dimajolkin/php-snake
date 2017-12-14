<?php

namespace dimajolkin\snake\view;

use phpdk\lang\TObject;

class Box extends TObject
{
    /** @var  int */
    private $width;
    /** @var  int */
    private $height;

    /**
     * Box constructor.
     * @param int $width
     * @param int $height
     */
    public function __construct($width, $height)
    {
        $this->width = $width;
        $this->height = $height;
    }

    /**
     * @return int
     */
    public function getWidth(): int
    {
        return $this->width;
    }

    /**
     * @return int
     */
    public function getHeight(): int
    {
        return $this->height;
    }
}