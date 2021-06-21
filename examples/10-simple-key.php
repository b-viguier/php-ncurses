#!/usr/bin/env php
<?php

require __DIR__.'/../vendor/autoload.php';

use bviguier\ncurses\NCurses;
use bviguier\ncurses\Window;

$ncurses = NCurses::create();

// https://tldp.org/HOWTO/NCURSES-Programming-HOWTO/keys.html

const WIDTH = 30;
const HEIGHT = 10;

$startx = 0;
$starty = 0;

$choices = [
    "Choice 1",
    "Choice 2",
    "Choice 3",
    "Choice 4",
    "Exit",
];
$n_choices = count($choices);


function print_menu(Window $menu_win, int $highlight): void
{
    global $ncurses, $n_choices, $choices;

    $x = 2;
    $y = 2;
    $ncurses->box($menu_win, 0, 0);
    for ($i = 0; $i < $n_choices; ++$i) {
        if ($highlight == $i + 1) /* High light the present choice */ {
            $ncurses->wattron($menu_win, NCurses::A_REVERSE);
            $ncurses->mvwprintw($menu_win, $y, $x, "%s", $choices[$i]);
            $ncurses->wattroff($menu_win, NCurses::A_REVERSE);
        } else
            $ncurses->mvwprintw($menu_win, $y, $x, "%s", $choices[$i]);
        ++$y;
    }
    $ncurses->wrefresh($menu_win);
}

$highlight = 1;
$choice = 0;
$ncurses->initscr();
$ncurses->clear();
$ncurses->noecho();
$ncurses->cbreak();    /* Line buffering disabled. pass on everything */
$ncurses->startx = (80 - WIDTH) / 2;
$ncurses->starty = (24 - HEIGHT) / 2;

$menu_win = $ncurses->newwin(HEIGHT, WIDTH, $starty, $startx);
$ncurses->keypad($menu_win, TRUE);
$ncurses->mvprintw(0, 0, "Use arrow keys to go up and down, Press enter to select a choice");
$ncurses->refresh();
print_menu($menu_win, $highlight);
while (1) {
    $c = $ncurses->wgetch($menu_win);
    switch ($c) {
        case NCurses::KEY_UP:
            if ($highlight == 1)
                $highlight = $n_choices;
            else
                --$highlight;
            break;
        case NCurses::KEY_DOWN:
            if ($highlight == $n_choices)
                $highlight = 1;
            else
                ++$highlight;
            break;
        case 10:
            $choice = $highlight;
            break;
        default:
            $ncurses->mvprintw(24, 0, "Character pressed is = %3d Hopefully it can be printed as '%c'", $c, $c);
            $ncurses->refresh();
            break;
    }
    print_menu($menu_win, $highlight);
    if ($choice != 0)    /* User did a choice come out of the infinite loop */
        break;
}
$ncurses->mvprintw(23, 0, "You chose choice %d with choice string %s\n", $choice, $choices[$choice - 1]);
$ncurses->clrtoeol();
$ncurses->refresh();
$ncurses->endwin();
