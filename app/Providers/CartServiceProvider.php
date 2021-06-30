<?php
declare(strict_types = 1);

namespace App\Providers;

use Cart\Application\Service\Product\ProductService;
use Cart\Application\Service\Product\ProductServiceInterface;
use Cart\Domain\Repository\CartRepositoryInterface;
use Cart\Infrastructure\Repository\InEloquent\CartRepository;
use Illuminate\Support\ServiceProvider;

/**
 * @author Bogusław Trojański
 */
class CartServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->bind(
            ProductServiceInterface::class,
            ProductService::class
        );

        $this->app->bind(
            CartRepositoryInterface::class,
            CartRepository::class
        );
    }
}
