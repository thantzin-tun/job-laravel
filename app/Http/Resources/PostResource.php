<?php

namespace App\Http\Resources;

use Carbon\Carbon;
use Illuminate\Support\Str;
use Illuminate\Http\Resources\Json\JsonResource;

class PostResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            "id" => $this->id,
            "title" => $this->title,
            "logo" => $this->logo,
            "company_name" => $this->company_name,
            "salary" => $this->salary,
            "location" => $this->city->name,
            "description" => Str::limit($this->description, 30, '...'),
            "job_function" => $this->category->name,
        ];
    }
}
