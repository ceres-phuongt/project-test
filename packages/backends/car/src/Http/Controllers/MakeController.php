<?php

namespace Backend\Car\Http\Controllers;

use App\Http\Controllers\Controller;
use Backend\Car\Http\Requests\MakeRequest;
use Backend\Car\Repositories\Interfaces\MakeInterface;

class MakeController extends Controller
{
    /**
     * [$makeRepository description]
     * @var [type]
     */
    protected $makeRepository;

    /**
     * [__contruct description]
     * @param  MakeInterface  $makeRepository  [description]
     * @return [type]                       [description]
     */
    public function __construct(MakeInterface $makeRepository)
    {
        $this->makeRepository = $makeRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $makes = $this->makeRepository->paginate(10);

        return view('backend/car::make.index', compact('makes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend/car::make.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(MakeRequest $request)
    {
        $inputs = $request->only('name', 'description', 'status');
        if ($this->makeRepository->create($inputs)) {
            toastr()->success('Create make success');
        } else {
            toastr()->error('Something went wrong!');
        }

        return redirect()->route('make.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $make = $this->makeRepository->find($id);

        return view('backend/car::make.show', compact('make'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $make = $this->makeRepository->find($id);

        return view('backend/car::make.edit', compact('make'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(MakeRequest $request, $id)
    {
        $inputs = $request->only('name', 'description', 'status');

        if ($this->makeRepository->update($id, $inputs)) {
            toastr()->success('Update make success');
        } else {
            toastr()->error('Something went wrong!');
        }

        return redirect()->route('make.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if ($deleted = $this->makeRepository->delete($id)) {
            toastr()->success('Delete make success');
        } else {
            toastr()->error('Something went wrong!');
        }

        return redirect()->route('make.index');
    }
}
