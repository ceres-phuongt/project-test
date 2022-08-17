<?php

namespace Backend\Car\Http\Controllers;

use App\Http\Controllers\Controller;
use Backend\Car\Http\Requests\EngineSizeRequest;
use Backend\Car\Repositories\Interfaces\EngineSizeInterface;

class EngineSizeController extends Controller
{
    /**
     * [$engineSizeRepository description]
     * @var [type]
     */
    protected $engineSizeRepository;

    /**
     * [__contruct description]
     * @param  EngineSizeInterface  $engineSizeRepository  [description]
     * @return [type]                       [description]
     */
    public function __construct(EngineSizeInterface $engineSizeRepository)
    {
        $this->engineSizeRepository = $engineSizeRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $engineSizes = $this->engineSizeRepository->paginate(10);

        return view('backend/car::engine-size.index', compact('engineSizes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend/car::engine-size.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(EngineSizeRequest $request)
    {
        $inputs = $request->only('name', 'description', 'status');
        if ($this->engineSizeRepository->create($inputs)) {
            toastr()->success('Create engine size success');
        } else {
            toastr()->error('Something went wrong!');
        }

        return redirect()->route('engine-size.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $engineSize = $this->engineSizeRepository->find($id);

        return view('backend/car::engine-size.show', compact('engineSize'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $engineSize = $this->engineSizeRepository->find($id);

        return view('backend/car::engine-size.edit', compact('engineSize'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(EngineSizeRequest $request, $id)
    {
        $inputs = $request->only('name', 'description', 'status');

        if ($this->engineSizeRepository->update($id, $inputs)) {
            toastr()->success('Update engine size success');
        } else {
            toastr()->error('Something went wrong!');
        }

        return redirect()->route('engine-size.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if ($deleted = $this->engineSizeRepository->delete($id)) {
            toastr()->success('Delete engine size success');
        } else {
            toastr()->error('Something went wrong!');
        }

        return redirect()->route('engine-size.index');
    }
}
