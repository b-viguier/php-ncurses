#!/usr/bin/env php
<?php

require __DIR__ . '/../vendor/autoload.php';

use bviguier\ncurses\NCurses;

$ncurses = NCurses::create();

// https://tldp.org/HOWTO/NCURSES-Programming-HOWTO/helloworld.html

$ncurses->initscr();			/* Start curses mode 		  */
$ncurses->printw("Hello World !!!");	/* Print Hello World		  */
$ncurses->refresh();			/* Print it on to the real screen */
$ncurses->getch();			/* Wait for user input */
$ncurses->endwin();			/* End curses mode		  */