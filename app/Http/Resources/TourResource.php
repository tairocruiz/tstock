<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource as Resource;

class TourResource extends Resource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
//        return parent::toArray($request);

        return [
            'id' => $this->id,
            'name' => $this->name,
            'slug' => $this->slug,
            'seo_title' => $this->seo_title,
            'meta_description' => $this->meta_description,
            'overview' => $this->overview,
            'map' => $this->map,
            'days' => $this->days,
            'price' => $this->price,
            'best_time' => $this->best_time,
            'useful_information' => $this->useful_information,
            'tour_days' => d2dresource::collection($this->tour_days),
            'categories' => TourCategoryResource::collection($this->categories),
            'featured' => (int)$this->featured,
            'photo' => $this->photo,
        ];
    }
}
