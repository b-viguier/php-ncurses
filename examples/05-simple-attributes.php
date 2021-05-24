#!/usr/bin/env php
<?php

require __DIR__.'/../vendor/autoload.php';

use bviguier\ncurses\NCurses;

$ncurses = NCurses::create();

// https://tldp.org/HOWTO/NCURSES-Programming-HOWTO/attrib.html

$ch = $prev = $row = $col = 0;
$prev = null;
$y = $x = 0;

if ($argc != 2) {
    printf("Usage: %s <a c file name>\n", $argv[0]);
    exit(1);
}

$fp = fopen($argv[1], "r");
if ($fp === false) {
    printf("Cannot open input file");
    exit(1);
}
$ncurses->initscr();                /* Start curses mode */
$ncurses->getmaxyx($ncurses->stdscr(), $row, $col);        /* find the boundaries of the screeen */
while (($ch = fgetc($fp)) !== false)    /* read the file till we reach the end */ {
    $ncurses->getyx($ncurses->stdscr(), $y, $x);        /* get the current curser position */
    if ($y == ($row - 1))            /* are we are at the end of the screen */ {
        $ncurses->printw("<-Press Any Key->");    /* tell the user to press a key */
        $ncurses->getch();
        $ncurses->clear();                /* clear the screen */
        $ncurses->move(0, 0);            /* start at the beginning of the screen */
    }
    if ($prev == '/' && $ch == '*') {      /* If it is / and * then only
                                     	 * switch bold on */
        $ncurses->attron(NCurses::A_BOLD);            /* cut bold on */
        $ncurses->getyx($ncurses->stdscr(), $y, $x);        /* get the current curser position */
        $ncurses->move($y, $x - 1);            /* back up one space */
        $ncurses->printw("%c%c", ord('/'), ord($ch));        /* The actual printing is done here */
    } else {
        $ncurses->printw("%c", ord($ch));
    }
    $ncurses->refresh();
    if ($prev == '*' && $ch == '/') {
        $ncurses->attroff(NCurses::A_BOLD);                /* Switch it off once we got */
    }                                     /* and then / */
    $prev = $ch;
}
$ncurses->getch();
$ncurses->endwin();                        /* End curses mode */
fclose($fp);
