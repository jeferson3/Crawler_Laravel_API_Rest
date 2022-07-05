<?php

namespace App\Http\Resources;

use App\Http\Resources\RefriplayService\StoreSearch;
use App\Http\Resources\RefriplayService\StoreSearchRS;
use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use JsonSerializable;

class PaginationResponseResource extends JsonResource
{

    /**
     * Transform the resource into an array.
     *
     * @param  Request  $request
     * @return array|Arrayable|JsonSerializable
     */
    public function toArray($request): array|JsonSerializable|Arrayable
    {
        return [
            'status'    => true,
            'timestamp' => now(),
            'data'      => $this->resource['data'],
            'page'      => intval($this->resource['page']),
            'per_page'  => intval($this->resource['per_page']),
            'total'     => intval($this->resource['total'])
        ];
    }
}
