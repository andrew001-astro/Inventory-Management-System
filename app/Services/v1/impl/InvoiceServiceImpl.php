<?php

namespace App\Services\v1\impl;

use Illuminate\Http\Request;
use App\Repositories\v1\InvoiceRepository;
use App\Http\Resources\v1\InvoiceResource;
use App\Http\Resources\v1\InvoiceCollection;
use App\Services\v1\InvoiceService;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Exception;
use App\Helpers\CommonHelper;

class InvoiceServiceImpl implements InvoiceService
{

    private InvoiceRepository $InvoiceRepository;

    public function __construct(InvoiceRepository $InvoiceRepository)
    {
        $this->InvoiceRepository = $InvoiceRepository;
    }

    public function create(Request $request)
    {
        try {
            $id = $this->InvoiceRepository->create(
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
            return new InvoiceResource($this->InvoiceRepository->get($id));
        } catch (ModelNotFoundException $e) {
            return CommonHelper::notFound($e->getMessage());
        } catch (Exception $e) {
            return CommonHelper::internalServerError($e->getMessage());
        }
    }

    public function getAll()
    {
        try {
            return new InvoiceCollection($this->InvoiceRepository->getAll());
        } catch (Exception $e) {
            return CommonHelper::internalServerError($e->getMessage());
        }
    }

    public function update(Request $request, $id)
    {
        try {
            return new InvoiceResource($this->InvoiceRepository->update(CommonHelper::sanitizeRequest($request), $id));
        } catch (ModelNotFoundException $e) {
            return CommonHelper::notFound($e->getMessage());
        } catch (Exception $e) {
            return CommonHelper::internalServerError($e->getMessage());
        }
    }

    public function delete($id)
    {
        try {
            return CommonHelper::success(['deleted' => $this->InvoiceRepository->delete($id)]);
        } catch (ModelNotFoundException $e) {
            return CommonHelper::notFound($e->getMessage());
        } catch (Exception $e) {
            return CommonHelper::internalServerError($e->getMessage());
        }
    }
}
