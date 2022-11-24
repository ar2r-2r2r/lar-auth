<?php
declare(strict_types=1);


namespace App\Http\Controllers\API;

use App\Events\CreateLinkSuccessful;
use App\Events\DelLinkSuccessful;
use App\Events\UpdateLinkSuccessful;
use App\Exceptions\LinkExceptions\LinkIdNotExistsException;
use App\Exceptions\LinkExceptions\OriginalLinkAlreadyExistsException;
use App\Exceptions\LinkExceptions\ShortCodeNotExists;
use App\Exceptions\LinkExceptions\UserIdNotExistsException;
use App\Http\Controllers\Controller;
use App\Http\Requests\CreateLinkRequest;
use App\Http\Requests\GetOriginalLinkRequest;
use App\Http\Requests\GetUserLinksRequest;
use App\Http\Requests\UpdateDelLinkRequest;
use App\Interfaces\LinkServiceProxyInterface;
use App\Interfaces\UserServiceInterface;

class LinkController extends Controller
{
    private LinkServiceProxyInterface $linkServiceProxy;
    private UserServiceInterface $userService;
    private int|string $currentUserId;

    public function __construct(
        LinkServiceProxyInterface $linkServiceProxy,
        UserServiceInterface $userService
    ) {
        $this->linkServiceProxy = $linkServiceProxy;
        $this->userService = $userService;
        $this->currentUserId = $this->userService->getId();
    }

    public function createLink(CreateLinkRequest $request)
    {
        try {
            $request->validated();
            $linkDetails = $request->getLinkDetails($request);

            $result = $this->linkServiceProxy->createLink($linkDetails,
                $this->currentUserId);
            CreateLinkSuccessful::dispatch($this->currentUserId);

            return response()->json($result, 201);
        } catch (OriginalLinkAlreadyExistsException $exception) {
            return response()->json($exception->getMessage(), 500);
        }

    }

    public function updateLink(UpdateDelLinkRequest $request)
    {
        try {
            $request->validated();
            $request->setLinkId($request->linkId);
            $result = $this->linkServiceProxy->updateLink($request->getLinkId(),
                $this->currentUserId);
            UpdateLinkSuccessful::dispatch($this->currentUserId);

            return response()->json($result, 200);
        } catch (LinkIdNotExistsException $exception) {
            return response()->json($exception->getMessage(), 500);
        }

    }

    public function deleteLink(UpdateDelLinkRequest $request)
    {
        try {
            $request->validated();
            $request->setLinkId($request->linkId);
            $result = $this->linkServiceProxy->deleteLink($request->getLinkId(),
                $this->currentUserId);
            DelLinkSuccessful::dispatch($this->currentUserId);

            return response()->json("Deleted", 200);
        } catch (LinkIdNotExistsException $exception) {
            return response()->json($exception->getMessage(), 500);
        }
    }

    public function getUserLinks(GetUserLinksRequest $request)
    {
        try {
            $request->validated();
            $request->setUserId($request->userId);

            $result
                = $this->linkServiceProxy->getUserLinks($request->getUserId(),
                $this->currentUserId);

            return response()->json($result, 200);
        } catch (UserIdNotExistsException $exception) {
            return response()->json($exception->getMessage(), 500);
        }
    }

    public function getOriginalLink(GetOriginalLinkRequest $request)
    {
        try {
            $request->validated();
            $request->setShortCode($request->shortCode);
            $result
                = $this->linkServiceProxy->getOriginalLink($request->getShortCode(),
                $this->currentUserId);

            return response()->json($result, 200);
        } catch (ShortCodeNotExists $exception) {
            return response()->json($exception->getMessage(), 500);
        }

    }
}
