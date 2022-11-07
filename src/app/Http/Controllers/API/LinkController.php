<?php

namespace App\Http\Controllers\API;

use App\Events\CreateLinkSuccessful;
use App\Events\DelLinkSuccessful;
use App\Events\UpdateLinkSuccessful;
use App\Exceptions\OriginalLinkAlreadyExistsException;
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
        try {
            $request->validated();
            $request->set($request, $this->linkDetails);
            $result = $this->linkService->createLink($this->linkDetails);
            CreateLinkSuccessful::dispatch(auth()->user()->email);
            return $result;
        }catch (\Exception $exception){
            return $exception->getMessage();
        }

    }
    public function updateLink(UpdateDelLinkRequest $request)
    {
        try{
            $request->validated();
            $result=$this->linkService->updateLink($request->linkId);
            UpdateLinkSuccessful::dispatch(auth()->user()->email);
            return $result;
        }catch (\Exception $exception){
            return $exception->getMessage();
        }

    }
    public function deleteLink(UpdateDelLinkRequest $request)
    {
        try{
            $request->validated();
            $result=$this->linkService->deleteLink($request->linkId);
            DelLinkSuccessful::dispatch(auth()->user()->email);
            return $result;
        }catch (\Exception $exception){
            return $exception->getMessage();
        }

    }
    public function getUserLinks(GetUserLinksRequest $request)
    {
        try{
            $request->validated();
            return $this->linkService->getUserLinks($request->userId);
        }catch (\Exception $exception){
            return $exception->getMessage();
        }
    }
    public function getOriginalLink(GetOriginalLinkRequest $request)
    {
        try{
            $request->validated();
            return $this->linkService->getOriginalLink($request->shortCode);
        }catch (\Exception $exception){
            return $exception->getMessage();
        }

    }
}
