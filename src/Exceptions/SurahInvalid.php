<?php

namespace FaizShukri\Quran\Exceptions;

use Exception;

class SurahInvalid extends Exception
{
    protected $message = 'Surah number is invalid.';
}
