<?php


namespace App\Providers;


use App\ShortUrl\Repository\PostgresShortUrlRepository;
use App\ShortUrl\Repository\ShortUrlRepositoryInterface;
use App\ShortUrl\Service\ShortUrlService;
use App\ShortUrl\Service\ShortUrlServiceInterface;
use Illuminate\Support\ServiceProvider;

class ShortUrlServiceProvider extends ServiceProvider
{
    public $bindings = [
        ShortUrlRepositoryInterface::class => PostgresShortUrlRepository::class,
        ShortUrlServiceInterface::class => ShortUrlService::class
    ];
}