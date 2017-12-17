<?php

namespace dimajolkin\snake\view\ASCII;

use dimajolkin\snake\view\Color as IColor;
use phpdk\lang\TObject;

class Color extends TObject implements IColor
{
    protected $int;

    /**
     * Color constructor.
     * @param $int
     */
    public function __construct(int $int)
    {
        $this->int = $int;
    }

    public function __toString()
    {
        return (string)$this->int;
    }


    public static function black(): IColor
    {
        return new static(40);
    }

    public static function red(): IColor
    {
        return new static(41);
    }

    public static function green(): IColor
    {
        return new static(42);
    }

    public static function yellow(): IColor
    {
        return new static(43);
    }

    public static function blue(): IColor
    {
        return new static(44);
    }
}