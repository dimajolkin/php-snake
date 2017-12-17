<?php

namespace dimajolkin\snake\view;

interface Color
{
    public static function black(): Color;

    public static function red(): Color;

    public static function green(): Color;

    public static function yellow(): Color;

    public static function blue(): Color;
}