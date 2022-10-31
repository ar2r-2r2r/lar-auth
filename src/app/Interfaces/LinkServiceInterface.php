<?php

namespace App\Interfaces;

use Illuminate\Http\Request;

interface LinkServiceInterface
{
    public function createLink(Request $request);
    public function updateLink(Request $request);
    public function deleteLink();
    public function getUserLinks(Request $request);
    public function getOriginalLink(Request $request);
}
