<?php

include_once "TennisGame.php";

$tennisGame = new TennisGame();

$tennisGame->getScore('player1', 'player2', 1, 3);

echo $tennisGame;