<?php
use dimajolkin\snake\Game;
use dimajolkin\snake\GamePad;
use dimajolkin\snake\input\KeyboardInput;
use dimajolkin\snake\map\LoopMap;
use dimajolkin\snake\Player;
use dimajolkin\snake\view\Char;
use dimajolkin\snake\view\Color;
use phpdk\awt\Point;

include __DIR__ ."/../vendor/autoload.php";

$map = new LoopMap(
    new Point(0, 0),
    new Point(15, 15),
    new Char('*')
);

$keyboard = new KeyboardInput();

$player1 = new Player(new Point(10, 10), new Point(0, 1), new Char('+', Color::RED));
$gamePad1 = new GamePad($player1);
$gamePad1->setting('a', 'd', 'w', 's');

$player2 = new Player(new Point(11, 10), new Point(0, 1), new Char('&', Color::GREEN));
$gamePad2 = new GamePad($player2);
$gamePad2->setting('f', 'h', 't', 'g');

$game = new Game($map, [$gamePad1, $gamePad2]);
$game->loop($keyboard);


