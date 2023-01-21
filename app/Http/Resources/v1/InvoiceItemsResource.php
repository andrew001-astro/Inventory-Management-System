<?php

namespace App\Http\Resources\v1;

use Illuminate\Http\Resources\Json\JsonResource;

class InvoiceItemsResource extends JsonResource
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
            'id' => $this->id,
            'itemId' => $this->item_id,
            'invoiceId' => $this->invoice_id,
            'quantity' => $this->quantity,
            'total' => $this->total
        ];
    }
}
