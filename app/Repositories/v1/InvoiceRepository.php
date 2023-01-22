<?php

namespace App\Repositories\v1;

use App\Models\Invoice;
use Illuminate\Support\Facades\DB;

class InvoiceRepository
{

    private Invoice $invoice;

    public function __construct(Invoice $invoice)
    {
        $this->invoice = $invoice;
    }

    public function create($invoice)
    {
        return $this->invoice->create($invoice)->id;
    }

    public function update($request, $id)
    {
        $this->invoice = $this->get($id);
        $this->fillModel($request);
        $this->invoice->save();
        return $this->invoice;
    }

    public function delete($id): bool
    {
        $this->invoice = $this->get($id);
        return $this->invoice->delete();
    }

    public function get($id)
    {
        return $this->invoice->findOrFail($id);
    }

    public function getAll()
    {
        return $this->invoice->paginate(10);
    }

  

    private function fillModel($request){
        foreach ($request as $key => $value) {
            $this->invoice[$key] = $value;
        }
    }
}
