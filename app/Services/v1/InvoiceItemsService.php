<?php

namespace App\Services\v1;
use Illuminate\Http\Request;

interface InvoiceItemsService
{
    public function create(Request $request);

    public function getById($id);

    public function getAll();

    public function update(Request $request, $id);

    public function delete($id);
}
