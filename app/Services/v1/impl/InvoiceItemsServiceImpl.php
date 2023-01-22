<?php

namespace App\Services\v1\impl;

use Illuminate\Http\Request;
use App\Repositories\v1\InvoiceItemsRepository;
use App\Http\Resources\v1\InvoiceItemsResource;
use App\Http\Resources\v1\InvoiceItemsCollection;
use App\Services\v1\InvoiceItemsService;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Exception;
use App\Helpers\CommonHelper;
use Illuminate\Support\Facades\Log;

class InvoiceItemsServiceImpl implements InvoiceItemsService
{

    private InvoiceItemsRepository $invoiceItemsRepository;

    public function __construct(InvoiceItemsRepository $invoiceItemsRepository)
    {
        $this->invoiceItemsRepository = $invoiceItemsRepository;
    }

    public function create(Request $request)
    {
        try {
            $id = $this->invoiceItemsRepository->create(
                CommonHelper::sanitizeRequest($request)
            );

            return CommonHelper::created(['id' => $id]);
        } catch (Exception $e) {
            return CommonHelper::internalServerError($e->getMessage());
        }
    }


    public function getById($id)
    {
        try {
            return new InvoiceItemsResource($this->invoiceItemsRepository->get($id));
        } catch (ModelNotFoundException $e) {
            return CommonHelper::notFound($e->getMessage());
        } catch (Exception $e) {
            return CommonHelper::internalServerError($e->getMessage());
        }
    }

    public function getAll()
    {
        try {
            return new InvoiceItemsCollection($this->invoiceItemsRepository->getAll());
        } catch (Exception $e) {
            return CommonHelper::internalServerError($e->getMessage());
        }
    }

    public function update(Request $request, $id)
    {
        try {
            return new InvoiceItemsResource($this->invoiceItemsRepository->update(CommonHelper::sanitizeRequest($request), $id));
        } catch (ModelNotFoundException $e) {
            return CommonHelper::notFound($e->getMessage());
        } catch (Exception $e) {
            return CommonHelper::internalServerError($e->getMessage());
        }
    }

    public function delete($id)
    {
        try {
            return CommonHelper::success(['deleted' => $this->invoiceItemsRepository->delete($id)]);
        } catch (ModelNotFoundException $e) {
            return CommonHelper::notFound($e->getMessage());
        } catch (Exception $e) {
            return CommonHelper::internalServerError($e->getMessage());
        }
    }

    public function createBatch($items, $invoiceId)
    {
        try {
            $savedIds = [];
            foreach ($items as $key => $value) {
                $invoiceItemsRequest = new Request();
                $value->invoiceId = $invoiceId;
                $invoiceItemsRequest->replace((array)$value);
                $id = $this->invoiceItemsRepository->create(
                    CommonHelper::sanitizeRequest($invoiceItemsRequest)
                );
                array_push($savedIds, $id);
            }
            return CommonHelper::created(['ids' =>  $savedIds]);
        } catch (Exception $e) {
            return CommonHelper::internalServerError($e->getMessage());
        }
    }

    public function getInvoiceItems($id)
    {
        try {
            return $this->invoiceItemsRepository->getInvoiceItems($id);
        } catch (ModelNotFoundException $e) {
            return CommonHelper::notFound($e->getMessage());
        } catch (Exception $e) {
            return CommonHelper::internalServerError($e->getMessage());
        }
    }
}
