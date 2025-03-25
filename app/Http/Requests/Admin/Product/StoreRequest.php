<?php

namespace App\Http\Requests\Admin\Product;

use Illuminate\Foundation\Http\FormRequest;

class StoreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'product.title' => 'required|string|max:255',
            'product.article' => 'required|string|max:255|unique:products,article',
            'product.description' => 'required|string',
            'product.content' => 'required|string',
            'product.price' => 'required|numeric',
            'product.old_price' => 'numeric',
            'product.qty' => 'required|integer',
            'product.parent_id' => 'nullable|integer|exists:products,id',
            'product.category_id' => 'required|integer|exists:categories,id',
            'product.product_group_id' => 'required|integer|exists:product_groups,id',
            'images' => 'nullable|array',
            'images.*' => 'required|file',
            'params' => 'nullable|array',
            'params.*.id' => 'required|integer|exists:params,id',
            'params.*.value' => 'required|string',
        ];
    }

    public function passedValidation()
    {
        $validated = $this->validated();

        return $this->merge([
            'product' => $validated['product'],
            'params' => $validated['params'] ?? [],
            'images' => $this->images ?? []
        ]);
    }
}
