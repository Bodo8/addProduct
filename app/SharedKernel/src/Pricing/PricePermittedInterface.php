<?php
declare(strict_types = 1);

namespace SharedKernel\Pricing;


/**
 * @author Bogusław Trojański
 */
interface PricePermittedInterface
{
    public function getVatRate(): int;

    public function getNetto(): int;

    public function getQuantity(): int;
}