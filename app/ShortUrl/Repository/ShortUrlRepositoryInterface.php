<?php

namespace App\ShortUrl\Repository;

use Carbon\Carbon;
use Illuminate\Support\Collection;
use App\ShortUrl\Entity\ShortUrlEntity;

interface ShortUrlRepositoryInterface
{

    /**
     * @param string $url
     * @return ShortUrlEntity|null
     */
    public function findByShortUrl(string $url): ?ShortUrlEntity;

    /**
     * @return Collection
     */
    public function all(): Collection;

    /**
     * @param ShortUrlEntity $entity
     * @return bool
     */
    public function update(ShortUrlEntity $entity): bool;

    /**
     * @param string $url
     * @param string $short_url
     * @param Carbon $active_to
     * @param int $count_redirects
     * @return ShortUrlEntity|null
     */
    public function add(string $url, string $short_url, Carbon $active_to, int $count_redirects = 0) : ?ShortUrlEntity;

    /**
     * @param string $url
     * @return bool
     */
    public function existByShortUrl(string $url): bool;

}