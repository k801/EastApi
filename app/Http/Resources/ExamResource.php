<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ExamResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return
        [
            'id'=>$this->id,
            'name'=>$this->name,
            'description'=>$this->desc,
            'duration mintues'=>$this->duration_mins
        ];
    }
}
