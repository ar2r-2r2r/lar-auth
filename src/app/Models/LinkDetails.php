<?php

namespace App\Models;

class LinkDetails
{
    protected string $originalUrl;
    protected string $isPublic;

    /**
     * @param string $originalUrl
     * @param string $isPublic
     */


    /**
     * @return string
     */
    public function getOriginalUrl(): string
    {
        return $this->originalUrl;
    }

    /**
     * @param string $originalUrl
     */
    public function setOriginalUrl(string $originalUrl): void
    {
        $this->originalUrl = $originalUrl;
    }

    /**
     * @return string
     */
    public function getIsPublic(): string
    {
        return $this->isPublic;
    }

    /**
     * @param string $isPublic
     */
    public function setIsPublic(string $isPublic): void
    {
        $this->isPublic = $isPublic;
    }


}
