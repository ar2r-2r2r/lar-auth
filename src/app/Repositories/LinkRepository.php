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
        return LinkModel::where('userId', $userId)->where('id', $linkId)->update(['shortCode'=>$shortCode]);
    }

    public function delete(string|int $userId, int|string $linkId):void
    {
        LinkModel::where('userId', $userId)->where('id', $linkId)->delete();
    }

    public function getById(int|string $linkId):LinkModel
    {
        return LinkModel::where('id', $linkId)->get('shortCode');
    }

    public function getByShortCode(string $shortCode):Collection
    {
        $originalUrl='';
        $collectionLinks=$this->getAll();
        $collectionLinks->toArray();

        for($i=0;$i<count($collectionLinks);$i++) {
            if($shortCode==$collectionLinks[$i]['shortCode']){
                $originalUrl=$collectionLinks[$i]['originalUrl'];
            }
        }
        return LinkModel::where('originalUrl',$originalUrl)->get('originalUrl');
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
        $currentUserId=auth()->user()->id;
        if($currentUserId==$userId){
            return LinkModel::where('userId', $userId)->where('userId', $currentUserId)->get(['shortCode','originalUrl']);
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
