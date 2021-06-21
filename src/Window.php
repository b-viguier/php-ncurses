<?php

namespace bviguier\ncurses;

class Window
{
    /**
     * @internal Use NCurses::newwin
     */
    public function __construct(\FFI\CData $cdata)
    {
        $this->cdata = $cdata;
    }

    /**
     * @internal Use NCursess::w* functions
     */
    public function cdata(): \FFI\CData
    {
        return $this->cdata;
    }

    private \FFI\CData $cdata;
}
