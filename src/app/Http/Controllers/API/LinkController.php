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
use Exception;

class LinkController extends Controller
{
    private LinkServiceInterface $linkService;
    private UserServiceInterface $userService;
    private int|string $currentUserId;

    public function __construct(
        LinkServiceInterface $linkService,
        UserServiceInterface $userService
    ) {
        $this->linkService = $linkService;
        $this->userService = $userService;
        $this->currentUserId = $this->userService->getId();
    }

    public function createLink(CreateLinkRequest $request)
    {
        try {
            $request->validated();
            $linkDetails = $request->getLinkDetails($request);

            $result = $this->linkService->createLink($linkDetails,
                $this->currentUserId);
            CreateLinkSuccessful::dispatch(auth()->user());

            return $result;
        } catch (Exception $exception) {
            return $exception->getMessage();
        }

    }

    public function updateLink(UpdateDelLinkRequest $request)
    {
        try {
            $request->validated();
            $request->setLinkId($request->linkId);
            $result = $this->linkService->updateLink($request->getLinkId(),
                $this->currentUserId);
            UpdateLinkSuccessful::dispatch(auth()->user());

            return $result;
        } catch (Exception $exception) {
            return $exception->getMessage();
        }

    }

    public function deleteLink(UpdateDelLinkRequest $request)
    {
        try {
            $request->validated();
            $request->setLinkId($request->linkId);
            $result = $this->linkService->deleteLink($request->getLinkId(),
                $this->currentUserId);
            DelLinkSuccessful::dispatch(auth()->user());

            return $result;
        } catch (Exception $exception) {
            return $exception->getMessage();
        }
    }

    public function getUserLinks(GetUserLinksRequest $request)
    {
        try {
            $request->validated();
            $request->setUserId($request->userId);

            return $this->linkService->getUserLinks($request->getUserId(),
                $this->currentUserId);
        } catch (Exception $exception) {
            return $exception->getMessage();
        }
    }

    public function getOriginalLink(GetOriginalLinkRequest $request)
    {
        try {
            $request->validated();
            $request->setShortCode($request->shortCode);

            return $this->linkService->getOriginalLink($request->getShortCode(),
                $this->currentUserId);
        } catch (Exception $exception) {
            return $exception->getMessage();
        }

    }
}
