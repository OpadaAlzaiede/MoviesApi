<?php

namespace Modules\Movie\Transformers;

use Illuminate\Http\Resources\Json\JsonResource;

class MovieResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'rate' => $this->rate,
            'date' => $this->date,
            'duartion' => $this->duration,
            'country' => $this->country,
            'category' => array_map( function($category) {
                return [
                    'id' => $category['id'],
                    'name' => $category['name']
                ];
            }, $this->category()->get()->toArray())
        ];
    }
}
