<?php

namespace App\Services\v1\impl;

use Illuminate\Http\Request;
use App\Repositories\v1\ItemRepository;
use App\Http\Resources\v1\ItemResource;
use App\Http\Resources\v1\ItemCollection;
use App\Services\v1\ItemService;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Exception;
use App\Helpers\CommonHelper;

class ItemServiceImpl implements ItemService
{

    private ItemRepository $itemRepository;

    public function __construct(ItemRepository $itemRepository)
    {
        $this->itemRepository = $itemRepository;
    }

    public function create(Request $request)
    {
        try {
            $id = $this->itemRepository->create(
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
            return new ItemResource($this->itemRepository->get($id));
        } catch (ModelNotFoundException $e) {
            return CommonHelper::notFound($e->getMessage());
        } catch (Exception $e) {
            return CommonHelper::internalServerError($e->getMessage());
        }
    }

    public function getAll()
    {
        try {
            return new ItemCollection($this->itemRepository->getAll());
        } catch (Exception $e) {
            return CommonHelper::internalServerError($e->getMessage());
        }
    }

    public function update(Request $request, $id)
    {
        try {
            return new ItemResource($this->itemRepository->update(CommonHelper::sanitizeRequest($request), $id));
        } catch (ModelNotFoundException $e) {
            return CommonHelper::notFound($e->getMessage());
        } catch (Exception $e) {
            return CommonHelper::internalServerError($e->getMessage());
        }
    }

    public function delete($id)
    {
        try {
            return CommonHelper::success(['deleted' => $this->itemRepository->delete($id)]);
        } catch (ModelNotFoundException $e) {
            return CommonHelper::notFound($e->getMessage());
        } catch (Exception $e) {
            return CommonHelper::internalServerError($e->getMessage());
        }
    }
}
