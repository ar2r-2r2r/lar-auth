<?php

namespace App\Services;

use App\Helper\Util;
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
    public function createLink(Request $request)
    {
        try {
            $validateUser = Validator::make($request->all(),
                [
                    'originalUrl' => 'required',
                    'isPublic'=>'required'
                ]);
        } catch (\Throwable $th) {
            return $response=[
                'status'=>false,
                'message'=>$th->getMessage(),
                'statusCode'=>500,
            ];
        }
        $this->linkDetails->setOriginalUrl($request->originalUrl);
        $this->linkDetails->setIsPublic($request->isPublic);
        $id=auth()->user()->id;

        $shortLink=Util::generateShortLink();
        $result=$this->linkRepository->create($id,$shortLink,$this->linkDetails);
        return response()->json([
            'result'=>"$result",
        ], 200);
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
        return response()->json([
            'result'=>"$result",
        ], 200);
    }

    public function deleteLink(Request $request)
    {
        $result=$this->linkRepository->delete($request->linkId);
    }

    public function getUserLinks(Request $request)
    {
        $result=$this->linkRepository->getAllByUser($request->userId);
        return response()->json([
            'result'=>"$result",
        ], 200);
    }

    public function getOriginalLink(Request $request)
    {
        $shortCode=$request->shortCode;
        $originalUrl=$this->linkRepository->getByShortCode($shortCode);
        return $originalUrl;
    }


}
