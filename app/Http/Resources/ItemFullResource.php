<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ItemFullResource extends JsonResource
{
	/**
	 * Transform the resource into an array.
	 *
	 * @param \Illuminate\Http\Request $request
	 * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
	 */
	public function toArray($request)
	{
		return [
			"name" => $this->name . " - " . $this->model_type,
			"available" => $this->available,
			"category_id" => $this->category_id,
			"created_at" => $this->created_at,
			"id" => $this->id,
			"image" => $this->image,
			"model_country" => $this->model_country,
			"model_type" => $this->model_type,
			"model_year" => $this->model_year,
			"price" => $this->price,
			"updated_at" => $this->updated_at,
		];
	}
}
