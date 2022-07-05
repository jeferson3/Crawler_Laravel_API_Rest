<?php

namespace App\Http\Controllers;

use App\Http\Requests\RequestValidation;
use App\Http\Resources\FailResponseResource;
use App\Http\Resources\PaginationResponseResource;
use App\Http\Resources\SuccessResponseResource;
use App\Models\ExchangeRate;
use App\Repositories\ExchangeRateRepository;
use Illuminate\Http\Request;

class ExchangeRateController extends Controller
{
    private ExchangeRateRepository $exchangeRateRepository;

    public function __construct(ExchangeRateRepository $exchangeRateRepository)
    {
        $this->exchangeRateRepository = $exchangeRateRepository;
    }

    /**
     * Exchange Rate - return data of database
     *
     * @OA\Get (
     *     path="/exchange-rate",
     *     summary="ExchangeRateController",
     *     @OA\Response(response="200", description="Response with success"),
     *     @OA\Response(response="404", description="Response with error"),
     *     tags={"ExchangeRate"},
     *
     *     @OA\Parameter(
     *          name="limit",
     *          in="query",
     *          required=false,
     *          description="pagination - per page",
     *          @OA\Schema(
     *              type="integer"
     *          ),
     *     ),
     *     @OA\Parameter(
     *          name="page",
     *          in="query",
     *          required=false,
     *          description="pagination - page",
     *          @OA\Schema(
     *              type="integer"
     *          ),
     *     ),
     *     @OA\Parameter(
     *          name="coin",
     *          in="query",
     *          required=false,
     *          description="filter - coin name",
     *          @OA\Schema(
     *              type="string"
     *          ),
     *     ),
     *    )
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse|object
     */
    public function index(Request $request)
    {
        return (new PaginationResponseResource($this->exchangeRateRepository->getAll($request->toArray())))
            ->response()
            ->setStatusCode(200);
    }

    /**
     * Exchange Rate - Store a newly created resource in storage.
     *
     * @OA\Post (
     *     path="/exchange-rate",
     *     summary="ExchangeRateController",
     *     @OA\Response(response="200", description="Response with success"),
     *     @OA\Response(response="404", description="Response with error"),
     *     tags={"ExchangeRate"},
     *
     *     @OA\RequestBody(
     *          required=true,
     *          @OA\MediaType(
     *              mediaType="application/x-www-form-urlencoded",
     *              @OA\Schema(
     *                  type="object",
     *                  required={"coin", "value"},
     *                  @OA\Property(property="coin", type="string" , example="dollar"),
     *                  @OA\Property(property="value", type="float" , example="10.5"),
     *              )
     *          )
     *      )
     *
     *    )
     *
     *
     * @param RequestValidation $request
     * @return \Illuminate\Http\JsonResponse|object
     */
    public function store(RequestValidation $request)
    {
        if ($status = $this->exchangeRateRepository->create($request->all())) {
            return (new SuccessResponseResource($status))
                ->response()
                ->setStatusCode(200);
        }
        return (new FailResponseResource($status))
            ->response()
            ->setStatusCode(400);
    }

    /**
     * Update the specified resource in storage.
     * @OA\Put (
     *     path="/exchange-rate/{exchange_rate}",
     *     summary="ExchangeRateController",
     *     @OA\Response(response="200", description="Response with success"),
     *     @OA\Response(response="404", description="Response with error"),
     *     tags={"ExchangeRate"},
     *
     *     @OA\RequestBody(
     *          required=true,
     *          @OA\MediaType(
     *              mediaType="application/x-www-form-urlencoded",
     *              @OA\Schema(
     *                  type="object",
     *                  required={"coin", "value"},
     *                  @OA\Property(property="coin", type="string" , example="dollar"),
     *                  @OA\Property(property="value", type="float" , example="10.5"),
     *              )
     *          ),
     *      ),
     *      @OA\Parameter(
     *          name="exchange_rate",
     *          in="path",
     *          required=true,
     *          description="exchange rate ID",
     *          @OA\Schema(
     *              type="string"
     *          ),
     *     ),
     *    )
     * @param RequestValidation $request
     * @param ExchangeRate $exchangeRate
     * @return \Illuminate\Http\JsonResponse|object
     */
    public function update(RequestValidation $request, ExchangeRate $exchangeRate)
    {
        if ($status = $this->exchangeRateRepository->update($exchangeRate, $request->all())) {
            return (new SuccessResponseResource($status))
                ->response()
                ->setStatusCode(200);
        }
        return (new FailResponseResource($status))
            ->response()
            ->setStatusCode(400);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @OA\Delete (
     *     path="/exchange-rate/{exchange_rate}",
     *     summary="ExchangeRateController",
     *     @OA\Response(response="200", description="Response with success"),
     *     @OA\Response(response="404", description="Response with error"),
     *     tags={"ExchangeRate"},
     *
     *     @OA\Parameter(
     *          name="exchange_rate",
     *          in="path",
     *          required=true,
     *          description="exchange rate ID",
     *          @OA\Schema(
     *              type="string"
     *          ),
     *     ),
     *    )
     * @param ExchangeRate $exchangeRate
     * @return \Illuminate\Http\JsonResponse|object
     */
    public function destroy(ExchangeRate $exchangeRate)
    {
        if ($status = $this->exchangeRateRepository->delete($exchangeRate)) {
            return (new SuccessResponseResource($status))
                ->response()
                ->setStatusCode(200);
        }
        return (new FailResponseResource($status))
            ->response()
            ->setStatusCode(400);
    }
}
