<?php
declare(strict_types=1);

namespace App\Services;

use Illuminate\Support\Facades\Cache;

class CacheService
{

    public function __construct()
    {
    }

    public function putCache($userId, $originalUrl, $shortCode)
    {
        if (($result = Cache::get($userId)) != 0) {
            $result[] = [
                "OriginalUrl" => $originalUrl,
                "ShortCode:" => $shortCode,
            ];
            Cache::put($userId, $result, 600);
        } else {
            Cache::put($userId, [$originalUrl, $shortCode], 600);
        }

    }

    public function getCache($userId)
    {
        return Cache::get($userId);

    }


}