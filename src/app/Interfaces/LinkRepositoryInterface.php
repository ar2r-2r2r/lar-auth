<?php
declare(strict_types=1);

namespace App\Interfaces;

use App\Models\LinkDetails;
use App\Models\LinkModel;
use Illuminate\Database\Eloquent\Collection;


interface LinkRepositoryInterface
{
    public function create(
        string|int $userId,
        string $shortCode,
        LinkDetails $linkDetails
    ): LinkModel;    //creates a new link

    public function update(
        string|int $userId,
        string|int $linkId,
        string $shortCode
    ): LinkModel;    //updates existing link

    public function delete(
        string|int $userId,
        string|int $linkId
    ): void;                                    //deletes existing model

    public function getById(string|int $linkId
    ): LinkModel;                              //returns link by its ID

    public function getByShortCode(
        string $shortCode,
        string $currentUserId
    ): LinkModel;                          //returns link by its short code

    public function getAll(): Collection;             //returns all links

    public function getAllByUser(
        int|string $userId,
        int|string $currentUserId
    ): Collection;                  // returns all user-specific links

    public function checkOriginalAlreadyExist(string $originalUrl);

    public function checkLinkIdAlreadyExist(string $linkId);
}
