<?php

namespace App\Services;

use App\Models\Currency;
use App\Services\Service;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;

class CurrencyRatesService extends Service
{
  protected const CURRENCY_LIST_URL = 'https://currate.ru/api/?get=currency_list';
  protected const CURRENCY_RATE_URL = 'https://currate.ru/api/?get=rates&pairs=';
  protected const CURRENCY_LIST = [
    'EURUSD',
    'BTCUSD',
    'USDCHF'
  ];

  /**
   * Retrive all currencies
   * 
   * @return array
   */
  protected function getAvailableCurrencies(): array
  {
      $url = self::CURRENCY_LIST_URL . '&' . env('CURRENCY_API_KEY');
      return Http::get($url)['data'];
  }

  /**
   * Retrive all currencies rate
   * 
   * @return \Illuminate\Support\Collection;
   */
  protected function getAvailableCurrenciesRate(): object
  {
    $currencies = $this->getAvailableCurrencies();
    $url = self::CURRENCY_RATE_URL . implode(',', $currencies) . '&' . env('CURRENCY_API_KEY');
    return collect(Http::get($url)['data'])->map(function($item, $key) {
        $exchange_currencies = str_split($key, 3);
        return [
            'from' => $exchange_currencies[0],
            'to' => $exchange_currencies[1],
            'rate'     => $item,
        ];
    });
  }

  public function store()
  {
    if ($this->getAvailableCurrenciesRate()->isNotEmpty()) {
      DB::transaction(function () {
        $rates = $this->getAvailableCurrenciesRate()->toArray();
        foreach ($rates as $rate) {
          Currency::create($rate);
        }
      });
    }
  }
}