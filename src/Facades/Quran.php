<?php

namespace FaizShukri\Quran\Facades;

use Illuminate\Support\Facades\Facade;

class Quran extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'quran';
    }
}
