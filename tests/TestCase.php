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

    public static function assertStringContainsString($needle, $haystack, $message = ''): void
    {
        if (version_compare(self::phpunitVersion(), '7.0.0', '<')) {
            parent::assertContains($needle, $haystack, $message);
        } else {
            parent::assertStringContainsString($needle, $haystack, $message);
        }
    }

    public static function assertMatchesRegularExpression($pattern, $string, $message = ''): void
    {
        if (version_compare(self::phpunitVersion(), '9.0.0', '<')) {
            parent::assertRegExp($pattern, $string);
        } else {
            parent::assertMatchesRegularExpression($pattern, $string);
        }
    }
}
