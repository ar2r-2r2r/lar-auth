<?php

namespace App\Repositories;

use App\Interfaces\LinkRepositoryInterface;
use App\Models\LinkDetails;
use App\Models\LinkModel;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\DB;
use League\CommonMark\Extension\CommonMark\Node\Inline\Link;


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
        return LinkModel::where('id', $linkId)->update(['shortCode'=>$shortCode]);
    }

    public function delete(int|string $linkId)
    {
        return LinkModel::where('id', $linkId)->delete();
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
        return LinkModel::all('originalUrl','shortCode');
    }

    public function getAllByUser(int|string $userId):Collection
    {
        return LinkModel::where('userId', $userId)->get(['shortCode','originalUrl']);

    }
}
