<?php
declare(strict_types=1);

namespace App\Factories\LinkModelFactory;

use App\Models\LinkModel;

class LinkModelFactory
{
    public function createModel():LinkModel
    {
        return new LinkModel();
    }
}

