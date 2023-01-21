<?php

namespace App\Repositories\v1;

use App\Models\ItemInvoice;

class InvoiceItemsRepository
{

    private ItemInvoice $itemInvoice;

    public function __construct(ItemInvoice $itemInvoice)
    {
        $this->itemInvoice = $itemInvoice;
    }

    public function create($itemInvoice)
    {
        return $this->itemInvoice->create($itemInvoice)->id;
    }

    public function update($request, $id)
    {
        $this->itemInvoice = $this->get($id);
        $this->fillModel($request);
        $this->itemInvoice->save();
        return $this->itemInvoice;
    }

    public function delete($id): bool
    {
        $this->itemInvoice = $this->get($id);
        return $this->itemInvoice->delete();
    }

    public function get($id)
    {
        return $this->itemInvoice->findOrFail($id);
    }

    public function getAll()
    {
        return $this->itemInvoice->paginate(10);
    }

    private function fillModel($request){
        foreach ($request as $key => $value) {
            $this->itemInvoice[$key] = $value;
        }
    }
}
