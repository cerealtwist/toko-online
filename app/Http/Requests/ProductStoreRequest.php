<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductStoreRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        if(request()->isMethod('post')) {
            return [
                'name' => 'required|string|max:258',
                'category_id' => 'required',
                'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
                'price' =>'required|numeric|min:0',
                'quantity' => 'required'
            ];
        } else {
            return [
                'name' => 'required|string|max:258',
                'category_id' => 'required',
                'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
                'price' =>'required|numeric|min:0',
                'quantity' => 'required'
            ];
        }
    }
    public function messages()
    {
        if(request()->isMethod('post')) {
            return [
                'name.required' => 'Name is required!',
                'category_id.required' => 'Type is required!',
                'image.required' => 'Image is required!',
                'price.required' => 'Price is required!',
                'quantity.required' => 'Quantity is required!'
            ];
        } else {
            return [
                'name.required' => 'Name is required!',
                'category_id.required' => 'Type is required!',
                'price.required' => 'Price is required!',
                'quantity.required' => 'Quantity is required!'
            ];   
        }
    }
}
