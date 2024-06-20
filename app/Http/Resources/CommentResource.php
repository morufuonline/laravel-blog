<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use App\Helpers\GeneralHelper;
use App\Http\Resources\UserResource;

class CommentResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        //return parent::toArray($request);
        return [
            "id" => $this->id,
            "user" => new UserResource($this->user),
            "post_id" => $this->post_id,
            "body" => $this->body,
            "created_at" => GeneralHelper::min_full_date($this->created_at),
            "updated_at" => GeneralHelper::min_full_date($this->updated_at),
        ];
    }
}
