<?php

namespace FaizShukri\Quran\Exceptions;

use Exception;

class AyahNotProvided extends Exception
{
    protected $message = 'Ayah argument is incorrect. Provide ayah with this format, \'<surah_no>:<ayah>\'';
}
