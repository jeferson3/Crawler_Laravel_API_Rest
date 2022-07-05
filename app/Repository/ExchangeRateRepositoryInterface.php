<?php

namespace App\Repository;

use App\Models\ExchangeRate;

interface ExchangeRateRepositoryInterface
{
    public function getAll(array $request): array;
    public function create(array $request): ExchangeRate|null;
    public function update(ExchangeRate $exchangeRate, array $request): ExchangeRate|null;
    public function delete(ExchangeRate $exchangeRate): bool;
}
