<?php

namespace App\Interfaces;

use App\Http\Requests\CreateLinkRequest;
use Illuminate\Http\Request;

interface LinkServiceInterface
{
    public function createLink(CreateLinkRequest $request);
    public function updateLink(Request $request);
    public function deleteLink(Request $request);
    public function getUserLinks(Request $request);
    public function getOriginalLink(Request $request);
}
