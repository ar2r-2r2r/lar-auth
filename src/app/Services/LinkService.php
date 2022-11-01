<?php

namespace App\Services;

use App\Helper\Util;
use App\Http\Requests\CreateLinkRequest;
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
        $validated=$request->validated();
        $this->linkDetails->setOriginalUrl($request->originalUrl);
        $this->linkDetails->setIsPublic($request->isPublic);
        $id=auth()->user()->id;

        $shortLink=Util::generateShortLink();
        $result=$this->linkRepository->create($id,$shortLink,$this->linkDetails);
        return $result;
    }

    public function updateLink(Request $request)
    {
        try {
            $validateUser = Validator::make($request->all(),
                [
                    'linkId' => 'required',
                ]);
        } catch (\Throwable $th) {
            return $response=[
                'status'=>false,
                'message'=>$th->getMessage(),
                'statusCode'=>500,
            ];
        }
        $linkId=$request->linkId;
        $shortLink=Util::generateShortLink();
        $result=$this->linkRepository->update($linkId,$shortLink,$this->linkDetails);
        return $result;
    }

    public function deleteLink(Request $request)
    {
        $this->linkRepository->delete($request->linkId);
    }

    public function getUserLinks(Request $request)
    {
        $userLinks=$this->linkRepository->getAllByUser($request->userId);
        return $userLinks;
    }

    public function getOriginalLink(Request $request)
    {
        $shortCode=$request->shortCode;
        $originalUrl=$this->linkRepository->getByShortCode($shortCode);
        return $originalUrl;
    }


}
