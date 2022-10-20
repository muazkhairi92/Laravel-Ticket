<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class TicketResource extends JsonResource
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
            'id'=>$this->id,
            'title'=>$this->title,
            'description'=>$this->description,
            'support_name'=>$this->user->name,
            'developer_name'=>$this->developer->name,
            'category'=>$this->category->category,
            'level'=>$this->priorityLevel->level,
            'status'=>$this->status->status,
            'developer_notes'=>$this->developer_notes,
        ];
    }
}
