#!/usr/bin/env php
<?php

require __DIR__.'/../vendor/autoload.php';

use bviguier\ncurses\NCurses;

$ncurses = NCurses::create();

// https://tldp.org/HOWTO/NCURSES-Programming-HOWTO/printw.html

$mesg = "Just a string";    /* message to be appeared on the screen */
$row = $col = 0;            /* to store the number of rows and *
                             * the number of colums of the screen */
$ncurses->initscr();    /* start the curses mode */
$ncurses->getmaxyx($ncurses->stdscr(), $row, $col);  /* get the number of rows and columns */
$ncurses->mvprintw($row / 2, ($col - strlen($mesg)) / 2, "%s", $mesg);
/* print the message at the center of the screen */
$ncurses->mvprintw($row - 2, 0, "This screen has %d rows and %d columns\n", $row, $col);
$ncurses->printw("Try resizing your window(if possible) and then run this program again");
$ncurses->refresh();
$ncurses->getch();
$ncurses->endwin();
