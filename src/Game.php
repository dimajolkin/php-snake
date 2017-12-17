<?php

namespace dimajolkin\snake;

use dimajolkin\snake\input\InputInterface;
use dimajolkin\snake\map\Map;
use dimajolkin\snake\view\DrawDriver;

class Game
{
    /** @var  Map */
    protected $map;

    /** @var  GamePad[] */
    protected $gamePads;

    protected $speed = 500000;

    /**
     * @var DrawDriver
     */
    private $driver;

    /**
     * Game constructor.
     * @param Map $map
     * @param DrawDriver $driver
     * @param GamePad[] $gamePads
     */
    public function __construct(
        Map $map,
        DrawDriver $driver,
        array $gamePads
    )
    {
        $this->map = $map;
        $this->gamePads = $gamePads;
        $this->driver = $driver;
    }

    protected function tick(Player $player, callable $func)
    {
        $this->map->clear($player->getPosition());

        $func();

        $this->map->set(
            $player->getPosition(),
            $player->getBlock()
        );
    }

    public function loop(InputInterface $keyboard)
    {
        $this->driver->map($this->map);
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

            $this->driver->map($this->map);
            usleep($this->speed);
        }
    }
}