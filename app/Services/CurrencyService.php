<?php

namespace App\Services;

use App\Services\Service;
use Illuminate\Support\Facades\DB;

class CurrencyService extends Service
{
  /**
   * Retrive all currencies rate
   * 
   * @return \Illuminate\Support\Collection;
   */
  public function getAvailableCurrenciesRate(): object
  {
    return DB::table('currencies')
            ->latest('created_at')
            ->paginate(10);
  }

  /**
   * Get from currencies rate
   * 
   */
  public function getFromCurrencyRate($keyword)
  {
      return DB::table('currencies')
              ->where('from', 'LIKE','%'.$keyword.'%')
              ->paginate(10);
              
  }

  /**
   * Get to currencies rate
   * 
   */
  public function getToCurrencyRate($keyword)
  {
      return DB::table('currencies')
              ->where('to', 'LIKE','%'.$keyword.'%')
              ->paginate(10);
              
  }
  /**
   * Get currencies rates
   * 
   */
  public function getCurrencyRateHistory($currency)
  {
    return DB::table('currencies')
            ->where('from', '=', $currency->from)
            ->where('to', '=', $currency->to)
            ->get();
  }
}