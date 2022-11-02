<?php

namespace App\Interfaces;

use App\Http\Requests\CreateLinkRequest;
use App\Http\Requests\GetOriginalLinkRequest;
use App\Http\Requests\GetUserLinksRequest;
use App\Http\Requests\UpdateDelLinkRequest;
use App\Models\LinkDetails;
use Illuminate\Http\Request;

interface LinkServiceInterface
{
    public function createLink(LinkDetails $linkDetails);
    public function updateLink(int|string $linkId,string $shortLink);
    public function deleteLink(int|string $linkId);
    public function getUserLinks(int|string $userId);
    public function getOriginalLink(string $shortCode);
}
