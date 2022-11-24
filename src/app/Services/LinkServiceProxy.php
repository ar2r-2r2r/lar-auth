<?php
declare(strict_types=1);

namespace App\Services;

use App\Interfaces\LinkServiceProxyInterface;
use App\Models\LinkDetails;

class LinkServiceProxy implements LinkServiceProxyInterface
{
    private LinkService $linkService;
    private CacheService $cacheService;


    public function __construct(
        LinkService $linkService,
        CacheService $cacheService
    ) {
        $this->linkService = $linkService;
        $this->cacheService = $cacheService;
    }


    public function createLink(
        LinkDetails $linkDetails,
        int|string $currentUserId
    ) {
        $result = $this->linkService->createLink($linkDetails, $currentUserId);
        $this->cacheService->putCache($result->userId, $result->originalUrl,
            $result->shortCode);

        return $result;
    }

    public function updateLink(int|string $linkId, int|string $currentUserId)
    {
        $result = $this->linkService->updateLink($linkId, $currentUserId);
        $this->cacheService->putCache($result->userId, $result->originalUrl,
            $result->shortCode);

        return $result;
    }

    public function deleteLink(int|string $linkId, int|string $currentUserId)
    {
        $this->linkService->deleteLink($linkId, $currentUserId);
    }

    public function getUserLinks(int|string $userId, int|string $currentUserId)
    {
        if($this->cacheService->getCache($currentUserId)===null)
            $result=$this->linkService->getUserLinks($userId,$currentUserId);
        else
        $result = $this->cacheService->getCache($currentUserId);

        return $result;
    }

    public function getOriginalLink(
        string $shortCode,
        int|string $currentUserId
    ) {
        return $this->linkService->getOriginalLink($shortCode, $currentUserId);
    }
}