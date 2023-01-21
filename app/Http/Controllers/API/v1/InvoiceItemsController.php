<?php

namespace App\Http\Controllers\API\v1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\ItemInvoiceRequest;
use App\Services\v1\InvoiceItemsService;

class InvoiceItemsController extends Controller
{

    private InvoiceItemsService $invoiceItemsService;
    public function __construct(InvoiceItemsService $invoiceItemsService)
    {
        $this->invoiceItemsService = $invoiceItemsService;
    } 
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return $this->invoiceItemsService->getAll();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\ItemInvoiceRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ItemInvoiceRequest $request)
    {
        return $this->invoiceItemsService->create($request);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return $this->invoiceItemsService->getById($id);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\ItemInvoiceRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ItemInvoiceRequest $request, $id)
    {
        return $this->invoiceItemsService->update($request, $id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        return $this->invoiceItemsService->delete($id);
    }
}
