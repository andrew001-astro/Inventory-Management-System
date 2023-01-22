<?php

namespace App\Repositories\v1;

use App\Models\ItemInvoice;
use Illuminate\Support\Facades\DB;

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

    public function getInvoiceItems($id){
        $items = DB::select('
        SELECT
        i.id as item_id,
        i.no as no,
        i.name as name,
        i.price as price,
        ii.quantity as quantity,
        ii.total as total
        FROM items_invoices as ii
        INNER JOIN items as i
        ON i.id = ii.item_id
        WHERE ii.invoice_id = ?
        ', [$id]);

        return $items;
    }

    private function fillModel($request){
        foreach ($request as $key => $value) {
            $this->itemInvoice[$key] = $value;
        }
    }
}
