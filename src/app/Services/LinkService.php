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
use App\Models\LinkModel;

class LinkService implements LinkServiceInterface
{
    private LinkRepositoryInterface $linkRepository;
    private LinkModel $linkModel;

    public function __construct(LinkRepositoryInterface $linkRepository, LinkModel $linkModel)
    {
        $this->linkRepository=$linkRepository;
        $this->linkModel=$linkModel;
    }
    public function createLink(LinkDetails $linkDetails)
    {
        $this->linkModel->setUserId(auth()->user()->id);
        $this->linkModel->setShortCode(Util::generateShortLink());
        $result=$this->linkRepository->create($this->linkModel->getUserId(),$this->linkModel->getShortCode(), $linkDetails);
        return $result;
    }
    public function updateLink($linkId,$shortLink)
    {
        $this->linkModel->setId($linkId);
        $this->linkModel->setUserId(auth()->user()->id);
        $this->linkModel->setShortCode(Util::generateShortLink());
        $result=$this->linkRepository->update($this->linkModel->getUserId(),$this->linkModel->getId(),$shortLink);
        return $result;
    }

    public function deleteLink($linkId)
    {
        $this->linkModel->setUserId(auth()->user()->id);
        $this->linkModel->setId($linkId);
        $this->linkRepository->delete($this->linkModel->getUserId(), $this->linkModel->getId());
    }

    public function getUserLinks($userId)
    {
        $this->linkModel->setUserId($userId);
        $currentUser=auth()->user()->id;
        $userLinks=$this->linkRepository->getAllByUser($this->linkModel->getUserId(), $currentUser);
        return $userLinks;
    }

    public function getOriginalLink(string $shortCode)
    {
        $this->linkModel->setShortCode($shortCode);
        $originalUrl=$this->linkRepository->getByShortCode($this->linkModel->getShortCode());
        return $originalUrl;
    }

}
