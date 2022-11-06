<?php

namespace Tests\Unit;

use App\Helper\Util;
use PHPUnit\Framework\TestCase;

class GenerateShortLinkTest extends TestCase
{
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function test_generation_short_link()
    {
        $shortLink=Util::generateShortLink();
        $this->assertMatchesRegularExpression("/.{6}/", $shortLink);        //check for only 6 symbols
    }
}
