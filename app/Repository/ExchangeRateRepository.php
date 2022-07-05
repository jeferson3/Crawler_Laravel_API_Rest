<?php

namespace App\Repository;

use App\Models\ExchangeRate;

final class ExchangeRateRepository implements ExchangeRateRepositoryInterface
{
    /**
     * Table model
     * @var ExchangeRate
     */
    private ExchangeRate $exchangeRate;

    public function __construct(ExchangeRate $exchangeRate)
    {
        $this->exchangeRate = $exchangeRate;
    }

    /**
     * Get all paginated data from database
     * @param array $request
     * @return array
     */
    public function getAll(array $request): array
    {
        $limit = isset($request['limit']) ? $request['limit'] : 10;
        $page  = isset($request['page'])  ? $request['page'] : 1;

        $where = " 1=1 ";
        $bind  = array();
        if (isset($request['coin'])) {
            $where .= " AND coin like CONCAT('%', ?, '%')";
            $bind[] = $request['coin'];
        }

        return [
            'data'      => $this->exchangeRate->whereRaw($where, $bind)->limit($limit)->offset(($page - 1) * $limit)->get(),
            'total'     => $this->exchangeRate->whereRaw($where, $bind)->count(),
            'page'      => $page,
            'per_page'  => $limit
        ];
    }

    /**
     * Save new record in database
     * @param array $request
     * @return ExchangeRate|null
     */
    public function create(array $request): ExchangeRate|null
    {
        return $this->exchangeRate->create([
            'coin'   => $request['coin'],
            'value'  => $request['value']
        ]);
    }

    /**
     * Update record from database
     * @param ExchangeRate $exchangeRate
     * @param array $request
     * @return ExchangeRate|null
     */
    public function update(ExchangeRate $exchangeRate, array $request): ExchangeRate|null
    {
        $exchangeRate->update([
            'coin'   => $request['coin'],
            'value'  => $request['value']
        ]);
        return $exchangeRate;
    }

    /**
     * Delete record from database
     * @param ExchangeRate $exchangeRate
     * @return bool
     */
    public function delete(ExchangeRate $exchangeRate): bool
    {
        return $exchangeRate->delete();
    }
}
