<?php

namespace bviguier\ncurses;

class Window
{
    public function __construct(\FFI\CData $cdata)
    {
        $this->cdata = $cdata;
    }

    public function cdata(): \FFI\CData
    {
        return $this->cdata;
    }

    private \FFI\CData $cdata;
}
