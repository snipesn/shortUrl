<?php


namespace App\ShortUrl\Repository;


use App\ShortUrl\Entity\ShortUrlEntity;
use Carbon\Carbon;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

class PostgresShortUrlRepository implements ShortUrlRepositoryInterface
{
    /**
     * @param string $url
     * @return ShortUrlEntity|null
     * @throws \Exception
     */
    public function findByShortUrl(string $url): ?ShortUrlEntity
    {
        $row = DB::table('short_url')->where('short', $url)
            ->where('active_to', '>',  Carbon::now()->toDateTimeString())->first();
        return !empty($row) ? new ShortUrlEntity($row) : null;
    }

    /**
     * @return Collection
     */
    public function all(): Collection
    {
        return DB::table('short_url')->orderBy('id')->get()->mapInto(ShortUrlEntity::class);
    }

    /**
     * @param ShortUrlEntity $entity
     * @return bool
     */
    public function update(ShortUrlEntity $entity): bool
    {
        return DB::table('short_url')->where('id', $entity->getId())
            ->limit(1)->update($entity->toArray());
    }

    /**
     * @param string $url
     * @param string $short_url
     * @param Carbon $active_to
     * @param int $count_redirects
     * @return ShortUrlEntity|null
     * @throws \Exception
     */
    public function add(string $url, string $short_url, Carbon $active_to, int $count_redirects = 0): ?ShortUrlEntity
    {
        $result = DB::table('short_url')->insert(
            [
                'source' => $url,
                'short' => $short_url,
                'active_to' => $active_to->toDateTime(),
                'count_redirects' => $count_redirects
            ]
        );
        return $result ? $this->findByShortUrl($short_url) : null;
    }

    /**
     * @param string $url
     * @return bool
     */
    public function existByShortUrl(string $url): bool
    {
        return DB::table('short_url')->where('short', $url)->exists();
    }
}