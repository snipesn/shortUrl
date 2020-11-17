<?php

namespace App\ShortUrl\Entity;

use App\ShortUrl\Exception\ShortUrlRuntimeException;
use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Support\Carbon;

class ShortUrlEntity implements Arrayable
{

    const LENGTH_SHORT_URL = 8;

    /**
     * @var int
     */
    private int $id;
    /**
     * @var string
     */
    private string $source;
    /**
     * @var string
     */
    private string $short;
    /**
     * @var Carbon
     */
    private Carbon $active_to;
    /**
     * @var int
     */
    private int $count_redirects;

    /**
     * ShortUrlEntity constructor.
     * @param array|\stdClass $data
     * @throws \Exception
     */
    public function __construct($data)
    {
        if (!is_array($data)) {
            $data = (array)$data;
        }
        $this->setId($data['id'])
            ->setSource($data['source'] ?? null)
            ->setShort($data['short'] ?? null)
            ->setActiveTo($data['active_to'] ?? null)
            ->setCountRedirects($data['count_redirects'] ?? 0);
    }

    private function setId(int $id)
    {
        if (empty($id)) {
            throw new ShortUrlRuntimeException('Id required');
        }
        $this->id = $id;
        return $this;
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getSource(): string
    {
        return $this->source;
    }

    /**
     * @param string|null $source
     * @return $this
     */
    public function setSource(?string $source): ShortUrlEntity
    {
        if (empty($source)) {
            throw new ShortUrlRuntimeException('Source required');
        }
        $this->source = $source;
        return $this;
    }

    /**
     * @return string
     */
    public function getShort(): string
    {
        return $this->short;
    }

    /**
     * @param string|null $short
     * @return $this
     */
    public function setShort(?string $short): ShortUrlEntity
    {
        $this->short = $short;
        return $this;
    }

    /**
     * @return Carbon
     */
    public function getActiveTo(): Carbon
    {
        return $this->active_to;
    }

    /**
     * @param Carbon|string|null $active_to
     * @return $this
     * @throws \Exception
     */
    public function setActiveTo($active_to): ShortUrlEntity
    {
        if (empty($active_to)) {
            throw new ShortUrlRuntimeException('ActiveTo required');
        }
        $this->active_to = $active_to instanceof Carbon ? $active_to : new Carbon($active_to);
        return $this;
    }

    /**
     * @return int
     */
    public function getCountRedirects(): int
    {
        return $this->count_redirects;
    }

    /**
     * @param int $count_redirects
     * @return $this
     */
    public function setCountRedirects(int $count_redirects = 0): ShortUrlEntity
    {
        $this->count_redirects = $count_redirects;
        return $this;
    }

    public function incrementCountRedirect()
    {
        $this->count_redirects++;
    }

    /**
     * @return array
     */
    public function toArray()
    {
        return [
            'id' => $this->getId(),
            'source' => $this->getSource(),
            'short' => $this->getShort(),
            'active_to' => $this->getActiveTo()->toDateTimeString(),
            'count_redirects' => $this->getCountRedirects()
        ];
    }
}