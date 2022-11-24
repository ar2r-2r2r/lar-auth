<?php

namespace Tests\Unit;

use App\Factories\LinkModelFactory\LinkModelFactory;
use App\Helper\Util;
use App\Models\LinkDetails;
use App\Models\LinkModel;
use App\Repositories\LinkRepository;
use App\Services\LinkService;
use PHPUnit\Framework\TestCase;


class LinkServiceTest extends TestCase
{

    public function test_Link_service_createLink(): void
    {
        $linkRepositoryMock = $this->createMock(LinkRepository::class);
        $linkModelFactoryMock = $this->createMock(LinkModelFactory::class);
        $linkModelMock = $this->createMock(LinkModel::class);
        $utilMock = $this->createMock(Util::class);
        $linkDetailsMock = $this->createMock(LinkDetails::class);
        $linkService = new LinkService($linkRepositoryMock,
            $linkModelFactoryMock);

        $currentUserId = 1;
        $originalUrl = "qwe";
        $linkDetailsMock->expects($this->once())->method('setOriginalUrl')
            ->with($originalUrl);
        $linkDetailsMock->setOriginalUrl($originalUrl);
        $linkModelMock->expects($this->once())->method('setUserId')
            ->with($currentUserId);
        $linkModelMock->setUserId($currentUserId);

        $utilMock->expects($this->once())->method('generateShort')
            ->willReturn("short");
        $shortCode = $utilMock->generateShort();

        $linkModelMock->expects($this->once())->method('setShortCode')
            ->with($shortCode);
        $linkModelMock->setShortCode($shortCode);

        $linkModelMock->expects($this->exactly(2))->method('getUserId')
            ->willReturn($currentUserId);
        $linkModelMock->expects($this->exactly(2))->method('getShortCode')
            ->willReturn($shortCode);


        $linkRepositoryMock->expects($this->once())->method('create')->with(
            $linkModelMock->getUserId(),
            $linkModelMock->getShortCode(),
            $linkDetailsMock
        )->willReturn($linkModelMock);

        $result = $linkRepositoryMock->create(
            $linkModelMock->getUserId(),
            $linkModelMock->getShortCode(),
            $linkDetailsMock
        );


        $this->assertNotEmpty($result);
        $this->assertObjectHasAttribute('createdDate', $result);

    }

//    public function test_Link_update_createLink(): void
//    {
//        $linkRepositoryMock = $this->createMock(LinkRepository::class);
//        $linkModelFactoryMock = $this->createMock(LinkModelFactory::class);
//        $linkModelMock = $this->createMock(LinkModel::class);
//        $linkDetailsMock = $this->createMock(LinkDetails::class);
//        $linkService = new LinkService($linkRepositoryMock,
//            $linkModelFactoryMock);
//
//        $linkDetailsMock->setOriginalUrl("Qwerty");
//        $linkDetailsMock->setIsPublic("1");
//        $currentUserId = 1;
//        $linkId = 1;
//
//        $linkRepositoryMock->checkLinkIdAlreadyExist($linkId);
//        $linkId = (int)$linkId;
//        $linkModelMock->setId($linkId);
//        $linkModelMock->setUserId($currentUserId);
//        $linkModelMock->setShortCode(Util::generateShortLink());
//        $result = $linkRepositoryMock->update(
//            $linkModelMock->getUserId(),
//            $linkModelMock->getId(),
//            $linkModelMock->getShortCode());
//
//        $this->assertNotEmpty($result);
//    }

//    public function test_getUserLinks(): void
//    {
//        $linkRepositoryMock = $this->createMock(LinkRepository::class);
//        $linkModelFactoryMock = $this->createMock(LinkModelFactory::class);
//        $linkModelMock = $this->createMock(LinkModel::class);
//        $linkDetailsMock = $this->createMock(LinkDetails::class);
//        $linkService = new LinkService($linkRepositoryMock,
//            $linkModelFactoryMock);
//
//
//        $linkDetailsMock->setOriginalUrl("Qwerty");
//        $linkDetailsMock->setIsPublic("1");
//        $currentUserId = 1;
//
//        $linkRepositoryMock->checkOriginalAlreadyExist($linkDetailsMock->getOriginalUrl());
//        $linkModelMock->setUserId($currentUserId);
//
//        do {
//            $recreate = true;
//            try {
//                $shortCode = Util::generateShortLink();
//                $linkRepositoryMock->checkShortCodeAlreadyExist($shortCode);
//            } catch (ShortCodeAlreadyExistsException $ex) {
//                $recreate = $ex->changeRecreate($recreate);
//            }
//        } while (!$recreate);
//
//        $linkModelMock->setShortCode($shortCode);
//        $result = $linkRepositoryMock->create(
//            $linkModelMock->getUserId(),
//            $linkModelMock->getShortCode(),
//            $linkDetailsMock
//        );
//
//
//
//
//
//
//
//
//
//
//
//
//
//        $linkModelMock->setUserId(1);
//        $currentUserId=1;
//
//        $result=$linkRepositoryMock->getAllByUser($linkModelMock->getUserId(),
//            $currentUserId);
//
//        $result->shortCode="asd";
//        var_dump($result);
//
//        $this->assertNotEmpty($result);
//    }


}