<?php

namespace App\Http\Controllers\Api\V1;

use App\Models\Currency;
use Illuminate\Http\Request;
use App\Services\CurrencyService;
use App\Http\Controllers\Controller;
use App\Http\Resources\CurrencyResource;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class CurrenciesController extends Controller
{
    protected $service;

    /**
     * @param \App\Services\CurrencyService $service
     * 
     */
    public function __construct(CurrencyService $service)
    {
        $this->service = $service;
    }

    /**
     * Display all currencies
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        try {
            $data = $this->service->getAvailableCurrenciesRate();
        } catch (\Exception $exception) {
            return response()->json(['message' => $exception->getMessage()]);
        }
        return response()->json($data);
    }

    /**
     * Display current currency rate.
     *
     * @param  \App\Models\Currency $currency
     * @return \Illuminate\Http\JsonResponse
     */
    public function showFromCurrencyRate(Request $request)
    {
        try {
            $data = $this->service->getFromCurrencyRate($request->keyword);
        } catch (ModelNotFoundException $exception) {
            return response()->json(['message' => $exception->getMessage()]);
        }
        return response()->json($data);
    }

    /**
     * Display current currency rate.
     *
     * @param  \App\Models\Currency $currency
     * @return \Illuminate\Http\JsonResponse
     */
    public function showToCurrencyRate(Request $request)
    {
        try {
            $data = $this->service->getToCurrencyRate($request->keyword);
        } catch (ModelNotFoundException $exception) {
            return response()->json(['message' => $exception->getMessage()]);
        }
        return response()->json($data);
    }

    /**
     * Display current currency rate.
     *
     * @param  \App\Models\Currency $currency
     * @return \Illuminate\Http\JsonResponse
     */
    public function  showCurrencyRateHistory(Currency $currency)
    {
        try {
            $data = $this->service->getCurrencyRateHistory($currency);
            $response = (CurrencyResource::collection($data));
        } catch (ModelNotFoundException $exception) {
            return response()->json(['message' => $exception->getMessage()]);
        }
        return $response;
    }
}
