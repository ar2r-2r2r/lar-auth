<?php

namespace App\Interfaces;

use App\Models\LinkDetails;
use App\Models\LinkModel;
use Illuminate\Database\Eloquent\Collection;
use Termwind\Components\Li;


interface LinkRepositoryInterface
{
    public function create(string|int $userId,string $shortCode, LinkDetails $linkDetails):LinkModel;    //creates a new link
    public function update(string|int $userId, string|int $linkId, string $shortCode):Collection;    //updates existing link
    public function delete(string|int $userId, string|int $linkId):void;                                    //deletes existing model
    public function getById(string|int $linkId):Collection;                              //returns link by its ID
    public function getByShortCode(string $shortCode):Collection;                          //returns link by its short code
    public function getAll():Collection;                                                  // returns all links
    public function getAllByUser(int|string $userId, int|string $currentUserId):Collection;                       // returns all user-specific links
    public function check(string $originalUrl):Collection;
}
