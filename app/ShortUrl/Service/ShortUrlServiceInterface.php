<?php

namespace App\ShortUrl\Service;

interface ShortUrlServiceInterface
{
    /**
     * @param string $short
     * @return string|null
     */
    public function redirectUrl(string $short): ?string;

    /**
     * @return array
     */
    public function all(): array;

    /**
     * @param string $url
     * @param int $ttl
     * @return string|null
     */
    public function add(string $url, int $ttl): ?string;

}