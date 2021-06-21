#!/usr/bin/env php
<?php

require __DIR__.'/../vendor/autoload.php';

use bviguier\ncurses\NCurses;
use bviguier\ncurses\Window;

$ncurses = NCurses::create();

// https://tldp.org/HOWTO/NCURSES-Programming-HOWTO/color.html

function main(int $argc, array $argv): int
{
    global $ncurses;

    $ncurses->initscr();			/* Start curses mode 		*/
    if($ncurses->has_colors() == FALSE)
    {
        $ncurses->endwin();
        printf("Your terminal does not support color\n");
        exit(1);
    }
    $ncurses->start_color();			/* Start color 			*/
    $ncurses->init_pair(1, NCurses::COLOR_RED, NCurses::COLOR_BLACK);

    $ncurses->attron($ncurses->COLOR_PAIR(1));
    print_in_middle($ncurses->stdscr(), $ncurses->LINES() / 2, 0, 0, "Voila !!! In color ...");
    $ncurses->attroff($ncurses->COLOR_PAIR(1));
    $ncurses->getch();
    $ncurses->endwin();

    return 0;
}

function print_in_middle(Window $win, int $starty, int $startx, int $width, string $string): void
{
    global $ncurses;

    $x = $y = 0;

	if($win == NULL)
        $win = $ncurses->stdscr();
    $ncurses->getyx($win, $y, $x);
	if($startx != 0)
        $x = $startx;
	if($starty != 0)
        $y = $starty;
	if($width == 0)
        $width = 80;

	$length = strlen($string);
	$temp = ($width - $length)/ 2;
	$x = $startx + (int)$temp;
    $ncurses->mvwprintw($win, $y, $x, "%s", $string);
    $ncurses->refresh();
}

return main($argc, $argv);
