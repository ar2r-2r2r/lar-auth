<?php

namespace App\Interfaces;

use App\Models\LinkDetails;
use App\Models\LinkModel;
use Illuminate\Database\Eloquent\Collection;


interface LinkRepositoryInterface
{
    public function create(string|int $userId, string $shortCode, LinkDetails $linkDetails);    //creates a new link
    public function update(string|int $linkId, string $shortCode, LinkDetails $linkDetails);    //updates existing link
    public function delete(string|int $linkId);                                    //deletes existing model
    public function getById(string|int $linkId);                              //returns link by its ID
    public function getByShortCode(string $shortCode);                          //returns link by its short code
    public function getAll():Collection;                                                  // returns all links
    public function getAllByUser(string|int $userId):Collection;                       // returns all user-specific links
}
