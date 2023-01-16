<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\API\BaseController;
use Illuminate\Http\Request;
use App\Http\Resources\Item as ItemResource;
use App\Http\Resources\ItemCollection;

use App\Item;

class ItemController extends BaseController
{
    public function index()
    {
        return $this
            ->sendResponse(
                new ItemCollection(
                    factory(
                        Item::class,
                        5
                    )
                        ->make()
                ),
                'Success'
            );
    }

    public function show($id)
    {
        return $this
            ->sendResponse(
                new ItemResource(
                    factory(
                        Item::class
                    )
                        ->make()
                ),
                'Success'
            );
    }
}
