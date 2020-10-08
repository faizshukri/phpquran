<?php

namespace FaizShukri\Quran\Exceptions;

use Exception;

class WrongArgument extends Exception
{
    protected $message = 'Surah / Ayah format is incorrect. Please try again.';
}
