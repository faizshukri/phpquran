<?php

namespace Test;

use PHPUnit\Framework\TestCase as PHPUnitTestCase;

class TestCase extends PHPUnitTestCase
{
    protected static function phpunitVersion()
    {
        if (class_exists('PHPUnit_Runner_Version')) {
            return \PHPUnit_Runner_Version::id();
        }

        return \PHPUnit\Runner\Version::id();
    }

    public static function assertStringContainsString2($needle, $haystack, $message = '')
    {
        if (version_compare(self::phpunitVersion(), '6.0.0', '<')) {
            $constraint = new \PHPUnit_Framework_Constraint_StringContains($needle, false);
        } else {
            $constraint = new \PHPUnit\Framework\Constraint\StringContains($needle, false);
        }

        parent::assertThat($haystack, $constraint, $message);
    }

    public static function assertMatchesRegularExpression2($pattern, $string, $message = '')
    {
        if (version_compare(self::phpunitVersion(), '9.0.0', '<')) {
            parent::assertRegExp($pattern, $string);
        } else {
            parent::assertMatchesRegularExpression($pattern, $string);
        }
    }
}
