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
        $this->item->create($item);
    }

    public function update()
    {
    }

    public function delete()
    {
    }

    public function get($id)
    {
        return $this->item->find($id);
    }

    public function getAll()
    {
        return $this->item->paginate(10);
    }
}
