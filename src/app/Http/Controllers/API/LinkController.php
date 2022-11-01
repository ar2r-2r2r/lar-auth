<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreateLinkRequest;
use App\Http\Requests\GetOriginalLinkRequest;
use App\Http\Requests\GetUserLinksRequest;
use App\Http\Requests\UpdateDelLinkRequest;
use App\Interfaces\LinkServiceInterface;
use Illuminate\Http\Request;

class LinkController extends Controller
{
    private LinkServiceInterface $linkService;

    public function __construct(LinkServiceInterface $linkService)
    {
        $this->linkService=$linkService;
    }
    public function createLink(CreateLinkRequest $request)
    {
        return $this->linkService->createLink($request);
    }
    public function updateLink(UpdateDelLinkRequest $request)
    {
        return $this->linkService->updateLink($request);
    }
    public function deleteLink(UpdateDelLinkRequest $request)
    {
        return $this->linkService->deleteLink($request);
    }
    public function getUserLinks(GetUserLinksRequest $request)
    {
        return $this->linkService->getUserLinks($request);
    }
    public function getOriginalLink(GetOriginalLinkRequest $request)
    {
        return $this->linkService->getOriginalLink($request);
    }
}
