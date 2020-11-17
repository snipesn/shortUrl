<?php


namespace App\ShortUrl\Service;


use App\ShortUrl\Entity\ShortUrlEntity;
use App\ShortUrl\Exception\ShortUrlRuntimeException;
use App\ShortUrl\Repository\ShortUrlRepositoryInterface;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;

class ShortUrlService implements ShortUrlServiceInterface
{
    /**
     * @var ShortUrlRepositoryInterface
     */
    private ShortUrlRepositoryInterface $repository;

    /**
     * ShortUrlService constructor.
     * @param ShortUrlRepositoryInterface $repository
     */
    public function __construct(ShortUrlRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @param string $short
     * @return string|null
     */
    public function redirectUrl(string $short): ?string
    {
        $entity = $this->repository->findByShortUrl($short);
        if (!empty($entity)) {
            $entity->incrementCountRedirect();
            $this->repository->update($entity);
            return $entity->getSource();
        } else {
            return null;
        }
    }

    /**
     * @return array
     */
    public function all(): array
    {
        return $this->repository->all()->toArray();
    }

    /**
     * @param string $url
     * @param int $ttl
     * @return string|null
     * @throws \Exception
     */
    public function add(string $url, int $ttl): ?string
    {
        try {
             $entity = $this->repository->add($url, $this->getUniqueShortUrl(), Carbon::now()->addHours($ttl));
        } catch (ShortUrlRuntimeException $exception) {
            Log::error('ShortUrlEntity error:' . $exception->getMessage());
            throw new \RuntimeException('ShortUrlEntity error:' . $exception->getMessage());
        }
        
        return $entity !== null ? $entity->getShort() : null;
    }

    /**
     * @return string
     */
    private function getUniqueShortUrl()
    {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyz';
        do {
            $short_url = '';
            for ($i = 0; $i < ShortUrlEntity::LENGTH_SHORT_URL; $i++) {
                $short_url .= $characters[mt_rand(0, strlen($characters) - 1)];
            }
        } while ($this->repository->existByShortUrl($short_url) === true);
        return $short_url;
    }
}