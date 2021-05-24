#!/usr/bin/env php
<?php

require __DIR__.'/../vendor/autoload.php';

use bviguier\ncurses\NCurses;

$ncurses = NCurses::create();

// https://tldp.org/HOWTO/NCURSES-Programming-HOWTO/scanw.html

$mesg = "Enter a string: ";  /* message to be appeared on the screen */
$str = str_pad('', 80);
$row = $col = 0;    /* to store the number of rows and *
                     * the number of colums of the screen */
$ncurses->initscr();    /* start the curses mode */
$ncurses->getmaxyx($ncurses->stdscr(), $row, $col);  /* get the number of rows and columns */
$ncurses->mvprintw($row / 2, ($col - strlen($mesg)) / 2, "%s", $mesg);
/* print the message at the center of the screen */
$ncurses->getstr($str);
$ncurses->mvprintw($ncurses->LINES() - 2, 0, "You Entered: %s", $str);
$ncurses->getch();
$ncurses->endwin();