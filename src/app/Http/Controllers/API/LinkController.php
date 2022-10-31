<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Interfaces\LinkServiceInterface;
use Illuminate\Http\Request;

class LinkController extends Controller
{
    private LinkServiceInterface $linkService;

    public function __construct(LinkServiceInterface $linkService)
    {
        $this->linkService=$linkService;
    }
    public function createLink(Request $request)
    {
        return $this->linkService->createLink($request);
    }
    public function updateLink(Request $request)
    {
        return $this->linkService->updateLink($request);
    }
    public function getUserLinks(Request $request)
    {
        return $this->linkService->getUserLinks($request);
    }
    public function getOriginalLink(Request $request)
    {
        return $this->linkService->getOriginalLink($request);
    }
}
