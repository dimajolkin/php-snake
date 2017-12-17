<?php

namespace dimajolkin\snake\view;

use phpdk\util\TList;

interface Block
{
    public function getListPixels(): TList;
}