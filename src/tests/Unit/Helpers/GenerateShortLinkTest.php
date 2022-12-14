<?php

namespace Tests\Unit;

use App\Helper\Util;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;

class GenerateShortLinkTest extends TestCase
{
    /**
     * A basic unit test example.
     *
     * @return void
     */

    use DatabaseMigrations;


    public function test_find_modelLink_by_Id()
    {
        $shortLink = Util::generateShortLink();
        $this->assertMatchesRegularExpression("/.{6}/",
            $shortLink);        //check for only 6 symbols
    }


}
