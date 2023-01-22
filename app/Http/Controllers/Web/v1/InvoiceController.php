<?php

namespace App\Http\Controllers\Web\v1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Services\v1\ItemService;
use App\Services\v1\InvoiceService;
use App\Services\v1\InvoiceItemsService;
use Symfony\Component\HttpFoundation\Response;
use App\Helpers\CommonHelper;
use App\Models\Invoice;
use Illuminate\Support\Facades\DB;

class InvoiceController extends Controller
{

    private ItemService $itemService;
    private InvoiceService $invoiceService;
    private InvoiceItemsService $invoiceItemsService;

    public function __construct(ItemService $itemService, InvoiceService $invoiceService, InvoiceItemsService $invoiceItemsService)
    {
        $this->itemService = $itemService;
        $this->invoiceService = $invoiceService;
        $this->invoiceItemsService = $invoiceItemsService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Log::debug(json_encode(Invoice::paginate(10)));
        return view('invoice.index')
            ->with(['invoices' => Invoice::paginate(10)]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('invoice.create-invoice');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Log::debug(json_encode($request->all()));

        // save invoice
        $invoiceRequest = new Request();
        $invoiceRequest->replace($request->all()['invoice']);
        $invoiceReponse = $this->invoiceService->create($invoiceRequest);
        Log::debug('invoiceReponse: ' . $invoiceReponse);
        if ($invoiceReponse->getStatusCode() != Response::HTTP_CREATED)
            return $invoiceReponse;
        $invoiceId = json_decode($invoiceReponse->getContent())->id;
        $invoiceReferenceNo = json_decode($invoiceReponse->getContent())->referenceNo;
        Log::debug('Web/v1/InvoiceController::store:invoiceId: ' . $invoiceId);


        // save items and get ids
        $itemResponse = $this->itemService->createBatch($request->all()['items']);
        if ($itemResponse->getStatusCode() != Response::HTTP_CREATED)
            return $itemResponse;
        $items = json_decode($itemResponse->getContent())->data;
        Log::debug('Web/v1/InvoiceController::store:items: ' . json_encode($items));


        // save invoice items
        $invoiceItemsResponse = $this->invoiceItemsService->createBatch($items, $invoiceId);
        if ($invoiceItemsResponse->getStatusCode() != Response::HTTP_CREATED)
            return $invoiceItemsResponse;
        $savedInvoiceItemsIds = json_decode($invoiceItemsResponse->getContent())->ids;
        Log::debug('Web/v1/InvoiceController::store:invoiceItems: ' . json_encode($savedInvoiceItemsIds));

        return CommonHelper::created(['invoiceReferenceNo' => $invoiceReferenceNo]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $items = $this->invoiceItemsService->getInvoiceItems($id);
        return view('invoice.show-invoice')
            ->with(['invoice' => Invoice::find($id), 'items' => $items]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
