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
        $url = 'https://valorinveste.globo.com/cotacoes/';
        $page = $client->request('GET', $url);
        $page->filter('.ticker__item')->each(function ($node){
            $coin = $node->filter('.ticker__item__symbol')->text();
            $value = $node->filter('.ticker__item__value')->text();
            ExchangeRate::updateOrCreate(
                ['coin' => $coin],
                ['value' => $value]
            );
        });
    }


}
