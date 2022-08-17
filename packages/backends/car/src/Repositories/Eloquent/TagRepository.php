<?php

namespace Backend\Car\Repositories\Eloquent;

use Backend\Car\Models\Tag;
use Backend\Car\Repositories\Interfaces\EngineSizeInterface;
use Backend\Core\Repositories\Eloquent\BaseRepository;

class TagRepository extends BaseRepository implements EngineSizeInterface
{
    public function getModel()
    {
        return Tag::class;
    }
}
