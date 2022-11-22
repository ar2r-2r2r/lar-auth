<?php
declare(strict_types=1);

namespace App\Services;

use App\Exceptions\OriginalLinkAlreadyExistsException;
use App\Factories\LinkModelFactory\LinkModelFactory;
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
    private LinkModelFactory $linkModelFactory;
    private LinkModel $linkModel;

    public function __construct(
        LinkRepositoryInterface $linkRepository,
        LinkModelFactory $linkModelFactory
    ) {
        $this->linkRepository = $linkRepository;
        $this->linkModelFactory = $linkModelFactory;
        $this->linkModel = $this->linkModelFactory->createModel();
    }


    public function createLink(
        LinkDetails $linkDetails,
        string|int $currentUserId
    ): LinkModel|string {
        $this->linkRepository->checkOriginalAlreadyExist($linkDetails->getOriginalUrl());
        $this->linkModel->setUserId($currentUserId);

        do {
            $recreate = true;
            try {
                $shortCode = Util::generateShortLink();
                $this->linkRepository->checkShortCodeAlreadyExist($shortCode);
            } catch (OriginalLinkAlreadyExistsException $ex) {
                $recreate = $ex->changeRecreate($recreate);
            }
        } while (!$recreate);

        $this->linkModel->setShortCode($shortCode);
        $result = $this->linkRepository->create(
            $this->linkModel->getUserId(),
            $this->linkModel->getShortCode(),
            $linkDetails
        );
        Cache::put('modelLink', '$result', 300);

        return $result;
    }

    public function updateLink(
        int|string $linkId,
        int|string $currentUserId
    ): LinkModel {
        $this->linkRepository->checkLinkIdAlreadyExist($linkId);
        $linkId = (int)$linkId;
        $this->linkModel->setId($linkId);
        $this->linkModel->setUserId($currentUserId);
        $this->linkModel->setShortCode(Util::generateShortLink());
        $result = $this->linkRepository->update(
            $this->linkModel->getUserId(),
            $this->linkModel->getId(),
            $this->linkModel->getShortCode());
        Cache::put('modelLink', '$result', 300);

        return $result;
    }

    public function deleteLink($linkId, int|string $currentUserId)
    {
        $linkId = (int)$linkId;
        $this->linkModel->setUserId($currentUserId);
        $this->linkModel->setId($linkId);
        $this->linkRepository->delete($this->linkModel->getUserId(),
            $this->linkModel->getId());
    }

    public function getUserLinks(
        int|string $userId,
        int|string $currentUserId
    ): Collection {
        $this->linkModel->setUserId($userId);

        return $this->linkRepository->getAllByUser($this->linkModel->getUserId(),
            $currentUserId);
    }

    public function getOriginalLink(
        string $shortCode,
        string|int $currentUserId
    ): LinkModel {
        $this->linkModel->setShortCode($shortCode);

        return $this->linkRepository->getByShortCode($this->linkModel->getShortCode(),
            $currentUserId);
    }

}
