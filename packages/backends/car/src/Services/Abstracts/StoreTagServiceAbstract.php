<?php

namespace Backend\Car\Services\Abstracts;

use Backend\Car\Models\Car;
use Backend\Car\Repositories\Interfaces\TagInterface;
use Illuminate\Http\Request;

abstract class StoreTagServiceAbstract
{
    /**
     * @var TagInterface
     */
    protected $tagRepository;

    /**
     * StoreTagService constructor.
     * @param TagInterface $tagRepository
     */
    public function __construct(TagInterface $tagRepository)
    {
        $this->tagRepository = $tagRepository;
    }

    /**
     * @param Request $request
     * @param Car $car
     * @return mixed
     */
    abstract public function execute(Request $request, Car $car);
}
