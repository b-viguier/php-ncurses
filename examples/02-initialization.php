#!/usr/bin/env php
<?php

require __DIR__.'/../vendor/autoload.php';

use bviguier\ncurses\NCurses;

$ncurses = NCurses::create();

// https://tldp.org/HOWTO/NCURSES-Programming-HOWTO/init.html

$ncurses->initscr();                            /* Start curses mode   */
$ncurses->raw();                                /* Line buffering disabled */
$ncurses->keypad($ncurses->stdscr(), true); /* We get F1, F2 etc..  */
$ncurses->noecho();                             /* Don't echo() while we do getch */

$ncurses->printw("Type any character to see it in bold\n");
$ch = $ncurses->getch();            /* If raw() hadn't been called
                                    * we have to press enter before it
                                    * gets to the program   */
if ($ch == $ncurses->KEY_F(1)) {         /* Without keypad enabled this will */
    $ncurses->printw("F1 Key pressed"); /*  not get to us either */
                                            /* Without noecho() some ugly escape
                                              * characters might have been printed
                                              * on screen   */
} else {
    $ncurses->printw("The pressed key is ");
    $ncurses->attron(NCurses::A_BOLD);
    $ncurses->printw("%c", $ch);
    $ncurses->attroff(NCurses::A_BOLD);
}

$ncurses->refresh();            /* Print it on to the real screen */
$ncurses->getch();            /* Wait for user input */
$ncurses->endwin();            /* End curses mode    */
