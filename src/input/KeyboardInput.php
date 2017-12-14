<?php

namespace dimajolkin\snake\input;

class KeyboardInput implements InputInterface
{
    public function __construct()
    {
        stream_set_blocking(STDIN, false);
    }

    /**
     * @return string
     */
    public function getKey(): string
    {
        readline_callback_handler_install('', function () {
        });
        $char = stream_get_contents(STDIN, 1);
        readline_callback_handler_remove();

        return $char;
    }
}