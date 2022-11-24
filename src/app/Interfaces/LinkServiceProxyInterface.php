<?php
declare(strict_types=1);

namespace App\Interfaces;

use App\Models\LinkDetails;

interface LinkServiceProxyInterface
{
    public function createLink(
        LinkDetails $linkDetails,
        int|string $currentUserId
    );

    public function updateLink(int|string $linkId, int|string $currentUserId);

    public function deleteLink(int|string $linkId, int|string $currentUserId);

    public function getUserLinks(int|string $userId, int|string $currentUserId);

    public function getOriginalLink(
        string $shortCode,
        int|string $currentUserId
    );

}
