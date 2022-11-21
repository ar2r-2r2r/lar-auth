<?php
declare(strict_types=1);

namespace App\Interfaces;

use App\Http\Requests\CreateLinkRequest;
use App\Http\Requests\GetOriginalLinkRequest;
use App\Http\Requests\GetUserLinksRequest;
use App\Http\Requests\UpdateDelLinkRequest;
use App\Models\LinkDetails;
use Illuminate\Http\Request;

interface LinkServiceInterface
{
    public function createLink(LinkDetails $linkDetails, int|string $currentUserId);
    public function updateLink(int|string $linkId);
    public function deleteLink(int|string $linkId);
    public function getUserLinks(int|string $userId);
    public function getOriginalLink(string $shortCode, int|string $currentUserId);

}
