<?php

namespace bviguier\ncurses;

class NCurses
{
    /**
     * @throws \Exception
     */
    static public function create(): self
    {
        switch (PHP_OS_FAMILY) {
            case 'Darwin':
                return self::createFromLibraryName('libncurses.dylib');
            case 'Linux':
                return self::createFromLibraryName('libncurses.so');
        }

        throw new \Exception('No default NCurses library configured for your OS.');
    }

    /**
     * @throws \Exception
     */
    static public function createFromLibraryName(string $libraryName): self
    {
        if (false === $headers = file_get_contents(__DIR__.DIRECTORY_SEPARATOR.'internal'.DIRECTORY_SEPARATOR.'ncurses.h')) {
            throw new \Exception('Unable to read bundled ncurses.h header file.');
        }

        return new self(\FFI::cdef($headers, $libraryName));
    }

    public const OK = 0;
    public const ERR = -1;

    public const COLOR_BLACK = 0;
    public const COLOR_RED = 1;
    public const COLOR_GREEN = 2;
    public const COLOR_YELLOW = 3;
    public const COLOR_BLUE = 4;
    public const COLOR_MAGENTA = 5;
    public const COLOR_CYAN = 6;
    public const COLOR_WHITE = 7;

    public const A_NORMAL = 0;
    public const A_ATTRIBUTES = ~0 << 8;
    public const A_CHARTEXT = 1 << 8 - 1;
    public const A_COLOR = self::A_CHARTEXT << 8;
    public const A_STANDOUT = 1 << (8 + 8);
    public const A_UNDERLINE = 1 << (8 + 9);
    public const A_REVERSE = 1 << (8 + 10);
    public const A_BLINK = 1 << (8 + 11);
    public const A_DIM = 1 << (8 + 12);
    public const A_BOLD = 1 << (8 + 13);
    public const A_ALTCHARSET = 1 << (8 + 14);
    public const A_INVIS = 1 << (8 + 15);
    public const A_PROTECT = 1 << (8 + 16);
    public const A_HORIZONTAL = 1 << (8 + 17);
    public const A_LEFT = 1 << (8 + 18);
    public const A_LOW = 1 << (8 + 19);
    public const A_RIGHT = 1 << (8 + 20);
    public const A_TOP = 1 << (8 + 21);
    public const A_VERTICAL = 1 << (8 + 22);
    public const A_ITALIC = 1 << (8 + 23);

