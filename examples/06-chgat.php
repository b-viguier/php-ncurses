#!/usr/bin/env php
<?php

require __DIR__.'/../vendor/autoload.php';

use bviguier\ncurses\NCurses;

$ncurses = NCurses::create();

// https://tldp.org/HOWTO/NCURSES-Programming-HOWTO/attrib.html

$ncurses->initscr();            /* Start curses mode 		*/
$ncurses->start_color();            /* Start color functionality	*/

$ncurses->init_pair(1, NCurses::COLOR_CYAN, NCurses::COLOR_BLACK);
$ncurses->printw("A Big string which i didn't care to type fully ");
$ncurses->mvchgat(0, 0, -1, NCurses::A_BLINK, 1, NULL);
/*
 * First two parameters specify the position at which to start
 * Third parameter number of characters to update. -1 means till
 * end of line
 * Forth parameter is the normal attribute you wanted to give
 * to the character
 * Fifth is the color index. It is the index given during init_pair()
 * use 0 if you didn't want color
 * Sixth one is always NULL
 */
$ncurses->refresh();
$ncurses->getch();
$ncurses->endwin();            /* End curses mode		  */
