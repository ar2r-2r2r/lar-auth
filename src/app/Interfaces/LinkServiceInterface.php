<?php
declare(strict_types=1);

namespace App\Interfaces;

use App\Models\LinkDetails;

interface LinkServiceInterface
{
    public function createLink(
        LinkDetails $linkDetails,
        int|string $currentUserId
    );

    public function updateLink(int|string $linkId);

    public function deleteLink(int|string $linkId);

    public function getUserLinks(int|string $userId);

    public function getOriginalLink(
        string $shortCode,
        int|string $currentUserId
    );

}
