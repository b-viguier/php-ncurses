#!/usr/bin/env php
<?php

require __DIR__.'/../vendor/autoload.php';

use bviguier\ncurses\NCurses;
use bviguier\ncurses\Window;
use bviguier\ncurses\MEvent;

$ncurses = NCurses::create();

// https://tldp.org/HOWTO/NCURSES-Programming-HOWTO/mouse.html

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

function main(): int
{
    global $ncurses, $startx, $starty, $choices;

    $choice = 0;
    $event = new MEvent();

    /* Initialize curses */
    $ncurses->initscr();
    $ncurses->clear();
    $ncurses->noecho();
    $ncurses->cbreak();    //Line buffering disabled. pass on everything

    /* Try to put the window in the middle of screen */
    $startx = (80 - WIDTH) / 2;
    $starty = (24 - HEIGHT) / 2;

    $ncurses->attron(NCurses::A_REVERSE);
    $ncurses->mvprintw(23, 1, "Click on Exit to quit (Works best in a virtual console)");
    $ncurses->refresh();
    $ncurses->attroff(NCurses::A_REVERSE);

    /* Print the menu for the first time */
    $menu_win = $ncurses->newwin(HEIGHT, WIDTH, $starty, $startx);
    $ncurses->keypad($menu_win, true);
    print_menu($menu_win, 1);
    /* Get all the mouse events */
    $ncurses->mousemask(NCurses::ALL_MOUSE_EVENTS);

    while (1) {
        $c = $ncurses->wgetch($menu_win);
        switch ($c) {
            case NCurses::KEY_MOUSE:
                if ($ncurses->getmouse($event) == NCurses::OK) {    /* When the user clicks left mouse button */
                    if ($event->bstate & NCurses::BUTTON1_CLICKED) {
                        report_choice($event->x + 1, $event->y + 1, $choice);
                        if ($choice == -1) //Exit chosen
                            goto end;
                        $ncurses->mvprintw(22, 1, "Choice made is : %d String Chosen is \"%10s\"", $choice, $choices[$choice - 1]);
                        $ncurses->refresh();
                    }
                }
                print_menu($menu_win, $choice);
                break;
        }
    }
    end:
    $ncurses->endwin();

    return 0;
}


function print_menu(Window $menu_win, int $highlight): void
{
    global $ncurses, $choices, $n_choices;
    $x = 2;
    $y = 2;
    $ncurses->box($menu_win, 0, 0);
    for ($i = 0; $i < $n_choices; ++$i) {
        if ($highlight == $i + 1) {
            $ncurses->wattron($menu_win, NCurses::A_REVERSE);
            $ncurses->mvwprintw($menu_win, $y, $x, "%s", $choices[$i]);
            $ncurses->wattroff($menu_win, NCurses::A_REVERSE);
        } else
            $ncurses->mvwprintw($menu_win, $y, $x, "%s", $choices[$i]);
        ++$y;
    }
    $ncurses->wrefresh($menu_win);
}

/* Report the choice according to mouse position */
function report_choice(int $mouse_x, int $mouse_y, int &$p_choice): void
{
    global $startx, $starty, $choices, $n_choices;

    $i = $startx + 2;
    $j = $starty + 3;

    for ($choice = 0; $choice < $n_choices; ++$choice)
        if ($mouse_y == $j + $choice && $mouse_x >= $i && $mouse_x <= $i + strlen($choices[$choice])) {
            if ($choice == $n_choices - 1)
                $p_choice = -1;
            else
                $p_choice = $choice + 1;
            break;
        }
}

return main();
