<?php
declare(strict_types=1);

namespace App\Helper;

class Util
{
    public static function generateShortLink(): string
    {
        $letters = 'qwertyuiopasdfghjkl1234567890';
        $count = strlen($letters);
        $intval = time();
        $result = '';
        for ($i = 0; $i < 3; $i++) {
            $last = $intval % $count;
            $intval = ($intval - $last) / $count;
            $result .= $letters[$last];
            $random = rand(0, 10);
            $result .= $letters[$random];
        }

        return $result;
    }

    public function generateShort(): string
    {
        $letters = 'qwertyuiopasdfghjkl1234567890';
        $count = strlen($letters);
        $intval = time();
        $result = '';
        for ($i = 0; $i < 3; $i++) {
            $last = $intval % $count;
            $intval = ($intval - $last) / $count;
            $result .= $letters[$last];
            $random = rand(0, 10);
            $result .= $letters[$random];
        }

        return $result;
    }

}
