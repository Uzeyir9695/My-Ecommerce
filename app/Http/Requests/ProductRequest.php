<?php

namespace App\Http\Requests;

use App\Models\Subcategory;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;
use function PHPUnit\Framework\at;

class ProductRequest extends FormRequest
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
//        $inputs =implode(',', ['category_id', 'subcategory_id', 'description', 'quantity', 'images']);
        return [
            'category_id' => 'required|integer',
            'subcategory_id' => 'required|integer',
            'name' => 'bail|required|min:3|max:100',
            'price' => 'bail|required|max:255',
            'description' => 'required|min: 5|max: 500',
            'quantity' => 'required|max:10000',
            'discount' => 'nullable|integer|max:100',
            'images' => 'required',
            'images.*' => 'bail|required|image|mimes:jpg,png,jpeg,gif,svg|max:2048|dimensions:min_width=100,min_height=100,max_width=2000,max_height=2000',
            'agreed' => 'required|in:true',
            ] + (request()->filled('subcategory_id') ? $this->dynamicData()[1] : []);
    }

    public function messages()
    {
        return [
            'category_id.required' => 'The category is required!',
            'subcategory_id.required' => 'The subcategory is required!',
            'agreed.required_with_all' => 'Almost done! Just agree to our terms and conditions and continue.',
        ];
    }

    public function dynamicData()
    {
        if (request()->has('subcategory_id')){
                $json = request('attributes');
                $dataArray = json_decode($json, true);

            $stringKeys = implode(',', array_map(function ($key) {
                return Str::snake(strtolower($key));
            }, array_keys($dataArray)));

            $assocArray = collect($dataArray)->mapWithKeys(function ($value, $key) {
                return [Str::snake(strtolower($key)) => 'required_with:subcategory_id,*'];
            })->all();

            return [$stringKeys, $assocArray];
        }
    }
}
