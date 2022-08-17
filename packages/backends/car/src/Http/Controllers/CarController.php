<?php

namespace Backend\Car\Http\Controllers;

use App\Http\Controllers\Controller;
use Backend\Car\Http\Requests\CarRequest;
use Backend\Car\Repositories\Interfaces\CarInterface;
use Backend\Car\Repositories\Interfaces\EngineSizeInterface;
use Backend\Car\Repositories\Interfaces\MakeInterface;
use Backend\Car\Services\StoreTagService;

class CarController extends Controller
{
    /**
     * [$carRepository description]
     * @var [type]
     */
    protected $carRepository;
    /**
     * [$makeRepository description]
     * @var [type]
     */
    protected $makeRepository;
    /**
     * [$engineSizeRepository description]
     * @var [type]
     */
    protected $engineSizeRepository;
    /**
     * [__construct description]
     * @param CarInterface        $carRepository        [description]
     * @param EngineSizeInterface $engineSizeRepository [description]
     * @param MakeInterface       $makeRepository       [description]
     */
    public function __construct(CarInterface $carRepository, EngineSizeInterface $engineSizeRepository, MakeInterface $makeRepository)
    {
        $this->carRepository = $carRepository;
        $this->engineSizeRepository = $engineSizeRepository;
        $this->makeRepository = $makeRepository;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $cars = $this->carRepository->paginate(10);

        return view('backend/car::car.index', compact('cars'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $makes = $this->makeRepository->findWhere(['status' => 'published']);
        $engineSizes = $this->engineSizeRepository->findWhere(['status' => 'published']);

        return view('backend/car::car.create', compact('makes', 'engineSizes'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CarRequest $request, StoreTagService $tagService)
    {
        $inputs = $request->only('name', 'make_id', 'model', 'engine_size_id', 'registration', 'price', 'status');
        $car = $this->carRepository->create($inputs);
        if ($car) {
            $tagService->execute($request, $car);
            toastr()->success('Create car success');
        } else {
            toastr()->error('Something went wrong!');
        }

        return redirect()->route('car.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $car = $this->carRepository->find($id);
        $makes = $this->makeRepository->findWhere(['status' => 'published']);
        $engineSizes = $this->engineSizeRepository->findWhere(['status' => 'published']);

        return view('backend/car::car.show', compact('car', 'makes', 'engineSizes'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $car = $this->carRepository->find($id);
        $makes = $this->makeRepository->findWhere(['status' => 'published']);
        $engineSizes = $this->engineSizeRepository->findWhere(['status' => 'published']);

        return view('backend/car::car.edit', compact('car', 'makes', 'engineSizes'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(CarRequest $request, $id, StoreTagService $tagService)
    {
        $inputs = $request->only('name', 'make_id', 'model', 'engine_size_id', 'registration', 'price', 'status');
        $car = $this->carRepository->update($id, $inputs);
        if ($car) {
            $tagService->execute($request, $car);
            toastr()->success('Update car success');
        } else {
            toastr()->error('Something went wrong!');
        }

        return redirect()->route('car.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if ($deleted = $this->carRepository->delete($id)) {
            toastr()->success('Delete car success');
        } else {
            toastr()->error('Something went wrong!');
        }

        return redirect()->route('car.index');
    }
}
