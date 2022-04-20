<?php

use FaizShukri\Quran\Supports\Config;
use FaizShukri\Quran\Supports\Downloader;
use PHPUnit\Framework\TestCase;

class DownloaderTest extends TestCase
{
    private $dw;

    /**
     * @before
     */
    protected function initialize()
    {
        $this->dw = new Downloader(new Config());
    }

    public function test_cleanxml()
    {
        $file = __DIR__ . '/test-translation.xml';
        $str = '
<?xml version="1.0" encoding="utf-8" ?>
<!--

# -------------------
#
#  Quran Translation
#
# -------------------

-->
<quran>
    <sura index="1">
        <aya index="1" />
    </sura>
</quran>
';

        $strExpect = '
<?xml version="1.0" encoding="utf-8" ?>
<!--

# ===================
#
#  Quran Translation
#
# ===================

-->
<quran>
    <sura index="1">
        <aya index="1" />
    </sura>
</quran>
';
        file_put_contents($file, $str);
        $this->dw->cleanXML($file);
        $str = file_get_contents($file);
        unlink($file);

        $this->assertEquals($str, $strExpect);
    }
}
