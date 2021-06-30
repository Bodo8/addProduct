<?php
declare(strict_types = 1);

namespace Product\Domain\Repository;

use Illuminate\Contracts\Pagination\Paginator;

/**
 * @author Bogusław Trojański
 */
interface PaginationRepositoryInterface
{
    /**
     * Pobranie paginacji produktu
     */
    public function getPage(int $number): Paginator;
}