<?php

namespace dimajolkin\snake;


use dimajolkin\snake\input\InputInterface;
use dimajolkin\snake\map\Map;
use dimajolkin\snake\view\Draw;
use phpdk\awt\Point;

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

    protected function tick(Player $player, callable $func)
    {
        $this->map->clear($player->getPosition());

        $func();

        $this->map->set(
            $player->getPosition(),
            $player->getChar()
        );
    }

    public function loop(InputInterface $keyboard)
    {
        $this->draw->draw($this->map);
        while (true) {
            $key = $keyboard->getKey();
            foreach ($this->gamePads as $gamePad) {

                if ($gamePad->has($key)) {
                    $this->tick($gamePad->getPlayer(), function () use ($gamePad, $key) {
                        $gamePad->pressKey($key);
                    });
                } else {
                    $this->tick($gamePad->getPlayer(), [$gamePad->getPlayer(), 'next']);
                }
            }

            $this->draw->draw($this->map);
            usleep($this->speed);
        }
    }
}