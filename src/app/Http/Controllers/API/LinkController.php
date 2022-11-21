<?php
declare(strict_types=1);


namespace App\Http\Controllers\API;

use App\Events\CreateLinkSuccessful;
use App\Events\DelLinkSuccessful;
use App\Events\UpdateLinkSuccessful;
use App\Http\Controllers\Controller;
use App\Http\Requests\CreateLinkRequest;
use App\Http\Requests\GetOriginalLinkRequest;
use App\Http\Requests\GetUserLinksRequest;
use App\Http\Requests\UpdateDelLinkRequest;
use App\Interfaces\LinkServiceInterface;
use App\Interfaces\UserServiceInterface;

class LinkController extends Controller
{
    private LinkServiceInterface $linkService;
    private UserServiceInterface $userService;

    public function __construct(LinkServiceInterface $linkService, UserServiceInterface $userService)
    {
        $this->linkService=$linkService;
        $this->userService=$userService;
    }
    public function createLink(CreateLinkRequest $request)
    {
        try {
            $request->validated();
            $linkDetails=$request->getLinkDetails($request);
            $currentUserId=$this->userService->getId();
            $result = $this->linkService->createLink($linkDetails,$currentUserId);
            CreateLinkSuccessful::dispatch(auth()->user());
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
            UpdateLinkSuccessful::dispatch(auth()->user());
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
            DelLinkSuccessful::dispatch(auth()->user());
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
            $currentUserId=$this->userService->getId();
            return $this->linkService->getOriginalLink($request->shortCode,$currentUserId);
        }catch (\Exception $exception){
            return $exception->getMessage();
        }

    }
}
