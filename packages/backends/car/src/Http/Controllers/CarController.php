<?php

namespace Backend\Car\Http\Controllers;

use App\Http\Controllers\Controller;
use Backend\Car\Http\Requests\CarRequest;
use Backend\Car\Repositories\Interfaces\CarInterface;

class CarController extends Controller
{
    /**
     * [$carRepository description]
     * @var [type]
     */
    protected $carRepository;
    /**
     * [__contruct description]
     * @param  CarInterface $carRepository [description]
     * @return [type]                       [description]
     */
    public function __construct(CarInterface $carRepository)
    {
        $this->carRepository = $carRepository;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $cars = $this->carRepository->paginate(1);

        return view('backend/car::index', compact('cars'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend/car::create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CarRequest $request)
    {
        $inputs = $request->only('name', 'make', 'model', 'engin_size', 'registration', 'price', 'status');
        if ($this->carRepository->create($inputs)) {
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

        return view('backend/car::show', compact('car'));
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

        return view('backend/car::edit', compact('car'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(CarRequest $request, $id)
    {
        $inputs = $request->only('name', 'make', 'model', 'engin_size', 'registration', 'price', 'status');

        if ($this->carRepository->update($id, $inputs)) {
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

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroys($id)
    {
        //
    }
}
