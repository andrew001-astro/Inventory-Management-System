<?php

namespace App\Repositories\v1;

use App\Models\Item;

class ItemRepository
{

    private Item $item;
    
    public function __construct(Item $item)
    {
        $this->item = $item;
    }

    public function create($item)
    {
        return $this->item->create($item)->id;
    }

    public function update($request, $id)
    {
        $this->item = $this->get($id);
        $this->fillModel($request);
        $this->item->save();
        return $this->item;
    }

    public function delete($id): bool
    {
        $this->item = $this->get($id);
        return $this->item->delete();
    }

    public function get($id)
    {
        return $this->item->findOrFail($id);
    }

    public function getAll()
    {
        return $this->item->paginate(10);
    }

    private function fillModel($request){
        foreach ($request as $key => $value) {
            $this->item[$key] = $value;
        }
    }
}
