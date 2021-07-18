<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\ImgKeyResource;

class ItemResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [


            "category"=>$this->category,
            "scategory"=>$this->scategory,
            "brand"=>$this->brand,
            "name"=>$this->name,
            "name_ar"=>$this->name_ar,
            "model"=>$this->model,
            "model_ar"=>$this->model_ar,
            "short"=>strip_tags($this->short),
            "short_ar"=>strip_tags($this->short_ar),
            "des"=>strip_tags($this->des),
            "des_ar"=>strip_tags($this->des_ar),
            "stock"=>$this->stock,
            "old_price"=>$this->old_price,
            "price"=>$this->price,
            "c_price"=>$this->c_price,
            "p_price"=>$this->p_price,
            "weight"=>$this->weight,
            "images"=>ImgKeyResource::collection($this->img_keys),
            "point"=>$this->point,
            "os_system"=>$this->os_system,
            "processor"=>$this->processor,
            "processor_g"=>$this->processor,
            "color"=>$this->color,
            "img_key"=>$this->img_key,
            "att_key"=>$this->att_key,
            "views"=>$this->views,
            "option_key"=>$this->option_key,
            "meta_key"=>$this->meta_key,
            "published"=>$this->published,
            "type"=>$this->type,
            "seller"=>$this->seller,
            "agent"=>$this->agent,
            "date"=>$this->date,
            "time"=>$this->time,
            "API_code"=>$this->API_code,
            "url"=>$this->url,
        ];
    }
}