    public const KEY_DOWN = 0402;  /* down-arrow key */
    public const KEY_UP = 0403;  /* up-arrow key */
    public const KEY_LEFT = 0404;  /* left-arrow key */
    public const KEY_RIGHT = 0405;  /* right-arrow key */
    public const KEY_HOME = 0406;  /* home key */
    public const KEY_BACKSPACE = 0407;  /* backspace key */
    public const KEY_F0 = 0410;  /* Function keys.  Space for 64 */
    public const KEY_DL = 0510;  /* delete-line key */
    public const KEY_IL = 0511;  /* insert-line key */
    public const KEY_DC = 0512;  /* delete-character key */
    public const KEY_IC = 0513;  /* insert-character key */
    public const KEY_EIC = 0514;  /* sent by rmir or smir in insert mode */
    public const KEY_CLEAR = 0515;  /* clear-screen or erase key */
    public const KEY_EOS = 0516;  /* clear-to-end-of-screen key */
    public const KEY_EOL = 0517;  /* clear-to-end-of-line key */
    public const KEY_SF = 0520;  /* scroll-forward key */
    public const KEY_SR = 0521;  /* scroll-backward key */
    public const KEY_NPAGE = 0522;  /* next-page key */
    public const KEY_PPAGE = 0523;  /* previous-page key */
    public const KEY_STAB = 0524;  /* set-tab key */
    public const KEY_CTAB = 0525;  /* clear-tab key */
    public const KEY_CATAB = 0526;  /* clear-all-tabs key */
    public const KEY_ENTER = 0527;  /* enter/send key */
    public const KEY_PRINT = 0532;  /* print key */
    public const KEY_LL = 0533;  /* lower-left key (home down) */
    public const KEY_A1 = 0534;  /* upper left of keypad */
    public const KEY_A3 = 0535;  /* upper right of keypad */
    public const KEY_B2 = 0536;  /* center of keypad */
    public const KEY_C1 = 0537;  /* lower left of keypad */
    public const KEY_C3 = 0540;  /* lower right of keypad */
    public const KEY_BTAB = 0541;  /* back-tab key */
    public const KEY_BEG = 0542;  /* begin key */
    public const KEY_CANCEL = 0543;  /* cancel key */
    public const KEY_CLOSE = 0544;  /* close key */
    public const KEY_COMMAND = 0545;  /* command key */
    public const KEY_COPY = 0546;  /* copy key */
    public const KEY_CREATE = 0547;  /* create key */
    public const KEY_END = 0550;  /* end key */
    public const KEY_EXIT = 0551;  /* exit key */
    public const KEY_FIND = 0552;  /* find key */
    public const KEY_HELP = 0553;  /* help key */
    public const KEY_MARK = 0554;  /* mark key */
    public const KEY_MESSAGE = 0555;  /* message key */
    public const KEY_MOVE = 0556;  /* move key */
    public const KEY_NEXT = 0557;  /* next key */
    public const KEY_OPEN = 0560;  /* open key */
    public const KEY_OPTIONS = 0561;  /* options key */
    public const KEY_PREVIOUS = 0562;  /* previous key */
    public const KEY_REDO = 0563;  /* redo key */
    public const KEY_REFERENCE = 0564;  /* reference key */
    public const KEY_REFRESH = 0565;  /* refresh key */
    public const KEY_REPLACE = 0566;  /* replace key */
    public const KEY_RESTART = 0567;  /* restart key */
    public const KEY_RESUME = 0570;  /* resume key */
    public const KEY_SAVE = 0571;  /* save key */
    public const KEY_SBEG = 0572;  /* shifted begin key */
    public const KEY_SCANCEL = 0573;  /* shifted cancel key */
    public const KEY_SCOMMAND = 0574;  /* shifted command key */
    public const KEY_SCOPY = 0575;  /* shifted copy key */
    public const KEY_SCREATE = 0576;  /* shifted create key */
    public const KEY_SDC = 0577;  /* shifted delete-character key */
    public const KEY_SDL = 0600;  /* shifted delete-line key */
    public const KEY_SELECT = 0601;  /* select key */
    public const KEY_SEND = 0602;  /* shifted end key */
    public const KEY_SEOL = 0603;  /* shifted clear-to-end-of-line key */
    public const KEY_SEXIT = 0604;  /* shifted exit key */
    public const KEY_SFIND = 0605;  /* shifted find key */
    public const KEY_SHELP = 0606;  /* shifted help key */
    public const KEY_SHOME = 0607;  /* shifted home key */
    public const KEY_SIC = 0610;  /* shifted insert-character key */
    public const KEY_SLEFT = 0611;  /* shifted left-arrow key */
    public const KEY_SMESSAGE = 0612;  /* shifted message key */
    public const KEY_SMOVE = 0613;  /* shifted move key */
    public const KEY_SNEXT = 0614;  /* shifted next key */
    public const KEY_SOPTIONS = 0615;  /* shifted options key */
    public const KEY_SPREVIOUS = 0616;  /* shifted previous key */
    public const KEY_SPRINT = 0617;  /* shifted print key */
    public const KEY_SREDO = 0620;  /* shifted redo key */
    public const KEY_SREPLACE = 0621;  /* shifted replace key */
    public const KEY_SRIGHT = 0622;  /* shifted right-arrow key */
    public const KEY_SRSUME = 0623;  /* shifted resume key */
    public const KEY_SSAVE = 0624;  /* shifted save key */
    public const KEY_SSUSPEND = 0625;  /* shifted suspend key */
    public const KEY_SUNDO = 0626;  /* shifted undo key */
    public const KEY_SUSPEND = 0627;  /* suspend key */
    public const KEY_UNDO = 0630;  /* undo key */
    public const KEY_MOUSE = 0631;  /* Mouse event has occurred */
    public const KEY_RESIZE = 0632;  /* Terminal resize event */
    public const KEY_EVENT = 0633;  /* We were interrupted by an event */
    public const KEY_MAX = 0777;  /* Maximum key value is 0633 */

