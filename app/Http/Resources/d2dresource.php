<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource as Resource;

class d2dresource extends Resource
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
            'day_id' => $this->id,
            'tour_id' => $this->tour_id,
            'day_order' => $this->day_order,
            'day_title' => $this->day_title,
            'day_description' => $this->day_description,
            'day_photo1' => $this->day_photo1,
            'day_photo2' => $this->day_photo2
        ];
    }
}
