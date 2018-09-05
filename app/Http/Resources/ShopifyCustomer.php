<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;

class ShopifyCustomer extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'email' => $this->resource['email'],
            'first_name' => $this->resource['first_name'],
            'last_name' => $this->resource['last_name'],
        ];
    }
}
