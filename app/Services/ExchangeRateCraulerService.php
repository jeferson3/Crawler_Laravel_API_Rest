<?php

namespace App\Services;

use App\Models\ExchangeRate;
use Goutte\Client;

trait ExchangeRateCraulerService
{
    /**
     * Get data
     * @return void
     */
    public function scrapping(): void
    {
        $client = new Client();
        ExchangeRate::updateOrCreate(
            ['coin' => 'dolar'],
            ['value' => $this->getDolarValue($client)]
        );
        ExchangeRate::updateOrCreate(
            ['coin' => 'euro'],
            ['value' => $this->getEuroValue($client)]
        );
    }

    /**
     * @param Client $client
     * @return string
     */
    private function getDolarValue(Client $client): string
    {
        $url = 'https://valorinveste.globo.com/cotacoes/dolar/';
        $page = $client->request('GET', $url);
        return $page->filter('.tabela-data__ticker__lastQuote')->text();
    }

    /**
     * @param Client $client
     * @return string
     */
    private function getEuroValue(Client $client): string
    {
        $url = 'https://valorinveste.globo.com/cotacoes/euro/';
        $page = $client->request('GET', $url);
        return $page->filter('.tabela-data__ticker__lastQuote')->text();
    }
}
