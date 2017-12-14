<?php
use dimajolkin\snake\GamePad;
use dimajolkin\snake\map\LoopMap;
use dimajolkin\snake\Player;
use dimajolkin\snake\TerminalInput;
use dimajolkin\snake\view\Char;
use dimajolkin\snake\view\Color;
use dimajolkin\snake\view\Draw;
use phpdk\awt\Point;

include __DIR__ ."/../vendor/autoload.php";

$map = new LoopMap(
    new Point(0, 0),
    new Point(15, 15),
    new Char('*')
);

$draw = new Draw(STDOUT);
$draw->draw($map);

$terminal = new TerminalInput();

$player = new Player(new Point(3, 1), new Point(0, 1), new Char('+', Color::RED));
$map->set($player->getPosition(), $player->getChar());

$gamePad = new GamePad($player);
$gamePad->setting('a', 'd', 'w', 's');


while (true) {
    $c = $terminal->getChar();

    if ($gamePad->has($c)) {
        $map->clear($player->getPosition());
        $gamePad->pressKey($c);
        $map->set($player->getPosition(), $player->getChar());
    } else {
        $map->clear($player->getPosition());
        $player->next();
        $map->set($player->getPosition(), $player->getChar());
    }

    $draw->draw($map);
    sleep(1);
}

