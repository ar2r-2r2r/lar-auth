<?php

namespace App\Interfaces;

use App\Http\Requests\CreateLinkRequest;
use App\Http\Requests\GetOriginalLinkRequest;
use App\Http\Requests\GetUserLinksRequest;
use App\Http\Requests\UpdateDelLinkRequest;
use Illuminate\Http\Request;

interface LinkServiceInterface
{
    public function createLink(CreateLinkRequest $request);
    public function updateLink(UpdateDelLinkRequest $request);
    public function deleteLink(UpdateDelLinkRequest $request);
    public function getUserLinks(GetUserLinksRequest $request);
    public function getOriginalLink(GetOriginalLinkRequest $request);
}
