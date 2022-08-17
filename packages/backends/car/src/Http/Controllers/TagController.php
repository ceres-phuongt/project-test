<?php

namespace Backend\Car\Http\Controllers;

use App\Http\Controllers\Controller;
use Backend\Car\Http\Requests\TagRequest;
use Backend\Car\Repositories\Interfaces\TagInterface;

class TagController extends Controller
{
    /**
     * [$tagRepository description]
     * @var [type]
     */
    protected $tagRepository;

    /**
     * [__contruct description]
     * @param  TagInterface  $tagRepository  [description]
     * @return [type]                       [description]
     */
    public function __construct(TagInterface $tagRepository)
    {
        $this->tagRepository = $tagRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tags = $this->tagRepository->paginate(10);

        return view('backend/car::tag.index', compact('tags'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend/car::tag.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(TagRequest $request)
    {
        $inputs = $request->only('name', 'description', 'status');
        if ($this->tagRepository->create($inputs)) {
            toastr()->success('Create tag success');
        } else {
            toastr()->error('Something went wrong!');
        }

        return redirect()->route('tag.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $tag = $this->tagRepository->find($id);

        return view('backend/car::tag.show', compact('tag'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $tag = $this->tagRepository->find($id);

        return view('backend/car::tag.edit', compact('tag'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(TagRequest $request, $id)
    {
        $inputs = $request->only('name', 'description', 'status');

        if ($this->tagRepository->update($id, $inputs)) {
            toastr()->success('Update tag success');
        } else {
            toastr()->error('Something went wrong!');
        }

        return redirect()->route('tag.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if ($deleted = $this->tagRepository->delete($id)) {
            toastr()->success('Delete tag success');
        } else {
            toastr()->error('Something went wrong!');
        }

        return redirect()->route('tag.index');
    }
}
