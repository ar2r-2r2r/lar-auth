<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreateLinkRequest;
use App\Http\Requests\GetOriginalLinkRequest;
use App\Http\Requests\GetUserLinksRequest;
use App\Http\Requests\UpdateDelLinkRequest;
use App\Interfaces\LinkServiceInterface;
use App\Models\LinkDetails;
use Illuminate\Http\Request;

class LinkController extends Controller
{
    private LinkServiceInterface $linkService;

    private LinkDetails $linkDetails;

    public function __construct(LinkServiceInterface $linkService, LinkDetails $linkDetails)
    {
        $this->linkService=$linkService;
        $this->linkDetails=$linkDetails;
    }
    public function createLink(CreateLinkRequest $request)
    {
        $request->validated();
        $request->set($request, $this->linkDetails);
        return $this->linkService->createLink($this->linkDetails);
    }
    public function updateLink(UpdateDelLinkRequest $request)
    {
        $request->validated();
        return $this->linkService->updateLink($request->id,$request->shortLink);
    }
    public function deleteLink(UpdateDelLinkRequest $request)
    {
        $request->validated();
        return $this->linkService->deleteLink($request->id);
    }
    public function getUserLinks(GetUserLinksRequest $request)
    {
        $request->validated();
        return $this->linkService->getUserLinks($request->userId);
    }
    public function getOriginalLink(GetOriginalLinkRequest $request)
    {
        $request->validated();
        return $this->linkService->getOriginalLink($request->shortCode);
    }
}
