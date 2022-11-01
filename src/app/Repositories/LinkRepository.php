<?php

namespace App\Repositories;

use App\Interfaces\LinkRepositoryInterface;
use App\Models\LinkDetails;
use App\Models\LinkModel;
use Illuminate\Database\Eloquent\Collection;

class LinkRepository implements LinkRepositoryInterface
{
    public function create(int|string $userId, string $shortCode, LinkDetails $linkDetails)
    {
        return LinkModel::create([
            'userId'=>$userId,
            'originalUrl'=>$linkDetails->getOriginalUrl(),
            'shortCode'=>$shortCode,
            'isPublic'=>$linkDetails->getIsPublic(),
        ]);
    }

    public function update(int|string $linkId, string $shortCode, LinkDetails $linkDetails)
    {
        $currentUserId=auth()->user()->id;
        return LinkModel::where('userId', $currentUserId)->where('id', $linkId)->update(['shortCode'=>$shortCode]);
    }

    public function delete(int|string $linkId)
    {
        $currentUserId=auth()->user()->id;
        return LinkModel::where('userId', $currentUserId)->where('id', $linkId)->delete();
    }

    public function getById(int|string $linkId):LinkModel
    {
        return LinkModel::where('id', $linkId)->get('shortCode');
    }

    public function getByShortCode(string $shortCode)
    {
        $originalUrl='';
        $collectionLinks=$this->getAll();
        $collectionLinks->toArray();

        for($i=0;$i<count($collectionLinks);$i++) {
            if($shortCode==$collectionLinks[$i]['shortCode']){
                $originalUrl=$collectionLinks[$i]['originalUrl'];
            }
        }
        return $originalUrl;
    }

    public function getAll():Collection
    {
        $currentUserId=auth()->user()->id;
        $public=LinkModel::where('isPublic',1)->get(['shortCode', 'originalUrl']);          //public Url
        $private=LinkModel::where('userId', $currentUserId)->where('isPublic', 0)->get(['shortCode','originalUrl']);    //private Url
        return $all=$public->merge($private);
    }

    public function getAllByUser(int|string $userId):Collection
    {
        $currentUserId=auth()->user()->id;
        if($currentUserId==$userId){
            return LinkModel::where('userId', $userId)->where('userId', $currentUserId)->get(['shortCode','originalUrl']);
        }
        else{
            return LinkModel::where('userId', $userId)->where('isPublic', 1)->get(['shortCode','originalUrl']);
        }
    }

}
