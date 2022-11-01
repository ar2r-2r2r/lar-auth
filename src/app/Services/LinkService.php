<?php

namespace App\Services;

use App\Helper\Util;
use App\Http\Requests\CreateLinkRequest;
use App\Http\Requests\GetOriginalLinkRequest;
use App\Http\Requests\GetUserLinksRequest;
use App\Http\Requests\UpdateDelLinkRequest;
use App\Interfaces\LinkRepositoryInterface;
use App\Interfaces\LinkServiceInterface;
use App\Models\LinkDetails;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Arr;

class LinkService implements LinkServiceInterface
{
    private LinkRepositoryInterface $linkRepository;
    protected LinkDetails $linkDetails;

    public function __construct(LinkRepositoryInterface $linkRepository, LinkDetails $linkDetails)
    {
        $this->linkRepository=$linkRepository;
        $this->linkDetails=$linkDetails;
    }
    public function createLink(CreateLinkRequest $request)
    {
        $request->validated();
        $this->linkDetails->setOriginalUrl($request->originalUrl);
        $this->linkDetails->setIsPublic($request->isPublic);
        $id=auth()->user()->id;
        $shortLink=Util::generateShortLink();
        $result=$this->linkRepository->create($id,$shortLink,$this->linkDetails);
        return $result;
    }
    public function updateLink(UpdateDelLinkRequest $request)
    {
        $request->validated();
        $linkId=$request->linkId;
        $shortLink=Util::generateShortLink();
        $result=$this->linkRepository->update($linkId,$shortLink,$this->linkDetails);
        return $result;
    }

    public function deleteLink(UpdateDelLinkRequest $request)
    {
        $request->validated();
        $this->linkRepository->delete($request->linkId);
    }

    public function getUserLinks(GetUserLinksRequest $request)
    {
        $request->validated();
        $userLinks=$this->linkRepository->getAllByUser($request->userId);
        return $userLinks;
    }

    public function getOriginalLink(GetOriginalLinkRequest $request)
    {
        $request->validated();
        $shortCode=$request->shortCode;
        $originalUrl=$this->linkRepository->getByShortCode($shortCode);
        return $originalUrl;
    }


}
