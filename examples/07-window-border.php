#!/usr/bin/env php
<?php

require __DIR__.'/../vendor/autoload.php';

use bviguier\ncurses\NCurses;
use bviguier\ncurses\Window;

$ncurses = NCurses::create();

// https://tldp.org/HOWTO/NCURSES-Programming-HOWTO/windows.html

function main(int $argc, array $argv): int
{
    global $ncurses;

	$ncurses->initscr();			/* Start curses mode 		*/
	$ncurses->cbreak();			/* Line buffering disabled, Pass on
					 * everty thing to me 		*/
	$ncurses->keypad($ncurses->stdscr(), TRUE);		/* I need that nifty F1 	*/

	$height = 3;
	$width = 10;
	$starty = ($ncurses->LINES() - $height) / 2;	/* Calculating for a center placement */
	$startx = ($ncurses->COLS() - $width) / 2;	/* of the window		*/
	$ncurses->printw("Press F1 to exit");
	$ncurses->refresh();
	$my_win = create_newwin($height, $width, $starty, $startx);

	while(($ch = $ncurses->getch()) != $ncurses->KEY_F(1))
	{	switch($ch)
		{	case NCurses::KEY_LEFT:
				destroy_win($my_win);
				$my_win = create_newwin($height, $width, $starty,--$startx);
				break;
			case NCurses::KEY_RIGHT:
				destroy_win($my_win);
				$my_win = create_newwin($height, $width, $starty,++$startx);
				break;
			case NCurses::KEY_UP:
				destroy_win($my_win);
				$my_win = create_newwin($height, $width, --$starty,$startx);
				break;
			case NCurses::KEY_DOWN:
				destroy_win($my_win);
				$my_win = create_newwin($height, $width, ++$starty,$startx);
				break;
		}
	}

	$ncurses->endwin();			/* End curses mode		  */
	return 0;
}

function create_newwin(int $height, int $width, int $starty, int $startx): Window
{
    global $ncurses;
	$local_win = $ncurses->newwin($height, $width, $starty, $startx);
	$ncurses->box($local_win, 0 , 0);		/* 0, 0 gives default characters
					 * for the vertical and horizontal
					 * lines			*/
	$ncurses->wrefresh($local_win);		/* Show that box 		*/

	return $local_win;
}

function destroy_win(Window $local_win): void
{
    global $ncurses;
	/* box(local_win, ' ', ' '); : This won't produce the desired
	 * result of erasing the window. It will leave it's four corners
	 * and so an ugly remnant of window.
	 */
    $ncurses->wborder($local_win, ' ', ' ', ' ',' ',' ',' ',' ',' ');
	/* The parameters taken are
	 * 1. win: the window on which to operate
	 * 2. ls: character to be used for the left side of the window
	 * 3. rs: character to be used for the right side of the window
	 * 4. ts: character to be used for the top side of the window
	 * 5. bs: character to be used for the bottom side of the window
	 * 6. tl: character to be used for the top left corner of the window
	 * 7. tr: character to be used for the top right corner of the window
	 * 8. bl: character to be used for the bottom left corner of the window
	 * 9. br: character to be used for the bottom right corner of the window
	 */
    $ncurses->wrefresh($local_win);
    $ncurses->delwin($local_win);
}

return main($argc, $argv);
