<?php

namespace Frontend\Theme\Http\Controllers;

use App\Http\Controllers\Controller;
use Backend\Car\Repositories\Interfaces\CarInterface;

class ThemeController extends Controller
{
    /**
     * [$carRepository description]
     * @var [type]
     */
    protected $carRepository;
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
        $listCar = $this->carRepository->getListCarHomepage(['status' => 'published'], 10);

        return view('frontend/theme::theme.index', compact('listCar'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
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

        return view('frontend/theme::theme.detail-product', compact('car'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
    }
}
