<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class PostDetailResource extends JsonResource
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
            "description" => $this->description,
            "deadline" => $this->job_deadline,
            "experience" => $this->level->job_level,
            "job_function" => $this->category->name,
            "address" => $this->address,
        ];
    }
}
