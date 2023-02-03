<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
    //    return [
    //         "product_id" => $this->id,
    //         "name" => $this->name,
    //         "description" => $this->descirption,
    //         "price" => $this->price,
    //         "qty" => $this->qty,
    //         "discount" => $this->discount,
    //         "photo" => $this->image ? assert("storage/product/" . $this->photo) : null,
    //         "category_name" => $this->category->name
    //     ];
    return [
        "product_id" => $this->id,
        "name" => $this->name,
        "description" => $this->description,
        "price" => $this->price,
        "discount" => $this->discount,
        "photo" => $this->photo ? asset("storage/product/" . $this->photo) : null,
        "category_name" => $this->category->name
    ];
    }
}
