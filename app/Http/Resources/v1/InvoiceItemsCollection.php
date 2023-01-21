<?php

namespace App\Http\Resources\v1;

use Illuminate\Http\Resources\Json\ResourceCollection;

class InvoiceItemsCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    // public function toArray($request)
    // {
    //     return parent::toArray($request);
    // }

    public $collects = 'App\Http\Resources\v1\InvoiceItemsResource';
}
