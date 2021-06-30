<?php
declare(strict_types = 1);

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Product\Application\Service\OpenHost\ProductService;
use Product\Application\Service\OpenHost\ProductServiceInterface;
use Product\Domain\Repository\PaginationRepositoryInterface;
use Product\Domain\Repository\ProductRepositoryInterface;
use Product\Infrastructure\Repository\InEloquent\ProductRepository;

/**
 * @author Bogusław Trojański
 */
class ProductServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->bind(
            ProductRepositoryInterface::class,
            ProductRepository::class
        );

        $this->app->bind(
            PaginationRepositoryInterface::class,
            ProductRepository::class
        );

        $this->app->bind(
            ProductServiceInterface::class,
            ProductService::class
        );
    }
}