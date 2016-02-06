<?php

namespace FaizShukri\Quran\Exceptions;

use Exception;

class AyahInvalid extends Exception
{
    protected $message = 'Ayah number is invalid.';
}
