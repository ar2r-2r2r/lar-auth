<?php

namespace Tests\Unit;

use App\Exceptions\LinkExceptions\ShortCodeAlreadyExistsException;
use App\Factories\LinkModelFactory\LinkModelFactory;
use App\Helper\Util;
use App\Models\LinkDetails;
use App\Models\LinkModel;
use App\Repositories\LinkRepository;
use App\Services\LinkService;
use Illuminate\Support\Facades\Cache;
use Mockery;
use Mockery\Mock;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;

class LinkServiceTest extends TestCase
{



    public function test_Link_service():void
    {
        $linkRepositoryMock=$this->createMock(LinkRepository::class);
        $linkModelFactoryMock=$this->createMock(LinkModelFactory::class);
        $linkModelMock=$this->createMock(LinkModel::class);
        $linkDetailsMock=$this->createMock(LinkDetails::class);
        $linkService=new LinkService($linkRepositoryMock,$linkModelFactoryMock);

        $linkDetailsMock->setOriginalUrl("Qwerty");
        $linkDetailsMock->setIsPublic("1");
        $currentUserId=1;

        $linkRepositoryMock->checkOriginalAlreadyExist($linkDetailsMock->getOriginalUrl());
        $linkModelMock->setUserId($currentUserId);

        do {
            $recreate = true;
            try {
                $shortCode = Util::generateShortLink();
                $linkRepositoryMock->checkShortCodeAlreadyExist($shortCode);
            } catch (ShortCodeAlreadyExistsException $ex) {
                $recreate = $ex->changeRecreate($recreate);
            }
        } while (!$recreate);

        $linkModelMock->setShortCode($shortCode);
        $result = $linkRepositoryMock->create(
            $linkModelMock->getUserId(),
            $linkModelMock->getShortCode(),
            $linkDetailsMock
        );


        $this->assertObjectHasAttribute('createdDate',$result);
    }




}