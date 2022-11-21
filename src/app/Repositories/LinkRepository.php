<?php

namespace App\Repositories;

use App\Interfaces\LinkRepositoryInterface;
use App\Models\LinkDetails;
use App\Models\LinkModel;
use Illuminate\Database\Eloquent\Collection;


class LinkRepository implements LinkRepositoryInterface
{
    public function create(string|int $userId,string $shortCode, LinkDetails $linkDetails):LinkModel
    {

        return LinkModel::create([
            'userId'=>$userId,
            'originalUrl'=>$linkDetails->getOriginalUrl(),
            'shortCode'=>$shortCode,
            'isPublic'=>$linkDetails->getIsPublic(),
        ]);
    }

    public function update(string|int $userId, int|string $linkId, string $shortCode):LinkModel
    {
        LinkModel::where('userId', $userId)->where('id', $linkId)->update(['shortCode'=>$shortCode]);
        return LinkModel::where('shortCode',$shortCode)->getModel();
    }

    public function delete(string|int $userId, int|string $linkId):void
    {
        LinkModel::where('userId', $userId)->where('id', $linkId)->delete();
    }

    public function getById(int|string $linkId):LinkModel
    {
        return LinkModel::where('id', $linkId)->getModel();
    }

    public function getByShortCode(string $shortCode): LinkModel
    {
        $currentUserId="9";
        return LinkModel::where('shortCode',$shortCode)
            ->where(function ($query) use ($currentUserId) {
                $query->where('isPublic',1)
                    ->orWhere([
                        'isPublic' => 0,
                        'userId' => $currentUserId,
                    ]);
    })->first();
    }

    public function getAll():Collection
    {
        $currentUserId=auth()->user()->id;
        $public=LinkModel::where('isPublic',1)->get(['shortCode', 'originalUrl']);          //public Url
        $private=LinkModel::where('userId', $currentUserId)->where('isPublic', 0)->get(['shortCode','originalUrl']);    //private Url
        return $all=$public->merge($private);
    }

    public function getAllByUser(int|string $userId, int|string $currentUserId):Collection
    {
        if($currentUserId==$userId){
            return LinkModel::where('userId', $userId)->get(['shortCode','originalUrl']);
        }
        else{
            return LinkModel::where('userId', $userId)->where('isPublic', 1)->get(['shortCode','originalUrl']);
        }
    }
    public function check(string $originalUrl):Collection
    {
        return $link=LinkModel::where('originalUrl', $originalUrl)->get('originalUrl');
    }

}
