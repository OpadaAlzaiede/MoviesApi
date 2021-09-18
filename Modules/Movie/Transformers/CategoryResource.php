<?php

namespace Modules\Movie\Transformers;

use Illuminate\Http\Resources\Json\JsonResource;

class CategoryResource extends JsonResource
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
            'movies' => array_map( function($movie) {
                return [
                    'id' => $movie['id'],
                    'name' => $movie['name'],
                    'rate' => $movie['rate'],
                    'duration' => $movie['duration'],
                    'contry' => $movie['country']
                ];
            }, $this->movies()->get()->toArray())
        ];
    }
}
