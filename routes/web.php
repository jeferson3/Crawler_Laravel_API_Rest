<?php

use Illuminate\Support\Facades\Route;
use Goutte\Client;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    $url = 'https://valorinveste.globo.com/cotacoes/dolar/';
    $client = new Client();
    $page = $client->request('GET', $url);
    $dolar = $page->filter('.tabela-data__ticker__lastQuote')->text();
    return view('welcome', compact('dolar'));
});
