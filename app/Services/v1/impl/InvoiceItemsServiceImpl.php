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

class InvoiceItemsServiceImpl implements InvoiceItemsService
{

    private InvoiceItemsRepository $InvoiceItemsRepository;

    public function __construct(InvoiceItemsRepository $InvoiceItemsRepository)
    {
        $this->InvoiceItemsRepository = $InvoiceItemsRepository;
    }

    public function create(Request $request)
    {
        try {
            $id = $this->InvoiceItemsRepository->create(
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
            return new InvoiceItemsResource($this->InvoiceItemsRepository->get($id));
        } catch (ModelNotFoundException $e) {
            return CommonHelper::notFound($e->getMessage());
        } catch (Exception $e) {
            return CommonHelper::internalServerError($e->getMessage());
        }
    }

    public function getAll()
    {
        try {
            return new InvoiceItemsCollection($this->InvoiceItemsRepository->getAll());
        } catch (Exception $e) {
            return CommonHelper::internalServerError($e->getMessage());
        }
    }

    public function update(Request $request, $id)
    {
        try {
            return new InvoiceItemsResource($this->InvoiceItemsRepository->update(CommonHelper::sanitizeRequest($request), $id));
        } catch (ModelNotFoundException $e) {
            return CommonHelper::notFound($e->getMessage());
        } catch (Exception $e) {
            return CommonHelper::internalServerError($e->getMessage());
        }
    }

    public function delete($id)
    {
        try {
            return CommonHelper::success(['deleted' => $this->InvoiceItemsRepository->delete($id)]);
        } catch (ModelNotFoundException $e) {
            return CommonHelper::notFound($e->getMessage());
        } catch (Exception $e) {
            return CommonHelper::internalServerError($e->getMessage());
        }
    }
}