    public function KEY_F(int $n): int
    {
        return self::KEY_F0 + $n; /* Value of function key n */
    }

    public function initscr(): Window
    {
        return new Window($this->ffi->initscr());
    }

    public function printw(string $fmt, ...$args): int
    {
        return $this->ffi->printw($fmt, ...$args);
    }

    public function mvprintw(int $y, int $x, string $fmt, ...$args): int
    {
        return $this->ffi->mvprintw($y, $y, $fmt, ...$args);
    }

    public function refresh(): int
    {
        return $this->ffi->refresh();
    }

    public function getch(): int
    {
        return $this->ffi->getch();
    }

    public function getstr(string &$str): int
    {
        if(0 === $length = strlen($str)) {
            return self::ERR;
        }

        $buffer = $this->ffi->new("char[$length]");
        $result = $this->ffi->getstr($buffer);
        $str = \FFI::string($buffer);

        return $result;
    }

    public function endwin(): int
    {
        return $this->ffi->endwin();
    }

    public function stdscr(): Window
    {
        return new Window($this->ffi->stdscr);
    }

    public function LINES(): int
    {
        return $this->ffi->LINES;
    }

    public function raw(): int
    {
        return $this->ffi->raw();
    }

    public function noecho(): int
    {
        return $this->ffi->noecho();
    }

    public function keypad(Window $win, bool $bf): int
    {
        return $this->ffi->keypad($win->cdata(), $bf);
    }

    public function attroff(int $attrs): int
    {
        return $this->ffi->attroff($attrs);
    }

    public function attron(int $attrs): int
    {
        return $this->ffi->attron($attrs);
    }

    public function attrset(int $attrs): int
    {
        return $this->ffi->attrset($attrs);
    }

    public function getattrs(Window $win): int
    {
        return $this->ffi->getattrs($win->cdata());
    }

    public function getcurx(Window $win): int
    {
        return $this->ffi->getcurx($win->cdata());
    }

    public function getcury(Window $win): int
    {
        return $this->ffi->getcury($win->cdata());
    }

    public function getbegx(Window $win): int
    {
        return $this->ffi->getbegx($win->cdata());
    }

    public function getbegy(Window $win): int
    {
        return $this->ffi->getbegy($win->cdata());
    }

    public function getmaxx(Window $win): int
    {
        return $this->ffi->getmaxx($win->cdata());
    }

    public function getmaxy(Window $win): int
    {
        return $this->ffi->getmaxy($win->cdata());
    }

    public function getparx(Window $win): int
    {
        return $this->ffi->getparx($win->cdata());
    }

    public function getpary(Window $win): int
    {
        return $this->ffi->getpary($win->cdata());
    }

    public function getyx(Window $win, int &$y, int &$x): void
    {
        $y = $this->getcury($win);
        $x = $this->getcurx($win);
    }

    public function getbegyx(Window $win, int &$y, int &$x): void
    {
        $y = $this->getbegy($win);
        $x = $this->getbegx($win);
    }

    public function getmaxyx(Window $win, int &$y, int &$x): void
    {
        $y = $this->getmaxy($win);
        $x = $this->getmaxx($win);
    }

    public function getparyx(Window $win, int &$y, int &$x): void
    {
        $y = $this->getpary($win);
        $x = $this->getparx($win);
    }

    public function clear(): int
    {
        return $this->ffi->clear();
    }

    public function move(int $y, int $x): int
    {
        return $this->ffi->move($y, $x);
    }

    private \FFI $ffi;

    private function __construct(\FFI $ffi)
    {
        $this->ffi = $ffi;
    }
}
