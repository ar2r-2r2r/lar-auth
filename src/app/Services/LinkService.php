<?php
declare(strict_types=1);

namespace App\Services;

use App\Exceptions\OriginalLinkAlreadyExistsException;
use App\Helper\Util;
use App\Interfaces\LinkRepositoryInterface;
use App\Interfaces\LinkServiceInterface;
use App\Models\LinkDetails;
use App\Models\LinkModel;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Cache;

class LinkService implements LinkServiceInterface
{
    private LinkRepositoryInterface $linkRepository;
    private LinkModel $linkModel;

    public function __construct(LinkRepositoryInterface $linkRepository, LinkModel $linkModel)
    {
        $this->linkRepository=$linkRepository;
        $this->linkModel=$linkModel;
    }

    public function createLink(LinkDetails $linkDetails, string $currentUserId): LinkModel|string
    {
        $link=$this->linkRepository->check($linkDetails->getOriginalUrl());
        try {
            if ($link==$linkDetails->getOriginalUrl()) {
                throw new OriginalLinkAlreadyExistsException('already exists');
            }
            $this->linkModel->setUserId($currentUserId);
            $this->linkModel->setShortCode(Util::generateShortLink());
            $result=$this->linkRepository->create(
                $this->linkModel->getUserId(),
                $this->linkModel->getShortCode(),
                $linkDetails
            );
            Cache::put('modelLink', '$result', 300);
        }catch (OriginalLinkAlreadyExistsException $e) {
            $result=$e->errorMessage();
        }
        return $result;
    }

    public function updateLink($linkId): LinkModel
    {
        $this->linkModel->setId($linkId);
        $this->linkModel->setUserId(auth()->user()->id);
        $this->linkModel->setShortCode(Util::generateShortLink());
        $result=$this->linkRepository->update(
            $this->linkModel->getUserId(),
            $this->linkModel->getId(),
            $this->linkModel->getShortCode());
        Cache::put('modelLink', '$result', 300);
        return $result;
    }

    public function deleteLink($linkId)
    {
        $this->linkModel->setUserId(auth()->user()->id);
        $this->linkModel->setId($linkId);
        $this->linkRepository->delete($this->linkModel->getUserId(), $this->linkModel->getId());
    }

    public function getUserLinks($userId): Collection
    {
        $this->linkModel->setUserId($userId);
        $currentUser=auth()->user()->id;
        return $this->linkRepository->getAllByUser($this->linkModel->getUserId(), $currentUser);
    }

    public function getOriginalLink(string $shortCode, string $currentUserId): LinkModel
    {
        $this->linkModel->setShortCode($shortCode);
        return $this->linkRepository->getByShortCode($this->linkModel->getShortCode(), $currentUserId);
    }

}
