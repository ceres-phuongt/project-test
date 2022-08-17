<?php

namespace Backend\Car\Repositories\Eloquent;

use Backend\Car\Models\EngineSize;
use Backend\Car\Repositories\Interfaces\EngineSizeInterface;
use Backend\Core\Repositories\Eloquent\BaseRepository;

class EngineSizeRepository extends BaseRepository implements EngineSizeInterface
{
    public function getModel()
    {
        return EngineSize::class;
    }
}
