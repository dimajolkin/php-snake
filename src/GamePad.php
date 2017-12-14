<?php

namespace dimajolkin\snake;

use dimajolkin\snake\input\InputInterface;

class GamePad
{
    /** @var  Player */
    private $player;

    private $left = 'a';
    private $right = 'd';
    private $top = 'w';
    private $bottom = 's';

    /**
     * GamePad constructor.
     * @param Player $player
     */
    public function __construct(Player $player)
    {
        $this->player = $player;
    }

    /**
     * @return Player
     */
    public function getPlayer(): Player
    {
        return $this->player;
    }

    public function setting(string $left, string $right, string $top, string $bottom): void
    {
        $this->left = $left;
        $this->right = $right;
        $this->top = $top;
        $this->bottom = $bottom;
    }

    public function has($key): bool
    {
        return in_array($key, [
            $this->left,
            $this->right,
            $this->top,
            $this->bottom,
        ]);
    }

    public function pressKey($key): void
    {
        if ($key === $this->left) {
            $this->player->left();
        } elseif ($key === $this->right) {
            $this->player->right();
        } elseif ($key === $this->top) {
            $this->player->top();
        } elseif ($key === $this->bottom) {
            $this->player->bottom();
        }
    }
}