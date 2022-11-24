<?php
declare(strict_types=1);

namespace App\Repositories;

use App\Exceptions\LinkExceptions\LinkIdNotExistsException;
use App\Exceptions\LinkExceptions\OriginalLinkAlreadyExistsException;
use App\Exceptions\LinkExceptions\ShortCodeAlreadyExistsException;
use App\Exceptions\LinkExceptions\UserIdNotExistsException;
use App\Exceptions\MyCustomException;
use App\Interfaces\LinkRepositoryInterface;
use App\Models\LinkDetails;
use App\Models\LinkModel;
use Illuminate\Database\Eloquent\Collection;


class LinkRepository implements LinkRepositoryInterface
{
    public function create(
        string|int $userId,
        string $shortCode,
        LinkDetails $linkDetails
    ): LinkModel {

        return LinkModel::create([
            'userId' => $userId,
            'originalUrl' => $linkDetails->getOriginalUrl(),
            'shortCode' => $shortCode,
            'isPublic' => $linkDetails->getIsPublic(),
        ])->firstOrFail();
    }

    public function update(
        string|int $userId,
        int|string $linkId,
        string $shortCode
    ): LinkModel {
        LinkModel::where('userId', $userId)->where('id', $linkId)
            ->update(['shortCode' => $shortCode]);

        return LinkModel::where('shortCode', $shortCode)->first();
    }

    public function delete(string|int $userId, int|string $linkId): void
    {
        LinkModel::where('userId', $userId)->where('id', $linkId)->delete();
    }

    public function getById(int|string $linkId): LinkModel
    {
        return LinkModel::where('id', $linkId)->first();
    }

    public function getByShortCode(
        string $shortCode,
        int|string $currentUserId
    ): LinkModel {

        return LinkModel::where('shortCode', $shortCode)
            ->where(function ($query) use ($currentUserId) {
                $query->where('isPublic', 1)
                    ->orWhere([
                        'isPublic' => 0,
                        'userId' => $currentUserId,
                    ]);
            })->firstOrFail();
    }

    public function getAll(): Collection
    {
        return LinkModel::paginate(15)->get([
            'shortCode',
            'originalUrl',
        ]);
    }

    public function getAllByUser(
        int|string $userId,
        int|string $currentUserId
    ): Collection {
        if ($currentUserId == $userId) {
            return LinkModel::where('userId', $userId)->get([
                'shortCode',
                'originalUrl',
            ]);
        } else {
            return LinkModel::where('userId', $userId)->where('isPublic', 1)
                ->get(['shortCode', 'originalUrl']);
        }
    }

    public function checkOriginalAlreadyExist(string $originalUrl)
    {
        if (LinkModel::where('originalUrl', $originalUrl)->exists()) {
            throw new OriginalLinkAlreadyExistsException('This link already exists');
        }

    }

    public function checkLinkIdAlreadyExist(string $linkId)
    {
        if (!LinkModel::where('id', $linkId)->exists()) {
            throw new LinkIdNotExistsException('This link id doesnt exists');
        }

    }

    public function checkShortCodeAlreadyExist(string $shortCode)
    {
        if (LinkModel::where('shortCode', $shortCode)->exists()) {
            throw new ShortCodeAlreadyExistsException('This shortCode already exists');
        }

    }

    public function checkUserIdExist(string $userId)
    {
        if (!LinkModel::where('id', $userId)->exists()) {
            throw new UserIdNotExistsException('This User Id doesnt exists');
        }

    }

    public function checkShortCodeNotExist(string $shortCode)
    {
        if (!LinkModel::where('shortCode', $shortCode)->exists()) {
            throw new ShortCodeAlreadyExistsException('This shortCode not exists');
        }

    }

}
