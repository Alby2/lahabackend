<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class CoursResource extends JsonResource
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
            "id"=>(string)$this->id,
            "attributes" =>[
                "titre"=> $this->titre,
                "description"=>$this->description,
                "created_at"=>$this->createdAt,
                "updated_at"=>$this->updatedAt,
            ],
            "relationships"=>[

            ],

        ];
    }
}
