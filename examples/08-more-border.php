#!/usr/bin/env php
<?php

require __DIR__.'/../vendor/autoload.php';

use bviguier\ncurses\NCurses;
use bviguier\ncurses\Window;

$ncurses = NCurses::create();

// https://tldp.org/HOWTO/NCURSES-Programming-HOWTO/windows.html

class WIN_BORDER
{
    public string $ls;
    public string $rs;
    public string $ts;
    public string $bs;
    public string $tl;
    public string $tr;
    public string $bl;
    public string $br;
}

;

class WIN
{

    public int $startx;
    public int $starty;
    public int $height;
    public int $width;
    public WIN_BORDER $border;

    public function __construct()
    {
        $this->border = new WIN_BORDER();
    }
}

function main(int $argc, array $argv): int
{
    global $ncurses;

    $win = new WIN();

    $ncurses->initscr();            /* Start curses mode 		*/
    $ncurses->start_color();            /* Start the color functionality */
    $ncurses->cbreak();            /* Line buffering disabled, Pass on
					                * every thing to me 		*/
    $ncurses->keypad($ncurses->stdscr(), TRUE);        /* I need that nifty F1 	*/
    $ncurses->noecho();
    $ncurses->init_pair(1, NCurses::COLOR_CYAN, NCurses::COLOR_BLACK);

    /* Initialize the window parameters */
    init_win_params($win);
    print_win_params($win);

    $ncurses->attron($ncurses->COLOR_PAIR(1));
    $ncurses->printw("Press F1 to exit");
    $ncurses->refresh();
    $ncurses->attroff($ncurses->COLOR_PAIR(1));

    create_box($win, TRUE);
    while (($ch = $ncurses->getch()) != $ncurses->KEY_F(1)) {
        switch ($ch) {
            case NCurses::KEY_LEFT:
                create_box($win, FALSE);
                --$win->startx;
                create_box($win, TRUE);
                break;
            case NCurses::KEY_RIGHT:
                create_box($win, FALSE);
                ++$win->startx;
                create_box($win, TRUE);
                break;
            case NCurses::KEY_UP:
                create_box($win, FALSE);
                --$win->starty;
                create_box($win, TRUE);
                break;
            case NCurses::KEY_DOWN:
                create_box($win, FALSE);
                ++$win->starty;
                create_box($win, TRUE);
                break;
        }
    }
    $ncurses->endwin();            /* End curses mode		  */

    return 0;
}

function init_win_params(WIN $p_win): void
{
    global $ncurses;

    $p_win->height = 3;
    $p_win->width = 10;
    $p_win->starty = ($ncurses->LINES() - $p_win->height) / 2;
    $p_win->startx = ($ncurses->COLS() - $p_win->width) / 2;

    $p_win->border->ls = '|';
    $p_win->border->rs = '|';
    $p_win->border->ts = '-';
    $p_win->border->bs = '-';
    $p_win->border->tl = '+';
    $p_win->border->tr = '+';
    $p_win->border->bl = '+';
    $p_win->border->br = '+';
}

function print_win_params(WIN $p_win): void
{
    global $ncurses;
    $ncurses->mvprintw(25, 0, "%d %d %d %d", $p_win->startx, $p_win->starty, $p_win->width, $p_win->height);
    $ncurses->refresh();
}

function create_box(WIN $p_win, bool $flag): void
{
    global $ncurses;

    $x = $p_win->startx;
    $y = $p_win->starty;
    $w = $p_win->width;
    $h = $p_win->height;

    if ($flag == TRUE) {
        $ncurses->mvaddch($y, $x, $p_win->border->tl);
        $ncurses->mvaddch($y, $x + $w, $p_win->border->tr);
        $ncurses->mvaddch($y + $h, $x, $p_win->border->bl);
        $ncurses->mvaddch($y + $h, $x + $w, $p_win->border->br);
        $ncurses->mvhline($y, $x + 1, $p_win->border->ts, $w - 1);
        $ncurses->mvhline($y + $h, $x + 1, $p_win->border->bs, $w - 1);
        $ncurses->mvvline($y + 1, $x, $p_win->border->ls, $h - 1);
        $ncurses->mvvline($y + 1, $x + $w, $p_win->border->rs, $h - 1);

    } else
        for ($j = $y; $j <= $y + $h; ++$j)
            for ($i = $x; $i <= $x + $w; ++$i)
                $ncurses->mvaddch($j, $i, ' ');

    $ncurses->refresh();
}

return main($argc, $argv);
