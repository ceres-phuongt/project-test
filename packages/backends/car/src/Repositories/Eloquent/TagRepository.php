<?php

namespace Backend\Car\Repositories\Eloquent;

use Backend\Car\Models\Tag;
use Backend\Car\Repositories\Interfaces\TagInterface;
use Backend\Core\Repositories\Eloquent\BaseRepository;

class TagRepository extends BaseRepository implements TagInterface
{
    public function getModel()
    {
        return Tag::class;
    }
}
