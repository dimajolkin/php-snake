<?php

namespace dimajolkin\snake;


use dimajolkin\snake\input\InputInterface;
use dimajolkin\snake\map\Map;
use dimajolkin\snake\view\Draw;

class Game
{
    /** @var  Map */
    protected $map;

    /** @var  GamePad[] */
    protected $gamePads;

    /** @var  Draw */
    protected $draw;

    protected $speed = 500000; //0.5 sec

    /**
     * Game constructor.
     * @param Map $map
     * @param GamePad[] $gamePads
     */
    public function __construct(Map $map, array $gamePads)
    {
        $this->map = $map;
        $this->gamePads = $gamePads;
        $this->draw = new Draw(STDOUT);
    }

    public function loop(InputInterface $keyboard)
    {
        $this->draw->draw($this->map);

        while (true) {
            $key = $keyboard->getChar();
            foreach ($this->gamePads as $gamePad) {

                if ($gamePad->has($key)) {
                    $this->map->clear($gamePad->getPlayer()->getPosition());

                    $gamePad->pressKey($key);

                    $this->map->set(
                        $gamePad->getPlayer()->getPosition(),
                        $gamePad->getPlayer()->getChar()
                    );
                } else {

                    $this->map->clear($gamePad->getPlayer()->getPosition());
                    $gamePad->getPlayer()->next();
                    $this->map->set(
                        $gamePad->getPlayer()->getPosition(),
                        $gamePad->getPlayer()->getChar()
                    );
                }
            }

            $this->draw->draw($this->map);
            usleep($this->speed);
        }
    }
}