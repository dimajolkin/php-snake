<?php

namespace dimajolkin\snake\view;

use phpdk\lang\TObject;
use phpdk\util\TList;

interface Block
{
    public function getListPixels(): TList;

    public function equals($object): bool;
}