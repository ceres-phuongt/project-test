<?php

namespace Backend\Car\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Http\Request;

class CarRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $rules = [
            'name'           => 'required|max:255|unique:cars,name',
            'model'          => 'nullable|string|max:255',
            'make_id'        => 'nullable|exists:makes,id',
            'engine_size_id' => 'nullable|exists:engine_sizes,id',
            'registration'   => 'nullable|string|max:2048',
            'price'          => 'nullable|numeric',
            'image'          => 'nullable|string|max:255',
            'status'         => Rule::in(['published', 'draft', 'pending']),
        ];

        $input = Request::only('id');
        if (!empty($input['id'])) {
            $rules['name']    .= ','. $input['id'] .',id';
        }

        return $rules;
    }
}
