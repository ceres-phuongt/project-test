<?php

namespace Backend\Car\Services;

use Backend\Car\Models\Car;
use Backend\Car\Services\Abstracts\StoreTagServiceAbstract;
use Illuminate\Http\Request;

class StoreTagService extends StoreTagServiceAbstract
{
    /**
     * @param Request $request
     * @param Car $car
     * @return mixed|void
     */
    public function execute(Request $request, Car $car)
    {
        $tags = $car->tags->pluck('name')->all();

        $tagsInput = collect(json_decode($request->input('tag'), true))->pluck('value')->all();

        if (count($tags) != count($tagsInput) || count(array_diff($tags, $tagsInput)) > 0) {
            $car->tags()->detach();
            foreach ($tagsInput as $tagName) {
                if (!trim($tagName)) {
                    continue;
                }

                $tag = $this->tagRepository->getFirstBy(['name' => $tagName]);

                if ($tag === null && !empty($tagName)) {
                    $tag = $this->tagRepository->updateOrCreate([
                        'name'        => $tagName
                    ]);

                    $request->merge(['slug' => $tagName]);
                }

                if (!empty($tag)) {
                    $car->tags()->attach($tag->id);
                }
            }
        }
    }
}
