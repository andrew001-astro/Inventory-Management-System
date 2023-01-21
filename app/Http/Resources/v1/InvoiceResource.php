<?php

namespace App\Http\Resources\v1;

use Illuminate\Http\Resources\Json\JsonResource;

class InvoiceResource extends JsonResource
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
            'referenceNo' => $this->reference_no,
            'senderId' => $this->sender_id,
            'recipientName' => $this->recipient_name,
            'recipientAddress' => $this->recipient_address,
            'subTotal' => $this->sub_total,
            'taxRate' => $this->tax_rate,
            'taxAmount' => $this->tax_amount,
            'total' => $this->total,
            'amountPaid' => $this->amount_paid,
            'amountDue' => $this->amount_due,
            'notes' => $this->notes
        ];
    }
}
