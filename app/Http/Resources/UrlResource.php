<?php

namespace App\Http\Resources;

use App\Models\Url;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @property Url $resource
 */
class UrlResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request): array
    {
        return [
            'id' => $this->resource->id,
            'short_url' => $this->resource->short_url,
            'full_short_url' => $this->resource->full_short_url,
            'visited_count' => $this->resource->visited_count
        ];
    }
}
